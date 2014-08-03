<?php
if (file_exists('../settings.php')) {
header('Location: alreadysetup.php');
die();
}
if ($_GET['agree'] == 'yes') {
header('Location: 3.php');
die();
}
?>
<html>
<head>
<head><title>STOCKWIZARD Setup Utility - Step 2</title></head>

<body>
<p align="center"><img src="setuplogo.png"></p>
<br><br>
<p style="color: grey;"><b>Welcome</b> -> <b>Licence</b> -> MySQL credentials -> MySQL table creation -> User creation -> Additional options -> Done!</p>

<p>Please read the licence agreement.</p>
<p><b>By using, installing, modifying or distributing this software you agree that you are bound to all the terms outlined below:</b></p>
<ul>
<li>This software is provided open source and must not be sold (modified or unmodified) unless explicit permission has been given by Jamster Technologies.</li>
<li>If modifying this software, you must credit the work of Jamster Technologies, your own credit is acceptable in conjunction with the Jamster Technologies credit. (For example: "Based on original work by Jamster Technologies and modified by John Smith"). This is not required if being modified for personal use.</li>
<li>Do not distribute a modified version of STOCKWIZARD without informing the end user that is modified and is not the official version distributed by Jamster Technologies. A simple message on the welcome screen should suffice.</li>
<li>Jamster Technologies provides no warranty, in that any failures that may occur (however unlikely) are not of Jamster Technologies fault.</li>
</ul>
<form action="2.php">
<p>Do you agree to the terms outlined above? <select name="agree"><option value="no">No</option><option value="yes">Yes</option></select></p>
<?php
if ($_GET['agree'] == 'no') {
echo '<p style="color: red;">You must agree to the licence to continue the installation.</p>';
}
?>
<p><input type="submit" value="Continue"></p>
</form>

</body>
</html>