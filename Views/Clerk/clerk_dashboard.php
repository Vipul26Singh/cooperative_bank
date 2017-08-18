<?php
include '../superadmin-session.php';
error_reporting(0);

$sql1 = mysql_fetch_array(mysql_query("SELECT COUNT(Approval) As rejectcount FROM `customer` WHERE Approval='decline' AND BranchId='" . $_SESSION['branch_id'] . "' and  ActiveBy= '" . $_SESSION['userid'] . "'"));

$sqlloan = mysql_fetch_array(mysql_query("SELECT COUNT(Approval) As appoveloan FROM `loanapplication` WHERE Approval='approve' AND BranchId='" . $_SESSION['branch_id'] . "' and Createdby='" . $_SESSION['userid'] . "'  "));

$sqlloangold = mysql_fetch_array(mysql_query("SELECT COUNT(Approval) As appoveloangold FROM `goldloanapplication` WHERE Approval='approve' AND BranchId='" . $_SESSION['branch_id'] . "' and Createdby='" . $_SESSION['userid'] . "' "));

$loancoun = $sqlloan['appoveloan'] + $sqlloangold['appoveloangold'];



$sqlloanapp = mysql_fetch_array(mysql_query("SELECT COUNT(Approval) As rejectloan FROM `loanapplication` WHERE Approval='decline' AND BranchId='" . $_SESSION['branch_id'] . "' and Createdby='" . $_SESSION['userid'] . "'"));

$sqlloanappgold = mysql_fetch_array(mysql_query("SELECT COUNT(Approval) As rejectloangold FROM `goldloanapplication` WHERE Approval='decline' AND BranchId='" . $_SESSION['branch_id'] . "' and Createdby='" . $_SESSION['userid'] . "'"));
$rejectedloancoun = $sqlloanappgold['rejectloangold'] + $sqlloanapp['rejectloan'];

$activecust = mysql_fetch_array(mysql_query("SELECT COUNT(CustomerID) As activecount FROM `customer` WHERE BranchId='" . $_SESSION['branch_id'] . "' AND memactive='1' AND Approval='approve' "));

$inactivecust = mysql_fetch_array(mysql_query("SELECT COUNT(CustomerID) As inactivecount FROM `customer` WHERE BranchId='" . $_SESSION['branch_id'] . "' AND memactive='0' and Approval='approve' "));

$totalacc = mysql_fetch_array(mysql_query("SELECT COUNT(*) As cust FROM `bankaccapplication` WHERE BranchId='" . $_SESSION['branch_id'] . "' and Createdby='" . $_SESSION['userid'] . "' ")) or die(mysql_error());
?>
<!DOCTYPE html>
<html>
    <head>
<?php include 'include/clerk_nav.php'; ?>
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
<?php include 'include/clerk_sidenav.php'; ?>

            <div class="content-wrapper">
                <div class="text-center"  id="testdiv" >


                    <span class="" style="text-align:center; ">
<?php if (isset($_SESSION["alertmsg"]) && $_SESSION["message"] !== 0) {
    echo $_SESSION["message"]; //unset($_SESSION["message"]); 
}
?>
                    </span>
                </div>

                <section class="content">

                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <p>Customer KYC</p>
                                    <?php $sql = mysql_fetch_array(mysql_query("SELECT COUNT(Approval) As pendingcount FROM `customer` WHERE Approval='pending' AND BranchId='" . $_SESSION['branch_id'] . "'  and  ActiveBy= '" . $_SESSION['userid'] . "'")); ?>
                                    <p>Pending: <?php echo $sql['pendingcount']; ?></p>
                                    <p>Rejected: <?php echo $sql1['rejectcount']; ?></p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-user-plus"></i>
                                </div>
                              <!--   <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <p>Loan Application</p>
                                    <?php
                                    ?>
                                    <p>Approved: <?php //echo $sqlloan['appoveloan'];
                                    echo $loancoun;
                                    ?></p>
                                    <p>Rejected: <?php
                                        //echo $sqlloanapp['rejectloan'];
                                        echo $rejectedloancoun;
                                        ?></p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-users"></i>
                                </div>
                               <!--  <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <p>Customer</p>
                                    <p>Active: <?php echo $activecust['activecount']; ?></p>
                                    <p>InActive: <?php echo $inactivecust['inactivecount']; ?></p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-user-plus"></i>
                                </div>
                                <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <p>Account Inquiry</p>
                                    <p>No of Accounts: <?php echo $totalacc['cust']; ?></p>
                                    <p>&nbsp;&nbsp;</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-users"></i>
                                </div>
                              <!--   <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <!--  <div class="box box-warning">
                         <div class="box-body table-responsive no-padding">
                       <table class="table table-hover">
                         <tr>
                           <th>Types of Account </th>
                           <th>Active Account</th>
                           <th>Deatived</th>
                           <th>Account Closing</th>
                           <th>Cash InHand</th>
                         </tr>
                         <tr>
                           <td>No Data</td>
                         </tr>
                       </table>
                     </div>
                     </div> -->

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
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <!-- Control Sidebar -->

            <div class="control-sidebar-bg">

            </div>

            <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
            <script type="text/javascript">
                $(function () {
                    setTimeout(function () {
                        $("#testdiv").fadeOut(1500);
                    }, 3000)
                    $('#btnclick').click(function () {
                        $('#testdiv').show();
                        setTimeout(function () {
                            $("#testdiv").fadeOut(1500);
                        }, 3000)
                    })
                })
            </script>   


<?php include 'include/clerk_script.php'; ?>
    </body>
</html>
