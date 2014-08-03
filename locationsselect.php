<?php
session_start();

if ($_SESSION['loggedin'] == 'yes') {
echo '<title>STOCKWIZARD - Move product</title>';
include('header.htm');
require('settings.php');
echo '<p><a href="showlist.php">Back to products</a> | Select location:</p>';
echo '<form action="locationsmove.php" method="get">';
echo '<select name="locationid">';
$dbc = mysqli_connect($mhost, $musr, $mpss, $mdb);
$q = "SELECT * FROM simlocations";
$r = mysqli_query($dbc, $q);
if (mysqli_num_rows($r) == 0) {
echo '<p>No locations found! Create one to continue</p>';
} else {

while ($cr = mysqli_fetch_array($r)) {
echo '<option value="' . $cr['id'] . '">' . $cr['name'] . '</option>';
}
echo '</select>';
echo '<input name="proid" type="hidden" value="' . $_GET['proid'] . '"><input type="hidden" name="productcode" value="' . $_GET['productcode'] . '">';
echo '<input type="submit" value="Select location">';
echo '</form>';
}
} else {
header('Location: index.php?login=no');
}
?>