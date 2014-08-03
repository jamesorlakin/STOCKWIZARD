<?php
if (file_exists('../settings.php')) {
header('Location: alreadysetup.php');
die();
}

if ($_GET['create'] == 'yes') {
require('../config/host.php');
require('../config/usr.php');
require('../config/pss.php');
require('../config/db.php');
$dbc = mysqli_connect($mhost, $musr, $mpss, $mdb);
if ($dbc == false) {
die('Connection error to MySQL database');
}
$q1 = "CREATE TABLE `simlist` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `dateofpurchase` varchar(500) NOT NULL,
  `supplier` varchar(500) NOT NULL,
  `productcode` varchar(500) NOT NULL,
  `barcode` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL,
  `quantity` varchar(500) NOT NULL,
  `unitprice` varchar(500) NOT NULL,
  `discount` varchar(500) NOT NULL,
  `vat` varchar(500) NOT NULL,
  `salesprice` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=82 ;";
$r1 = mysqli_query($dbc, $q1);
if ($r1 == false) {
die("Issue with creating table, please check MySQL user permissions\nOriginal query:\n" . $q1);
}

$q2 = "CREATE TABLE `simlocations` (
  `id` int(124) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;";
$r2 = mysqli_query($dbc, $q2);
if ($r2 == false) {
die("Issue with creating table, please check MySQL user permissions\nOriginal query:\n" . $q2);
}

$q3 = "CREATE TABLE `simlocationslist` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `dateoftransfer` varchar(500) NOT NULL,
  `supplier` varchar(500) NOT NULL,
  `productcode` varchar(500) NOT NULL,
  `barcode` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL,
  `quantity` varchar(500) NOT NULL,
  `unitprice` varchar(500) NOT NULL,
  `discount` varchar(500) NOT NULL,
  `vat` varchar(500) NOT NULL,
  `salesprice` varchar(500) NOT NULL,
  `locationid` int(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;";
$r3 = mysqli_query($dbc, $q3);
if ($r3 == false) {
die("Issue with creating table, please check MySQL user permissions\nOriginal query:\n" . $q3);
}

$q4 = "CREATE TABLE `simusr` (
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `admin` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
$r4 = mysqli_query($dbc, $q4);
if ($r4 == false) {
die("Issue with creating table, please check MySQL user permissions\nOriginal query:\n" . $q4);
}

header('Location: 5.php?created=yes');
die();
}

if ($_GET['create'] == 'no') {
header('Location: 5.php?created=no');
die();
}
?>
<html>
<head>
<head><title>STOCKWIZARD Setup Utility - Step 4</title></head>

<body>
<p align="center"><img src="setuplogo.png"></p>
<br><br>
<p style="color: grey;"><b>Welcome</b> -> <b>Licence</b> -> <b>MySQL credentials</b> -> <b>MySQL table creation</b> -> User creation -> Additional options -> Done!</p>
<p>STOCKWIZARD needs tables in the MySQL database. Would you like for STOCKWIZARD to create these tables automatically now?</p>
<form action="4.php">
<p><select name="create"><option value="yes">Yes, create these now.</option><option value="no">No, I have existing tables in this MySQL database.</option></select></p>
<p><input type="submit" value="Continue"></p>
</form>
</body>
</html>