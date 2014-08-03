<?php
session_start();
require('settingsdbc.php');

if ($_SESSION['loggedin'] == 'yes') {
$q = "DELETE FROM simlocations WHERE id = '" . $_GET['id'] . "'";
$r = mysqli_query($dbc, $q);
$q = "DELETE FROM simlocationslist WHERE locationid = '" . $_GET['id'] . "'";
$r = mysqli_query($dbc, $q);
if ($_GET['silverlight'] == 'yes') {
header('Location: showlist.php?deletelocation=yes#bottom');
} else {
header('Location: locations.php');
}
} else {
header('Location: index.php?login=no');
}
?>