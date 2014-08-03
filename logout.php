<?php

session_start();
unset($_SESSION['loggedin']);
unset($_SESSION['loggedinas']);
unset($_SESSION['who']);
$_SESSION['admin'] = 'no';
header('Location: index.php?loggedout=yes');

?>