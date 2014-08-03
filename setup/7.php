<?php
if (file_exists('../settings.php')) {
header('Location: alreadysetup.php');
die();
}

if ($_GET['complete'] == 'yes') {
$h = fopen("../settings.php", 'w');
fwrite($h, '<?php foreach (glob("config/*.php") as $filename) { include $filename; } include(\'version.php\'); ?>');
fclose($h);
header('Location: ../index.php?newinstall=yes');
}
?>
<html>
<head>
<head><title>STOCKWIZARD Setup Utility - Step 3</title></head>

<body>
<p align="center"><img src="setuplogo.png"></p>
<br><br>
<p style="color: grey;"><b>Welcome</b> -> <b>Licence</b> -> <b>MySQL credentials</b> -> <b>MySQL table creation</b> -> <b>User creation</b> -> <b>Additional options</b> -> <b>Done!</b></p>
<p>STOCKWIZARD is almost setup! Click the link below to finish the installation process and continue onto the login screen.</p>
<h2 align="center"><a href="7.php?complete=yes">Finalize installation.</a></h2>

</body>
</html>