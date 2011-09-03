<?php
include('../includes/config.php');
if (isset($_POST['submitted'])) {
    foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); }
    $sql = "INSERT INTO `items_itm` ( `itm_id` ,  `itm_text` ,  `itm_isEnabled`  ) VALUES(  NULL ,  '{$_POST['itm_text']}' ,  '1'  ) ";
    mysql_query($sql) or die(mysql_error());
    echo "Added row.<br />";
    echo "<a href='index.php'>Back To Listing</a>";
}
?>

<form action='' method='POST'>
<p><b>Itm Text:</b><br /><textarea name='itm_text'></textarea>
<p><input type='submit' value='Add Row' /><input type='hidden' value='1' name='submitted' />
</form>
