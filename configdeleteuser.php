<?php
session_start();

if ($_SESSION['loggedin'] == 'yes') {
if ($_SESSION['admin'] == 'yes') {
require('settingsdbc.php');
$q = "DELETE FROM simusr WHERE username = '{$_GET['username']}'";
$r = mysqli_query($dbc, $q);
header('Location: configedit.php?updated=yes');
} else {
header('Location: configedit.php');
}
} else {
header('Location: index.php?login=no');
}

?>