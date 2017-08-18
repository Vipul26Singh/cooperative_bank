<?php

include 'config.php';
$randno = rand();
// print_r($_REQUEST); exit;
$email = $_REQUEST['email'];
$code = $_REQUEST['varificationcode'];
$to = $email;
$subject = "Application activation";
$message = "This is your veryfication code : $code <br/>";
$message .= "Thank You.";
$header = "From:creditcoperativeactivation@gmail.com \r\n";
$retval = mail($to, $subject, $message, $header);

if ($retval == true) {
    $email1 = $_REQUEST['email'];
    $to1 = "creditcoperativeactivation@gmail.com";
    $subject1 = "Application activation";
    $message1 = "This $email1 user is actived";
    $message1 .= "User veryfication code : $code <br/>";
    $message1 .= "Thank You.";
    $header1 = "From:creditcoperativeactivation@gmail.com \r\n";
    $retval1 = mail($to1, $subject1, $message1, $header1);

    if ($retval1 == true) {
        //$response['code'] =$randno;
        // $response['codesend'] ='1';
        echo "1";
    } else {
        // $response['code'] =$randno;
        // $response['codesend'] ='2';
        //echo "2";
        echo "2";
    }
} else {
    //$response['code'] =$randno;
    // $response['codesend'] ='2';  
    echo "2";
}
?>