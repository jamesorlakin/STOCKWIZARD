<?php
session_start();
if ($_SESSION['loggedin'] == 'yes') {
echo '<title>STOCKWIZARD - Add location</title>';
include('header.htm');
echo '<p><a href="locations.php">Back to locations</a> | Add location:</p>';
echo '<form action="locationsaddgo.php">';
echo '<p>Location name: <input name="locname"></p>';
echo '<input type="submit" value="Add location">';
echo '</form>';
} else {
header('Location: index.php?login=no');
}

?>