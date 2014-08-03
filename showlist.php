<?php
session_start();
if ($_SESSION['loggedin'] == 'yes') {
include('settingsdbc.php');

if ($_GET['viewchange'] == 'yes') {
$q = "SELECT * FROM simlist ORDER BY supplier ASC, dateofpurchase DESC, productcode ASC";
} else {
$q = "SELECT * FROM simlist ORDER BY supplier ASC, productcode ASC, dateofpurchase DESC";
}
$r = mysqli_query($dbc, $q);
include('view.php');
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
		<th colspan="3">Product options</td>
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
		<td colspan="3">Product options</td>
	</tr>';
}
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
echo '<td><a style="underline: 0;" href="barcodepreview.php?barcode=' . $cr['barcode'] . '&list=' . $counter . '">' . $cr['barcode'] . '</a></td>';
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
echo '<td><a name="list' . $counter . '" href="edit.php?id=' . $cr['id'] . '&list=' . $counter . '">Edit</a></td>
<td><a href="javascript:dialogconfirmstart(' . $cr['id'] . ', ' . $counter . ')">Delete</a></td>
<td><a href="locationsselect.php?proid=' . $cr['id'] . '&productcode=' . $cr['productcode'] . '">Move</a></td>	</tr>';
echo "\n";
$counter = $counter + 1;
}
echo '<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td align="right">' . number_format($totalstock, 2) . '</td></tr>';
echo '</table><hr>';
echo "\n";

// Widgets!
if ($widgetenabled == 'y') {
$q = "SELECT * FROM simlocations";
$r = mysqli_query($dbc, $q);
$locationsname = mysqli_num_rows($r) . ":";
$locationsid = mysqli_num_rows($r) . ":";
while ($cr = mysqli_fetch_array($r)) {
$locationsname = $locationsname . $cr['name'] . ":";
$locationsid = $locationsid . $cr['id'] . ":";
}

if (!empty($_GET['newlocation'])) {
echo '<input type="hidden" id="quicklocationnewalert" value="yes">';
} else {
echo '<input type="hidden" id="quicklocationnewalert" value="no">';
}

if (!empty($_GET['deletelocation'])) {
echo '<input type="hidden" id="quicklocationdeletedalert" value="yes">';
} else {
echo '<input type="hidden" id="quicklocationdeletedalert" value="no">';
}

if (mysqli_num_rows($r) == 0) {
echo '<input type="hidden" id="quicklocation" value="none">';
echo '<input type="hidden" id="quicklocationid" value="none">';
} else {
echo '<input type="hidden" id="quicklocation" value="' . $locationsname . '">';
echo '<input type="hidden" id="quicklocationid" value="' . $locationsid . '">';
}
echo '<object data="data:application/x-silverlight-2," type="application/x-silverlight-2" height="193" width="395" align="center">
		  <param name="source" value="widgets/locationsquickmanagement.xap"/>
		  <param name="background" value="white" />
		  <param name="minRuntimeVersion" value="5.0.61118.0" />
		  <param name="autoUpgrade" value="true" />
	    </object>';
}
// End of widgets

echo '<table width="100%"><tr><td><img src="ui/up.png"> <a href="#top" name="bottom">Scroll to top</a></td><td align="right">Version ' . $version . '</td></tr></table>';
echo '</body></html>';
} else {
header('Location: index.php?login=no');
}
?>