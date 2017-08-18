<?php

include '../superadmin-session.php';
error_reporting(0);
/* echo  $_POST['Balance'];
  echo $_POST['Interest'];
  echo  $_POST['Duration']; */

$t1 = $_POST['Duration'];
$r1 = $_POST['Interest'];
$p = $_POST['Balance'];
$n = 1;
$t = $t1 / 365;
$r = $r1 / 100;

$maturityamount = $p * (pow((1 + $r / $n), ($n * $t)));
echo round($maturityamount, 2);
/* a = p * (Math.Pow((1 + r / n), n * t));
  n=1;
  t = t / 365;
  r = r / 100;
  a=maturity amount
  r=interest
  t=durationindays
  p=fdamount */
?>

