<?php
session_start();

if ($_SESSION['loggedin'] == 'yes') {
if ($_SESSION['admin'] == 'yes') {

if ((!empty($_GET['setting'])) or (!empty($_GET['value']))) {
$file = fopen('config/' . $_GET['setting'] . '.php', 'w');
switch ($_GET['setting']) {
case 'db':
	$_GET['setting'] = 'mdb';
	break;
case 'host':
	$_GET['setting'] = 'mhost';
	break;
case 'usr':
	$_GET['setting'] = 'musr';
	break;
case 'pss':
	$_GET['setting'] = 'mpss';
	break;
}
fwrite($file, '<?php $' . $_GET['setting'] . '="' . $_GET['value'] . '"; ?>');
fclose($file);
header('Location: configedit.php?updated=yes');
} else {
echo '<p>URL Query error</p>';
}

} else {
header('Location: configedit.php');
}
} else {
header('Location: index.php?login=no');
}
?>