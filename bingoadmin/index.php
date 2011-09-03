<?php
include('../includes/config.php');

echo "<table border=1 >";
echo "<tr>";
echo "<th>Itm Id</th>";
echo "<th>Itm Text</th>";
echo "<th colspan='2'>Actions</th>";

echo "</tr>";
$result = mysql_query("SELECT * FROM `items_itm` WHERE itm_isEnabled = 1 order by itm_id ") or trigger_error(mysql_error());
while($row = mysql_fetch_array($result)){
    foreach($row AS $key => $value) { $row[$key] = stripslashes($value); }
    echo "<tr>";
    echo "<td valign='top'>" . nl2br( $row['itm_id']) . "</td>";
    echo "<td valign='top'>" . nl2br( $row['itm_text']) . "</td>";
    echo "<td valign='top'><a href=edit.php?id={$row['itm_id']}>Edit</a></td><td><a href=delete.php?id={$row['itm_id']}>Delete</a></td> ";
    echo "</tr>";
}
echo "</table>";
echo "<a href=new.php>New Row</a>";
?>
