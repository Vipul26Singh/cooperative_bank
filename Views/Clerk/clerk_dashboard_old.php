<?php
include '../superadmin-session.php';
error_reporting(0);

$sql1 = mysql_fetch_array(mysql_query("SELECT COUNT(Approval) As rejectcount FROM `customer` WHERE Approval='decline'"));
$sqlloan = mysql_fetch_array(mysql_query("SELECT COUNT(Approval) As appoveloan FROM `loanapplication` WHERE Approval='approve'"));
$sqlloanapp = mysql_fetch_array(mysql_query("SELECT COUNT(Approval) As rejectloan FROM `loanapplication` WHERE Approval='decline'"));
$sqlcust = mysql_fetch_array(mysql_query("SELECT COUNT(CustomerID) As custcount FROM `customer` WHERE BranchId='" . $_SESSION['branch_id'] . "' "));
$totalacc = mysql_fetch_array(mysql_query("SELECT COUNT(CustomerNo) As cust FROM `customer`"));
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
<?php $sql = mysql_fetch_array(mysql_query("SELECT COUNT(Approval) As pendingcount FROM `customer` WHERE Approval='pending'")); ?>
                                    <p>Pending: <?php echo $sql['pendingcount']; ?></p>
                                    <p>Rejected: <?php echo $sql1['rejectcount']; ?></p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-user-plus"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <p>Loan Application</p>
<?php ?>
                                    <p>Approved: <?php echo $sqlloan['appoveloan']; ?></p>
                                    <p>Rejected: <?php echo $sqlloanapp['rejectloan']; ?></p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-users"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <p>Customer</p>
                                    <p>Account: <?php echo $sqlcust['custcount']; ?></p>
                                    <p>&nbsp;&nbsp;</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-user-plus"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
                                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box box-warning">
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
                    </div>

                </section>
            </div>     

            <!-- /.content -->

<?php include 'include/clerk_script.php'; ?>

            <!-- /.content-wrapper -->


            <!-- Control Sidebar -->

            <div class="control-sidebar-bg"></div>
        </div>

    </body>
</html>


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
<!-- <?php //include 'include/clerk_script.php';  ?>
-->