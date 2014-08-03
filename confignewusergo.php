<?php
session_start();

if ($_SESSION['loggedin'] == 'yes') {
if ($_SESSION['admin'] == 'yes') {
require('settingsdbc.php');
if ($_POST['type'] == 'admin') {
$ad = 'y';
} else {
$ad = 'n';
}
$q = "INSERT INTO simusr (username, password, admin) VALUES ('{$_POST['username']}', SHA1('{$_POST['password']}'), '$ad')";
$r = mysqli_query($dbc, $q);
header('Location: configedit.php?newuser=yes');
} else {
header('Location: configedit.php');
}
} else {
header('Location: index.php?login=no');
}

?>