<?php
session_start();
sleep(1);

if ($_SESSION['loggedin'] == 'yes') {
require('settingsdbc.php');
if ($toptablebold == 'y') {
echo '<table border="1" width="100%">
	<!-- MSTableType="layout" -->
	<tr>
		<th>Date</th>
		<th>Supplier</th>
		<th>Product code</th>
		<th>Barcode</th>
		<th>Description</th>
		<th>Quantity</th>
		<th>Unit price</th>
		<th>Discount</th>
		<th>V.A.T</th>
		<th>LCP</th>
		<th>Stock value</th>
		<th>Sales price</th>
		<th>Margin</th>
		<th>Profit</th>
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
	</tr>';
}
$q = "SELECT * FROM simlist WHERE barcode = '{$_GET['barcode']}' ORDER BY supplier ASC, productcode ASC, dateofpurchase DESC";
$r = mysqli_query($dbc, $q);
$totalstock = 0;
$counter = 1;
while($cr = mysqli_fetch_array($r)) {
$tempval1 = $cr['unitprice']*((100-$cr['discount'])/100);
$landedval = $tempval1+($tempval1*($cr['vat']/100));
$stockval = $cr['quantity']*$landedval;
@$marginval = ($cr['salesprice']-$landedval)/$cr['salesprice']*100;
$totalstock = $totalstock+$stockval;
$profit = $cr['salesprice']/100*$marginval;
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
echo '<td align="right">' . $profit . '</td>';
echo '</tr>';
echo "\n";
$counter = $counter + 1;
}
echo '</table>';

} else {
echo '<p>Unauthorised.</p>';
}
?>