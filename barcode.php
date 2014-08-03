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
echo '<title>UNKNOWN PRODUCT</title>';
} else {
echo '<title>' . $cr['description'] . '</title>';

}

} elseif ($_GET['type'] == 'quantity') {
if ($cr['quantity'] ==  '0') {
echo '<title>NONE</title>';
} else {
echo '<title>' . $cr['quantity'] . '</title>';
}

} else {
if (mysqli_num_rows($r) == 0) {
echo '<title>0</title>';
} else {
echo '<title>' . $cr['salesprice'] . '</title>';
}
}
}
} else {
echo '<title>BAD SALT</title>';
}

?>