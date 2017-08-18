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
                        <div class="box-header with-border">
                            <h3 class="box-title">Pending Application For Reguler Loan</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="">
                            <div class="col-md-12">
                                <div class="form-group">

                                    <?php
                                    $sql = mysql_query("SELECT * from  loanapplication la inner join customer c on c.CustomerID=la.CustomerID   where  LoanStatus='pending' ") or die(mysql_error());
                                    ?>

                                    <br>
                                    <table class="table table-responsive table-condensed table-striped table-hover table-bordered">
                                        <thead>
                                            <tr>  
                                                <th>CustomerID</th>
                                                <th>CustomerName</th>
                                                <th>MobileNo</th>
                                                <th>ApplyLoanDate</th>
                                                <th>AppliedAmount</th>
                                                <th>LoanPurpose</th>
                                                <!-- <th>CreatedBy</th> -->
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        while ($row = mysql_fetch_array($sql)) {
                                            echo "<tr>";
                                            echo "<td>" . $row['CustomerID'] . "</td>"
                                            . "<td>" . $row['CustomerName'] . "</td>"
                                            . "<td>" . $row['MobileNo'] . "</td>"
                                            . "<td>" . date('d-m-Y', strtotime($row['ApplyLoanDate'])) . "</td>"
                                            . "<td>" . $row['AppliedAmount'] . "</td>"
                                            . "<td>" . $row['LoanPurpose'] . "</td>"
                                            . "<td><a href='pending_regulerloan_applicationfrom.php?id=", $row['ApplyLoanID'], "' '><span class='badge bg-blue'>View</span></a></td>"
                                            . "</tr>";
                                        }
                                        ?> </table> 
                                        <?php
                                        if (mysql_num_rows($sql) == 0) {
                                            echo 'Data is not avaible in the table';
                                        }
                                        ?>
                                </div>
                            </div>
                            <div class="box-footer">
                            </div>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
<?php include 'include/mang_script.php'; ?>

            <!-- Control Sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>

    </body>
</html>