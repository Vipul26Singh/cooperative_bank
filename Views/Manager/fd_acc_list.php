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
            <div class="content-wrapper">

                <section class="content">    

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-list"></i> FD Accounts</h3>
                        </div>

                        <form role="form" method="post" action="add_fd_account.php">
                            <div class="box-header with-border text-center">
                                <a href="add_fd_account.php"><input type="submit" name="add" class="btn btn-primary" value="Add FD Account"></a>
                            </div>

                            <div class="box-body">               
                                <div class="col-md-12">
                                    <table id="example2" class="table table-bordered table-hover">
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
                                                <th>Print FD Certificate</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = mysql_query("SELECT f.*, c.CustomerName FROM fdaccount f INNER JOIN customer c ON c.CustomerID = f.CustomerID  and f.BranchId='" . $_SESSION['branch_id'] . "'  WHERE WithdrawDate IS NULL ");


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
                                                . "<td><a href='FDcertificate.php?id=", $row['FDId'], "' '><span class='badge bg-yellow'><i class='fa fa-print'></i>Print</span></a></td>"
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

                        </form>
                    </div>
                </section>
                <!-- /.content -->
            </div>

            <?php include 'include/mang_script.php'; ?>

            <!-- /.content-wrapper -->


            <!-- Control Sidebar -->

            <div class="control-sidebar-bg"></div>
        </div>

    </body>
</html>
