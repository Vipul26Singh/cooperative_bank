<?php
include '../superadmin-session.php';
error_reporting(0);
if (isset($_POST['addtype'])) {
    $aname = $_POST['acc_name'];
    $interest = $_POST['interest'];
    $mbal = $_POST['mini_bal'];
    $cday = $_POST['cal_day'];
    $tstatus = $_POST['typestatus'];
    $aststus = $_POST['activestatus'];

    $sql = mysql_query("INSERT INTO `accounttype`(`Accounttypename`, `InterestRate`, `MinimumBal`, `InterestCalculationDays`, `Type`, `Active`, `Createdby`, `CreatedDate` ) VALUES "
            . "('" . $aname . "', '" . $interest . "', '" . $mbal . "', '" . $cday . "', '" . $tstatus . "', '" . $aststus . "', '" . $_SESSION['userid'] . "', CURDATE())") or die(mysql_error());

    if ($sql) {
        //echo "Successfully inserted";
        header("location: account_typelist.php");
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

            <div class="content-wrapper">

                <section class="content">

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Account Type</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="">
                            <div class="box-body">               
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Account Type Name</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="acc_name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Interest Rate</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="interest" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>MinimumBal</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="mini_bal" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2">    
                                    <div class="form-group">
                                        <label>Interest Days</label>
                                    </div>
                                </div>
                                <div class="col-md-4">    
                                    <div class="form-group">
                                        <input type="text" name="cal_day" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2">    
                                    <div class="form-group">
                                        <label>Type</label>
                                    </div>
                                </div>
                                <div class="col-md-4">    
                                    <div class="form-group">
                                        <select class="form-control" name="typestatus" style="width: 100%;" required>
                                            <option value=''>--Select--</option>
                                            <option  value="Saving">Saving</option>
                                            <option  value="Current">Current</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">    
                                    <div class="form-group">
                                        <label>Active</label>
                                    </div>
                                </div>
                                <div class="col-md-4">    
                                    <div class="form-group">
                                        <select class="form-control" name="activestatus" style="width: 100%;" required>
                                            <option value=''>--Select--</option>
                                            <option  value="1">Active</option>
                                            <option  value="0">Deactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer text-center">
                                <button type="submit" name="addtype" class="btn btn-primary">Add</button>
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
