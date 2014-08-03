<?php
session_start();

if ($_SESSION['loggedin'] == 'yes') {
echo '<title>STOCKWIZARD - Multi create</title>';
include('headerui.html');
echo '<p><a href="showlist.php">Back to products</a> | Multi entry:</p>';
if (!empty($_POST['date'])) {
require('settings.php');
if (empty($_POST['barcodebox'])) {
$_POST['barcodebox'] = $_POST['productcode'];
}
$q = "INSERT INTO simlist (dateofpurchase, supplier, productcode, description, quantity, unitprice, discount, vat, salesprice, barcode) VALUES ('" . $_POST['date'] . "', '" . $_POST['supplier'] . "', '" . $_POST['productcode'] . "', '" . $_POST['description'] . "', '" . $_POST['quantity'] . "', '" . $_POST['unitprice'] . "', '" . $_POST['discount'] . "', '" . $_POST['vat'] . "', '" . $_POST['salesprice'] . "', '" . $_POST['barcodebox'] . "')";
$r = mysqli_query(mysqli_connect($mhost, $musr, $mpss, $mdb), $q);
if ($r == true) {
echo '<p>Entry inserted</p>';
} else {
echo '<p>Error occured!</p>';
}
}
echo '<p>The date, supplier, VAT and discount will be copied for each product entered here until you change it or exit this page back to all products.</p>';
echo '<form action="multimake.php" method="post">
<table>
<tr><td>Date (YYYY-MM-DD only):</td><td><input name="date" value="' . $_POST['date'] . '" id="datefield"></td></tr>
<tr><td>Supplier:</td><td><input name="supplier" id="supplier" value="' . $_POST['supplier'] . '"></td></tr>
<tr><td>Product code:</td><td><input name="productcode" onkeyup="checkproductcode(this)" onblur="checkproductcode(this)"></td><td><div id="productcodestatus"></div></td></tr>
<tr><td>Description:</td><td><input name="description"></td></tr>
<tr><td>Quantity:</td><td><input name="quantity"></td></tr>
<tr><td>Unit price:</td><td><input name="unitprice"></td><td rowspan="4" id="barcodepreview"></td></tr>
<tr><td>Discount:</td><td><input name="discount" value="' . $_POST['discount'] . '"></td></tr>
<tr><td>VAT:</td><td><input name="vat" value="' . $_POST['vat'] . '"></td></tr>
<tr><td>Sales price:</td><td><input name="salesprice"></td></tr>
<tr><td>Barcode:</td><td><input type="text" name="barcodebox" id="barcodebox" onkeyup="checkbarcode(this)"></td><td><div id="barcodestatus"></div></td></tr>
<tr><td>Barcode generation:</td><td><input type="button" id="generatebutton" value="Generate barcode" onclick="generatebarcode()"></td></tr>
</table>
<input type="submit" value="Insert product"></form>';
echo '<script>
function checkproductcode(ele) {
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("productcodestatus").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","productcodecheck.php?q=" + ele.value,true);
xmlhttp.send();
}

function checkbarcode(ele) {
var xmlhttp3;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp3=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp3=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp3.onreadystatechange=function()
  {
  if (xmlhttp3.readyState==4 && xmlhttp3.status==200)
    {
    document.getElementById("barcodestatus").innerHTML=xmlhttp3.responseText;
	showbarcode(ele);
    }
  }
xmlhttp3.open("GET","barcodecheck.php?q=" + ele.value,true);
xmlhttp3.send();
}

function generatebarcode() {
var xmlhttp4;
var genbut = document.getElementById("generatebutton");
genbut.disabled = "disabled";
genbut.value = "Generating...";
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp4=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp4=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp4.onreadystatechange=function()
  {
  if (xmlhttp4.readyState==4 && xmlhttp4.status==200)
    {
	var genbut = document.getElementById("generatebutton");
genbut.disabled = "";
genbut.value = "Generate barcode";
    document.getElementById("barcodebox").value = xmlhttp4.responseText;
	checkbarcode(document.getElementById("barcodebox"));
    }
  }
xmlhttp4.open("GET","barcodemakeajax.php",true);
xmlhttp4.send();
}

function showbarcode(ele) {
var xmlhttp5;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp5=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp5=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp5.onreadystatechange=function()
  {
  if (xmlhttp5.readyState==4 && xmlhttp5.status==200)
    {
    document.getElementById("barcodepreview").innerHTML=xmlhttp5.responseText;
    }
  }
xmlhttp5.open("GET","barcodepreview.php?ajax=yes&q=" + ele.value,true);
xmlhttp5.send();
}
</script>';
echo '</body></html>';
} else {
header('Location: index.php?login=no');
}
?>