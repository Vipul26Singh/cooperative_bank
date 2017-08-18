<?php

include '../superadmin-session.php';


$sqlaccount = mysql_fetch_array(mysql_query("SELECT * from loan l 
               	    inner join customer c ON c.CustomerID=l.CustomerID where  LoanId='" . $_POST['LoanId'] . "' "));

$sqlloanTransaction = mysql_fetch_array(mysql_query("SELECT * from  loantransaction  where  LoanId='" . $_POST['LoanId'] . "' ORDER BY LoanNumber DESC "));

$sqlloanTransaction2 = mysql_fetch_array(mysql_query("SELECT max(LoanTransactionId) as maxid from  loantransaction  where  LoanNumber='" . $_POST['val'] . "' ORDER BY LoanNumber DESC "));

$sqlloanTransaction123 = mysql_fetch_array(mysql_query("SELECT installment_date from  loantransaction  where  LoanTransactionId='" . $sqlloanTransaction2['maxid'] . "' ORDER BY LoanNumber DESC "));

if ($sqlloanTransaction == '') {
    $InstallmentDate = $sqlaccount['FirstInstallmentDate'];
} else {
    $InstallmentDate = date('Y-m-d', strtotime($sqlloanTransaction123['installment_date'] . "+1 months"));
}

$currentdate = date("Y-m-d");
$installDay = date('d', strtotime($InstallmentDate));
$currentDay = date('d', strtotime($currentdate));
$emi = $sqlaccount['installmentamount'];
$interest = $sqlaccount['Interestrate'];
$start = date('Y-m-d', strtotime($sqlaccount['DisburseDate']));
$end = date('Y-m-d', strtotime($sqlaccount['FirstInstallmentDate']));

/* ----Same date insttallment pay functionality start--- */
if ($installDay == $currentDay) {
    if ($sqlloanTransaction == '') {
        if ($currentdate > $InstallmentDate) {
            $data = round(abs(strtotime($start) - strtotime($currentdate)) / 86400);
        } else {
            $data = round(abs(strtotime($start) - strtotime($end)) / 86400);
        }
    } else {

        $nextday = date('Y-m-d', strtotime($InstallmentDate . "+1 months"));

        if ($currentdate > $InstallmentDate) {
            $data = round(abs(strtotime($InstallmentDate) - strtotime($currentdate)) / 86400);
        } else {
            $data = round(abs(strtotime($installDay) - strtotime($currentDay)) / 86400);
        }
    }
}

/* ----Same date insttallment pay functionality end--- */

/* ---- insttallment date greter than current date functionality start--- */ else if ($currentdate < $InstallmentDate) {
    if ($sqlloanTransaction == '') {
        $data = round(abs(strtotime($start) - strtotime($currentdate)) / 86400);
    } else {
        $data = round(abs(strtotime($InstallmentDate) - strtotime($InstallmentDate)) / 86400);
    }
}

/* ---- Insttallment date greter than current date functionality end-- */

/* ---- Current date greter than  insttallment date functionality start-- */ else {

    if ($sqlloanTransaction == '') {
        $data = round(abs(strtotime($start) - strtotime($currentdate)) / 86400);
    } else {
        $nextday = date('Y-m-d', strtotime($InstallmentDate . "+1 months"));
        $data = round(abs(strtotime($InstallmentDate) - strtotime($currentdate)) / 86400);
    }
}

/* ---- Current date greter than  insttallment date functionality end-- */

$emi = $sqlaccount['installmentamount'];
$interest = $sqlaccount['Interestrate'];
$outstanding = $sqlaccount['Balance'];

if ($data == 0) {
    $nextday = date('Y-m-d', strtotime($InstallmentDate . "+1 months"));

    if ($sqlloanTransaction == '') {
        $days = round(abs(strtotime($start) - strtotime($currentdate)) / 86400);
    } else {
        $days = round(abs(strtotime($InstallmentDate) - strtotime($nextday)) / 86400);
    }
} else {
    $nextday = date('Y-m-d', strtotime($InstallmentDate . "+1 months"));
    if ($sqlloanTransaction == '') {
        $days = round(abs(strtotime($start) - strtotime($currentdate)) / 86400);
    } else {
        $days = round(abs(strtotime($InstallmentDate) - strtotime($nextday)) / 86400) + $data;
    }
}

// $intrestamount = ((($outstanding) * ($_POST['interestamount']))/ 36500) * $days;
//   print_r($_POST['interestamount'] ); echo "<br>";
if ($sqlaccount['Balance'] > $emi) {

    if ($_POST['val'] > $_POST['Amountnew1']) {

        $principal = ($_POST['val'] - $_POST['interestamount']);
        $outstanding = $sqlaccount['Balance'] - ($principal);
        $odintrest = 0;
    } else {
        if ($_POST['val'] > $_POST['interestamount']) {
            $odintrest = ($_POST['val']) - ($_POST['interestamount']);
            $outstanding = $sqlaccount['Balance'] - ($odintrest);
            $principal = ($_POST['val'] - $_POST['interestamount']);
        } else {
            $principal = ($_POST['val'] - $_POST['interestamount']);
            $odintrest = ($_POST['interestamount']) - ($_POST['val']);
            $outstanding = $sqlaccount['Balance'];
        }
    }
} else {
    $outprincipal = $sqlaccount['Balance'];
    $principal = $outprincipal;
    $outstanding = $outprincipal - $principal;
}



/* if($sqlaccount['Balance'] > $emi)
  {
  if($_POST['val'] > $intrestamount)
  {
  $principal = ($_POST['val'] - $intrestamount);
  $outstandingbal = ($sqlaccount['Balance'] - $principal);
  }
  else
  {
  $principal = ($_POST['val'] - $intrestamount);
  $outstandingbal = $sqlaccount['Balance'];
  }
  }
  else
  {
  $outprincipal = $sqlaccount['Balance'];
  $principal = $outprincipal;
  $outstandingbal = $outprincipal - $principal;
  } */

$response['principal'] = round($principal, 2);
$response['odintrest'] = round($odintrest, 2);
$response['outstanding'] = round($outstanding, 2);
echo json_encode($response);
?>