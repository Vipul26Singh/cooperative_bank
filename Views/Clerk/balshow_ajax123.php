<?php

include '../superadmin-session.php';


$sqlbranch = mysql_fetch_array(mysql_query("SELECT * from  bankaccount where accountNo='" . $_POST['val'] . "' "));

$sqlbranch1 = mysql_fetch_array(mysql_query("SELECT * from  accounttype where AccountTypeid='" . $sqlbranch['AccountTypeid'] . "' "));


print_r($sqlbranch['Balance']);

