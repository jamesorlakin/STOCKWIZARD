<?php
session_start();

if ($_SESSION['loggedin'] == 'yes') {
if ($_SESSION['admin'] == 'yes') {

require('settingsdbc.php');
echo '<title>STOCKWIZARD - Reset password</title>';
include('header.htm');
echo '<p><a href="showlist.php">Back to products</a> | <a href="configedit.php">Back to configuration</a> | Reset password for ' . $_GET['username'] . ':</p>';
$q = "SELECT * FROM simusr WHERE username = '{$_GET['username']}'";
$r = mysqli_query($dbc, $q);
if (mysqli_num_rows($r) == 0) {
echo '<p>User not found in database!</p>';
} else {
echo '<form action="configresetpasswordgo.php" method="post">
<p>New password:</td><td><input type="password" name="password"></p>
<input type="hidden" name="username" value="' . $_GET['username'] . '">
<p><input type="submit" value="Reset password"></p>
</form>';
}

} else {
header('Location: configedit.php');
}
} else {
header('Location: index.php?login=no');
}