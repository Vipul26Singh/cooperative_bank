<?php
include '../superadmin-session.php';
error_reporting(0);
//print_r($_SESSION['branch_id']);
$useractive = mysql_fetch_array(mysql_query("SELECT count(UserId) as activeUser FROM  userinfo where  Active=1 and BranchId='" . $_SESSION['branch_id'] . "' "));

$userInactive = mysql_fetch_array(mysql_query("SELECT count(UserId) as inactiveUser FROM  userinfo where  Active=0 and BranchId='" . $_SESSION['branch_id'] . "'"));

$customeractive = mysql_fetch_array(mysql_query("SELECT count(CustomerID) as activecustomer FROM  customer where  memactive='1' and BranchId='" . $_SESSION['branch_id'] . "' and  Approval='approve'"));

$customerInactive = mysql_fetch_array(mysql_query("SELECT count(CustomerID) as inactivecustomer FROM  customer where  memactive='0'and  Approval='approve' and BranchId='" . $_SESSION['branch_id'] . "' "));


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
?>

<!DOCTYPE html>
<html>
    <head>
<?php include 'include/mang_nav.php'; ?>
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

<?php include 'include/mang_sidenav.php'; ?>

            <div class="content-wrapper">

                <section class="content">

                    <div class="row">

                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua ">
                                <div class="inner">
                                    <h4>Employee</h4>
                                    <p>Active: <?php echo $useractive['activeUser']; ?></p>
                                    <p>Inactive:  <?php echo $userInactive['inactiveUser']; ?></p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-user-plus"></i>
                                </div>
                              <!--   <a class="small-box-footer" href="UserList.aspx">More info<i class="fa fa-arrow-circle-right"></i></a> -->
                            </div>
                        </div>

                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                 <!--  <h3>53<sup style="font-size: 20px">%</sup></h3> -->

                                    <h4>Customer</h4>
                                    <p>Active: <?php echo $customeractive['activecustomer']; ?></p>
                                    <p>Inactive: <?php echo $customerInactive['inactivecustomer']; ?></p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-users"></i>
                                </div>
                                <!--  <a class="small-box-footer" href="UserList.aspx">
                                 More info
                                 <i class="fa fa-arrow-circle-right"></i>
                                 </a> -->
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <!--   <h3>44</h3> -->

                                    <h4>Demand</h4>
                                    <p>Account: <?php echo $sumaccount; ?></p>
                                    <p>Amount: <?php echo $sum; ?></p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa fa-upload"></i>
                                </div>
                                <!--    <a class="small-box-footer" href="UserList.aspx">
                                   More info
                                   <i class="fa fa-arrow-circle-right"></i>
                                   </a> -->
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
                                <!--  <a class="small-box-footer" href="UserList.aspx">
                                 More info
                                 <i class="fa fa-arrow-circle-right"></i>
                                 </a> -->
                            </div>
                        </div>
                    </div>

                    <!-- /.box-header -->
                    <!-- form start -->

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

    $accountdata3 = mysql_fetch_array(mysql_query("SELECT sum(Balance) as sumbalance FROM bankaccount ba  where BranchId='" . $_SESSION['branch_id'] . "' and  AccountTypeid='" . $rowdata['AccountTypeid'] . "' and Active='1'  "));
    ?>
                                            <tr>
                                                <td><?php echo $accountdata['Accounttypename'] ?></td>
                                                <td><a href="activeAccountList.php?id=<?php echo $accountdata['AccountTypeid']; ?>"><?php echo $accountdata1['countdata']; ?></a></td>
                                                <td><?php echo $accountdata2['countdata2']; ?></td>
                                                <td><?php ?></td>
                                                <td><?php echo $accountdata3['sumbalance']; ?></td>
                                            </tr>
<?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <!--  <div class="col-md-6">
                             <div class="box box-danger">
                                 <div class="box-header with-border">
                                     <h3 class="box-title">Donut Chart</h3>
                                     <div class="box-tools pull-right">
                                         <button class="btn btn-box-tool" type="button" data-widget="collapse">
                                         <i class="fa fa-minus"></i>
                                         </button>
                                         <button class="btn btn-box-tool" type="button" data-widget="remove">
                                         <i class="fa fa-times"></i>
                                         </button>
                                     </div>
                                 </div>
                                 <div class="box-body">
                                     <div class="chart" style="height:300px">
                                     <img id="ContentPlaceHolder2_Chart1" src="/microfinancev2/ChartImg.axd?i=charts_0/chart_0_0.png&g=8481530f2f364b37aba05b2dbf118f6e" alt="" style="height:300px;width:477px;border-width:0px;">
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="box box-success">
                                 <div class="box-header with-border">
                                     <h3 class="box-title">Bar Chart</h3>
                                     <div class="box-tools pull-right">
                                         <button class="btn btn-box-tool" type="button" data-widget="collapse">
                                         <i class="fa fa-minus"></i>
                                         </button>
                                         <button class="btn btn-box-tool" type="button" data-widget="remove">
                                         <i class="fa fa-times"></i>
                                         </button>
                                     </div>
                                 </div>
                                 <div class="box-body">
                                     <div class="chart" style="height:300px">
                                     <img id="ContentPlaceHolder2_Chart2" src="/microfinancev2/ChartImg.axd?i=charts_0/chart_0_1.png&g=e4c0c728745b469c96578f41d2fe37c0" alt="" style="height:283px;width:534px;border-width:0px;">
                                     </div>
                                 </div>
                             </div>
                         </div> -->
                    </div>

                </section>
            </div>     

            <!-- /.content -->

<?php include 'include/mang_script.php'; ?>

            <!-- /.content-wrapper -->


            <!-- Control Sidebar -->

            <div class="control-sidebar-bg"></div>
        </div>

    </body>
</html>
