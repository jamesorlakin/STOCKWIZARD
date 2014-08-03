<?php
if (file_exists('../settings.php')) {
header('Location: alreadysetup.php');
die();
}
?>
<html>
<head>
<head><title>STOCKWIZARD Setup Utility - Step 3</title></head>

<body>
<p align="center"><img src="setuplogo.png"></p>
<br><br>
<p style="color: grey;"><b>Welcome</b> -> <b>Licence</b> -> <b>MySQL credentials</b> -> MySQL table creation -> User creation -> Additional options -> Done!</p>
<p>STOCKWIZARD uses MySQL to store product information and user credentials. Please enter the connection details for MySQL below.</p>
<?php
if ($_GET['submit'] == 'yes') {
$dbc = mysqli_connect($_GET['host'], $_GET['user'], $_GET['pass'], $_GET['db']);
if ($dbc == false) {
echo '<p style="color: red;">A connection to the database failed, please check your login information.</p>';
} else {
if (!file_exists("../config")) {
mkdir("../config");
}
function createsetting($name, $val) {
$h = fopen("../config/" . $name  . ".php", 'w');
fwrite($h, '<?php $m' . $name . ' = "' . $val . '"; ?>');
fclose($h);
}
createsetting('host', $_GET['host']);
createsetting('usr', $_GET['user']);
createsetting('pss', $_GET['pass']);
createsetting('db', $_GET['db']);
echo '<p style="color: green;">Connection successful! These settings have been saved, <a href="4.php">click here</a> to continue.</p>';
}
}
?>
<form action="3.php">
<table>
<tr><td>MySQL host:</td><td><input name="host" value="<?php echo $_GET['host']; ?>"></td></tr>
<tr><td>MySQL username:</td><td><input name="user" value="<?php echo $_GET['user']; ?>"></td></tr>
<tr><td>MySQL password:</td><td><input type="password" name="pass" value="<?php echo $_GET['pass']; ?>"></td></tr>
<tr><td>MySQL database:</td><td><input name="db" value="<?php echo $_GET['db']; ?>"></td></tr>
<tr><td><input type="submit" value="Continue"><input type="hidden" name="submit" value="yes"></td></tr>
</table>
</form>
</body>
</html>
