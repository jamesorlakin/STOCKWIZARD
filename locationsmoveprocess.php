<?php
session_start();

if ($_SESSION['loggedin'] == 'yes') {
require('settingsdbc.php');
$q = "SELECT * FROM simlist WHERE productcode = '" . $_GET['productcode'] . "'";
$r = mysqli_query($dbc, $q);
$cr = mysqli_fetch_array($r);

if($_GET['exists'] == 'yes') {
$q2 = "SELECT * FROM simlocationslist WHERE productcode = '" . $_GET['productcode'] . "' AND locationid = '{$_GET['locationid']}'";
$r2 = mysqli_query($dbc, $q2);
$cr2 = mysqli_fetch_array($r2);

$newvaluelocation = $cr2['quantity'] + $_GET['quantity'];
$q3 = "UPDATE simlocationslist SET quantity = '$newvaluelocation' WHERE productcode = '" . $_GET['productcode'] . "' AND locationid = '{$_GET['locationid']}'";
$r3 = mysqli_query($dbc, $q3);

$q5 = "UPDATE simlocationslist SET dateoftransfer = '" . $_GET['dateoftransfer'] . "' WHERE productcode = '" . $_GET['productcode'] . "' AND locationid = '{$_GET['locationid']}'";
$r5 = mysqli_query($dbc, $q5);

$newvalue = $cr['quantity'] - $_GET['quantity'];
$q4 = "UPDATE simlist SET quantity = '$newvalue' WHERE productcode = '" . $_GET['productcode'] . "'";
$r4 = mysqli_query($dbc, $q4);
header('Location: locationsshowlist.php?id=' . $_GET['locationid']);
} else {
$q2 = "INSERT INTO simlocationslist (dateoftransfer, supplier, productcode, barcode, description, quantity, unitprice, discount, vat, salesprice, locationid) VALUES ('{$_GET['dateoftransfer']}', '{$cr['supplier']}', '{$cr['productcode']}', '{$cr['barcode']}', '{$cr['description']}', '{$_GET['quantity']}', '{$cr['unitprice']}', '{$cr['discount']}', '{$cr['vat']}', '{$cr['salesprice']}', '{$_GET['locationid']}')";
$r2 = mysqli_query($dbc, $q2);

$newvalue = $cr['quantity'] - $_GET['quantity'];
$q3 = "UPDATE simlist SET quantity = '$newvalue' WHERE productcode = '" . $_GET['productcode'] . "'";
$r3 = mysqli_query($dbc, $q3);
header('Location: locationsshowlist.php?id=' . $_GET['locationid']);
}
} else {
header('Location: index.php?login=no');	
}
?>