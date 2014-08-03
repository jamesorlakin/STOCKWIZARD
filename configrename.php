<?php
session_start();

if ($_SESSION['loggedin'] == 'yes') {
if ($_SESSION['admin'] == 'yes') {

require('settings.php');
echo '<title>STOCKWIARD - Configuration</title>';
include('header.htm');
echo '<p><a href="showlist.php">Back to products</a> | <a href="configedit.php">Back to configuration</a> | Edit setting: </p>';
$settingnames = array("usr" => "MySQL username", "pss" => "MySQL password", "host" => "MySQL host", "db" => "MySQL database name", "businessname" => "Business name", "salt" => "Salt");
$usr = $musr;
$pss = $mpss;
$db = $mdb;
$host = $mhost;
echo '<form action="configchange.php" method="get"><p>';
echo $settingnames[$_GET['setting']];
echo ': <input type="text" name="value"><input type="hidden" name="setting" value="' . $_GET['setting'] . '"></p><p>Current value: ' . $$_GET['setting'] . '</p>';
echo '<p><input type="submit" value="Save"></p></form>';

} else {
header('Location: configedit.php') ;
}
} else {
header('Location: index.php?login=no');
}
?>