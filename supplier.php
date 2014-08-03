<?php
session_start();
if ($_SESSION['loggedin'] == 'yes') {
echo '<title>STOCKWIZARD - Search database</title>';
include('header.htm');
echo '<p><a href="javascript:window.close();">Close</a> | Search:</p>';
echo '<form>
<input type="hidden" name="querytype" value="normal">
<p>Search:</p>
<p>Search what? <select name="searchwhat">';
$pcode = "";
$unitp = "";
$quant = "";
$sales = "";
$dateo = "";
$descr = "";
$suppl = "";

$st = "selected=\"selected\"";
switch ($_GET['searchwhat']) {
    case "productcode":
        $pcode = $st;
        break;
    case "unitprice":
        $unitp = $st;
        break;
    case "quantity":
        $quant = $st;
        break;
	case "salesprice":
        $sales = $st;
        break;
	case "dateofpurchase":
        $dateo = $st;
        break;
	case "description":
        $descr = $st;
        break;
	case "supplier":
        $suppl = $st;
        break;
}
echo '<option value="productcode" ' . $pcode . '>Product Code</option>';
echo '<option value="unitprice" ' . $unitp . '>Unit price</option>';
echo '<option value="quantity" ' . $quant . '>Quantity</option>';
echo '<option value="salesprice" ' . $sales . '>Sales price</option>';
echo '<option value="dateofpurchase" ' . $dateo . '>Date</option>';
echo '<option value="description" ' . $descr . '>Description</option>';
echo '<option value="supplier" ' . $suppl . '>Supplier</option>';
echo '</select></p>';
if (!empty($_GET['query'])) {
echo '<p>Search query: <input name="query" value="' . $_GET['query'] . '"></p>';
} else {
echo '<p>Search query: <input name="query"></p>';
}
echo '<p><input type="submit" value="Search"></p>
</form>';
if (!empty($_GET['querytype'])) {
echo '<p>Searching for \'' . $_GET['query'] . '\':</p>';
require('settings.php');
$dbc = mysqli_connect($mhost, $musr, $mpss, $mdb);
$q = "SELECT * FROM simlist WHERE " . $_GET['searchwhat'] . " LIKE '%" . $_GET['query'] . "%' ORDER BY supplier ASC, dateofpurchase DESC";
$r = mysqli_query($dbc, $q);
echo '<table border="1">
	<tr>
		<td';
		if ($_GET['searchwhat'] == 'dateofpurchase' or $_GET['querytype'] == 'between') {
		echo ' bgcolor="red"';
		}
		echo '>Date</td>
		<td';
		if ($_GET['searchwhat'] == 'supplier') {
		echo ' bgcolor="red"';
		}
		echo '>Supplier</td>
		<td';
		if ($_GET['searchwhat'] == 'productcode') {
		echo ' bgcolor="red"';
		}
		echo '>Product code</td>
		<td>Barcode</td>
		<td>Description</td>
		<td';
		if ($_GET['searchwhat'] == 'quantity') {
		echo ' bgcolor="red"';
		}
		echo '>Quantity</td>
		<td';
		if ($_GET['searchwhat'] == 'unitprice') {
		echo ' bgcolor="red"';
		}
		echo '>Unit price</td>
		<td>Discount</td>
		<td>V.A.T</td>
		<td>Landed cost price</td>
		<td>Stock value</td>
		<td';
		if ($_GET['searchwhat'] == 'salesprice') {
		echo ' bgcolor="red"';
		}
		echo '>Sales price</td>
		<td>Margin</td>
		<td colspan="3">Editing options</td>
	</tr>';
	$totalstock = 0;
	$counter = 1;
while ($cr = mysqli_fetch_array($r)) {
$tempval1 = $cr['unitprice']*((100-$cr['discount'])/100);
$landedval = $tempval1+($tempval1*($cr['vat']/100));
$stockval = $cr['quantity']*$landedval;
$marginval = ($cr['salesprice']-$landedval)/$cr['salesprice']*100;
$totalstock = $totalstock+$stockval;
echo '<tr>';
echo '<td>' . $cr['dateofpurchase'] . '</td>';
echo '<td>' . $cr['supplier'] . '</td>';
echo '<td>' . $cr['productcode'] . '</td>';
echo '<td>' . $cr['barcode'] . '</td>';
echo '<td>' . $cr['description'] . '</td>';
echo '<td>' . $cr['quantity'] . '</td>';
echo '<td align="right">' . $cr['unitprice'] . '</td>';
echo '<td>' . $cr['discount'] . '</td>';
echo '<td>' . $cr['vat'] . '%</td>';
echo '<td align="right">' . number_format($landedval, 2) . '</td>';
echo '<td align="right">' . number_format($stockval, 2) . '</td>';
echo '<td align="right">' . $cr['salesprice'] . '</td>';
echo '<td align="right">' . number_format($marginval, 2) . '</td>';
echo '<td><a name="list' . $counter . '" href="edit.php?id=' . $cr['id'] . '&list=' . $counter . '&search=yes&searchwhat=' . $_GET['searchwhat'] . '&query=' . $_GET['query'] . '">Edit</a></td>
<td><a href="delete.php?id=' . $cr['id'] . '">Delete</a></td>
<td><a href="locationsselect.php?proid=' . $cr['id'] . '&productcode=' . $cr['productcode'] . '">Move</a></td>		</tr>';
	$counter = $counter + 1;
}
echo '<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td align="right">' . number_format($totalstock, 2) . '</td></tr>';
echo '</table>';
}
} else {
header('Location: index.php?login=no');
}
?>