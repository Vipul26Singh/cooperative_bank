<?php
include '../superadmin-session.php';
error_reporting(0);
if (isset($_POST['addemail'])) {
    $des = $_POST['des'];
    $fdi = $_POST['fdi'];
    $did = $_POST['did'];
    $status = $_POST['status'];

    $sql = mysql_query("INSERT INTO `fdsetup`(`Description`, `fdinterest`, `durationindays`, `Active`, `CreatedBy`, `CreatedDate` ) VALUES "
            . "('" . $des . "', '" . $fdi . "', '" . $did . "', '" . $status . "', '" . $_SESSION['userid'] . "', CURDATE())");

    if ($sql) {
        //echo "Successfully inserted";
        header("location: fdtype_list.php");
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
                            <h3 class="box-title">FD Setup</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="">
                            <div class="box-body">               
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Description</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="des" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>FD Interest</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="fdi" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Duration In Days</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="did" class="form-control" required>
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

                            <div class="box-footer text-center">
                                <button type="submit" name="addemail" class="btn btn-primary">Add FD</button>
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
