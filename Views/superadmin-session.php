<?php
    global $db;
    include '../../config.php';
    error_reporting(0);
  
    session_start();// Starting Session
    // Storing Session
    $user_check=$_SESSION['login_user'];
    // SQL Query To Fetch Complete Information Of User
    $ses_sql = mysql_query("select UserId, Username, Userimage from userinfo where Username='$user_check'") or die(mysql_error());
    $row = mysql_fetch_assoc($ses_sql);
    $login_session = $row['Username'];
    $login_session_id = $row['UserId'];
    $filepath = "../upload/";
    $_SESSION['uimage'] = $row['Userimage'];
    if(!isset($login_session)){
    mysql_close($db); // Closing Connection
    header('Location:../login.php'); // Redirecting To Home Page
}
?>
