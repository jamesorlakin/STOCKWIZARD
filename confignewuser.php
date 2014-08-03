<?php
session_start();

if ($_SESSION['loggedin'] == 'yes') {
if ($_SESSION['admin'] == 'yes') {
echo '<title>STOCKWIZARD - New user</title>';
include('header.htm');
echo '<p><a href="showlist.php">Back to products</a> | <a href="configedit.php">Back to configuration</a> | New user:</p>';
echo '<form action="confignewusergo.php" method="post"><table>
<tr><td>Username: </td><td><input name="username"></td></tr>
<tr><td>Password: </td><td><input type="password" name="password"></td></tr>
<tr><td>Account type: </td><td><select name="type"><option value="user">User</option><option value="admin">Admin</option></select></td></tr>
</table>
<p><input type="submit" value="Create new user"></p>
</form>';
} else {
header('Location: configedit.php');
}
} else {
header('Location: index.php?login=no');
}
?>
