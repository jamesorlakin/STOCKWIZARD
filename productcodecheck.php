<?php
require('settingsdbc.php');

$q = "SELECT * FROM simlist WHERE productcode = '{$_GET['q']}'";
$r = mysqli_query($dbc, $q);
if (empty($_GET['q'])) {
echo '<table><tr><td><img src="ui/warning.png"></td><td>No product code entered, unable to move product without!</td></tr></table>';
} else {
if (mysqli_num_rows($r) != 0) {
$cr = mysqli_fetch_array($r);
echo '<table><tr><td><img src="ui/cross.png"></td><td>Product code conflicts with <a href="viewproduct.php?productcode=' . $cr['productcode'] . '" target="_blank">this</a> product</td></tr></table>';
} else {
echo '<table><tr><td><img src="ui/tick.png"></td><td>Product code \'' . $_GET['q'] . '\' does not conflict with database</td></tr></table>';
}
}
?>