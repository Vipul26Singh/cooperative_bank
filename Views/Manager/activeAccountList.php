<?php
include '../superadmin-session.php';
error_reporting(0);

$sqldata = mysql_fetch_array(mysql_query("SELECT * FROM accounttype  WHERE AccountTypeid='" . $_GET['id'] . "'"));
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
                            <h3 class="box-title">Active Account List</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="add_bank_account.php">


                            <div class="col-md-12">
                                <div class="form-group">

                                    <?php $sql = mysql_query("SELECT ba.accountNo,ba.Balance,ba.BranchId,ba.AccountId,ba.Active,c.*,at.Accounttypename,at.AccountTypeid,at.Type FROM bankaccount ba
                                              INNER JOIN  customer c ON c.CustomerID=ba.CustomerID 
                                              LEFT JOIN  accounttype at ON at.AccountTypeid=ba.AccountTypeid  
                                              WHERE ba.BranchId='" . $_SESSION['branch_id'] . "' and ba.AccountTypeid='" . $_GET['id'] . "'");
                                    ?><br>
                                    <div><b>Account Type</b>:&nbsp;<?php echo $sqldata['Accounttypename']; ?></div><br>
                                    <table  id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>  
                                                <th>Customer ID</th>
                                                <th>Customer Name</th>
                                                <th>Account Number</th>

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
    . "<td>" . $row['Balance'] . "</td>";

    if ($row['Active'] == 1) {
        echo '<td><span class="label bg-green">' . $a = "Active" . '</span></td>';
    } else {
        echo '<td><span class="label bg-red">' . $a = "Deactive" . '</span></td>';
    }
    echo

    "<td><a href='view_customer_bankaccount.php?id=", $row['AccountId'], "' '><span class='badge bg-yellow'>View</span></a></td>"
    . "</tr>";
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


