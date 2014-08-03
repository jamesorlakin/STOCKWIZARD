<?php
session_start();

if ($_SESSION['loggedin'] == 'yes') {
require('settingsdbc.php');
echo '<title>STOCKWIZARD - Cashier</title>';
include('header.htm');
echo '<p><a href="showlist.php">Back to products</a> | Cashier:</p>';
if (!empty($_GET['newbarcode'])) {
if (empty($_GET['barcodesentered'])) {
$_GET['barcodesentered'] = $_GET['newbarcode'];
} else {
$_GET['barcodesentered'] = $_GET['barcodesentered'] . ':' . $_GET['newbarcode'];
}
}
echo '<form action="cashier.php">
<p>Barcode: <input name="newbarcode" id="bbox"> | Command: <input id="command" onkeyup="checkcommand(this.value);"><input type="button" value="Clear" onclick="checkcommand(\'clear\');"><input type="button" value="Price check" onclick="checkcommand(\'pcheck\');"><input type="hidden" name="barcodesentered" value="' . $_GET['barcodesentered'] . '"> | <input type="submit" value="Scan"></p>
<script>window.document.getElementById("bbox").focus();</script>';
echo '<script>
function checkcommand(com) { 
if (com == "clear") {
window.location = "cashier.php?clear=yes";
}
if (com == "pcheck") {
var bcode = window.prompt("Enter barcode for price check:");
var totalprice = window.document.getElementById("currenttotal").value;
window.open("cashierpricecheck.php?barcode=" + bcode + "&total=" + totalprice);
window.document.getElementById("command").value = "";
}
}
</script>';
if (empty($_GET['barcodesentered'])) {
if ($_GET['clear'] == 'yes') {
echo '<p><font style="font-size: 20">Transaction cleared.</font></p>';
} else {
echo '<p><font style="font-size: 20">No items scanned.</font></p>';
}
} else {
echo '<table width="100%" border="0">';
$pros = explode(':', $_GET['barcodesentered']);
$total = 0;
foreach($pros as $probar) {
$q = "SELECT * FROM simlist WHERE barcode = '$probar'";
$r = mysqli_query($dbc, $q);
$cr = mysqli_fetch_array($r);
echo '<tr><td>' . strtoupper($cr['description']) . '</td><td align="right">' . $cr['salesprice'] . '</td></tr>';
$total = $total + $cr['salesprice'];
}
echo '</table>';
echo '<p><font style="font-size: 20">Total price: ' . $total . '</font><input type="hidden" name="currenttotal" id="currenttotal" value="' . $total . '"></p>';
}
} else {
header('Location: index.php?login=no');
}

?>