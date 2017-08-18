<?php
include '../superadmin-session.php';
error_reporting(0);
?>    

<!DOCTYPE html>
<html>
    <head>
        <?php include 'include/cash_nav.php'; ?>
    </head>

    <body class="hold-transition skin-blue sidebar-mini" link="white">
        <div class="wrapper">

            <?php include 'include/cash_sidenav.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                <section class="content">

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Bank Account List</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="">

                            <div class="col-md-12">
                                <div class="form-group">

                                    <?php
                                    $sql = mysql_query("SELECT ba.accountNo,ba.Balance,ba.BranchId,ba.AccountId,c.*,at.* FROM bankaccount ba
                             INNER JOIN customer c ON c.CustomerID=ba.CustomerID 
                             inner JOIN accounttype at ON at.AccountTypeid=ba.AccountTypeid
                           WHERE ba.BranchId='" . $_SESSION['branch_id'] . "'") or die(mysql_error());
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

    "<td><a href='cash_view_account.php?id=", $row['AccountId'], "' '><span class='badge bg-yellow'>View</span></a></td>"
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





<?php include 'include/cash_script.php'; ?>
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


