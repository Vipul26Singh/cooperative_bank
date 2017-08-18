<?php

include '../superadmin-session.php';
error_reporting(0);
$sql1 = mysql_query("SELECT * FROM customer where 	CustomerID='" . $_POST['cid'] . "' ");
$row = mysql_fetch_array($sql1);

// Replace with your username
$user = $_POST['username'];

// Replace with your API KEY (We have sent API KEY on activation email, also available on panel)
$apikey = $_POST['apikey'];

// Replace if you have your own Sender ID, else donot change
$senderid = $_POST['senderid'];

// Replace with the destination mobile Number to which you want to send sms
$mobile = $row['MobileNo'];
// Replace with your Message content
$message = "Hello " . $row['CustomerName'] . " Your customer ID is " . $row['CustomerID'] . "";
$message = urlencode($message);

//print_r($message); exit;
// For Plain Text, use "txt" ; for Unicode symbols or regional Languages like hindi/tamil/kannada use "uni"
$type = "txt";

$ch = curl_init("http://smshorizon.co.in/api/sendsms.php?user=" . $user . "&apikey=" . $apikey . "&mobile=" . $mobile . "&senderid=" . $senderid . "&message=" . $message . "&type=" . $type . "");


curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);


// Display MSGID of the successful sms push
echo ($output);
print_r("1");
?>
