<?php
session_start();
if (!file_exists('settings.php')) {
header('Location: setup/1.php');
die('No setup configuration found.');
}
if ($_SESSION['loggedin'] == 'yes') {
echo '<p align="center">Redirecting to main stock list.</p>';
echo '<p align="center"><img src="ui/spinningcircle.gif"></p>';
echo '<script>window.location = "showlist.php";</script>';
//header('Location: showlist.php');
die();
} else {
require('settings.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>STOCKWIZARD - Login</title>
</head>

<body>
<p align="center">
<img border="0" src="logo.png" width="591" height="101" alt="STOCKWIZARD logo"></p>
<p align="center"><font color="#0000FF"><?php echo $businessname ?> Stock Management | Login:</font></p>
<?php
if ($_GET['fail'] == 'yes') {
echo '<table align="center"><tr><td><img src="ui/cross.png"></td><td><font color="#FF0000">Username or password incorrect, please try again.</font></td></tr></table>';
}
if ($_GET['login'] == 'no') {
echo '<table align="center"><tr><td><img src="ui/warning.png"></td><td><font color="#FF0000">No login has been detected. Please login now.</font></td></tr></table>';
}
if ($_GET['loggedout'] == 'yes') {
echo '<table align="center"><tr><td><img src="ui/tick.png"></td><td><font color="#2BDE21">You are now logged out.</font></td></tr></table>';
}
if (is_string(strstr($_SERVER['HTTP_USER_AGENT'], 'MSIE'))) {
echo '<table align="center"><tr><td><img src="ui/warning.png"></td><td>Internet Explorer has some compatibility issues. Please try and use another browser if you have the option.</td></tr></table>';
}
if ($_GET['newinstall'] == 'yes') {
echo '<table align="center"><tr><td><img src="ui/tick.png"></td><td>Welcome to STOCKWIZARD! Please login with the administrator credentials you set in the installation process.</td></tr></table>';
}
?>
<script>
function buttonhide() {
var but = window.document.getElementById('loginbutton');
but.style.display='none';
var butarea = window.document.getElementById('loginbuttonarea');
butarea.style.visibility='visible';
return true;
}

var xmlhttp;
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
	xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
	if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		document.getElementById("connectindicator").innerHTML=xmlhttp.responseText;
	   }
	}
	xmlhttp.open("GET","connectioncheck.php?index=yes",true);
	xmlhttp.send();
</script>
<form action="login.php" onsubmit="buttonhide()" method="post">
<p align="center">Username:
<input type="text" alt="username" value="<?php echo $_COOKIE['simusr']; ?>" name="usr">
</p>
<p align="center">Password:<input alt="password" type="password" name="pss"></p>
<p id="loginbutton" align="center"><input type="submit" value="Login"><input type="hidden" name="sub" value="y"></p>
<div style="visibility: collapse;" id="loginbuttonarea"><p align="center"><img src="ui/loadingcircle.gif" width="32" height="32"></p></div>
</form>
<table style=" position: absolute; bottom: 0; left: 0; width: 100%;"><tr><td><div id="connectindicator"><img src="ui/loadingcircle.gif" width="16" height="16"> Checking system status...</div></td><td align="right">STOCKWIZARD <?php echo $version; ?></td></tr></table>
</body>
</html>
<?php } ?>