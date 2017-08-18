<?php
include '../superadmin-session.php';
error_reporting(0);
$cid = $_GET['id'];
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include 'include/nav.php'; ?>
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php include 'include/sidenav.php'; ?>

            <div class="content-wrapper">

                <section class="content">

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">View FD Type</h3>
                        </div>
                        <form role="form" method="post" action="superadmin_edit_fdtype.php?id=<?php echo $cid ?>">

                            <?php
                            if (isset($_GET['id'])) {
                                //echo $_GET['id'];
                                $id = $_GET['id'];
                                $sql = mysql_query("SELECT * FROM fdsetup WHERE fdsetupid ='" . $id . "' ") or die(mysql_error());
                                while ($row = mysql_fetch_array($sql)) {
                                    if ($row['Active'] == 1)
                                        $a = "Active";
                                    else
                                        $a = "Deactive";
                                    ?>

                                    <div class="box-body">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Description</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" value="<?php echo $row['Description']; ?>" name="" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>FD Interest</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" value="<?php echo $row['fdinterest']; ?>" name="" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Duration In Days</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" value="<?php echo $row['durationindays']; ?>" name="" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Status</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" value="<?php echo $a; ?>" name="" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer text-center">
                                        <input type="submit" name="submit1" class="btn btn-primary" value="Edit">
                                    </div>
    <?php }
}
?>

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
