<?php
session_start();

if ($_SESSION['loggedin'] == 'yes') {
echo '<html><head><title>STOCKWIZARD - Price check</title></head>';
echo '<body onload="window.document.getElementById(\'cls\').focus()">';
echo '<input type="button" id="cls" value="Close" onclick="window.close()">';
require('settingsdbc.php');
$q = "SELECT * FROM simlist WHERE barcode = '{$_GET['barcode']}'";
$r = mysqli_query($dbc, $q);
$cr = mysqli_fetch_array($r);
echo '<p><font style="font-size: 25">Price: ' . $cr['salesprice'] . '</font></p>';
echo '<p><font style="font-size: 25">Current total: ' . $_GET['total'] . '</font></p>';
$newval = $cr['salesprice'] + $_GET['total'];
echo '<p><font style="font-size: 25">New total if scanned: ' . $newval . '</font></p>';
echo '</body></html>';
} else {
header('Location: index.php?login=no');
}

?>