<?php
session_start();

if ($_SESSION['loggedin'] == 'yes') {
if ($_SESSION['admin'] == 'yes') {
require('settingsdbc.php');
echo '<title>STOCKWIZARD - Configuration</title>';
include('header.htm');
echo '<script src="confirm/message.js"></script><link rel="stylesheet" href="confirm/message.css"/>';
echo '<p><a href="showlist.php">Back to products</a> | STOCKWIZARD Configuration:</p>';
if ($_GET['updated'] == 'yes') {
echo '<script>
dhtmlx.message("Configuration updated");
</script>';
}
if ($_GET['newuser'] == 'yes') {
echo '<script>
dhtmlx.message("New user created");
</script>';
}
if ($_GET['oneadmin'] == 'yes') {
echo '<script>
dhtmlx.alert("Only one administrator left, you cannot disable the last one. If you were to disable all of the administrators you would not have any control over the configuration of this system!");
</script>';
}
echo '<font><b>MySQL Configuration:</b></font>';
if ($dbc == false) {
echo '<p><font style="background-color: #FE8080;"><table><tr><td><img src="ui/cross.png"></td><td>Database connection error! Make sure your MySQL configuration is correct.</td></tr></table></font></p>';
}
echo '<table border="0" style="margin-left: 10px;" width="50%">';
echo '<tr><td>Username:</td><td>' . $musr . '</td><td><a href="configrename.php?setting=usr">Edit</a></td></tr>';
echo '<tr><td>Password:</td><td>' . $mpss . '</td><td><a href="configrename.php?setting=pss">Edit</a></td></tr>';
echo '<tr><td>Host:</td><td>' . $mhost . '</td><td><a href="configrename.php?setting=host">Edit</a></td></tr>';
echo '<tr><td>Database:</td><td>' . $mdb . '</td><td><a href="configrename.php?setting=db">Edit</a></td></tr>';
echo '</table>';


echo '<font><b>User management:</b></font>';
$q = "SELECT * FROM simusr";
$r = @mysqli_query($dbc, $q);
echo '<script>
    function dialogconfirmstart(username) {
        dhtmlx.confirm({
    type:"confirm",
    text: "Delete user?",
    callback: function(result){
        if (result == true) {
    window.document.location = "configdeleteuser.php?username=" + username;
    }
    }
  });
    }
    </script>';
echo '<table border="0" style="margin-left: 10px;" width="50%">';
echo '<tr><td><u>Username</u></td><td><u>Password</u></td><td><u>Admin</u></td><td><a href="confignewuser.php">New user</a></td></tr>';
while ($cr = @mysqli_fetch_array($r)) {
if ($cr['admin'] != "y") {
$adminlink = '<a href="configadmin.php?enable=yes&username=' . $cr['username'] . '">Enable admin</a>';
} else {
$adminlink = '<a href="configadmin.php?enable=no&username=' . $cr['username'] . '">Disable admin</a>';
}
echo '<tr><td>' . $cr['username'] . '</td><td><a href="configresetpassword.php?username=' . $cr['username'] . '">Change password</a></td><td>' . $adminlink . '</td><td><a href="javascript:dialogconfirmstart(\'' . $cr['username'] . '\')">Delete user</a></td></tr>';
}
echo '</table>';


echo '<font><b>STOCKWIZARD Options:</b></font>';
echo '<table border="0" style="margin-left: 10px;" width="50%">';
//
echo '<tr><td>Business name:</td><td>' . $businessname . '</td><td></td><td><a href="configrename.php?setting=businessname">Edit</a></td></tr>';
//
echo '<tr><td>Salt:</td><td>' . $salt . '</td><td></td><td><a href="configrename.php?setting=salt">Edit</a></td></tr>';
//
if ($updatecheck == 'y') {
$settingstring = '<td>Enabled</td><td><img src="ui/tick.png"></td><td><a href="configchange.php?setting=updatecheck&value=n">Disable</a></td>';
} else {
$settingstring = '<td>Disabled</td><td><img src="ui/cross.png"></td><td><a href="configchange.php?setting=updatecheck&value=y">Enable</a></td>';
}
echo '<tr><td>Check for updates:</td>' . $settingstring . '</tr>';
//
if ($allowauto == 'y') {
$settingstring = '<td>Enabled</td><td><img src="ui/tick.png"></td><td><a href="configchange.php?setting=allowauto&value=n">Disable</a></td>';
} else {
$settingstring = '<td>Disabled</td><td><img src="ui/cross.png"></td><td><a href="configchange.php?setting=allowauto&value=y">Enable</a></td>';
}
echo '<tr><td>Allow login by URL:</td>' . $settingstring . '</tr>';
//
if ($autoneedsalt == 'y') {
$settingstring = '<td>Enabled</td><td><img src="ui/tick.png"></td><td><a href="configchange.php?setting=autoneedsalt&value=n">Disable</a></td>';
} else {
$settingstring = '<td>Disabled</td><td><img src="ui/cross.png"></td><td><a href="configchange.php?setting=autoneedsalt&value=y">Enable</a></td>';
}
echo '<tr><td>Login by URL require salt:</td>' . $settingstring . '</tr>';
//
if ($widgetenabled == 'y') {
$settingstring = '<td>Enabled</td><td><img src="ui/tick.png"></td><td><a href="configchange.php?setting=widgetenabled&value=n">Disable</a></td>';
} else {
$settingstring = '<td>Disabled</td><td><img src="ui/cross.png"></td><td><a href="configchange.php?setting=widgetenabled&value=y">Enable</a></td>';
}
echo '<tr><td>Locations widget:</td>' . $settingstring . '</tr>';
//
if ($toptablebold == 'y') {
$settingstring = '<td>Enabled</td><td><img src="ui/tick.png"></td><td><a href="configchange.php?setting=toptablebold&value=n">Disable</a></td>';
} else {
$settingstring = '<td>Disabled</td><td><img src="ui/cross.png"></td><td><a href="configchange.php?setting=toptablebold&value=y">Enable</a></td>';
}
echo '<tr><td>Top of product table is bold:</td>' . $settingstring . '</tr>';
echo '</table>';

// Allow plugins to give settings
echo '<hr>';
if (count($plugins) == 0) {
echo '<p style="text-size: 4px;">No plugins are currently installed.</p>';
} else {
$template = array('<font><b>', ':</b></font>', '<table border="0" style="margin-left: 10px;" width="50%">', '</table>');
pluginbroadcast('configedit', $template);
}

} else {
echo '<title>STOCKWIZARD - Configuration</title>';
include('header.htm');
echo '<p><a href="showlist.php">Back to products</a> | STOCKWIZARD Configuration:</p>';
echo '<p><b>Your account has not got administrative permissions enabled, please contact a system administrator if you wish to enable this functionality.</b></p>';
echo '<p>Change password:</p>';
echo '<form action="configresetpasswordgo.php" method="post">';
echo '<p>New password: <input type="password" name="password"></p>';
echo '<p><input type="hidden" name="username" value="' . $_SESSION['who'] . '"><input type="submit" value="Change password"></p>';
echo '</form>';
}
} else {
header('Location: index.php?login=no');
}
?>