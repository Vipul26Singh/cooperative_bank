<?php
include '../superadmin-session.php';
error_reporting(0);
if (isset($_POST['Save'])) {

    $sql = mysql_query("insert into onlinetransactionlimit set 
                            OnlineCustomertypeId = '" . $_POST['Customertypename'] . "', 
                            AccountTypeid = '" . $_POST['Accounttypename'] . "',
                            ViaMobileAmount = '" . $_POST['ViaMobileAmount'] . "',
                            ViaInternetAmount = '" . $_POST['ViaInternetAmount'] . "',
                            Setdate =  CURTIME(),
                            Createdby = '" . $_SESSION['userid'] . "',   
                            CreatedDate = CURTIME()
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
                            <h3 class="box-title">Online Transaction Limit Setting </h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="" method="post" onsubmit="validationcheck()">
                            <div class="box-body">

                                <div class="row">  
                                    <div class="col-md-12">  
                                        <div class="col-md-2">             
                                            <div class="form-group">
                                                <label> Customer Type</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">             
                                            <div class="form-group">
                                                <select class="form-control" name="Customertypename" required>
                                                    <option value=''>--Select--</option>
<?php
$custtype = mysql_query("SELECT OnlineCustomertypeId, OnlineCustomertypename FROM onlinecutomertype WHERE Active=1");

while ($row = mysql_fetch_array($custtype)) {
    echo "<option value='" . $row['OnlineCustomertypeId'] . "'>" . $row['OnlineCustomertypename'];
}
?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">             
                                            <div class="form-group">
                                                <label>Account Type</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">             
                                            <div class="form-group">
                                                <select class="form-control" name="Accounttypename" required>
                                                    <option value="">--Select--</option> 
<?php
$acctype = mysql_query("SELECT AccountTypeid, Accounttypename FROM accounttype");

while ($row1 = mysql_fetch_array($acctype)) {
    echo "<option value='" . $row1['AccountTypeid'] . "'>" . $row1['Accounttypename'];
}
?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Via Mobile (Amount)</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">             
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="ViaMobileAmount" name="ViaMobileAmount" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">             
                                            <div class="form-group">
                                                <label>Via Internet (Amount)</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">             
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="ViaInternetAmount" name="ViaInternetAmount" required>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="box-footer text-center">
                                <input type="submit" name="Save" id="submit" class="btn btn-warning" value="Save" >
                            </div>
                        </form>
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
