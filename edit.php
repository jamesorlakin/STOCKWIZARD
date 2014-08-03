<?php
require('settings.php');
$q = "SELECT * FROM simlist WHERE id=" . $_GET['id'];
$r = mysqli_query(mysqli_connect($mhost, $musr, $mpss, $mdb), $q);
$cr = mysqli_fetch_array($r);
$name = $cr['name'];
$price = $cr['price'];
$stock = $cr['stock'];
$amount = $cr['amount'];
if (isset($_POST['sub'])) {
$dbc = mysqli_connect($mhost, $musr, $mpss, $mdb);
$q2 = "UPDATE simlist SET dateofpurchase = '" . $_POST['date'] . "' WHERE id=" . $_GET['id'];
$r2 = mysqli_query($dbc, $q2);
$q2 = "UPDATE simlist SET supplier = '" . $_POST['supplier'] . "' WHERE id=" . $_GET['id'];
$r2 = mysqli_query($dbc, $q2);
$q2 = "UPDATE simlist SET productcode = '" . $_POST['productcode'] . "' WHERE id=" . $_GET['id'];
$r2 = mysqli_query($dbc, $q2);
$q2 = "UPDATE simlist SET description = '" . $_POST['description'] . "' WHERE id=" . $_GET['id'];
$r2 = mysqli_query($dbc, $q2);
$q2 = "UPDATE simlist SET quantity = '" . $_POST['quantity'] . "' WHERE id=" . $_GET['id'];
$r2 = mysqli_query($dbc, $q2);
$q2 = "UPDATE simlist SET unitprice = '" . $_POST['unitprice'] . "' WHERE id=" . $_GET['id'];
$r2 = mysqli_query($dbc, $q2);
$q2 = "UPDATE simlist SET discount = '" . $_POST['discount'] . "' WHERE id=" . $_GET['id'];
$r2 = mysqli_query($dbc, $q2);
$q2 = "UPDATE simlist SET vat = '" . $_POST['vat'] . "' WHERE id=" . $_GET['id'];
$r2 = mysqli_query($dbc, $q2);
$q2 = "UPDATE simlist SET salesprice = '" . $_POST['salesprice'] . "' WHERE id=" . $_GET['id'];
$r2 = mysqli_query($dbc, $q2);
$q2 = "UPDATE simlist SET barcode = '" . $_POST['barcodebox'] . "' WHERE id=" . $_GET['id'];
$r2 = mysqli_query($dbc, $q2);
if ($_POST['conflictmode'] == 'yes') {
header('Location: viewproduct.php?productcode=' . $_POST['productcode'] . '&edited=yes');
} else {
if ($_POST['search'] == 'yes') {
header('Location: search.php?querytype=normal&searchwhat=' . $_POST['searchwhat'] . '&query=' . $_POST['query'] . '#list' . $_POST['list']);
} else {
if ($_POST['conflictshowlist'] == 'yes') {
header('Location: conflictshowlist.php#list' . $_POST['listconflict']);
} else {
header('Location: showlist.php?edit=yes#list' . $_POST['list']);
} // END CONFLICT SHOWLIST
} // END SEARCH IF
} // END BIG IF
} else {
echo '<title>STOCKWIZARD - EDIT</title>';
include('header.htm');
echo '<form action="edit.php?id=' . $_GET['id'] . '" method = "post">';
echo '<table>
<tr><td>Date (YYYY-MM-DD only):</td><td><input name="date" value="' . $cr['dateofpurchase'] . '"></td></tr>
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
if ($_GET['conflictmode'] == 'yes') {
echo '<input type="hidden" name="conflictmode" value="yes"><input type="hidden" name="conflictproductcode" value="' . $_GET['productcode'] . '">';
}
if ($_GET['conflictshowlist'] == 'yes') {
echo '<input type="hidden" name="conflictshowlist" value="yes"><input type="hidden" name="listconflict" value="' . $_GET['list'] . '">';
}
echo '</p>
</form>';
}
?>