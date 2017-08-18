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
                            <h3 class="box-title">Approve Customer</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="manager.php">
                            <div class="col-md-12">
                                <div class="form-group">

                                    <?php $sql = mysql_query("SELECT bankaccapplication.*, customer.CustomerName
                                            FROM `bankaccapplication` INNER JOIN customer ON customer.CustomerID = bankaccapplication.CustomerID
                                            WHERE ApplicationStatus='Approve' and customer.BranchId='" . $_SESSION['branch_id'] . "' ") or die(mysql_error());
                                    ;
                                    ?><br>
                                    <table class="table table-responsive table-condensed table-striped table-hover table-bordered">
                                        <thead>
                                            <tr>  
                                                <th>Customer ID</th>
                                                <th>Customer Name</th>
                                                <th>Opening Balance</th>
                                                <th>Approver Remark</th>
                                                <th>Application Status</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        while ($row = mysql_fetch_array($sql)) {
                                            echo "<tr>"
                                            . "<td>" . $row['CustomerID'] . "</td>"
                                            . "<td>" . $row['CustomerName'] . "</td>"
                                            . "<td>" . $row['OpenBalance'] . "</td>"
                                            . "<td>" . $row['ApproverRemark'] . "</td>"
                                            . "<td><span class='label bg-green'>" . $row['ApplicationStatus'] . "</span></td>";
                                            /*  if($row['ApplicationStatus']==1)
                                              {
                                              echo '<td><span class="label bg-green">'.$a="Active".'</span></td>';
                                              }
                                              else{
                                              echo '<td><span class="label bg-red">'.$a="Deactive".'</span></td>';
                                              } */
                                            "</tr>";
                                        }
                                        ?> </table> <?php
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
            <?php include 'include/mang_script.php'; ?>
            <!-- /.content-wrapper -->
            <!--  <footer class="main-footer">
              
               <strong>Copyright &copy; 2017-2018 <a href="#">CodeFever</a>.</strong> All rights
               reserved.
             </footer> -->

            <!-- Control Sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>

    </body>
</html>