<?php
sleep(1);
if ($_GET['index'] == 'yes') {
require('settingsdbc.php');
if ($dbc == false) {
echo '<img src="ui/cross.png"> Unable to connect to MySQL DB!';
} else {
echo '<img src="ui/tick.png"> Connection to MySQL server successful.';
}
}

?>