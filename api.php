<?php

require('settingsdbc.php');
function sr($msg) {
if ($_GET['type'] == 'print') {
echo $msg;
} else {
echo '<title>' . $msg . '</title>';
}
}

// SORT REQUESTS
if ($_GET['key'] == $salt) {

switch($_GET['request']) {
	case 'getsetting':
	sr($$_GET['requestmsg']);
	break;
	
	case 'listproductids':
	$q = "SELECT * FROM simlist";
	$r = mysqli_query($dbc, $q);
	if ($_GET['requestmsg'] == 'nocount') {
	$result = "";
	$count = 0;
	while ($cr = mysqli_fetch_array($r)) {
	if ($count = 0) {
	$result = $cr['id'];
	} else {
	$result = $result . ":" . $cr['id'];
	}
	$count = $count + 1;
	}
	
	} else {
	$result = mysqli_num_rows($r);
	while ($cr = mysqli_fetch_array($r)) {
	$result = $result . ":" . $cr['id'];
	}
	}
	sr($result);
	break;
	
	case 'selectproductbyid':
	$q = "SELECT * FROM simlist WHERE id = {$_GET['requestmsg']}";
	$r = mysqli_query($dbc, $q);
	$cr = mysqli_fetch_array($r);
	$tempval1 = $cr['unitprice']*((100-$cr['discount'])/100);
	$landedval = $tempval1+($tempval1*($cr['vat']/100));
	$stockval = $cr['quantity']*$landedval;
	@$marginval = ($cr['salesprice']-$landedval)/$cr['salesprice']*100;
	$totalstock = $totalstock+$stockval;
	$profit = $cr['salesprice']/100*$marginval;
	$output = "8:";
	$output = $output . $cr['dateofpurchase'] . ':';
	$output = $output . $cr['supplier'] . ':';
	$output = $output . $cr['productcode'] . ':';
	$output = $output . $cr['barcode'] . ':';
	$output = $output . $cr['description'] . ':';
	$output = $output . $cr['quantity'] . ':';
	$output = $output . $cr['unitprice'] . ':';
	$output = $output . $cr['discount'] . ':';
	$output = $output . $cr['vat'] . ':';
	$output = $output . number_format($landedval, 2) . ':';
	$output = $output . number_format($stockval, 2) . ':';
	$output = $output . $cr['salesprice'] . ':';
	$output = $output . number_format($marginval, 2) . ':';
	$output = $output . $profit;
	sr($output);
	break;
	
	case 'getversion':
	sr($versionnum);
	break;
	
	case 'saltcheck':
	sr('GOOD SALT');
	break;
	
}

} else {
sr('BAD SALT');
}

?>