<?php
include '../superadmin-session.php';
error_reporting(0);
$sql = mysql_query("SELECT * FROM `intializeaccountno` WHERE InitID=1");

if (!sql) {
    header('location: initialize_acc_no.php');
} else {
    header('location: update_initialize_acc_no.php');
}

if (isset($_POST['addacc'])) {
    $sacc = $_POST['saving_acc'];
    $facc = $_POST['fd_acc'];
    $lacc = $_POST['loan_acc'];
    $shacc = $_POST['share_acc'];

    $sql = mysql_query("INSERT INTO `intializeaccountno`(`AccountNo`, `FDAccountNo`, `ShareAccountNo`, `LoanAccountno`, `CreatedBy`, `CreatedDate` ) VALUES "
            . "('" . $sacc . "', '" . $facc . "', '" . $lacc . "', '" . $shacc . "', '" . $_SESSION['userid'] . "', CURDATE())");

    if ($sql) {
        //echo "Successfully inserted";
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
                            <h3 class="box-title">Initialize Account Numbers</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="">
                            <div class="box-body">               
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Saving/Current Account No</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="saving_acc" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>FD Account No</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="fd_acc" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Loan Account No</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="loan_acc" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Share Account No</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="share_acc" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" name="addacc" class="btn btn-primary">Save</button>
                            </div>
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
