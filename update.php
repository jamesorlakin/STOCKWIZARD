<?php
session_start();
require('settings.php');
sleep(0.1);
if ($versionupdate == true) {
file_put_contents("update.zip", file_get_contents("http://jameslakin.co.uk/stockwizard/update.zip?ran=" . rand(1, 1245)));
sleep(0.1);
require('pclzip.lib.php');
$archive = new PclZip('update.zip');
$archive->extract();
unset($archive);
//
$archive = new PclZip('update.zip');
$archive->extract();
unlink('update.zip');
unset($archive);

echo '<title>STOCKWIZARD - Update applied</title>';
include('header.htm');
echo '<p><a href="showlist.php">Back to products</a> | Update:</p><p><img src="ui/tick.png"> Update applied successfully! Your STOCKWIZARD version is now ' . $versionserver . '</p>';
} else {
header('Location: showlist.php?msg=No update needed');
}
?>