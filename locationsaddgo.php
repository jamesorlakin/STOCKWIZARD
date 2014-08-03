<?php
session_start();
if ($_SESSION['loggedin'] == 'yes') {
require('settings.php');
$q = "INSERT INTO simlocations (name) VALUES ('" . $_GET['locname'] . "')";
$r = mysqli_query(mysqli_connect($mhost, $musr, $mpss, $mdb), $q);
sleep(1);
if ($_GET['silverlight'] == 'yes') {
header('Location: showlist.php?newlocation=yes#bottom');
} else {
header('Location: locations.php');
}
} else {
header('Location: index.php?login=no');
}
?>