<?php
include '../superadmin-session.php';
error_reporting(0);
if (isset($_POST['updateloan'])) {
    //echo 'update1';
    $des = $_POST['lgd'];

    $sql1 = mysql_query("UPDATE `loansetting` SET `LoanGraceDays`='" . $des . "' WHERE LoanSettingId=1") or die(mysql_error());
    //echo "UPDATE `loansetting` SET `LoanGraceDays`='".$des."' WHERE LoanSettingId=1";

    if ($sql1) {
        $_SESSION['message'] = 'Successfully update';
        header("location: superadmin_dashboard.php");
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
<?php include 'include/nav.php'; ?>
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
<?php include 'include/sidenav.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                <section class="content">

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Update Loan Setting</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="">
<?php
$sql = mysql_query("SELECT * FROM loansetting WHERE LoanSettingId=1") or die(mysql_error());
while ($row = mysql_fetch_array($sql)) {
    ?>
                                <div class="box-body">               
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Loan Grace Days</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="lgd" value="<?php echo $row[1]; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer text-center">
                                    <input type="submit" name="updateloan" class="btn btn-primary" value="Update" id="btnclick">
                                </div>
<?php } ?>
                        </form>
                    </div>

                </section>
                <!-- /.content -->
            </div>

            <!-- /.content-wrapper -->
<?php include 'include/script.php'; ?>

            <!-- Control Sidebar -->

            <div class="control-sidebar-bg"></div>
        </div>

    </body>
</html>
