<?php
/////////////////////////////////////////////////////////
// STUFF BELOW HERE SHOULD NOT BE MODIFIED
// JUST FOR VERSION CHECKING AND CONFIGURATION INTEGRITY
require('pluginhandler.php');

$versionnum = 2.991;
$version = "$versionnum by Jamster Technologies";
if (!isset($mdb)) {
require('settings.php');
}

if ($updatecheck == "y") {
$fromweb = @file_get_contents("http://jameslakin.co.uk/stockwizard/version.txt?rnd=" . rand(1,1000));
if (empty($fromweb)) {
$versionserver = $versionnum;
$report = "Update check failed, make sure fopen URL's are allowed and your connection is working";
} else {
$versionserver = floatval($fromweb);
if ($versionnum < $versionserver) {
$versionupdate = true;
} else {
$versionupdate = false;
}
}
}

if (!file_exists("settings.php.bak")) {
$setfile = fopen("settings.php", 'r');
$setbackup = fopen("settings.php.bak", 'w');
fwrite($setbackup, fread($setfile, 700));
fclose($setbackup);
fclose($setfile);
}

// CHECK ALL FILES EXIST
$checkfile = 'allowauto.php';
if (!file_exists('config/' . $checkfile)) {
$report = "Config files error, default setting applied for '$checkfile'!";
$checkfilehandle = fopen('config/' . $checkfile, 'w');
fwrite($checkfilehandle, '<?php $allowauto="n"; ?>');
fclose($checkfilehandle);
}

$checkfile = 'autoneedsalt.php';
if (!file_exists('config/' . $checkfile)) {
$report = "Config files error, default setting applied for '$checkfile'!";
$checkfilehandle = fopen('config/' . $checkfile, 'w');
fwrite($checkfilehandle, '<?php $autoneedsalt="y"; ?>');
fclose($checkfilehandle);
}

$checkfile = 'businessname.php';
if (!file_exists('config/' . $checkfile)) {
$report = "Config files error, default setting applied for '$checkfile'!";
$checkfilehandle = fopen('config/' . $checkfile, 'w');
fwrite($checkfilehandle, '<?php $businessname="Change this business name in config/businessname.php or using the configuration utility."; ?>');
fclose($checkfilehandle);
}

$checkfile = 'db.php';
if (!file_exists('config/' . $checkfile)) {
$report = "Config files error, default setting applied for '$checkfile'!";
$checkfilehandle = fopen('config/' . $checkfile, 'w');
fwrite($checkfilehandle, '<?php $mdb="mysqldatabase"; ?>');
fclose($checkfilehandle);
}

$checkfile = 'host.php';
if (!file_exists('config/' . $checkfile)) {
$report = "Config files error, default setting applied for '$checkfile'!";
$checkfilehandle = fopen('config/' . $checkfile, 'w');
fwrite($checkfilehandle, '<?php $mhost="localhost"; ?>');
fclose($checkfilehandle);
}

$checkfile = 'pss.php';
if (!file_exists('config/' . $checkfile)) {
$report = "Config files error, default setting applied for '$checkfile'!";
$checkfilehandle = fopen('config/' . $checkfile, 'w');
fwrite($checkfilehandle, '<?php $mpss="root"; ?>');
fclose($checkfilehandle);
}

$checkfile = 'salt.php';
if (!file_exists('config/' . $checkfile)) {
$report = "Config files error, default setting applied for '$checkfile'!";
$checkfilehandle = fopen('config/' . $checkfile, 'w');
fwrite($checkfilehandle, '<?php $salt="defaultsalt"; ?>');
fclose($checkfilehandle);
}

$checkfile = 'usr.php';
if (!file_exists('config/' . $checkfile)) {
$report = "Config files error, default setting applied for '$checkfile'!";
$checkfilehandle = fopen('config/' . $checkfile, 'w');
fwrite($checkfilehandle, '<?php $musr="root"; ?>');
fclose($checkfilehandle);
}

$checkfile = 'updatecheck.php';
if (!file_exists('config/' . $checkfile)) {
$report = "Config files error, default setting applied for '$checkfile'!";
$checkfilehandle = fopen('config/' . $checkfile, 'w');
fwrite($checkfilehandle, '<?php $updatecheck="y"; ?>');
fclose($checkfilehandle);
}

$checkfile = 'widgetenabled.php';
if (!file_exists('config/' . $checkfile)) {
$report = "Config files error, default setting applied for '$checkfile'!";
$checkfilehandle = fopen('config/' . $checkfile, 'w');
fwrite($checkfilehandle, '<?php $widgetenabled="n"; ?>');
fclose($checkfilehandle);
}

$checkfile = 'toptablebold.php';
if (!file_exists('config/' . $checkfile)) {
$report = "Config files error, default setting applied for '$checkfile'!";
$checkfilehandle = fopen('config/' . $checkfile, 'w');
fwrite($checkfilehandle, '<?php $toptablebold="y"; ?>');
fclose($checkfilehandle);
}

?>