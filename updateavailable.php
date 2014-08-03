<?php
require('settings.php');
echo '<title>STOCKWIZARD - Update available</title>';
include('header.htm');
//if ($versionupdate == true) {
//echo '<div border="red"><table><tr><td><img src="ui/warning.png"></td><td>This update has already been applied!</td></tr></table></div>';
//}
echo '<p><a href="showlist.php">Back to products</a> | Update available:</p>';
$veravail = file_get_contents("http://jameslakin.co.uk/stockwizard/version.txt?txt=" . rand(1,1000));
echo '<p>An update is available, version ' . $veravail . '.</p>';
echo '<p>More information:</p>';
echo '<div border="1">' . file_get_contents("http://jameslakin.co.uk/stockwizard/versioninfo.txt?txt=" . rand(1, 1000)) . '</div>';
echo '<p>Do you wish to update to ' . $veravail . '?</p>
<script>
function updatehide() {
var but = window.document.getElementById(\'updatebuttons\');
but.style.display=\'none\';
var butarea = window.document.getElementById(\'updatingarea\');
butarea.style.visibility=\'visible\';
return true;
}
</script>
<p id="updatebuttons"><a href="update.php" onclick="updatehide();">Yes</a> | <a href="showlist.php">No, later</a></p>
<div id="updatingarea" style="visibility: collapse;"><img src="ui/loadingcircle.gif"></div>';
?>