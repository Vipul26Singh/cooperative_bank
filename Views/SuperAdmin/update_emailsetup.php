<?php
include '../superadmin-session.php';
error_reporting(0);
if (isset($_POST['updateacc'])) {
    //echo 'update1';
    $mail = $_POST['emailid'];
    $mailpass = $_POST['emailpass'];
    $smtp = $_POST['smtp'];
    $pno = $_POST['p_no'];
    $status = $_POST['status'];

    $sql1 = mysql_query("UPDATE `emailsetup` SET `EmailId`='" . $mail . "', `EmailIdPassword`='" . $mailpass . "', `smtphost`='" . $smtp . "', `portno`='" . $pno . "', `Active`='" . $status . "', `ModifiedBy`='" . $_SESSION['userid'] . "', `ModifiedDate`=CURTIME() WHERE EmailSetupId=1") or die(mysql_error());
    //echo "UPDATE `emailsetup` SET `EmailId`='".$mail."', `EmailIdPassword`='".$mailpass."', `smtphost`='".$smtp."', `portno`='".$pno."',`Active`='".$status."', `ModifiedBy`='".$_SESSION['userid']."', `ModifiedDate`=CURTIME() WHERE EmailSetupId=1";

    if ($sql1) {
        $_SESSION['message'] = 'Successfully update';
        header("location: superadmin_dashboard.php");
        //Refresh: 3;url=page.php
        //echo "Successfully update";
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
                            <h3 class="box-title">Update Email Setup</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="">
<?php
$sql = mysql_query("SELECT * FROM emailsetup WHERE EmailSetupId=1") or die(mysql_error());
while ($row = mysql_fetch_array($sql)) {
    ?>
                                <div class="box-body">               
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>EmailId</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="emailid" value="<?php echo $row[1]; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>EmailId Password</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="password" name="emailpass" value="<?php echo $row[2]; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>SMTP host</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="smtp" value="<?php echo $row[3]; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Port No</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="p_no" value="<?php echo $row[4]; ?>" class="form-control" required>
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
