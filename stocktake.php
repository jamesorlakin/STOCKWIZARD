<?php
session_start();
if ($_SESSION['loggedin'] == 'yes') {
require('settings.php');
$q = "SELECT * FROM simlist ORDER BY supplier ASC, productcode ASC, dateofpurchase DESC";
$r = mysqli_query(mysqli_connect($mhost, $musr, $mpss, $mdb), $q);
echo '<html><head><title>STOCKWIZARD - Stocktake</title></head><body>';
if (empty($_GET['textmode'])) {
$date = getdate(time());
echo '<table width="100%" style="font-size: 75%;"><tr><td align="left">STOCKWIZARD printout stocktake sheet</td><td align="right">Generated on ' . $date['mday'] . '-' . $date['mon'] . '-' . $date['year'] . '</td></tr></table>';
echo '<hr />';
echo '<p><a href="showlist.php">Back to products</a> | <img src="ui/print.png"> <a href="javascript:window.print()">Print</a> | <img src="ui/documents.png"> <a href="stocktake.php?textmode=yes">Update stock for all products</a></p>';
}
if ($_GET['updated'] == 'yes') {
echo '<table><tr><td><img src="ui/tick.png"></td><td><h1>Entries updated!</h1></td></tr></table>';
}
if ($_GET['textmode'] == 'yes') {
echo '<form action="stocktakeedit.php" method="post">';
}
echo '<table border="1">
<tr>
<td>Date</td>
<td>Supplier</td>
<td>Product code</td>
<td>Description</td>
<td>Unit price</td>
<td>Sales price</td>
<td>Current Quantity</td>
<td>New Quantity</td>
</tr>';
$counter = 1;
while ($cr = mysqli_fetch_array($r)) {
$tempval1 = $cr['unitprice']*((100-$cr['discount'])/100);
$landedval = $tempval1+($tempval1*($cr['vat']/100));
echo '<tr>';
echo '<td>' . $cr['dateofpurchase'] . '</td>';
echo '<td>' . $cr['supplier'] . '</td>';
echo '<td>' . $cr['productcode'] . '</td>';
echo '<td>' . $cr['description'] . '</td>';
echo '<td align="right">' . $cr['unitprice'] . '</td>';
echo '<td align="right">' . $cr['salesprice'] . '</td>';
echo '<td align="right">' . $cr['quantity'] . '</td>';
if ($_GET['textmode'] != 'yes') {
echo '<td>#</td></tr>';
} else {
echo '<td><input name="' . $counter . '"><input type="hidden" name="' . $counter . 'id" value="' . $cr['id'] . '"></td></tr>';
}
$counter = $counter + 1;
}
echo '</table>';
if ($_GET['textmode'] == 'yes') {
echo '<input type="submit" value="Save all">';
echo '<input type="hidden" name="count" value="' . mysqli_num_rows($r) . '">';
echo '</form>';
}
echo '<hr />';
//echo '<p style="text-size: 150%; color: red;" align="center">PROTOTYPE STOCKWIZARD VERSION, FOR INTERAL DISTRIBUTION WITHIN JAMSTER TECHNOLOGIES.</p>';
echo '<p align="right"><font style="text-size: 75%;">Generated on ' . $date['mday'] . '-' . $date['mon'] . '-' . $date['year'] . '</font></p>';
echo '</body></html>';
} else {
header('Location: index.php?login=no');
}

?>