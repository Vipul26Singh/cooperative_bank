<?php
include '../superadmin-session.php';
error_reporting(0);
$cid = $_GET['id'];

if (isset($_REQUEST['submit'])) {
    $mname = $_POST['m_name'];
    $mdate = $_POST['m_date'];

    $sql1 = mysql_query("UPDATE `membershipfees` SET `MemberShipFees`='" . $mname . "', `MemberShipFeeDate`='" . $mdate . "',`ModifiedBy`='" . $_SESSION['userid'] . "',`ModifiedDate`=CURTIME() WHERE MemberShipFeesId ='" . $cid . "' ") or die(mysql_error());

    if ($sql1) {
        //echo "Successfully Updated";
        header("location: superadmin_membership_list.php");
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
                            <h3 class="box-title">Edit Membership Detail</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="">

<?php
if (isset($_GET['id'])) {
    //echo $_GET['id'];
    $id = $_GET['id'];
    $sql = mysql_query("SELECT * FROM membershipfees WHERE MemberShipFeesId ='" . $id . "' ") or die(mysql_error());
    while ($row = mysql_fetch_array($sql)) {
        ?>

                                    <div class="box-body">

                                        <div class="form-group">
                                            <input type="hidden" name="cid" class="form-control" id="cust"  value="<?php echo $row[0]; ?>" >
                                        </div> 

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>MemberShip Fees</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" value="<?php echo $row[1]; ?>" name="m_name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Date</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">    
                                                <input type="date" value="<?php echo $row['MemberShipFeeDate']; ?>" name="m_date" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer text-center">
                                        <input type="submit" name="submit" class="btn btn-primary" value="Update">
                                    </div>
    <?php }
}
?>

                        </form>
                    </div>
                </section>           

                <!-- /.box-body -->


                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
<?php include 'include/script.php'; ?>

            <!-- Control Sidebar -->

            <div class="control-sidebar-bg"></div>
        </div>
    </body>
</html>
