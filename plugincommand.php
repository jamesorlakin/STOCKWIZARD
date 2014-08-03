<?php
session_start();

if ($_SESSION['loggedin'] == 'yes') {
require('settingsdbc.php');
pluginbroadcast($_GET['broadcast'], array($_GET['message'], $_GET['messageparams']));
} else {
header('Location: index.php?login=no');
}

?>