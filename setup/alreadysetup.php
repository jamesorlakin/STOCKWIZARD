<html>
<head><title>STOCKWIZARD Setup Utility</title></head>

<body>
<p align="center"><img src="setuplogo.png"></p>
<br /><br />
<?php
if (!file_exists('../settings.php')) {
echo '<h1>Please note this does not apply to you!</h1>';
}
?>
<p><b>STOCKWIZARD already has a configuration, if you need to reset this please delete settings.php or edit individual settings through the STOCKWIZARD configuration manager (top right on the main stock list).</b></p>
<p><a href="../index.php">Click here to exit the STOCKWIZARD Setup Utility</a></p>

</body>
</html>