<?php
session_start();

if ($_SESSION['loggedin'] == 'yes') {
echo '<title>STOCKWIZARD - Stock take wizard</title>';
include('header.htm');
echo '<p><a href="showlist.php">Back to products</a> | Stock take wizard:</p>';

switch ($_GET['step']) {
default:
echo '<p>Welcome to the stock take wizard.</p>';
echo '<p>To complete a stock take you will:</p>';
echo '<ui><li>Print out all the products onto paper</li><li>Count up stock and write down the new quantities onto the paper</li><li>Enter the new stock quantities into STOCKWIZARD</li></ui>';
echo '<p><input type="button" value="Continue" onclick="window.location = \'stocktakewizard.php?step=2\';"></p>';
break;

case 2:
echo '<p>Step 2.</p>';
echo '<p>You will need to print out your products onto paper. Click <a href="stocktake.php" target="_blank">here</a> to open the page to print.</p>';
echo '<p>After you have done this please click continue.</p>';
echo '<p><input type="button" value="Continue" onclick="window.location = \'stocktakewizard.php?step=3\'"></p>';
break;

case 3:
echo '<p>Step 3.</p>';
echo '<p>You will now count up all the stock and write down the quantities onto the paper. You may leave this wizard and resume at a later point in time if needed.</p>';
echo '<p>To start to enter the new values please click continue.</p>';
echo '<p><input type="button" value="Continue" onclick="window.location = \'stocktakewizard.php?step=4\'"></p>';
break;

case 4:
echo '<p>Step 4.</p>';
echo '<p>You will now enter the new quantities into STOCKWIZARD.</p>';
echo '<p>Below are all your products with a box to the right, please enter the new quantities in the corresponding boxes. You can use the tab key to jump to the next box.</p>';
break;
}

} else {
header('Location: index.php?login=no');
}

?>