<?php
if (file_exists('../settings.php')) {
header('Location: alreadysetup.php');
die();
}

if (!empty($_GET['username'])) {
require('../config/host.php');
require('../config/usr.php');
require('../config/pss.php');
require('../config/db.php');
$dbc = mysqli_connect($mhost, $musr, $mpss, $mdb);
$q = "INSERT INTO simusr (username, password, admin) VALUES ('" . $_GET['username'] . "', SHA1('" . $_GET['password'] . "'), 'y')";
$r = mysqli_query($dbc, $q);
if ($r == false) {
die("Error inserting user\nOriginal query:\n" . $q);
}
header('Location: 6.php');
}
?>
<html>
<head><title>STOCKWIZARD Setup Utility - Step 5</title></head>

<body>
<p align="center"><img src="setuplogo.png"></p>
<br><br>
<p style="color: grey;"><b>Welcome</b> -> <b>Licence</b> -> <b>MySQL credentials</b> -> <b>MySQL table creation</b> -> <b>User creation</b> -> Additional options -> Done!</p>

<?php
if ($_GET['created'] == 'no') {
echo '<table><tr><td><img src="../ui/warning.png"></td><td>Since you are using existing tables, creating a user should not be necessary. If you wish to skip this step please <a href="6.php">click here</a>.</td></tr></table>';
} else {
echo '<table><tr><td><img src="../ui/tick.png"></td><td>Tables successfully created!</td></tr></table>';
}
?>
<p>An administrator must be created before you can use STOCKWIZARD, more users and administrators can be added later in the configuration menu.</p>
<form action="5.php">
<table>
<tr><td>Username:</td><td><input name="username"></td></tr>
<tr><td>Password:</td><td><input type="password" name="password"></td></tr>
<tr><td><input type="submit" value="Continue"></td></tr>
</table>
</form>

</body>
</html>