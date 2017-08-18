<?php
include '../superadmin-session.php';
error_reporting(0);
$cid = $_GET['id'];

if (isset($_REQUEST['submit'])) {
    $g_name = $_POST['g_name'];
    $g_desp = $_POST['g_desp'];
    $g_rate = $_POST['g_rate'];
    $g_durn = $_POST['duratn'];

    $g_status = $_POST['status'];

    $sql1 = mysql_query("UPDATE `loantype` SET `Type`='" . $g_name . "',`Description`='" . $g_desp . "',`InterestRate`='" . $g_rate . "',`Durationinmonth`='" . $g_durn . "', `Active`='" . $g_status . "',`ModifiedBy`='" . $login_session_id . "',`ModifiedDate`=CURTIME() WHERE LoanTypeid ='" . $cid . "' ") or die(mysql_error());
    if ($sql1) {
        //echo "Successfully Updated";
        header("location: loantype_list.php");
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
                            <h3 class="box-title">Edit Loan Type Detail</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="">

<?php
if (isset($_GET['id'])) {
    //echo $_GET['id'];
    $id = $_GET['id'];
    $sql = mysql_query("SELECT * FROM loantype WHERE LoanTypeid ='" . $id . "' ") or die(mysql_error());
    while ($row = mysql_fetch_array($sql)) {
        ?>

                                    <div class="box-body">

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Loan Type Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" value="<?php echo $row['Type']; ?>" name="g_name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Description</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" value="<?php echo $row['Description']; ?>" name="g_desp" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>InterestRate</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" value="<?php echo $row['InterestRate']; ?>" name="g_rate" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Durationinmonth</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" value="<?php echo $row['Durationinmonth']; ?>" name="duratn" class="form-control">
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
