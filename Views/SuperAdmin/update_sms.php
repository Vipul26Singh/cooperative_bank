<?php
include '../superadmin-session.php';
error_reporting(0);
if (isset($_POST['updateacc'])) {

    $sqlsms = mysql_fetch_array(mysql_query("SELECT smsid FROM sms"));
    $sqlsms['smsid'];
    //echo 'update1';
    $mail = $_POST['url'];
    $mailpass = $_POST['uname'];
    $smtp = $_POST['api'];
    $pno = $_POST['sid'];
    $status = $_POST['status'];

    $sql1 = mysql_query("UPDATE `sms` SET `gatewayurl`='" . $mail . "', `username`='" . $mailpass . "', `apikey`='" . $smtp . "', `senderid`='" . $pno . "', `Active`='" . $status . "', `ModifiedBy`='" . $_SESSION['userid'] . "', `ModifiedDate`=CURTIME() WHERE smsid='" . $sqlsms['smsid'] . "'") or die(mysql_error());
    //echo "UPDATE `sms` SET `gatewayurl`='".$mail."', `username`='".$mailpass."', `apikey`='".$smtp."', `senderid`='".$pno."', `Active`='".$status."', `ModifiedBy`='".$_SESSION['userid']."', `ModifiedDate`=CURTIME() WHERE smsid=1";

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
                            <h3 class="box-title">Update SMS Setup</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="">
<?php
$sqlsms = mysql_fetch_array(mysql_query("SELECT smsid FROM sms"));
$sqlsms['smsid'];
$sql = mysql_query("SELECT * FROM sms WHERE smsid='" . $sqlsms['smsid'] . "' ") or die(mysql_error());
while ($row = mysql_fetch_array($sql)) {
    ?>
                                <div class="box-body">               
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Gateway Url</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="url" value="<?php echo $row['gatewayurl']; ?>" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Username</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="uname" value="<?php echo $row['username']; ?>" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>API Key</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="api" value="<?php echo $row['apikey']; ?>" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Sender ID</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="sid" value="<?php echo $row['senderid']; ?>" class="form-control" >
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
