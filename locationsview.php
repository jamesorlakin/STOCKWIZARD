<html>

<head>
<meta http-equiv="Content-Language" content="en-gb">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>STOCKWIZARD - View</title>
</head>

<body>
<style>
a {
color:blue;
}
</style>
<p><img border="0" src="logo.png" width="484" height="88" alt="STOCKWIZARD logo"></p>
<p>
<p>
<?php
$q = "SELECT * FROM simlocations WHERE id = " . $_GET['id'];
$r = mysqli_query($dbc, $q);
$cr = mysqli_fetch_array($r);
?>
<p align="left"><a href="showlist.php">Back to main product list</a> | <a href="locations.php">Back to locations</a> | <a href="locationssearch.php?locationid=<?php echo $cr['id']; ?>&locationname=<?php echo $cr['name']; ?>">Search</a> | Current items in '<?php echo $cr['name']; ?>':</p>
<hr>