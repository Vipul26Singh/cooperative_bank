<?php
include '../superadmin-session.php';
error_reporting(0);

$customeractive = mysql_fetch_array(mysql_query("SELECT count(CustomerID) as activecustomer FROM  customer where  memactive=1 and BranchId='" . $_SESSION['branch_id'] . "' AND Approval='approve' "));

$customerInactive = mysql_fetch_array(mysql_query("SELECT count(CustomerID) as inactivecustomer FROM  customer where  memactive=0 and BranchId='" . $_SESSION['branch_id'] . "' AND Approval='approve' "));

$loandata_amount = mysql_fetch_array(mysql_query("SELECT sum(Balance) as sumbal FROM loan where  BranchId='" . $_SESSION['branch_id'] . "' and Status='active' "));

$loandata_count = mysql_fetch_array(mysql_query("SELECT count(LoanId) as sumaccount FROM loan where  BranchId='" . $_SESSION['branch_id'] . "' and Status='active' "));

$loan_demand = mysql_query("SELECT * FROM loan where  BranchId='" . $_SESSION['branch_id'] . "' ");

$sum = 0;
$sumaccount = 0;
while ($row = mysql_fetch_array($loan_demand)) {
    $chequedate = date('d', strtotime($row['FirstInstallmentDate']));
    $currentdate = date("d");

    if ($chequedate == $currentdate) {
        $sum += $row['installmentamount'];
        $sumaccount = count($row['LoanNumber']);
    }
}
$activecount = 0;

$todaydate = date('Y-m-d');
$bankdeposit = mysql_fetch_array(mysql_query("SELECT sum(Deposit) as bankdeposit FROM `bankaccounttransactions` 
                                        WHERE CreatedBy='" . $_SESSION['userid'] . "' 
                           AND LEFT(Transactiondate, 10)='" . $todaydate . "' AND BranchId='" . $_SESSION['branch_id'] . "' ")) or die(mysql_error());
//echo $bankdeposit['bankdeposit'];


$bankwithdraw = mysql_fetch_array(mysql_query("SELECT sum(Withdraw) as bankwithdraw FROM `bankaccounttransactions` 
                                                WHERE CreatedBy='" . $_SESSION['userid'] . "' 
                         AND LEFT(Transactiondate, 10)='" . $todaydate . "' AND BranchId='" . $_SESSION['branch_id'] . "' "));
//echo $bankwithdraw['bankwithdraw'];

$loanamount = mysql_fetch_array(mysql_query("SELECT sum(Amount) as loanamount FROM loantransaction 
                                        WHERE CreatedBy='" . $_SESSION['userid'] . "' 
                                        AND LEFT(DepositDate, 10)='" . $todaydate . "' AND BranchId='" . $_SESSION['branch_id'] . "' "));
//echo $loanamount['loanamount'];

$sharedeposit = mysql_fetch_array(mysql_query("SELECT sum(ShareAmount) as sharedeposit FROM sharetransaction 
              WHERE LEFT(Transactiondate, 10)='" . $todaydate . "' AND CreatedBy='" . $_SESSION['userid'] . "' 
             AND TransactionType='Deposit' AND BranchId='" . $_SESSION['branch_id'] . "'"));
//echo $sharedeposit['sharedeposit'];

$sharewithdraw = mysql_fetch_array(mysql_query("SELECT sum(ShareAmount) as sharewithdraw FROM sharetransaction 
                 WHERE LEFT(Transactiondate, 10)='" . $todaydate . "' AND CreatedBy='" . $_SESSION['userid'] . "' 
                 AND TransactionType='Withdraw' AND BranchId='" . $_SESSION['branch_id'] . "'"));
//echo $sharewithdraw['sharewithdraw'];

$fddeposit = mysql_fetch_array(mysql_query("SELECT sum(Deposit) as fddeposit FROM fdtransaction
                                WHERE CreatedBy='" . $_SESSION['userid'] . "' AND LEFT(Transactiondate, 10)='" . $todaydate . "' 
                                AND BranchId='" . $_SESSION['branch_id'] . "' "));
//echo $fddeposit['fddeposit'];

$fdwithdraw = mysql_fetch_array(mysql_query("SELECT sum(Withdraw) as fdwithdraw FROM fdtransaction
                                WHERE CreatedBy='" . $_SESSION['userid'] . "' AND LEFT(Transactiondate, 10)='" . $todaydate . "' AND BranchId='" . $_SESSION['branch_id'] . "' "));
//echo $fdwithdraw['fdwithdraw'];

$deposit = $bankdeposit['bankdeposit'] + $sharedeposit['sharedeposit'] + $fddeposit['fddeposit'] + $loanamount['loanamount'];
//echo $deposit;

$withdraw = $bankwithdraw['bankwithdraw'] + $sharewithdraw['sharewithdraw'] + $fdwithdraw['fdwithdraw'];
//echo $withdraw;
?>
<!DOCTYPE html>
<html>
    <head>
<?php include 'include/acc_nav.php'; ?>
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
<?php include 'include/acc_sidenav.php'; ?>
            <div class="content-wrapper">

                <section class="content">

                    <div class="row">

                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua ">
                                <div class="inner">
                                    <h4>Bank Acc Collection</h4>
                                    <p>Deposit: <?php echo $deposit; ?></p>
                                    <p>Withdraw:  <?php echo $withdraw; ?></p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-rupee"></i>
                                </div>
                             <!--   <a class="small-box-footer" href="#">More info<i class="fa fa-arrow-circle-right"></i></a> -->
                            </div>
                        </div>

                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h4>Customer</h4>
                                    <p>Active: <?php echo $customeractive['activecustomer']; ?></p>
                                    <p>Inactive: <?php echo $customerInactive['inactivecustomer']; ?></p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-users"></i>
                                </div>
                                <!--   <a class="small-box-footer" href="#">More info<i class="fa fa-arrow-circle-right"></i></a> -->
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h4>Demand</h4>
                                    <p>Account: <?php echo $sumaccount; ?></p>
                                    <p>Amount: <?php echo $sum; ?></p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa fa-upload"></i>
                                </div>
                                    <!--   <a class="small-box-footer" href="#">More info<i class="fa fa-arrow-circle-right"></i></a> -->
                            </div>
                        </div>

                        <div class="col-lg-3 col-xs-6">
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h4>Outstanding</h4>

                                    <p>Account: <?php echo $loandata_count['sumaccount']; ?></p>
                                    <p>Amount: <?php echo $loandata_amount['sumbal']; ?></p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-users"></i>
                                </div>
                                <!--   <a class="small-box-footer" href="#">More info<i class="fa fa-arrow-circle-right"></i></a> -->
                            </div>
                        </div>
                    </div>



                    <div class="box box-warning">
                        <div class="box-body">
                            <div class="form-group">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Types of Account</th>
                                            <th>Active Account</th>
                                            <th>Deactived</th>
                                            <th>Acc Closing</th>
                                            <th>Cash In Hand</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$account = mysql_query("SELECT * FROM  accounttype  ");
while ($rowdata = mysql_fetch_array($account)) {
    $accountdata = mysql_fetch_array(mysql_query("SELECT * FROM  accounttype ba INNER JOIN accounttype at ON ba.AccountTypeid=at.AccountTypeid  where  at.AccountTypeid='" . $rowdata['AccountTypeid'] . "' and ba.Active='1'"));

    $accountdata1 = mysql_fetch_array(mysql_query("SELECT count(*) as countdata FROM bankaccount ba  where BranchId='" . $_SESSION['branch_id'] . "' and  AccountTypeid='" . $rowdata['AccountTypeid'] . "' and Active='1' "));

    $accountdata2 = mysql_fetch_array(mysql_query("SELECT count(*) as countdata2 FROM bankaccount ba  where BranchId='" . $_SESSION['branch_id'] . "' and  AccountTypeid='" . $rowdata['AccountTypeid'] . "' and Active='0' "));
    ?>
                                            <tr>
                                                <td><?php echo $accountdata['Accounttypename'] ?></td>
                                                <td><a href="activeAccountList.php?id=<?php echo $accountdata['AccountTypeid']; ?>"><?php echo $accountdata1['countdata']; ?></a></td>
                                                <td><?php echo $accountdata2['countdata2']; ?></td>
                                                <td><?php ?></td>
                                                <td><?php ?></td>
                                            </tr>
<?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </section>
                <!-- /.content -->
            </div>

            <!-- /.content-wrapper -->
<?php include 'include/acc_script.php'; ?>
            <!-- Control Sidebar -->

            <div class="control-sidebar-bg"></div>
        </div>

    </body>
</html>
