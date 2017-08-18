<?php
include '../superadmin-session.php';
error_reporting(0);
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
                            <h3 class="box-title">View Loan Type</h3>
                        </div>
                        <form role="form" method="post" action="superadmin_edit_loantype.php?id=<?php echo $_GET['id']; ?>">

                            <?php
                            if (isset($_GET['id'])) {
                                //echo $_GET['id'];
                                $id = $_GET['id'];
                                $sql = mysql_query("SELECT * FROM loantype WHERE LoanTypeid ='" . $id . "' ") or die(mysql_error());
                                while ($row = mysql_fetch_array($sql)) {
                                    if ($row['Active'] == 1)
                                        $a = "Active";
                                    else
                                        $a = "Deactive";
                                    ?>

                                    <div class="box-body">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Loan Type Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="" value="<?php echo $row['Type']; ?>" class="form-control" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Description</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="" value="<?php echo $row['Description']; ?>" class="form-control" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Interest Rate</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="" value="<?php echo $row['InterestRate']; ?>" class="form-control" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-md-2">   
                                            <div class="form-group">
                                                <label>Duration In Month</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="" value="<?php echo $row['Durationinmonth']; ?>" class="form-control" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Status</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="" value="<?php echo $a; ?>" class="form-control" readonly="">
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
