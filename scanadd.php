<?php
session_start();

if ($_SESSION['loggedin'] == 'yes') {
echo '<title>STOCKWIZARD - Increase quantity by barcode</title>';
include('header.htm');
echo '<p><a href="showlist.php">Back to products</a> | Scan in more products:</p>';
if ($_GET['updated'] == 'yes') {

if ($_GET['problem'] == 'yes') {
echo '<table><tr><td><img src="ui/cross.png"></td><td>' . $_GET['reason'] . '</td></tr></table><br />';
} else {
echo '<table><tr><td><img src="ui/tick.png"></td><td>Product \'' . $_GET['productname'] . '\' with barcode ' . $_GET['productbarcode'] . ' has been updated, the quantity is now ' . $_GET['newquantity'] . ' from ' . $_GET['oldquantity'] . '.</td></tr></table><br />';
}

} else {
echo '<p>This tool can let you scan a barcode and if the product already exists in the database this will add one to the quantity of the product. This is so that you can scan in barcoded products upon delivery.</p>';
}
echo '<form action="scanaddgo.php"><table>';
echo '<tr><td>Quantity to add:</td><td><input name="quantity" value="1"></td>';
echo '<tr><td>Barcode:</td><td><input name="barcodebox" id="bx"></td></tr>';
echo '</table>';
echo '<p><input type="submit" value="Increase quantity"></p>';
echo '</form>';
echo '<script>document.getElementById("bx").focus();</script>';
} else {
header('Location: index.php?login=no');
}

?>