<?php
include('../includes/config.php');
$id = (int) $_GET['id'];
mysql_query("UPDATE `items_itm` SET `itm_isEnabled` = '0' WHERE `items_itm`.`itm_id` =$id limit 1") ;

echo (mysql_affected_rows()) ? "Row deleted.<br /> " : "Nothing deleted.<br /> ";
?>

<a href='index.php'>Back To Listing</a>
