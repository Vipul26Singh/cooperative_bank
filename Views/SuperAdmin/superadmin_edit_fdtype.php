<?php
include '../superadmin-session.php';
error_reporting(0);
$id = $_GET['id'];
if (isset($_REQUEST['updateacc'])) {

    $mail = $_POST['des'];
    $mailpass = $_POST['fdi'];
    $smtp = $_POST['did'];
    $pno = $_POST['status'];
    $sql1 = mysql_query("UPDATE `fdsetup` SET `Description`='" . $mail . "', `fdinterest`='" . $mailpass . "', `durationindays`='" . $smtp . "', `Active`='" . $pno . "', `ModifiedBy`='" . $_SESSION['userid'] . "', `ModifiedDate`=CURTIME() WHERE fdsetupid='" . $id . "' ") or die(mysql_error());

    if ($sql1) {
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
                            <h3 class="box-title">Update FD Setup</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="">
<?php
$sql = mysql_query("SELECT * FROM fdsetup WHERE fdsetupid = '" . $_GET['id'] . "' ") or die(mysql_error());
while ($row = mysql_fetch_array($sql)) {
    ?>
                                <div class="box-body">               
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Description</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="des" value="<?php echo $row['Description']; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>FD Interest</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="fdi" value="<?php echo $row['fdinterest']; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Duration In Days</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="did" value="<?php echo $row['durationindays']; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Status</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select class="form-control" name="status" style="width: 100%;" >
    <?php
    if ($row['Active'] == 1) {
        $a = "Active";
        $b = "Deactive";
        echo "<option  value='1'>" . $a . "</option>"
        . "<option  value='0'>" . $b . "</option>";
    } else {
        $a = "Active";
        $b = "Deactive";
        echo "<option  value='0'>" . $b . "</option>"
        . "<option  value='1'>" . $a . "</option>";
    }
    ?>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer text-center">
                                    <input type="submit" name="updateacc" class="btn btn-primary" value="Update">
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
