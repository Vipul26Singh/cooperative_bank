<?php

session_start();
//set random name for the image, used time() for uniqueness
error_reporting(0);
$filename = time() . '.jpg';
$filepath = '../upload/' . $filename;
$_SESSION['filepath'] = $filename;
//read the raw POST data and save the file with file_put_contents()
$result = file_put_contents($filepath, file_get_contents('php://input'));
if (!$result) {
    print "ERROR: Failed to write data to $filepath, check permissions\n";
    exit();
}

echo $filepath;
?>