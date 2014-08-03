<?php
if (file_exists('../settings.php')) {
header('Location: alreadysetup.php');
die();
}

if ($_GET['submit'] == 'yes') {
function createsetting($name) {
$h = fopen("../config/" . $name  . ".php", 'w');
fwrite($h, '<?php $' . $name . ' = "' . $_GET[$name] . '"; ?>');
fclose($h);
}
createsetting('businessname');
createsetting('salt');
createsetting('updatecheck');
createsetting('allowauto');
createsetting('autoneedsalt');
createsetting('widgetenabled');
createsetting('toptablebold');
header('Location: 7.php');
die();
}

?>
<html>
<head><title>STOCKWIZARD Setup Utility - Step 6</title></head>

<body>
<p align="center"><img src="setuplogo.png"></p>
<br><br>
<p style="color: grey;"><b>Welcome</b> -> <b>Licence</b> -> <b>MySQL credentials</b> -> <b>MySQL table creation</b> -> <b>User creation</b> -> <b>Additional options<b> -> Done!</p>
<p>Additional options for STOCKWIZARD can be selected below.</p>
<form action="6.php">
<table>
<tr><td>Business name:</td><td><input name="businessname"></td></tr>
<tr><td>Salt: (API password)</td><td><input name="salt" value="stockwizarddefaultsalt"></td></tr>
<tr><td>Check for updates:</td><td><select name="updatecheck"><option value="y">Yes</option><option value="n">No</option></td></tr>
<tr><td>Allow login by URL:</td><td><select name="allowauto"><option value="y">Yes</option><option value="n">No</option></td></tr>
<tr><td>Logging in by URL requires salt:</td><td><select name="autoneedsalt"><option value="y">Yes</option><option value="n">No</option></td></tr>
<tr><td>Enable location widget:</td><td><select name="widgetenabled"><option value="y">Yes</option><option value="n">No</option></td></tr>
<tr><td>Top of product table is bold:</td><td><select name="toptablebold"><option value="y">Yes</option><option value="n">No</option></td></tr>
<tr><td><input type="submit" value="Continue"><input type="hidden" name="submit" value="yes"></td></tr>
</table>
</form>

</body>
</html>