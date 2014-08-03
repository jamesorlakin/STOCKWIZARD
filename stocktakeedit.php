<?php
session_start();
if ($_SESSION['loggedin'] == 'yes') {
require('settings.php');
$dbc = mysqli_connect($mhost, $musr, $mpss, $mdb);
$rows = $_POST['count'] + 1;
$current = 1;
while ($current != $rows) {
if (empty($_POST[$current])) {
if ($_POST[$current] == 0) {
$currentid = $current . 'id';
$q = "UPDATE simlist SET quantity = " . $_POST[$current] . " WHERE id = " . $_POST[$currentid] . "";
$r = mysqli_query($dbc, $q);
}
} else {
$currentid = $current . 'id';
$q = "UPDATE simlist SET quantity = " . $_POST[$current] . " WHERE id = " . $_POST[$currentid] . "";
$r = mysqli_query($dbc, $q);
}
$current = $current + 1;
}
header('Location: stocktake.php?updated=yes');
} else {
header('Location: index.php?login=no');
}
?>