<?php

include '../superadmin-session.php';

mysql_query("START TRANSACTION");
$currentdate = date('Y-m-d H:i:s');

$selectdata = mysql_fetch_array(mysql_query("SELECT * FROM fdaccount WHERE CustomerID='" . $_POST['cid'] . "' and FdNo='" . $_POST['fdno'] . "' ")) or die(mysql_error());
$maturitydate = $selectdata['MaturityDate'];
$maturityamount = $selectdata['MaturityAmount'];
$lastid = $selectdata['FDId'];
$_POST['TransactionDate'] = date("Y-m-d");
$Transactiondate = date('Y-m-d', strtotime($_POST['TransactionDate']));


$bal_amount = $selectdata['MaturityAmount'];
$sqlinsert = mysql_query("insert into fdtransaction set
                       FDId='" . $lastid . "',
		                   FdNo='" . $_POST['fdno'] . "',
                       CustomerID='" . $_POST['cid'] . "',
                       TransactionDate='$Transactiondate',
		                   Balance='" . $_POST['Amountnew'] . "', 
		                   TransactionType='" . $_POST['TransactionType'] . "',
                       Withdraw='" . $_POST['Amountnew'] . "',
                       Transactionmode='" . $_POST['Transactionmode'] . "',
		                   Remark='" . $_POST['Remarknew'] . "',
                       BranchId ='" . $_SESSION['branch_id'] . "',
		                   ModifiedBy='" . $_SESSION['userid'] . "',
                       ModifiedDate='" . $currentdate . "' ");



$insert = mysql_query("update fdaccount set 
                       FDAmount='" . $_POST['Amount'] . "',
                       WithdrawDate='" . $currentdate . "',
                       ModifiedBy='" . $_SESSION['userid'] . "',
                       ModifiedDate='" . $currentdate . "' 
                       where CustomerID='" . $_POST['cid'] . "' and FdNo='" . $_POST['fdno'] . "' ");

if ($sqlinsert and $insert) {
    mysql_query("COMMIT");
    echo 'Commit';
} else {
    mysql_query("ROLLBACK");
    echo 'rollback';
}
?>