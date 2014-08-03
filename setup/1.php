<?php
if (file_exists('../settings.php')) {
header('Location: alreadysetup.php');
die();
}
?>
<html>
<head><title>STOCKWIZARD Setup Utility - Step 1</title></head>

<body>
<p align="center"><img src="setuplogo.png"></p>
<br><br>
<p style="color: grey;"><b>Welcome</b> -> Licence -> MySQL credentials -> MySQL table creation -> User creation -> Additional options -> Done!</p>

<p><b>Welcome to the STOCKWIZARD setup utility!</b></p>
<p>This utility will help you to configure a new installation of STOCKWIZARD. Please make sure you have the following:</p>
<ul>
<li>PHP session support | <a href="javascript:window.open('tests.php?test=sessions', '');">Test</a></li>
<li>A MySQL database and permission for SELECT, INSERT, CREATE, DELETE and UPDATE</li>
<li>Write access to all files in STOCKWIZARD folders</li>
<li><i>Optional</i> | PHP URL access for updates | <a href="javascript:window.open('tests.php?test=urlfetch', '');">Test</a></li>
<li>A few minutes of spare time</li>
</ul>
<p><form action="2.php"><input type="submit" value="That sounds great, lets go!"></form></p>

</body>
</html>