<?php
include '../superadmin-session.php';
error_reporting(0);
if (isset($_POST['submit'])) {
    $gname = $_POST['g_name'];
    $descriptn = $_POST['descriptn'];
    $irate = $_POST['i_rate'];
    $dim = $_POST['dim'];

    $status = $_POST['status'];


    $sql = mysql_query("INSERT INTO `loantype`(`Type`, `Description`,`InterestRate`, `Durationinmonth`,  `Active`, `CreatedBy`, `CreatedDate` ) VALUES "
            . "('" . $gname . "', '" . $descriptn . "','" . $irate . "', '" . $dim . "',  '" . $status . "', '" . $_SESSION['userid'] . "', CURDATE())");

    if ($sql) {
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

            <div class="content-wrapper">
                <section class="content">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Loan Type</h3>
                        </div>
                        <form role="form" method="post" action="" >
                            <div class="box-body">               
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Loan Type Name</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="g_name" class="form-control" required="required">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Description</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <textarea rows="1" type="text" name="descriptn" class="form-control" ></textarea>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Interest Rate</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="i_rate" class="form-control" required="required">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Duration In Month</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="dim" class="form-control" required="required">
                                    </div>
                                </div>
                                <!--    <div class="form-group">
                                        <label>Amount</label>
                                        <input type="text" name="amt" minlength="5" class="form-control" required="required">
                                    </div> -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Active Status</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control" name="status" style="width: 100%;" required="">
                                            <option value=''>--Select--</option>
                                            <option  value="1">Active</option>
                                            <option  value="0">Deactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer text-center">
                                <input type="submit"  name="submit" value="Add" class="btn btn-primary">
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
