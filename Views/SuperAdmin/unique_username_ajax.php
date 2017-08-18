<?php
//echo $_POST['user'];
include '../superadmin-session.php';

$sqlcode = mysql_fetch_array(mysql_query("SELECT count(Username) as username FROM `userinfo` where Username = '" . $_POST['user'] . "' ")) or die(mysql_error());

if ($sqlcode['username'] != 0) {
    ?><span style="color: #FF0000;">Enter username is already present.</span><?php
}
?>

