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
                            <h3 class="box-title">Account List</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="add_current_account.php">

                            <div class="box-header with-border text-center">
                                <a href="add_current_account.php"><input type="submit" name="add" class="btn btn-primary" value="Add New Account"></a>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">

                                    <?php
                                    $sql = mysql_query("SELECT ba.accountNo,ba.Balance,ba.BranchId,ba.AccountId,c.*,at.* FROM bankaccount ba
                                              INNER JOIN  customer c ON c.CustomerID=ba.CustomerID 
                                              LEFT JOIN  bankaccounttransactions bat ON bat.CustomerID=ba.CustomerID
                                              LEFT JOIN  accounttype at ON at.AccountTypeid=ba.AccountTypeid  
                                              WHERE ba.Active='1' and  ba.BranchId='" . $_SESSION['branch_id'] . "' GROUP by ba.accountNo");

                                    /*  print_r("SELECT ba.accountNo,ba.Balance,ba.BranchId,c.*,at.* FROM bankaccount ba
                                      INNER JOIN  customer c ON c.CustomerID=ba.CustomerID
                                      LEFT JOIN  bankaccounttransactions bat ON bat.CustomerID=ba.CustomerID
                                      LEFT JOIN  accounttype at ON at.AccountTypeid=ba.AccountTypeid
                                      WHERE ba.Active='1' and ba.BranchId='".$_SESSION['branch_id']."'"); exit; */
                                    ?><br>
                                    <table  id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>  
                                                <th>CustomerID</th>
                                                <th>CustomerName</th>
                                                <th>Account Number</th>
                                                <th>Account Type</th>
                                                <th>Current Balance</th>
                                                <th>Account Status</th>
                                                <th>View</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        while ($row = mysql_fetch_array($sql)) {

                                            echo "<tr>"
                                            . "<td>" . $row['CustomerID'] . "</td>"
                                            . "<td>" . $row['CustomerName'] . "</td>"
                                            . "<td>" . $row['accountNo'] . "</td>"
                                            . "<td>" . $row['Type'] . "</td>"
                                            . "<td>" . $row['Balance'] . "</td>";

                                            if ($row['Active'] == 1) {
                                                echo '<td><span class="label bg-green">' . $a = "Active" . '</span></td>';
                                            } else {
                                                echo '<td><span class="label bg-red">' . $a = "Deactive" . '</span></td>';
                                            }
                                            echo

                                            "<td><a href='view_customer_account.php?id=", $row['AccountId'], "' '><span class='badge bg-blue'>View</span></a></td>"
                                            . "</tr>";
                                        }
                                        ?> </table> <?php
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


