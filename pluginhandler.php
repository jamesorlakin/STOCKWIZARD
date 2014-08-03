<?php

$plugins = array();
// Provide a method for plugins to registered to receive hooks.
function registerplugin($fname) {
global $plugins;
$plugins[] = $fname;
return true;
}

// Function for STOCKWIZARD to broadcast hooks.
function pluginbroadcast($event, $eventdata = "none") {
global $plugins;
foreach ($plugins as $pluginfunction) {
$pluginfunction($event, $eventdata);
}
}

// Give functions that plugins can call, essentially a template.
function pluginoutputheader($pagetitle) {
echo '<html>
<head>
<title>STOCKWIZARD - ' . $pagetitle . '</title>
<meta http-equiv="Content-Language" content="en-gb">
</head>
<style>
a {
color:blue;
}
</style>
<body>
<p align="center"><img border="0" src="logo.png" width="591" height="101"></p>
<p align="center"></p>
<p align="center">&nbsp;</p>
<p align="left">&nbsp;</p>
<p><a href="showlist.php">Back to products</a> | ' . $pagetitle . ':</p>';
}

function pluginoutputfooter() {
echo '<hr /><p>STOCKWIZARD is not responsible for any content on this page as an external plugin generated it.</p></body></html>';
}

function pluginnewmenu($title, $link) {
echo ' | <a href="' . $link . '">' . $title . '</a>';
}

function plugincommandlink($broadcast, $message = "NONE", $messageparams = "NONE") {
return "plugincommand.php?broadcast=$broadcast&message=$message&messageparams=$messageparams";
}

// Load plugins
foreach (glob("plugins/*.php") as $pluginfile) {
include $pluginfile;
}

?>