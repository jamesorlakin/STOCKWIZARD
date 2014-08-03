<?php
session_start();
require('settingsdbc.php');

if ($_SESSION['loggedin'] == 'yes') {
$q = "DELETE FROM simlocationslist WHERE id = '" . $_GET['id'] . "'";
$r = mysqli_query($dbc, $q);
header('Location: locationsshowlist.php?id=' . $_GET['locationid']);
} else {
header('Location: index.php?login=no');
}
?>