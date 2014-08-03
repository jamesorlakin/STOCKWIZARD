<?php
function initializehtml() {
echo '<html><head><title>STOCKWIZARD Testing Utility</title></head><body>';
}
function finishhtml() {
echo '<p><a href="javascript:window.close()">Click to close</a></body></html>';
}

if ($_GET['test'] == 'sessions') {
session_start();
$_SESSION['testing_session_support'] = 'working';
header('Location: tests.php?test=sessions2');
}

if ($_GET['test'] == 'sessions2') {
session_start();
initializehtml();
if ($_SESSION['testing_session_support'] == 'working') {
echo '<p>Sessions work. You have session support.</p>';
} else {
echo '<p>Sessions do not work, please check your browser cookie settings and check in php.ini that sessions are enabled.</p>';
}
finishhtml();
}

if ($_GET['test'] == 'urlfetch') {
initializehtml();
if (file_get_contents('http://jameslakin.co.uk/stockwizard/verify.txt') == 'fetchedfromupdateserver') {
echo '<p>Successfully fetched data from update server.</p>';
} else {
echo '<p>Unable to fetch data from update server, check connectivity and that PHP scripts are allowed to use fopen by URL.</p>';
}
finishhtml();
}

?>