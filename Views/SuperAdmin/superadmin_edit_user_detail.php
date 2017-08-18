<?php
include '../superadmin-session.php';
error_reporting(0);
$cid = $_GET['id'];

if (isset($_REQUEST['submit'])) {
    $e_name = $_POST['emp_name'];
    $e_design = $_POST['design'];
    $uname = $_POST['uname'];
    //$upass = $_POST['upass'];
    $city = $_POST['ccity'];
    $state = $_POST['cstate'];
    $country = $_POST['ccountry'];
    $e_code = $_POST['empcode'];
    //$e_id = $_POST['empid'];
    $status = $_POST['status'];

    $pic = rand(1000, 100000) . "-" . $_FILES['eimage']['name'];
    $pic_loc = $_FILES['eimage']['tmp_name'];
    $folder = "../upload/";

    if (move_uploaded_file($pic_loc, $folder . $pic)) {
        $sql1 = mysql_query("UPDATE `userinfo` SET `Userimage`='" . $pic . "',
              `ModifiedBy`='" . $_SESSION['userid'] . "', 
                `ModifiedDate`=CURTIME()
               WHERE UserId='" . $cid . "' ") or die(mysql_error());
        ?><script>alert('successfully uploaded');</script><?php
    } else {
        ?><script>alert('error while uploading file');</script><?php
    }

    if (!empty($_POST['upass'])) {
        $sql2 = mysql_query("UPDATE `userinfo` SET `Apassword`='" . $_POST['upass'] . "' WHERE UserId='" . $cid . "' ");
    }

    $sql1 = mysql_query("UPDATE `userinfo` SET                 
                `EmployeeName`='" . $e_name . "',
                `Designation`='" . $e_design . "', 
                `Username`='" . $uname . "',
                `CityId`='" . $city . "',
                `StateId`='" . $state . "',
                `CountryId`='" . $country . "',
                `EmpCode`='" . $e_code . "',
                `Active`='" . $status . "',
                `ModifiedBy`='" . $_SESSION['userid'] . "', 
                `ModifiedDate`=CURTIME(),
                `BranchId` = '" . $_POST['branch_name'] . "'
                WHERE UserId='" . $cid . "' ") or die(mysql_error());

    if ($sql1) {
        header("location: superadmin_user_list.php");
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
<?php include 'include/nav.php'; ?>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
        <!-- image upload -->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>

        <script type='text/javascript'>
            function preview_image(event)
            {
                var reader = new FileReader();
                reader.onload = function ()
                {
                    var output = document.getElementById('output_image');
                    output.src = reader.result;
                }
                reader.readAsDataURL(event.target.files[0]);
            }
        </script>
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
<?php include 'include/sidenav.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                <section class="content">

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit User Detail</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="" enctype="multipart/form-data">

<?php
$sql = mysql_query("SELECT userinfo.*, branch.BranchName, city.CityName, state.StateName, country.CountryName FROM userinfo INNER JOIN branch ON userinfo.BranchId = branch.BranchId INNER JOIN city ON userinfo.CityId = city.CityId INNER JOIN state ON userinfo.StateId=state.StateId INNER JOIN country ON userinfo.CountryId = country.CountryId WHERE UserId ='" . $cid . "' ") or die(mysql_error());
while ($row = mysql_fetch_array($sql)) {
    ?>
                                <div class="box-body">
                                    <div class="col-md-2">
                                        <label>User Photo </label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                <?php
                                echo '<img src="../upload/' . $row['Userimage'] . '" id="output_image" style="width:100px; height:100px" />'
                                ?>
                                        </div>
                                        <div class="btn btn-sm btn-default btn-file">
                                            <i class="fa fa-image"></i>&nbsp;Select Photo
                                            <input type="file" accept="upload/*" onchange="preview_image(event)" onchange="readURL(this);" name="eimage" width="100px" />
                                        </div><br>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Employee Name </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" value="<?php echo $row['EmployeeName']; ?>" name="emp_name" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Designation</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" value="<?php echo $row['Designation']; ?>" class="form-control" name="design">
                                        </div>
                                    </div>

                                    <div class="col-md-2">             
                                        <div class="form-group">
                                            <label>Username</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" value="<?php echo $row['Username']; ?>" class="form-control" name="uname" >
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Password</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="password" value="<?php //echo $row['Apassword'];  ?>" class="form-control" name="upass">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Branch Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select class="form-control" name="branch_name">
    <?php
    echo "<option value='" . $row['BranchId'] . "'>" . $row['BranchName'];
    $result = mysql_query("SELECT BranchId, BranchName FROM branch WHERE Active=1");

    while ($branch = mysql_fetch_array($result)) {
        if ($branch['BranchName'] == $row['BranchName']) {
            "<option style='display: none;' value='' >";
        } else {
            echo "<option value='" . $branch['BranchId'] . "'>" . $branch['BranchName'];
        }
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
                                            <select class="form-control" name="ccity">
    <?php
    echo "<option value='" . $row['CityId'] . "'>" . $row['CityName'];
    $result = mysql_query("SELECT CityId, CityName FROM city WHERE Active=1");

    while ($city = mysql_fetch_array($result)) {
        if ($city['CityName'] == $row['CityName']) {
            "<option style='display: none;' value='' >";
        } else {
            echo "<option value='" . $city['CityId'] . "'>" . $city['CityName'];
        }
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
                                            <select class="form-control" name="cstate" >
    <?php
    echo "<option value='" . $row['StateId'] . "'>" . $row['StateName'];
    $result1 = mysql_query("SELECT StateId, StateName FROM state WHERE Active=1");
    while ($st = mysql_fetch_array($result1)) {
        if ($st['StateName'] == $row['StateName']) {
            "<option style='display: none;' value='' >";
        } else {
            echo "<option value='" . $st['StateId'] . "'>" . $st['StateName'];
        }
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
                                            <select class="form-control" name="ccountry" style="width: 100%;">
    <?php
    echo "<option value='" . $row['CountryId'] . "'>" . $row['CountryName'];
    $result2 = mysql_query("SELECT CountryId, CountryName FROM country WHERE Active=1");
    while ($c = mysql_fetch_array($result2)) {
        if ($c['CountryName'] == $row['CountryName']) {
            "<option style='display: none;' value='' >";
        } else {
            echo "<option value='" . $c['CountryId'] . "'>" . $c['CountryName'];
        }
    }
    ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Employee Code</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" value="<?php echo $row['EmpCode']; ?>" class="form-control" name="empcode">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Active Status</label>
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

                        </div>
<?php }
?>

                    </form>
            </div>


        </section>           

        <!-- /.box-body -->


        <!-- /.content -->

        <!-- /.content-wrapper -->

<?php include 'include/script.php'; ?>
        <!-- Control Sidebar -->

        <div class="control-sidebar-bg"></div>
    </div>
    <!-- webcam link -->


</body>
</html>
