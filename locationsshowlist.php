<?php
session_start();
if ($_SESSION['loggedin'] == 'yes') {
require('settingsdbc.php');
include('locationsview.php');
$q = "SELECT * FROM simlocationslist WHERE locationid = " . $_GET['id'] . " ORDER BY supplier ASC, dateoftransfer DESC";
$r = mysqli_query(mysqli_connect($mhost, $musr, $mpss, $mdb), $q);
if ($toptablebold == 'y') {
echo '<table border="1" width="100%">
	<!-- MSTableType="layout" -->
	<tr>
		<th>Date</td>
		<th>Supplier</td>
		<th>Product code</td>
		<th>Barcode</td>
		<th>Description</td>
		<th>Quantity</td>
		<th>Unit price</td>
		<th>Discount</td>
		<th>V.A.T</td>
		<th>LCP</td>
		<th>Stock value</td>
		<th>Sales price</td>
		<th>Margin</td>
		<th>Profit</td>
		<th colspan="2">Product options</td>
	</tr>';
} else {
echo '<table border="1" width="100%">
	<!-- MSTableType="layout" -->
	<tr>
		<td>Date</td>
		<td>Supplier</td>
		<td>Product code</td>
		<td>Barcode</td>
		<td>Description</td>
		<td>Quantity</td>
		<td>Unit price</td>
		<td>Discount</td>
		<td>V.A.T</td>
		<td>LCP</td>
		<td>Stock value</td>
		<td>Sales price</td>
		<td>Margin</td>
		<td>Profit</td>
		<td colspan="2">Product options</td>
	</tr>';
}
$totalstock = 0;
while($cr = mysqli_fetch_array($r)) {
$tempval1 = $cr['unitprice']*((100-$cr['discount'])/100);
$landedval = $tempval1+($tempval1*($cr['vat']/100));
$stockval = $cr['quantity']*$landedval;
@$marginval = ($cr['salesprice']-$landedval)/$cr['salesprice']*100;
$totalstock = $totalstock+$stockval;
$profit = $cr['salesprice']/100*$marginval;
echo '<tr>';
echo '<td>' . $cr['dateoftransfer'] . '</td>';
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
echo '<td align="right">' . $profit . '</td>';
echo '<td><a href="locationsedit.php?id=' . $cr['id'] . '&locationid=' . $_GET['id'] . '">Edit</a></td>
<td><a href="javascript:dialogconfirmstart(' . $cr['id'] . ',' . $_GET['id'] . ')">Delete</a></td></tr>';
echo "\n";
}
echo '<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td align="right">' . number_format($totalstock, 2) . '</td></tr>';
echo '</table>';
echo '<table width="100%"><tr><td><a href="#top" name="bottom">Scroll to top</a></td><td align="right">Ver. ' . $version . '</td></tr></table>';
echo '</body></html>';
} else {
header('Location: index.php?login=no');
}
?>