<?php

include '../superadmin-session.php';
error_reporting(0);
if ($_POST['mode'] == 'test') {
    $cid = $_POST['cid'];
    $approve_status = $_POST['approve_status'];
    $remark = $_POST['remark'];

    if (isset($approve_status) == "approve") {
        $sql1 = mysql_query("SELECT CustomerNo FROM customer ORDER BY CustomerNo DESC LIMIT 1");
        $row = mysql_fetch_array($sql1);
        $c_no = $row['CustomerNo'];
        $current_no = $c_no + 1;

        $sql = mysql_query("UPDATE customer SET `CustomerNo`='" . $current_no . "',`memactive`=1,`Approval`='" . $approve_status . "',`ApproverId`='" . $_SESSION['userid'] . "',`ApproverRemark`='" . $remark . "',`Approvaldate`=CURDATE(),`LastModifiedBy`='" . $_SESSION['userid'] . "',`LastModifiedDate`=CURTIME() WHERE CustomerID = $cid ") or die(mysql_error());

        if ($sql) {

            $sql1 = mysql_query("SELECT * FROM sms ");
            $row = mysql_fetch_array($sql1);
            $response['username'] = $row['username'];
            $response['apikey'] = $row['apikey'];
            $response['senderid'] = $row['senderid'];
            $response['outputdata'] = '1';
            $response['outputdata'] = '1';
            echo json_encode($response);
        }
    } else if (isset($approve_status) == "decline") {

        echo "2";
    }
}
?>