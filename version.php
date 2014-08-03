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

$setfile = fopen("settings.php", 'r');
if (!file_exists("settings.php.bak")) {
$setbackup = fopen("settings.php.bak", 'w');
fwrite($setbackup, fread($setfile, 700));
fclose($setbackup);
}
// UPDATING CONFIG SYSTEM IF NOT DONE ALREADY
if (is_string(strstr(fread($setfile, 280), '$mpss ='))) {
if (!isset($mpss)) {
require('settings.php');
}
if (!is_dir('config')) {
mkdir('config');
}
// COPY CURRENT SETTINGS INTO DIFFERENT FILES FOR EACH
$configfile = fopen('config/db.php', 'w');
fwrite($configfile, '<?php $mdb="' . $mdb . '"; ?>');
fclose($configfile);

$configfile = fopen('config/usr.php', 'w');
fwrite($configfile, '<?php $musr="' . $musr . '"; ?>');
fclose($configfile);

$configfile = fopen('config/pss.php', 'w');
fwrite($configfile, '<?php $mpss="' . $mpss . '"; ?>');
fclose($configfile);

$configfile = fopen('config/host.php', 'w');
fwrite($configfile, '<?php $mhost="' . $mhost . '"; ?>');
fclose($configfile);

$configfile = fopen('config/salt.php', 'w');
fwrite($configfile, '<?php $salt="' . $salt . '"; ?>');
fclose($configfile);

$configfile = fopen('config/allowauto.php', 'w');
fwrite($configfile, '<?php $allowauto="' . $allowauto . '"; ?>');
fclose($configfile);

$configfile = fopen('config/autoneedsalt.php', 'w');
fwrite($configfile, '<?php $autoneedsalt="' . $autoneedsalt . '"; ?>');
fclose($configfile);

$configfile = fopen('config/businessname.php', 'w');
fwrite($configfile, '<?php $businessname="' . $businessname . '"; ?>');
fclose($configfile);

// DELETE CURRENT SETTINGS FILE
@unlink('settings.php');
// MAKE SETTINGS FILE INCLUDE FILES
$configfile = fopen('settings.php', 'w');
fwrite($configfile, '<?php foreach (glob("config/*.php") as $filename) { include($filename); } include("version.php"); ?>');
fclose($configfile);
// REPORT THAT CONFIG HAS BEEN UPDATED
$report = "Config system updated, all configuration files are in the 'config' directory";
}


fclose($setfile);

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
fwrite($checkfilehandle, '<?php $businessname="Change this business name in config/businessname.php"; ?>');
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
fwrite($checkfilehandle, '<?php $widgetenabled="y"; ?>');
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