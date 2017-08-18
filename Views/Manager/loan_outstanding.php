<?php
include '../superadmin-session.php';
error_reporting(0);
?>    

<!DOCTYPE html>
<html>
    <head>
        <?php include 'include/mang_nav.php'; ?>
    </head>

    <body class="hold-transition skin-blue sidebar-mini" link="white">
        <div class="wrapper">

            <?php include 'include/mang_sidenav.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                <section class="content">


                    <div class="box box-primary">
                        <?php
                        $sql2 = mysql_query("SELECT * FROM companysetup") or die(mysql_error());
                        while ($row = mysql_fetch_array($sql2)) {
                            ?>
                            <br>
                            <div class="row">
                                <div class="col-xs-2 ">
                                    <?php echo '<img src="../upload/' . $row['companylogo'] . '" class="text-center" style="width:100px; height:120px; margin-left:20px;" />'; ?></div>
                                <div class="col-xs-10">
                                    <div class="col-xs-10"><h3 class="text-center" ><b><?php echo $row['CompanyName']; ?>&emsp;&emsp;</b></h3></div>
                                    <div class="col-xs-10 text-center"><i><b> <?php echo $row['CompanyAddress']; ?>&emsp;&emsp;</b></i></div>
                                    <div class="col-xs-10 text-center"><i><b> Registration No:  <?php echo $row['registrationno']; ?>&emsp;&emsp;</b></i></div>
                                    <div class="col-xs-10 text-center"><i><b> Contact No: <?php echo $row['phoneno']; ?>&emsp;&emsp;</b></i></div><br><br>
                                </div>
                            </div>
                            <div class="box-header with-border text-center">
                                <?php
                            }
                            $sqlbranch = mysql_fetch_array(mysql_query("SELECT * FROM `branch` WHERE BranchId='" . $_SESSION['branch_id'] . "' ")) or die(mysql_error());
                            ?>          <div class="row">
                                <div class="col-xs-4 text-left"><b>&emsp;<?php echo $sqlbranch['BranchName']; ?></b><br></div>
                                <div class="col-xs-4 text-center"><b>&nbsp; Loan Report</b></div>
                                <div class="col-xs-4 text-right"><p><b> Date: </b><?php echo date("d-m-Y"); ?>&emsp;</p></div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->

                        <form role="form" method="post" action="">
                            <div class="box-body">
                                <div class="col-md-12">
                                    <div class="form-group">

<?php
/* $sql = mysql_query("SELECT loan.*, bankaccount.accountNo, customer.CustomerName FROM loan
  INNER JOIN customer ON customer.CustomerID=loan.CustomerID
  INNER JOIN bankaccount ON bankaccount.BranchId=loan.BranchId
  WHERE Status='active' GROUP BY loan.CustomerID ") or die(mysql_error()); */


$sqldata = mysql_query("SELECT loan.*, customer.CustomerName FROM loan
                      INNER JOIN customer ON customer.CustomerID=loan.CustomerID 
                      WHERE Status='active' and loan.BranchId='" . $_SESSION['branch_id'] . "' ") or die(mysql_error());
?><br>
                                        <table class="table table-responsive table-striped table-hover">
                                            <thead>
                                                <tr>  
                                                    <th>Customer ID</th>
                                                    <th>Customer Name</th>
                                                    <th>Loan Date</th>
                                                    <th>Loan Amount</th>
                                                    <th>Loan No</th>
                                                    <th>Loan Type</th>
                                                    <th>Balance</th>
                                                    <th>End Date</th>
                                                </tr>
                                            </thead>
<?php
while ($row = mysql_fetch_array($sqldata)) {

    $date = date('d-m-Y', strtotime($row['FirstInstallmentDate']));

    $m = $row['Durationinmonth'];
    $maturitydate = date('d-m-Y', strtotime($date . "+$m months"));

    echo "<tr>";
    echo "<td>" . $row['CustomerID'] . "</td>"
    . "<td>" . $row['CustomerName'] . "</td>"
    . "<td>" . date('d-m-Y', strtotime($row['LoanDate'])) . "</td>"
    . "<td>" . $row['Amount'] . "</td>"
    . "<td>" . $row['LoanNumber'] . "</td>"
    . "<td>" . $row['Type'] . "</td>"
    . "<td>" . $row['Balance'] . "</td>"
    . "<td>" . $maturitydate . "</td>"
    . "</tr>";
}
?> </table> <?php
                                            /* if(mysql_num_rows($sql)==0) {
                                              echo 'Data is not avaible in the table';
                                              } */
                                            ?>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>


                    <!-- /.box-body -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Control Sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
        <!-- image upload -->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <!-- jQuery 2.2.3 -->
        <script src="../CSS/plugins/jQuery/jquery-2.2.3.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- DataTables -->
        <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="../CSS/bootstrap/js/bootstrap.min.js"></script>
        <!-- Morris.js charts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="../CSS/plugins/morris/morris.min.js"></script>
        <!-- Sparkline -->
        <script src="../CSS/plugins/sparkline/jquery.sparkline.min.js"></script>
        <!-- jvectormap -->
        <script src="../CSS/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="../CSS/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="../CSS/plugins/knob/jquery.knob.js"></script>
        <!-- daterangepicker -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
        <script src="../CSS/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- datepicker -->
        <script src="../CSS/plugins/datepicker/bootstrap-datepicker.js"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="../CSS/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
        <!-- Slimscroll -->
        <script src="../CSS/plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="../CSS/plugins/fastclick/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="../CSS/dist/js/app.min.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="../CSS/dist/js/pages/dashboard.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../CSS/dist/js/demo.js"></script>

        <script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="../../bootstrap/js/bootstrap.min.js"></script>

        <!-- SlimScroll -->
        <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="../../plugins/fastclick/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="../../dist/js/app.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../../dist/js/demo.js"></script>

    </body>
</html>