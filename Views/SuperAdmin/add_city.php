<?php
include '../superadmin-session.php';
error_reporting(0);
if (isset($_POST['add'])) {
    $cname = $_POST['city_name'];
    $cstatus = $_POST['status'];

    $sql = mysql_query("INSERT INTO `city`(`CityName`, `Active`, `CreatedBy`, `CreatedDate` ) VALUES "
            . "('" . $cname . "', '" . $cstatus . "', '" . $_SESSION['userid'] . "', CURDATE())");

    if ($sql) {
        //echo "Successfully inserted";
        header("location: superadmin_city_list.php");
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
                            <h3 class="box-title">Add City</h3>
                        </div>
                        <form role="form" method="post" action="" enctype="multipart/form-data">
                            <div class="box-body">               
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>City Name</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="city_name" class="form-control" required="required">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Active Status</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control" name="status" style="width: 100%;" required="required">
                                            <option value=''>--Select--</option>
                                            <option  value="1">Active</option>
                                            <option  value="0">Deactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer text-center">
                                <input type="submit" name="add" value="Add" class="btn btn-primary">
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
