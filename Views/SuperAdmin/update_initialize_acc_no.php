<?php
include '../superadmin-session.php';
error_reporting(0);
$sql = mysql_query("SELECT accountNo from bankaccount WHERE accountNo is not null UNION SELECT shareaccount.ShareAccountNo as accountNo from shareaccount WHERE ShareAccountNo is not null") or die(mysql_error());
$row1 = mysql_fetch_array($sql);
if ($row1['accountNo'] == NULL && $row1['ShareAccountNo'] == NULL) {

    if (isset($_POST['updateacc'])) {
        //echo 'update1';
        $sacc = $_POST['saving_acc'];
        $facc = $_POST['fd_acc'];
        $lacc = $_POST['loan_acc'];
        $shacc = $_POST['share_acc'];
        $sql1 = mysql_query("UPDATE `intializeaccountno` SET `AccountNo`='" . $sacc . "', `FDAccountNo`='" . $facc . "', `ShareAccountNo`='" . $shacc . "', `LoanAccountno`='" . $lacc . "', `ModifiedBy`='" . $_SESSION['userid'] . "', `ModifiedDate`=CURTIME() WHERE InitID=1") or die(mysql_error());
        //echo "UPDATE `intializeaccountno` SET `AccountNo`='".$sacc."', `FDAccountNo`='".$facc."', `ShareAccountNo`='".$shacc."', `LoanAccountno`='".$lacc."', `ModifiedBy`='".$_SESSION['userid']."', `ModifiedDate`=CURTIME() WHERE InitID=1";

        if ($sql1) {
            $_SESSION['message'] = 'Successfully update';
            header("location: superadmin_dashboard.php");
        }
    }
} else {
    //echo 'Sorry..!! Data already exists.';
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
                            <h3 class="box-title">Update Initialize Account Numbers</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="">
<?php
$sql = mysql_query("SELECT * FROM intializeaccountno WHERE InitID=1") or die(mysql_error());
while ($row = mysql_fetch_array($sql)) {
    ?>
                                <div class="box-body">               
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Saving/Current </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="saving_acc" value="<?php echo $row['AccountNo']; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>FD Account No</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="fd_acc" value="<?php echo $row['FDAccountNo']; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Share Account No</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="share_acc" value="<?php echo $row['ShareAccountNo']; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Loan Account No</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="loan_acc" value="<?php echo $row['LoanAccountno']; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer text-center">
                                    <input type="submit" name="updateacc" class="btn btn-primary" value="Update" id="btnclick">
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
