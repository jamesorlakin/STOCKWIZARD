<?php
session_start();

if ($_SESSION['loggedin'] == 'yes') {
require('settingsdbc.php');
$q = "SELECT * FROM simlist ORDER BY supplier ASC, productcode ASC, dateofpurchase DESC";
$r = mysqli_query($dbc, $q);
$r2 = mysqli_query($dbc, $q);

if ($_GET['countonly'] != 'yes') {
$count = array();
while ($cr = mysqli_fetch_array($r)) {
$cr['productcode'] = strtolower($cr['productcode']);
global $count;
$count[$cr['productcode']]++;
}
echo '<title>STOCKWIZARD - Conflict checker</title>';
include('header.htm');
echo '<p><a href="showlist.php">Back to products</a> | Conflict checker:</p>';
echo '<p>These product codes have multiple entries:</p>';
echo '<p>To edit or delete products associated with these product codes, please click <a href="conflictshowlist.php">here</a>.</p>';
if ($toptablebold == 'y') {
echo '<table border="1">
	<!-- MSTableType="layout" -->
	<tr>
		<th>Product code</td>
		<th>Instances</td>
	</tr>';
} else {
echo '<table border="1">
	<!-- MSTableType="layout" -->
	<tr>
		<td>Product code</td>
		<td>Instances</td>
	</tr>';
}

while ($cr = mysqli_fetch_array($r2)) {
$cr['productcode'] = strtolower($cr['productcode']);
global $count;
if ($count[$cr['productcode']] != 1) {
if ($cr['productcode'] != '') {
echo '<tr><td>' . $cr['productcode'] . '</td><td>' . $count[$cr['productcode']] . '</td></tr>';
} else {
echo '<tr><td>' . $cr['productcode'] . '</td><td>' . $count[$cr['productcode']] . '</td><td>Please note that blank product codes were not counted in the warning on the main product page.</tr>';
}
$count[$cr['productcode']] = 1;
}
}

} else {
$count = array();
while ($cr = mysqli_fetch_array($r)) {
$cr['productcode'] = strtolower($cr['productcode']);
global $count;
if ($cr['productcode'] != '') {
$count[$cr['productcode']]++;
}
}

$countconflict = 0;
while ($cr = mysqli_fetch_array($r2)) {
$cr['productcode'] = strtolower($cr['productcode']);
global $count;
if ($count[$cr['productcode']] != 1) {
$countconflict = $countconflict + $count[$cr['productcode']];
$count[$cr['productcode']] = 1;
}
}
if ($countconflict != 0) {
echo '<table><tr><td><img src="ui/warning.png"></td><td> There are ' . $countconflict . ' products with conflicting product codes. Click <a href="conflictcheck.php">here</a> to view them.</td></tr></table>';
} else {
echo '<table><tr><td><img src="ui/tick.png"></td><td> No conflicting product codes found.</td></tr></table>';
}
}
} else {
header('Location: index.php?login=no');
}

?>