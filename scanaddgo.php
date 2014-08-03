<?php
session_start();

if ($_SESSION['loggedin'] == 'yes') {
require('settingsdbc.php');
$q = "SELECT * FROM simlist WHERE barcode = '" . $_GET['barcodebox'] . "'";
$r = mysqli_query($dbc, $q);
if (mysqli_num_rows($r) == 0) {
header('Location: scanadd.php?updated=yes&problem=yes&reason=No such product with barcode ' . $_GET['barcodebox'] . ' exists in database');
} else {
$cr = mysqli_fetch_array($r);

$newquan = $cr['quantity'] + $_GET['quantity'];

$q = "UPDATE simlist SET quantity = $newquan WHERE id = {$cr['id']}";
$r = mysqli_query($dbc, $q);
header('Location: scanadd.php?updated=yes&productname=' . $cr['description'] . '&oldquantity=' . $cr['quantity'] . '&newquantity=' . $newquan . '&productbarcode=' . $_GET['barcodebox']);
}
} else {
header('index.php?login=no');
}

?>