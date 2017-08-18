<?php
include '../superadmin-session.php';
error_reporting(0);
?>    

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Manager</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="../CSS/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../CSS/dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="../CSS/dist/css/skins/_all-skins.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="../CSS/plugins/iCheck/flat/blue.css">
        <!-- Morris chart -->
        <link rel="stylesheet" href="../CSS/plugins/morris/morris.css">
        <!-- jvectormap -->
        <link rel="stylesheet" href="../CSS/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
        <!-- Date Picker -->
        <link rel="stylesheet" href="../CSS/plugins/datepicker/datepicker3.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="../CSS/plugins/daterangepicker/daterangepicker.css">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="../CSS/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
        <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
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

    <body class="body" >


        <section class="content">    
            <br> 
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
                    ?>  <div class="row">
                        <div class="col-xs-4 text-left"><b>&emsp;<?php echo $sqlbranch['BranchName']; ?></b><br></div>
                        <div class="col-xs-4 text-center"><b>&nbsp; FD List</b></div>
                        <div class="col-xs-4 text-right"><p><b> Date: </b><?php echo date("d-m-Y"); ?>&emsp;</p></div>
                    </div>
                </div>  

                <form role="form" method="post" action="">


                    <div class="box-body">               
                        <div class="col-md-12"><br>
                            <table id="example2" class="table table-hover table-striped table-responsive">
                                <thead>
                                    <tr>
                                        <th>FD No</th>
                                        <th>Customer Name</th>
                                        <th>Fixed Deposit Amount</th>
                                        <th>Duration in Days</th>
                                        <th> Interest</th>
                                        <th>Maturity Date</th>
                                        <th>Mature Amount</th>
                                        <th>Opening Date</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
$sql = mysql_query("SELECT f.*, c.CustomerName FROM fdaccount f INNER JOIN customer c ON c.CustomerID = f.CustomerID WHERE WithdrawDate IS NULL ");


while ($row = mysql_fetch_array($sql)) {
    echo "<tr>";
    echo "<td>" . $row['FdNo'] . "</td>"
    . "<td>" . $row['CustomerName'] . "</td>"
    . "<td>" . $row['FDAmount'] . "</td>"
    . "<td>" . $row['Duration'] . "</td>"
    . "<td>" . $row['Interest'] . "</td>"
    . "<td>" . date('d-m-Y', strtotime($row['MaturityDate'])) . "</td>"
    . "<td>" . $row['MaturityAmount'] . "</td>"
    . "<td>" . date('d-m-Y', strtotime($row['FDDate'])) . "</td>"
    . "</tr>";
}
?> 

                                </tbody>
                            </table>   <?php
                                    if (mysql_num_rows($sql) == 0) {
                                        echo 'Data is not avaible in the table';
                                    }
?>       
                        </div>		   
                    </div>

                </form><br>
            </div>
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
