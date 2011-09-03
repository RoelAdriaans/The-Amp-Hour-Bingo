<?php
include('../includes/config.php');
if (isset($_GET['id']) ) {
    $id = (int) $_GET['id'];
    if (isset($_POST['submitted'])) {
        foreach($_POST AS $key => $value) {
            $_POST[$key] = mysql_real_escape_string($value);
        }
        $sql = "UPDATE `items_itm` SET  `itm_id` =  '{$_POST['itm_id']}' ,  `itm_text` =  '{$_POST['itm_text']}' ,  `itm_isEnabled` =  '{$_POST['itm_isEnabled']}'   WHERE `itm_id` = '$id' ";
        mysql_query($sql) or die(mysql_error());
        echo (mysql_affected_rows()) ? "Edited row.<br />" : "Nothing changed. <br />";
        echo "<a href='index.php'>Back To Listing</a>";
    }
    $row = mysql_fetch_array ( mysql_query("SELECT * FROM `items_itm` WHERE `itm_id` = '$id' "));
    ?>

    <form action='' method='POST'>
    <p><b>Itm Id:</b><br /><input type='text' name='itm_id' value='<?= stripslashes($row['itm_id']) ?>' />
    <p><b>Itm Text:</b><br /><textarea name='itm_text'><?= stripslashes($row['itm_text']) ?></textarea>
    <p><b>Itm IsEnabled:</b><br /><input type='text' name='itm_isEnabled' value='<?= stripslashes($row['itm_isEnabled']) ?>' />
    <p><input type='submit' value='Edit Row' /><input type='hidden' value='1' name='submitted' />
    </form>
<?php } ?>
