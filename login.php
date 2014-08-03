<?php
require('settings.php');
session_start();
if (isset($_POST['sub'])) {
$usr = $_POST['usr'];
$pss = $_POST['pss'];
$r = mysqli_query(mysqli_connect($mhost, $musr, $mpss, $mdb), "SELECT * FROM simusr WHERE username = '$usr' AND password = SHA1('$pss')");
if (mysqli_num_rows($r) == 1) {
setcookie('simusr', $usr, time()+9999);
$_SESSION['loggedin'] = 'yes';
$_SESSION['who'] = $usr;
$_SESSION['loggedinas'] = $usr;
$cr = mysqli_fetch_array($r);
if ($cr['admin'] == 'y') {
$_SESSION['admin'] = 'yes';
}
if ($versionupdate == true) {
header('Location: updateavailable.php');
} else {
header('Location: showlist.php');
}
} else {
header('Location: index.php?fail=yes');
}
} elseif ($_GET['autologin'] == 'y') {
if ($allowauto == 'y') {
if ($autoneedsalt == 'y') {

if ($salt != $_GET['autosalt']) {
$autogo = 'n';
}

} else {
$autogo = 'y';
}
} else {
$autogo = 'n';
echo '<p style="text-color: red;">AUTO LOGIN NOT ENABLED</p><p>SYSTEM ADMINISTRATORS WHO WANT TO ENABLE THIS FEATURE, DO SO IN CONFIGURATION</p>';
}
if ($autogo == 'y' ) {
$_SESSION['loggedin'] = 'yes';
$_SESSION['who'] = 'Automatic logon user';
header('Location: showlist.php');
}
} else {
header('Location: index.php');
}
