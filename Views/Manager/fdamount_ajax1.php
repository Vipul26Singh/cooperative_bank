<?php

include '../superadmin-session.php';
//print_r("testing"); exit;   
mysql_query("START TRANSACTION");
$currentdate = date('Y-m-d H:i:s');
$selectdata = mysql_fetch_array(mysql_query("SELECT * FROM fdaccount WHERE CustomerID='" . $_POST['CustomerID'] . "' and FdNo='" . $_POST['FdNo'] . "' ")) or die(mysql_error());
$maturitydate = $selectdata['MaturityDate'];
$maturityamount = $selectdata['MaturityAmount'];
$lastid = $selectdata['FDId'];
$Transactiondate = date('Y-m-d', strtotime($_POST['TransactionDate']));
//print_r($maturitydate); echo "<br>";
//print_r($Transactiondate); //exit;

if ((date('Y-m-d', strtotime($maturitydate))) > ( date('Y-m-d', strtotime($Transactiondate)))) {

    $response['cid'] = $selectdata['CustomerID'];
    $response['fdno'] = $selectdata['FdNo'];
    $response['Amountnew'] = $_POST['Amountnew'];
    $response['Remarknew'] = $_POST['Remarknew'];
    $response['TransactionType'] = $_POST['TransactionType'];
    $response['Transactionmode'] = $_POST['Transactionmode'];
    $response['result'] = 1;
    echo json_encode($response);
    exit;
}
if ((date('Y-m-d', strtotime($maturitydate))) <= ( date('Y-m-d', strtotime($Transactiondate)))) {

    $bal_amount = $selectdata['MaturityAmount'];
    $sqlinsert = mysql_query("insert into fdtransaction set
                                   FDId='" . $lastid . "',
		                               FdNo='" . $_POST['FdNo'] . "',
                                   CustomerID='" . $_POST['CustomerID'] . "',
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
                       FDAmount='" . $_POST['FDAmount'] . "',
                       WithdrawDate='" . $currentdate . "',
                       ModifiedBy='" . $_SESSION['userid'] . "',
                       ModifiedDate='" . $currentdate . "' 
                       where CustomerID='" . $_POST['CustomerID'] . "' and FdNo='" . $_POST['FdNo'] . "' ");

    if ($insert and $sqlinsert) {
        mysql_query("COMMIT");
        //echo 'Commit'; exit;
        $response['result'] = 2;
        echo json_encode($response);
        exit;
    } else {
        mysql_query("ROLLBACK");
        //echo 'rollback'; exit;
    }
}
?>