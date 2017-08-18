<?php
include '../superadmin-session.php';
error_reporting(0);
if (isset($_POST['add'])) {
    $bname = $_POST['b_name'];
    $badd = $_POST['b_add'];
    $bcode = $_POST['b_code'];
    $regn = $_POST['region'];
    $bcity = $_POST['city'];
    $bstate = $_POST['state'];
    $bcountry = $_POST['country'];
    $bdate = $_POST['b_date'];
    $cstatus = $_POST['status'];

    $sql = mysql_query("INSERT INTO `branch`(`BranchName`, `BranchAddress`, `CityId`, `StateId`, `RegionId`, `CountryId`, `BranchCode`, `bdate`, `Active`, `CreatedBy`, `CreatedDate` ) VALUES "
            . "('" . $bname . "', '" . $badd . "', '" . $bcity . "', '" . $bstate . "', '" . $regn . "', '" . $bcountry . "', '" . $bcode . "', '" . $bdate . "', '" . $cstatus . "', '" . $_SESSION['userid'] . "', CURTIME())") or die(mysql_error());


    if ($sql) {
        //echo "Successfully inserted";
        header("location: superadmin_branch_list.php");
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
                            <h3 class="box-title">Add Branch</h3>
                        </div>
                        <form role="form" method="post" action="" >
                            <div class="box-body">               
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Branch Name</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="b_name" class="form-control" required="required">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Branch Address</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="b_add" class="form-control" required="required">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Branch Code</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="b_code" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Region</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control" name="region" style="width: 100%;" required>
<?php
$sql = mysql_query("SELECT RegionId, Regionname FROM region WHERE Active=1");
echo "<option value=''>Select Region</option>";
while ($row = mysql_fetch_array($sql)) {
    echo "<option value='" . $row['RegionId'] . "'>" . $row['Regionname'];
}
?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>City</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control" name="city" style="width: 100%;" required>
<?php
$sql = mysql_query("SELECT CityId, CityName FROM city WHERE Active=1");
echo "<option value=''>Select City</option>";
while ($row = mysql_fetch_array($sql)) {
    echo "<option value='" . $row['CityId'] . "'>" . $row['CityName'];
}
?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>State</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control" name="state" style="width: 100%;" required>
<?php
$sql = mysql_query("SELECT StateId, StateName FROM state WHERE Active=1");
echo "<option value=''>Select State</option>";
while ($row = mysql_fetch_array($sql)) {
    echo "<option value='" . $row['StateId'] . "'>" . $row['StateName'];
}
?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Country</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control" name="country" style="width: 100%;" required>
<?php
$sql = mysql_query("SELECT CountryId, CountryName FROM country WHERE Active=1");
echo "<option value=''>Select Country</option>";
while ($row = mysql_fetch_array($sql)) {
    echo "<option value='" . $row['CountryId'] . "'>" . $row['CountryName'];
}
?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Branch Date</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="date" name="b_date" class="form-control" id="cust">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Active Status</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control" name="status" style="width: 100%;" required>
                                            <option value=''>--Select--</option>
                                            <option  value="1">Active</option>
                                            <option  value="0">Deactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer text-center">
                                <input type="submit"  name="add" value="Add" class="btn btn-primary">
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
