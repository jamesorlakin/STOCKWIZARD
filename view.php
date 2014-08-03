<html>

<head>
<meta http-equiv="Content-Language" content="en-gb">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>STOCKWIZARD - View</title>
<style type="text/css">
   div.topright {    
   display:block;
   position:absolute;
   top:15;
   right:-2;
   width:350px;
   background:#eee;
   border:1px solid #ddd; 
}

   div.toprightlower {    
   display:block;
   position:absolute;
   top:45;
   right:-2;
   width:350px;
   background:#eee;
   border:1px solid #ddd; 
}
</style>
<style type="text/css"> a { color:blue; } </style>
</head>

<body>
<script src="confirm/message.js"></script><link rel="stylesheet" href="confirm/message.css"/>
<?php
if (isset($report)) {
echo '<div class="topright"><a href="logout.php">Logout</a> | <a href="configedit.php">Configuration</a> | ' . $report . '</div>';
} elseif (isset($_GET['msg'])) {
echo '<div class="topright"><a href="logout.php">Logout</a> | <a href="configedit.php">Configuration</a> | ' . $_GET['msg'] . '</div>';
} else {
echo '<div class="topright"><a href="logout.php">Logout</a> | <a href="cashier.php">Cashier</a> | <a href="configedit.php">Configuration</a> | STOCKWIZARD</div>';
}

if ($versionupdate == true) {
echo '<div class="toprightlower"><table><tr><td><img src="ui/warning.png"></td><td>An update is available! | <a href="updateavailable.php">Click here for more info</a></td></tr></table></div>';
} 
?>
<p><img border="0" src="logo.png" width="484" height="88" alt="STOCKWIZARD logo"></p>
<p></p>
<p>
<?php
if ($_GET['insert'] == 'yes') {
echo '<font color="#008000">ITEM HAS BEEN ADDED SUCCESSFULLY!</font></p>';
echo '<script>
dhtmlx.message("Item has been added successfully");
</script>';
}
if ($_GET['insert'] == 'no') {
echo '<font color="#FF0000">THERE WAS A PROBLEM WHILE INSERTING YOUR REQUEST, MAKE 
SURE YOU HAVE NO \' CHARACTERS</font></p>';
echo '<script>
dhtmlx.message("Error adding item");
</script>';
}
if ($_GET['del'] == 'yes') {
echo '<font color="#008000">Item deleted.</font></p>';
}
if ($_GET['edit'] ==  'yes') {
echo '<font color="#008000">Item modified.</font></p>';
}
if ($_GET['viewchange'] == 'yes') {
echo '<table><tr><td><img src="ui/warning.png"></td><td>You are currently using different ordering rules, to revert this back to normal please click <a href="showlist.php?viewchange=no">here</a></td></tr></table>';
}
?>
<?php //pluginbroadcast('menu', ' | '); ?>
<div id="conflictindicator"><table><tr><td><img src="ui/loadingcircle.gif" width="10" height="10"></td><td>Loading conflict status...</td></tr></table></div>
<script>
    function dialogconfirmstart(productid, number) {
        dhtmlx.confirm({
		type:"confirm",
    text: "Delete product?",
    callback: function(result){
        if (result == true) {
		window.document.location = "delete.php?id=" + productid + "&listnum=" + number;
		}
    }
	});
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
		document.getElementById("conflictindicator").innerHTML=xmlhttp.responseText;
	   }
	}
	xmlhttp.open("GET","conflictcheck.php?countonly=yes",true);
	xmlhttp.send();
</script>
<p align="left"><img src="ui/add.png"> <a href="make.php">Insert new product</a> | <img src="ui/add.png"> <a href="multimake.php">Multiple product insertion</a> | <img src="ui/search.png"> <a href="search.php">Search</a> | <img src="ui/house.png"> <a href="locations.php">Locations</a> | <img src="ui/down.png"> <a href="#bottom" name="top">Skip to bottom</a> | <img src="ui/documents.png"> <a href="stocktake.php">Stock take</a> | <img src="ui/barcode.png"> <a href="scanadd.php">Scan in products</a> | <img src="ui/view.png"> <a href="showlist.php?viewchange=yes">Re-order</a> | <?php pluginbroadcast('menu'); ?>Products:</p>
<hr>