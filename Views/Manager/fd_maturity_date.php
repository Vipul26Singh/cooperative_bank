<?php

include '../superadmin-session.php';

$sqlsetup = mysql_fetch_array(mysql_query("SELECT * FROM `fdsetup` WHERE fdsetupid='" . $_POST['val'] . "' "));

$days = $sqlsetup['durationindays'];
$date = date('d-m-Y');
$maturitydate = date('d-m-Y', strtotime($date . "+$days days"));

$response['durationindays'] = $sqlsetup['durationindays'];
$response['fdinterest'] = $sqlsetup['fdinterest'];
$response['fdsetupid'] = $sqlsetup['fdsetupid'];
$response['maturitydate'] = $maturitydate;


echo json_encode($response);
?>