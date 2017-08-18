<?php
include '../superadmin-session.php';
error_reporting(0);
$cid = $_GET['id'];
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include 'include/mang_nav.php'; ?>
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <?php include 'include/mang_sidenav.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                <section class="content">

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">View Bank Account Detail</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="edit_customer_bankaccount.php?id=<?php echo $cid ?>">

                            <?php
                            if (isset($_GET['id'])) {
                                $sql = mysql_query("SELECT ba.accountNo,ba.Balance,ba.CustomerID,ba.BranchId,ba.AccountId,c.*,at.*,
                                        bat.*,b.BranchName FROM bankaccount ba
                                        INNER JOIN  customer c ON c.CustomerID=ba.CustomerID 
                                        LEFT JOIN  bankaccounttransactions bat ON bat.CustomerID=ba.CustomerID
                                        LEFT JOIN  accounttype at ON at.AccountTypeid=ba.AccountTypeid 
                                        LEFT JOIN branch b ON b.BranchId=ba.BranchId 
                                        WHERE ba.AccountId='" . $_GET['id'] . "' ") or die(mysql_error());
                                $row = mysql_fetch_array($sql);
                                ?>

                                <div class="box-body">

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Photo/Signature</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
    <?php echo '<img src="../upload/' . $row['mphoto'] . '" style="width:100px; height:100px" />' ?>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <?php echo '<img src="../upload/' . $row['CSign'] . '" style="width:100px; height:100px" />' ?>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Customer ID</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text"  value="<?php echo $row['CustomerID']; ?>" class="form-control" id="custname" readonly>
                                        </div> 
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Customer Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text"  value="<?php echo $row['CustomerName']; ?>" class="form-control" id="custname" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Branch Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text"  value="<?php echo $row['BranchName']; ?>" class="form-control" id="custname" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Account Number</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"> 
                                            <input type="text"  value="<?php echo $row['accountNo']; ?>" class="form-control" id="custname" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Opening Balance</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text"  value="<?php echo $row['Balance']; ?>" class="form-control" id="custname" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Account Type</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"> 
                                            <input type="text"  value="<?php echo $row['Type']; ?>" class="form-control" id="custname" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Account Type Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text"  value="<?php echo $row['Accounttypename']; ?>" class="form-control" id="custname" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Remark</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text"  value="<?php echo $row['Remarks']; ?>" class="form-control" id="custname" readonly>
                                        </div>
                                    </div>

                                </div>

                                <div class="box-footer text-center">
                                    <input type="submit" name="submit1" class="btn btn-primary" value="Edit">
                                </div>
<?php }
?>

                        </form>
                </section>
            </div>

            <!-- /.box-body -->


            <!-- /.content -->

            <!-- /.content-wrapper -->

<?php include 'include/mang_script.php'; ?>
            <!-- Control Sidebar -->

            <div class="control-sidebar-bg"></div>
        </div>

    </body>
</html>
