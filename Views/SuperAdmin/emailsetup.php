<?php
include '../superadmin-session.php';
error_reporting(0);

if (isset($_POST['addemail'])) {
    $mail = $_POST['emailid'];
    $mailpass = $_POST['emailpass'];
    $smtp = $_POST['smtp'];
    $pno = $_POST['p_no'];
    $status = $_POST['status'];

    $sql = mysql_query("INSERT INTO `emailsetup`(`EmailId`, `EmailIdPassword`, `smtphost`, `portno`, `Active`, `CreatedBy`, `CreatedDate` ) VALUES "
            . "('" . $mail . "', '" . $mailpass . "', '" . $smtp . "', '" . $pno . "', '" . $status . "', '" . $_SESSION['userid'] . "', CURDATE())");

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
                            <h3 class="box-title">Email Setup</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="">
                            <div class="box-body">               
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>EmailId</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="email" name="emailid" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>EmailId Password</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="emailpass" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>SMTP host</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="smtp" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Port No</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="p_no" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Active Status</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control" name="status" style="width: 100%;" required="required">
                                            <option value=''>--Select--</option>
                                            <option  value="1">Active</option>
                                            <option  value="0">Deactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" name="addemail" class="btn btn-primary">Save</button>
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
