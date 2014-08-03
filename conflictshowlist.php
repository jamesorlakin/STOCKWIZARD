<?php
session_start();

if ($_SESSION['loggedin'] == 'yes') {
require('settingsdbc.php');
$q = "SELECT * FROM simlist";
$r = mysqli_query($dbc, $q);
$r2 = mysqli_query($dbc, $q);
$count = array();
while ($cr = mysqli_fetch_array($r)) {
global $count;
$count[$cr['productcode']]++;
}

echo '<title>STOCKWIZARD - Conflict checker</title>';
include('header.htm');
echo '<p><a href="showlist.php">Back to products</a> | Edit conflicts:</p>';
echo '<script src="confirm/message.js"></script><link rel="stylesheet" href="confirm/message.css"/>';
echo '<script>
    function dialogconfirmstart(productid, counter) {
        dhtmlx.confirm({
		type:"confirm",
    text: "Delete product?",
    callback: function(result){
        if (result == true) {
		window.document.location = "delete.php?id=" + productid + "&list=" + counter + "&conflictshowlist=yes";
		}
    }
	});
    }
	
	function getanchor() {
    return (document.URL.split(\'#\').length > 1) ? document.URL.split(\'#\')[1] : null;	
	}
</script>';

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
$counter = 0;
while ($cr = mysqli_fetch_array($r2)) {
if ($count[$cr['productcode']] != 1) {
if ($cr['productcode'] != '') {
$qt = "SELECT * FROM simlist WHERE productcode = '{$cr['productcode']}'";
$rt = mysqli_query($dbc, $qt);
while($crt = mysqli_fetch_array($rt)) {
$tempval1 = $crt['unitprice']*((100-$crt['discount'])/100);
$landedval = $tempval1+($tempval1*($crt['vat']/100));
$stockval = $crt['quantity']*$landedval;
@$marginval = ($crt['salesprice']-$landedval)/$crt['salesprice']*100;
$totalstock = $totalstock+$stockval;
$profit = $crt['salesprice']/100*$marginval;
echo '<tr>';
echo '<td>' . $crt['dateofpurchase'] . '</td>';
echo '<td>' . $crt['supplier'] . '</td>';
echo '<td>' . $crt['productcode'] . '</td>';
echo '<td>' . $crt['barcode'] . '</td>';
echo '<td>' . $crt['description'] . '</td>';
echo '<td>' . $crt['quantity'] . '</td>';
echo '<td align="right">' . $crt['unitprice'] . '</td>';
echo '<td>' . $crt['discount'] . '</td>';
echo '<td>' . $crt['vat'] . '%</td>';
echo '<td align="right">' . number_format($landedval, 2) . '</td>';
echo '<td align="right">' . number_format($stockval, 2) . '</td>';
echo '<td align="right">' . $crt['salesprice'] . '</td>';
echo '<td align="right">' . number_format($marginval, 2) . '</td>';
echo '<td align="right">' . $profit . '</td>';
echo '<td><a name="list' . $counter . '" href="edit.php?id=' . $crt['id'] . '&list=' . $counter . '&conflictshowlist=yes">Edit</a></td>
<td><a href="javascript:dialogconfirmstart(' . $crt['id'] . ', ' . $counter . ')">Delete</a></td></tr>';
echo "\n";
$counter = $counter + 1;
}
}
$count[$cr['productcode']] = 1;
}
}
} else {
header('Location: index.php?login=no');
}

?>