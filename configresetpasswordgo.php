<?php
session_start();

if ($_SESSION['loggedin'] == 'yes') {
if ($_SESSION['admin'] == 'yes') {

require('settingsdbc.php');
$q = "UPDATE simusr SET password = SHA1('{$_POST['password']}') WHERE username = '{$_POST['username']}'";
$r = mysqli_query($dbc, $q);
if ($r == true) {
header('Location: configedit.php?updated=yes');
} else {
echo '<p>Error with MySQL query</p>';
}

} else {
if (isset($_POST['username'])) {
if ($_POST['username'] == $_SESSION['who']) {
require('settingsdbc.php');
$q = "UPDATE simusr SET password = SHA1('{$_POST['password']}') WHERE username = '{$_POST['username']}'";
$r = mysqli_query($dbc, $q);
header('Location: showlist.php?msg=Password changed');
}
} else {
header('Location: configedit.php');
} // IF CHANGE PASSWORD 
} // IF ADMIN
} else {
header('Location: index.php?login=no');
}

?>