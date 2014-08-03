<?php
session_start();

if ($_SESSION['loggedin'] == 'yes') {
if ($_SESSION['admin'] == 'yes') {

require('settingsdbc.php');
if ($_GET['enable'] == 'yes') {
$set = "y";
} else {
$set = "n";
$q = "SELECT * FROM simusr WHERE admin = 'y'";
$r = mysqli_query($dbc, $q);
if (mysqli_num_rows($r) == 1) {
header('Location: configedit.php?oneadmin=yes');
die('Only one admin!');
}
if ($_SESSION['who'] == $_GET['username']) {
$_SESSION['admin'] = 'no';
}
}
$q = "UPDATE simusr SET admin = '$set' WHERE username = '{$_GET['username']}'";
$r = mysqli_query($dbc, $q);
header('Location: configedit.php?updated=yes');

} else {
header('Location: configedit.php');
}
} else {
header('Location: index.php?login=no');
}

?>