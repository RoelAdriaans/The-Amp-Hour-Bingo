<?php
$config = array(
    'dbhost' => 'localhost',
    'dbdb' => 'DB_DATABSENAME',
    'dbuser' => 'DB_USERNAME',
    'dbpass' => 'DB_PASSWORD',
    'debug' => true,
    'passwordSalt' => 'tripple5',
    'name' => 'Amphourbingo'
    );

$basePath = 'http://localhost/bingo/';

$config['directories'] = array(__DIR__);

function myautoload($name) {
    global $config;
    $name = strtolower($name);
    foreach ($config['directories'] as $dir) {
        $handler = @opendir($dir);
        if ($handler !== FALSE) {
            closedir($handler);
            // Does the file exist?
            $file = $dir."/class.".$name.".php";
            if (file_exists($file)) {
                require_once($file);
                return true;
            }
        }
    }
    return false;
}

spl_autoload_register('myautoload');


if ($config['debug'] === true) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

}

$dbLink = mysql_connect($config['dbhost'], $config['dbuser'], $config['dbpass']);
if (!$dbLink) {
    die('Could not connect: ' . mysql_error());
}

// make foo the current db
$db_selected = mysql_select_db($config['dbdb'], $dbLink);
if (!$db_selected) {
    die ('Cound not select database : ' . mysql_error());
}


mysql_set_charset('utf8',$dbLink);

// Preload the default options
// Optional, this can fail if we there is no option_opt table.
// Only in old database versions, but we have to be carefull of that.
$sql = "SELECT opt_name, opt_value FROM option_opt WHERE opt_autoload = 1";
$result = @mysql_query($sql);
if ($result) {
    while ($row = mysql_fetch_assoc($result)) {
        $config[$row['opt_name']] = $row['opt_value'];
    }
    mysql_free_result($result);
}

header("Content-type: text/html; charset=utf-8");



function printr($data, $text = "", $return = false) {
    $ret = "<font color='red'>$text</font><br>\n<pre>";
    $ret .= print_r($data, true);
    $ret .= "</pre>";
    if ($return == true) {
        return $ret;
    } else {
        echo $ret;
        return;
    }
}

?>
