<?php
include '../superadmin-session.php';
error_reporting(0);
?>    

<!DOCTYPE html>
<html>
    <head>
        <?php include 'include/clerk_nav.php'; ?>
    </head>

    <body class="hold-transition skin-blue sidebar-mini" link="white">
        <div class="wrapper">

            <?php include 'include/clerk_sidenav.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                <section class="content">

                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Bank Account Application</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="add_bank_account.php">

                            <div class="box-header with-border text-center">
                                <a href="add_current_account.php"><input type="submit" name="add" class="btn btn-warning" value="Add Bank Account"></a>
                            </div> 
                            <div class="col-md-12">
                                <div class="form-group">

                                    <?php $sql = mysql_query("SELECT * FROM  bankaccapplication baa
                                              INNER JOIN  customer c ON c.CustomerID=baa.CustomerID 
                                              LEFT JOIN  accounttype at ON at.AccountTypeid=baa.AccountTypeid  
                                              WHERE c.BranchId='" . $_SESSION['branch_id'] . "' and baa.CreatedBy='" . $_SESSION['userid'] . "' and ApplicationStatus='Pending' ");
                                    ?><br>
                                    <table  id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>  
                                                <th>Customer ID</th>
                                                <th>Customer Name</th>
                                                <th>Account Type</th>
                                                <th>Opening Balance</th>
                                                <th> Status</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        while ($row = mysql_fetch_array($sql)) {
                                            echo "<tr>"
                                            . "<td>" . $row['CustomerID'] . "</td>"
                                            . "<td>" . $row['CustomerName'] . "</td>"
                                            . "<td>" . $row['Type'] . "</td>"
                                            . "<td>" . $row['OpenBalance'] . "</td>"
                                            . "<td><span class='label bg-yellow'>" . $row['ApplicationStatus'] . "</span></td>";
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





<?php include 'include/clerk_script.php'; ?>
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


