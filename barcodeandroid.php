<?php
require('settings.php');
$r = mysqli_query(mysqli_connect($mhost, $musr, $mpss, $mdb), "SELECT * FROM simlist WHERE barcode = '" . $_GET['barcode'] . "'");
$cr = mysqli_fetch_array($r);
if ($_GET['salt'] == $salt) {
if ($_GET['mode'] == 'updatequantity') {
$newquantity = $cr['quantity'] - 1;
$q = "UPDATE simlist SET quantity = '$newquantity' WHERE barcode = '{$_GET['barcode']}'";
$r = mysqli_query(mysqli_connect($mhost, $musr, $mpss, $mdb), $q);
echo '<p>Quantity set!</p>';
} else {
if ($_GET['type'] == 'name') {
if (mysqli_num_rows($r) == 0) {
echo 'UNKNOWN PRODUCT';
} else {
echo '' . $cr['description'] . '';

}

} elseif ($_GET['type'] == 'quantity') {
if ($cr['quantity'] ==  '0') {
echo 'NONE';
} else {
echo '' . $cr['quantity'] . '';
}

} else {
if (mysqli_num_rows($r) == 0) {
echo '0';
} else {
echo '' . $cr['salesprice'] . '';
}
}
}
} else {
echo 'BAD SALT';
}

?>