<?php
function barcodegen() {
$barcodetemp = rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
// echo $barcodetemp;
$q = "SELECT * FROM simlist WHERE barcode = '" . $barcodetemp . "'";
require('settings.php');
$r = mysqli_query(mysqli_connect($mhost, $musr, $mpss, $mdb), $q);
if (mysqli_num_rows($r) == 0) {
return $barcodetemp;
} else {
barcodegen();
}
}
?>
