<?php
require('settingsdbc.php');

$q = "SELECT * FROM simlist WHERE supplier = '{$_GET['q']}'";
$r = mysqli_query($dbc, $q);
if (empty($_GET['q'])) {
echo '<table><tr><td><img src="ui/cross.png"></td><td>No supplier entered</td></tr></table>';
} else {
if (mysqli_num_rows($r) != 0) {
echo '<table><tr><td><img src="ui/tick.png"></td><td>Supplier \'' . $_GET['q'] . '\' is known to database | <a href="javascript:window.open(\'supplier.php?querytype=normal&searchwhat=supplier&query=' . $_GET['q'] . '\');">View products by supplier</a></td></tr></table>';
} else {
echo '<table><tr><td><img src="ui/warning.png"></td><td>Supplier unknown, check spelling in case you have mispelled</td></tr></table>';
}
}
?>