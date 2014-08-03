<?php
require('settingsdbc.php');

$q = "SELECT * FROM simlist WHERE barcode = '{$_GET['q']}'";
$r = mysqli_query($dbc, $q);
if (empty($_GET['q'])) {
echo '<table><tr><td><img src="ui/warning.png"></td><td>No barcode entered, barcode will be same as product code</td></tr></table>';
} else {
if (mysqli_num_rows($r) != 0) {
$cr = mysqli_fetch_array($r);
echo '<table><tr><td><img src="ui/cross.png"></td><td>Barcode conflicts with <a href="javascript:window.open(\'viewproduct.php?id=' . $cr['id'] . '\');">this</a> product</td></tr></table>';
} else {
echo '<table><tr><td><img src="ui/tick.png"></td><td>Barcode \'' . $_GET['q'] . '\' is new to database</td></tr></table>';
}
}
?>