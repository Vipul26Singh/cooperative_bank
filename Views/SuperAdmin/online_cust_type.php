<?php
include '../superadmin-session.php';
error_reporting(0);

if (isset($_POST['submit'])) {

    $sql = mysql_query("insert into onlinecutomertype set 
                            OnlineCustomertypename = '" . $_POST['cust_type'] . "',
                            Charges = '" . $_POST['Charges'] . "',
                            Chargefornodays = '" . $_POST['Chargefornodays'] . "',
                            AType = '" . $_POST['AType'] . "',
                            CreatedBy = '" . $_SESSION['userid'] . "',   
                            CreatedDate = CURTIME(),
                            Active = '1'
                            ") or die(mysql_error());

    if ($sql) {
        header("location: superadmin_dashboard.php");
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
<?php include 'include/nav.php'; ?>
        <?php include 'alerts.php'; ?>
    </head>

    <body class="hold-transition skin-yellow sidebar-mini">
        <div class="wrapper">

<?php include 'include/sidenav.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                <section class="content">

                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Online Customer Type Setting </h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="" method="post" onsubmit="validationcheck()">
                            <div class="box-body">

                                <div class="row">  
                                    <div class="col-md-12">  
                                        <div class="col-md-2">             
                                            <div class="form-group">
                                                <label>Customer Type Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">             
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="cust_type" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">    
                                            <div class="form-group">
                                                <label>Account Type</label>
                                            </div>
                                        </div>  
                                        <div class="col-md-4">    
                                            <div class="form-group">
                                                <select class="form-control" name="AType" required>
                                                    <option value="">--Select--</option>
                                                    <option value="current">Current</option>
                                                    <option value="saving">Saving</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Charges</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="Charges" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Charge for no of days</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="Chargefornodays" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="box-footer text-center">
                                <input type="submit" class="btn btn-warning" id="submit" name="submit" value="Save">
                            </div>
                        </form>
                    </div>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
<?php include 'script.php'; ?>

            <!-- Control Sidebar -->

            <div class="control-sidebar-bg"></div>
        </div>

        <script type="text/javascript">

            function validationcheck()
            {
                jSuccess('Customer Type Added succesfully', 'Success Dialog');
            }
        </script>

    </body>
</html>
