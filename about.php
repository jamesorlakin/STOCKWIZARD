<?php
session_start();
include('header.htm');
include('settings.php');
echo '<p><a href="showlist.php">Back to products</a> | About STOCKWIZARD:</p>';
echo '<p>STOCKWIZARD by Jamster Technologies</p>';
echo '<p>Version ' $version . '</p>';
echo '<p>Provided for ' . $businessname . '</p>';

?>