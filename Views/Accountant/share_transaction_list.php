<?php
include '../superadmin-session.php';
error_reporting(0);
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include 'include/acc_nav.php'; ?>
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <?php include 'include/acc_sidenav.php'; ?>

            <div class="content-wrapper">

                <section class="content">

                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Share Transaction List</h3>
                        </div>
                        <form role="form" method="post" action="add_share_transaction_account.php" >
                            <!--    <div class="box-header with-border text-center">
                                    <input type="submit" name="addtran" class="btn btn-warning" value="Add Share Transaction">
                                </div> -->
                            <div class="box-body">               
                                <div class="col-md-12">
                                    <div class="form-group">

                                        <?php //$sql = mysql_query("SELECT * FROM ``") or die(mysql_error()); 
                                        ?><br>
                                        <table id="example1" class="table table-responsive table-condensed table-striped table-hover table-bordered">
                                            <thead>
                                                <tr>  
                                                    <th>Share Account No</th>
                                                    <th>Customer Name</th>
                                                    <th>Transaction Date</th>
                                                    <th>Transaction Type</th>
                                                    <th>Withdraw</th>
                                                    <th>Deposit </th>
                                                    <th>Transaction Mode</th>
                                                    <th>Amount </th>
                                                    <th>Share Balance </th>
                                                </tr>
                                            </thead>
                                            <?php
                                            $currentdate = date('Y-m-d');
                                            $sql = mysql_query("select * from sharetransaction 
                                           where TransactionDate='" . $currentdate . "' and 
                                           BranchId='" . $_SESSION['branch_id'] . "' and CreatedBy='" . $_SESSION['userid'] . "' ") or die(mysql_error());

                                            while ($row = mysql_fetch_array($sql)) {
                                                $sqlbranch = mysql_fetch_array(mysql_query("SELECT * from  customer where CustomerID='" . $row['CustomerID'] . "' "));
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['ShareAccountNo']; ?></td>
                                                    <td><?php echo $sqlbranch['CustomerName']; ?></td>
                                                    <td><?php echo date('d-m-Y', strtotime($row['TransactionDate'])); ?></td>
                                                    <td><?php echo $row['TransactionType']; ?></td>
                                                    <td><?php echo $row['Withdraw']; ?></td>
                                                    <td><?php echo $row['Deposit']; ?></td>
                                                    <td><?php echo $row['Transactionmode']; ?></td>
                                                    <td><?php echo $row['ShareAmount']; ?></td>
                                                    <td><?php echo $row['BalanceShare']; ?></td>
                                                </tr>
                                            <?php }
                                            ?> </table> 
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>


                </section>
                <!-- /.content -->
            </div><?php include 'include/acc_script.php'; ?>

            <!-- /.content-wrapper -->


            <!-- Control Sidebar -->

            <div class="control-sidebar-bg"></div>
        </div>

    </body>
</html>
