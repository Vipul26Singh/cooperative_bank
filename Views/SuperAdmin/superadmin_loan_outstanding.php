<?php
include '../superadmin-session.php';
error_reporting(0);
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include 'include/nav.php'; ?>
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php include 'include/sidenav.php'; ?>

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

                            <div class=" with-border text-center">
                                <div class="row">
                                    <div class="col-xs-4 text-left"><b>&emsp; </b><br></div>
                                    <div class="col-xs-4 text-center"><b>&nbsp; Loan Report</b></div>
                                    <div class="col-xs-4 text-right"><p><b> Date: </b> <?php echo date("d-m-Y"); ?> &emsp;</p></div>
                                </div>
                            </div>
                        <?php } ?>

                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="">
                            <div class="box-body">
                                <div class="col-md-12">
                                    <div class="form-group">

                                        <?php $sql = mysql_query("SELECT loan.*, customer.CustomerName FROM loan
                      INNER JOIN customer ON customer.CustomerID=loan.CustomerID 
                      WHERE Status='active'  ") or die(mysql_error());
                                        ?><br>
                                        <table class="table table-responsive table-striped table-hover">
                                            <thead>
                                                <tr>  
                                                    <th>Customer ID</th>
                                                    <th>Customer Name</th>
                                                    <th>Account No</th>
                                                    <th>Loan Date</th>
                                                    <th>Loan Amount</th>
                                                    <th>Loan No</th>
                                                    <th>Loan Type</th>
                                                    <th>Balance</th>
                                                    <th>End Date</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            while ($row = mysql_fetch_array($sql)) {
                                                $date = date('d-m-Y', strtotime($row['FirstInstallmentDate']));
                                                $m = $row['Durationinmonth'];
                                                $maturitydate = date('d-m-Y', strtotime($date . "+$m months"));

                                                echo "<tr>";
                                                echo "<td>" . $row['CustomerID'] . "</td>"
                                                . "<td>" . $row['CustomerName'] . "</td>"
                                                . "<td>" . $row['accountNo'] . "</td>"
                                                . "<td>" . date('d-m-Y', strtotime($row['LoanDate'])) . "</td>"
                                                . "<td>" . $row['Amount'] . "</td>"
                                                . "<td>" . $row['LoanNumber'] . "</td>"
                                                . "<td>" . $row['Type'] . "</td>"
                                                . "<td>" . $row['Balance'] . "</td>"
                                                . "<td>" . $maturitydate . "</td>"
                                                . "</tr>";
                                            }
                                            ?> </table> <?php
                                            if (mysql_num_rows($sql) == 0) {
                                                echo 'Data is not avaible in the table';
                                            }
                                            ?>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>

                </section>
                <!-- /.content -->
            </div>

            <!-- /.content-wrapper -->
<?php include 'include/script.php'; ?>

            <!-- Control Sidebar -->

            <div class="control-sidebar-bg"></div>
        </div>



    </body>
</html>
