<?php
require('settings.php');
$q = "SELECT * FROM simlocationslist WHERE id= " . $_GET['id'];
$r = mysqli_query(mysqli_connect($mhost, $musr, $mpss, $mdb), $q);
$cr = mysqli_fetch_array($r);
$name = $cr['name'];
$price = $cr['price'];
$stock = $cr['stock'];
$amount = $cr['amount'];
if (isset($_POST['sub'])) {
$dbc = mysqli_connect($mhost, $musr, $mpss, $mdb);
$q2 = "UPDATE simlocationslist SET dateoftransfer = '" . $_POST['date'] . "' WHERE id=" . $_GET['id'];
$r2 = mysqli_query($dbc, $q2);
$q2 = "UPDATE simlocationslist SET supplier = '" . $_POST['supplier'] . "' WHERE id=" . $_GET['id'];
$r2 = mysqli_query($dbc, $q2);
$q2 = "UPDATE simlocationslist SET productcode = '" . $_POST['productcode'] . "' WHERE id=" . $_GET['id'];
$r2 = mysqli_query($dbc, $q2);
$q2 = "UPDATE simlocationslist SET description = '" . $_POST['description'] . "' WHERE id=" . $_GET['id'];
$r2 = mysqli_query($dbc, $q2);
$q2 = "UPDATE simlocationslist SET quantity = '" . $_POST['quantity'] . "' WHERE id=" . $_GET['id'];
$r2 = mysqli_query($dbc, $q2);
$q2 = "UPDATE simlocationslist SET unitprice = '" . $_POST['unitprice'] . "' WHERE id=" . $_GET['id'];
$r2 = mysqli_query($dbc, $q2);
$q2 = "UPDATE simlocationslist SET discount = '" . $_POST['discount'] . "' WHERE id=" . $_GET['id'];
$r2 = mysqli_query($dbc, $q2);
$q2 = "UPDATE simlocationslist SET vat = '" . $_POST['vat'] . "' WHERE id=" . $_GET['id'];
$r2 = mysqli_query($dbc, $q2);
$q2 = "UPDATE simlocationslist SET salesprice = '" . $_POST['salesprice'] . "' WHERE id=" . $_GET['id'];
$r2 = mysqli_query($dbc, $q2);
$q2 = "UPDATE simlocationslist SET barcode = '" . $_POST['barcodebox'] . "' WHERE id=" . $_GET['id'];
$r2 = mysqli_query($dbc, $q2);
if ($_POST['search'] == 'yes') {
header('Location: search.php?querytype=normal&searchwhat=' . $_POST['searchwhat'] . '&query=' . $_POST['query'] . '#list' . $_POST['list']);
} else {
header('Location: locationsshowlist.php?id=' . $_GET['locationid']);
}
} else {
echo '<title>STOCKWIZARD - EDIT</title>';
include('headerui.html');
echo '<form action="locationsedit.php?id=' . $_GET['id'] . '&locationid=' . $_GET['locationid'] . '" method = "post">';
echo '<table>
<tr><td>Date (YYYY-MM-DD only):</td><td><input name="date" id="datefield" value="' . $cr['dateoftransfer'] . '"></td></tr>
<tr><td>Supplier:</td><td><input name="supplier" id="supplier" value="' . $cr['supplier'] . '"></td></tr>
<tr><td>Product code:</td><td><input name="productcode" value="' . $cr['productcode'] . '"></td></tr>
<tr><td>Description:</td><td><input name="description" value="' . $cr['description'] . '"></td></tr>
<tr><td>Quantity:</td><td><input name="quantity" value="' . $cr['quantity'] . '"></td></tr>
<tr><td>Unit price:</td><td><input name="unitprice" value="' . $cr['unitprice'] . '"></td></tr>
<tr><td>Discount:</td><td><input name="discount" value="' . $cr['discount'] . '"></td></tr>
<tr><td>VAT:</td><td><input name="vat" value="' . $cr['vat'] . '"></td></tr>
<tr><td>Sales price:</td><td><input name="salesprice" value="' . $cr['salesprice'] . '"></td></tr>
<tr><td>Barcode:</td><td><input name="barcodebox" value="' . $cr['barcode'] . '"></tr></table>';
echo '<p>
<input type="submit" value="Update">
<input type="hidden" value="true" name="sub">
<input type="hidden" value="' . $_GET['list'] . '" name="list">
';
if ($_GET['search'] == 'yes') {
echo '<input type="hidden" value="' . $_GET['searchwhat'] . '" name="searchwhat"><input type="hidden" value="' . $_GET['query'] . '" name="query"><input type="hidden" value="yes" name="search"><input type="hidden" value="' . $_GET['list'] . '" name="list">';
}
echo '</p>
</form>';
}
?>