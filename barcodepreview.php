<?php
session_start();

if ($_SESSION['loggedin'] == 'yes') {
if ($_GET['ajax'] == 'yes') {
if (!empty($_GET['q'])) {
echo '<img src="http://www.barcodesinc.com/generator/image.php?code=' . $_GET['q'] . '&style=196&type=C128B&width=175&height=75&xres=1&font=4">';
}
} else {
echo '<title>STOCKWIZARD - Barcode</title>';
include('header.htm');
echo '<p><a href="showlist.php#list' . $_GET['list'] . '">Back to products</a> | Show barcode:</p>';
echo '<p><img src="http://www.barcodesinc.com/generator/image.php?code=' . $_GET['barcode'] . '&style=196&type=C128B&width=200&height=75&xres=1&font=4"></p>';
echo '<div id="viewproduct"><p align="center"><img src="ui/loadingcircle.gif" width="48" height="48"></p><p align="center">Loading product information...</p></div>';
echo '<script>
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
		document.getElementById("viewproduct").innerHTML=xmlhttp.responseText;
	   }
	}
	xmlhttp.open("GET","fetchproduct.php?barcode=' . $_GET['barcode'] . '",true);
	xmlhttp.send();
</script>';
}
} else {
echo '<p>Unauthorised.</p>';
}
?>