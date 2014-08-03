<?php
session_start();

if ($_SESSION['loggedin'] == 'yes') {
$id = $_GET['id'];
require('settings.php');
$q = "DELETE FROM simlist WHERE id=$id";
$r = mysqli_query(mysqli_connect($mhost, $musr, $mpss, $mdb), $q);
if ($_GET['conflictmode'] == 'yes') {
header('Location: viewproduct.php?productcode=' . $_GET['productcode']);
} else {

if ($_GET['search'] == 'yes') {
header('Location: search.php?searchwhat=' . $_GET['searchwhat'] . '&query=' . $_GET['query'] . '#list' . $_GET['listnum']);
} else {

if ($_GET['conflictshowlist'] == 'yes') {
header('Location: conflictshowlist.php#list' . $_GET['list']);
} else {
header('Location: showlist.php?del=yes#list' . $_GET['listnum']);
}

}

}
} else {
echo '<p>Auth error</p>';
}
?>