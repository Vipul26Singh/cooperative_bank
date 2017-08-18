<?php
include '../superadmin-session.php';
error_reporting(0);
// echo $_GET['trasactiondate'];
// echo $_GET['trasactionenddate'];
?>    

<!DOCTYPE html>
<html>
    <head>
        <?php include 'include/acc_nav.php'; ?>
        <style>
            .body {
                background-color: #ECF0F5;

            }
            .border {

                border: 1px solid #000;
                padding: 10px;
            }
        </style>
    </head>

    <body class="body">

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
                        <div class="col-xs-4 text-center"><b>&nbsp; Demand Report</b></div>
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
//echo $m;
//$maturitydate = date('d-m-Y', strtotime($date ."+$m months"));
//echo $maturitydate;
//echo date('l F jS, Y (m-d-Y)', strtotime('+3 months', strtotime($date)));
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
                                            <th>Installment Amount</th>
                                            <th>Installment Date</th>
                                        </tr>
                                    </thead>
<?php
$startdate = date('Y-m-d', strtotime($_GET['trasactiondate']));
$enddate = date('Y-m-d', strtotime($_GET['trasactionenddate']));


/*   $sql = mysql_query("SELECT loan.*, bankaccount.accountNo, customer.CustomerName FROM loan
  INNER JOIN customer ON customer.CustomerID=loan.CustomerID
  INNER JOIN bankaccount ON bankaccount.BranchId=loan.BranchId
  WHERE Status='active' AND
  EXTRACT(DAY FROM loan.FirstInstallmentDate) BETWEEN EXTRACT(DAY FROM '".$startdate."') and EXTRACT(DAY FROM '".$enddate."')
  GROUP BY loan.CustomerID ") or die(mysql_error()); */

$sqlname = mysql_query("SELECT loan.*,customer.CustomerName FROM loan
                                INNER JOIN customer ON customer.CustomerID=loan.CustomerID 
                                WHERE Status='active' AND
                                EXTRACT(DAY FROM loan.FirstInstallmentDate) BETWEEN EXTRACT(DAY FROM '" . $startdate . "') and EXTRACT(DAY FROM '" . $enddate . "')
                                ORDER BY loan.CustomerID") or die(mysql_error());

while ($row = mysql_fetch_array($sqlname)) {
    $p = $row['Amount'];
    $rate = $row['Interestrate'];
    $n = $row['Durationinmonth'];
    $r = $rate / 1200;
    $formula = ($p * $r * (pow(1 + $r, $n))) / ((pow(1 + $r, $n)) - 1);
    $installment_amount = round($formula, 2);
    $date = date('d-m-Y', strtotime($row['FirstInstallmentDate']));
    $maturitydate = date('d', strtotime($date . "+1 months"));

    echo "<tr>";
    echo "<td>" . $row['CustomerID'] . "</td>"
    . "<td>" . $row['CustomerName'] . "</td>"
    . "<td>" . date('d-m-Y', strtotime($row['LoanDate'])) . "</td>"
    . "<td>" . $row['Amount'] . "</td>"
    . "<td>" . $row['LoanNumber'] . "</td>"
    . "<td>" . $row['Type'] . "</td>"
    . "<td>" . $installment_amount . "</td>"
    . "<td>" . date('d', strtotime($row['FirstInstallmentDate'])) . "</td>"
    //. "<td>".date('d-m-Y',strtotime($row['FirstInstallmentDate']))."</td>"
    . "</tr>";
}
?> </table> <?php
                                    /*  if(mysql_num_rows($sqlname) == 0) {
                                      echo ' Customer Loan List are not avialable.';
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

        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <div class="control-sidebar-bg"></div>


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