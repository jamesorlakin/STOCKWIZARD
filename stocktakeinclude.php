<?php

if ($_SESSION['loggedin'] == 'yes') {
require('settings.php');
$q = "SELECT * FROM simlist ORDER BY supplier ASC, productcode ASC, dateofpurchase DESC";
$r = mysqli_query(mysqli_connect($mhost, $musr, $mpss, $mdb), $q);
$_GET['textmode'] == 'yes';
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
}
echo '</form>';
} else {
header('Location: index.php?login=no');
}

?>