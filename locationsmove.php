<?php
session_start();
if ($_SESSION['loggedin'] == 'yes') {
require('settings.php');
$dbc = mysqli_connect($mhost, $musr, $mpss, $mdb);
$q = "SELECT * FROM simlocationslist WHERE productcode = '" . $_GET['productcode'] . "' AND locationid = '" . $_GET['locationid'] . "'";
$r = mysqli_query($dbc, $q);
if (mysqli_num_rows($r) == 0) {
$q = "SELECT * FROM simlocations WHERE id = " . $_GET['locationid'];
$r = mysqli_query($dbc, $q);
$cr = mysqli_fetch_array($r);
$q2 = "SELECT * FROM simlist WHERE id = " . $_GET['proid'];
$r2 = mysqli_query($dbc, $q2);
$cr2 = mysqli_fetch_array($r2);
echo '<title>STOCKWIZARD - Move product</title>';
include('headerui.html');
echo '<p><a href="showlist.php">Back to products</a> | Move product:</p>';
echo '<form action="locationsmoveprocess.php" method="get"><table>';
echo '<tr><td>Quantity to move to \'' . $cr['name'] . '\': </td><td><input name="quantity" id="spinner"> / ' . $cr2['quantity'] . ' in main stock list</td></tr>';
echo '<tr><td>Date of transfer: (YYYY-MM-DD): </td><td><input name="dateoftransfer" id="datefield"></td></tr>';
echo '<tr></tr><tr></tr><tr><td>Description:</td><td>' . $cr2['description'] . '</td></tr></table><p><input type="submit" value="Move to ' . $cr['name'] . '"></p>';
echo '<input type="hidden" name="productcode" value="' . $_GET['productcode'] . '"><input type="hidden" name="proid" value="' . $_GET['proid'] . '"><input type="hidden" name="locationid" value="' . $_GET['locationid'] . '"></form></body></html>';
} else {
$q = "SELECT * FROM simlocations WHERE id = " . $_GET['locationid'];
$r = mysqli_query($dbc, $q);
$cr = mysqli_fetch_array($r);
$q2 = "SELECT * FROM simlist WHERE id = " . $_GET['proid'];
$r2 = mysqli_query($dbc, $q2);
$cr2 = mysqli_fetch_array($r2);
$q3 = "SELECT * FROM simlocationslist WHERE productcode = '" . $_GET['productcode'] . "' AND locationid = '{$_GET['locationid']}'";
$r3 = mysqli_query($dbc, $q3);
$cr3 = mysqli_fetch_array($r3);
echo '<title>STOCKWIZARD - Move product</title>';
include('headerui.html');
echo '<p><a href="showlist.php">Back to products</a> | Move product:</p>';
echo '<form action="locationsmoveprocess.php" method="get"><table>';
echo '<tr><td>Quantity to move to \'' . $cr['name'] . '\': </td><td><input name="quantity" id="spinner"> / ' . $cr2['quantity'] . ' in main stock list / ' . $cr3['quantity'] . ' in \'' . $cr['name'] . '\'</td></tr>';
echo '<tr><td>Date of transfer: (YYYY-MM-DD): </td><td><input name="dateoftransfer" id="datefield"></td></tr>';
echo '<tr></tr><tr></tr><tr><td>Product description:</td><td>' . $cr2['description'] . '</td></tr></table><p><input type="submit" value="Move to ' . $cr['name'] . '"></p>';
echo '<input type="hidden" name="productcode" value="' . $_GET['productcode'] . '"><input type="hidden" name="proid" value="' . $_GET['proid'] . '"><input type="hidden" name="locationid" value="' . $_GET['locationid'] . '">';
echo '<input type="hidden" name="exists" value="yes"></form></body></html>';
}
} else {
header('Location: index.php?login=no');
}
?>