<?php

include '../superadmin-session.php';


$sqlbranch = mysql_fetch_array(mysql_query("SELECT * from  accounttype where AccountTypeid='" . $_POST['val'] . "'  "));


print_r($sqlbranch['MinimumBal']);
?>
                    