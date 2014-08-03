<?php
session_start();
if ($_SESSION['loggedin'] == 'yes') {
echo '<title>STOCKWIZARD - Location management</title>';
require('settings.php');
include('headerui.html');
echo '<p><a href="showlist.php">Back to normal view</a> | <a href="locationsadd.php">Add new location</a> | Locations:</p>';
$q = "SELECT * FROM simlocations";
$r = mysqli_query(mysqli_connect($mhost, $musr, $mpss, $mdb), $q);
echo '<script src="confirm/message.js"></script><link rel="stylesheet" href="confirm/message.css"/><script>
    function dialogconfirmstart(locationid) {
        dhtmlx.confirm({
		type:"confirm",
    text: "Delete location and products associated with it?",
    callback: function(result){
        if (result == true) {
		window.document.location = "locationslocationdelete.php?id=" + locationid;
		}
    }
	});
    }
    </script>';
echo '<table border="1">
<tr><td>Location</td><td>Options</td></tr>';
while ($cr = mysqli_fetch_array($r)) {
echo '<tr><td>' . $cr['name'] . '</td><td><a href="locationsshowlist.php?id=' . $cr['id'] . '">View</a> | <a href="javascript:dialogconfirmstart(' . $cr['id'] . ')">Delete location and all products associated with it</a></td></tr>';
}
echo '</table>';
} else {
header('Location: index.php?login=no');
}
?>