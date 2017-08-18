<?php
include '../superadmin-session.php';
error_reporting(0);
if (isset($_POST['submit'])) {
    $ename = $_POST['emp-name'];
    $ecode = $_POST['emp-code'];
    $role = $_POST['role'];
    $branch = $_POST['branch'];
    $designation = $_POST['design'];
    $uname = $_POST['uname'];
    $upass = md5($_POST['upass']);
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];

    $pic = rand(1000, 100000) . "-" . $_FILES['eimage']['name'];
    $pic_loc = $_FILES['eimage']['tmp_name'];
    $folder = "../upload/";

    if (move_uploaded_file($pic_loc, $folder . $pic)) {
        ?><script>alert('successfully uploaded');</script><?php
    } else {
        ?><script>alert('error while uploading file');</script><?php
    }

    $sql = mysql_query("INSERT INTO `userinfo`(`EmployeeName`, `EmpCode`, `Userimage`, `RoleId`, `BranchId`, `Designation`, `Username`, `Apassword`,  `CityId`, `StateId`, `CountryId`, `CreatedBy`, `CreatedDate` ) VALUES "
            . "('" . $ename . "', '" . $ecode . "', '" . $pic . "', '" . $role . "', '" . $branch . "', '" . $designation . "', '" . $uname . "', '" . $upass . "', '" . $city . "', '" . $state . "', '" . $country . "', '" . $_SESSION['userid'] . "', CURTIME())");
    if ($sql) {
        header("location: superadmin_user_list.php");
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include 'include/nav.php'; ?>
        <script src="../js/googlejs.js"></script>
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
                            <h3 class="box-title">Add Users</h3>
                        </div>

                        <form role="form" method="post" action="" name="myForm" onsubmit="return(validation());" enctype="multipart/form-data">
                            <div class="box-body">               
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Employee Name</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="emp-name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Employee Code</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="emp-code" id="empcode"  class="form-control" oninput="empcode1()" required>
                                    </div>
                                </div>

                                <div class="col-md-2">             
                                    <div class="form-group">
                                        <label>Employee Photo</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <image id="output_image" src="../DefaultImage/user.jpg" alt="your image" style="border:1px solid lightgrey;" width="100px" height="100px"/>
                                    </div>
                                    <div class="row">
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <div class="btn btn-sm btn-default btn-file">
                                            <i class="fa fa-image"></i>&nbsp;Select Photo
                                            <input type="file" accept="upload/*" onchange="preview_image(event)" onchange="readURL(this);" name="eimage" width="100px" >
                                        </div><br>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="col-md-4" id="empcode_umique" ></div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Username</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text"  name="uname" id="username" class="form-control" oninput="username1()" required>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="col-md-4" id="username_umique" ></div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Employee Role</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control" name="role" style="width: 100%;" required>
                                            <?php
                                            $sql = mysql_query("SELECT * FROM role WHERE RoleName!='" . $login_session . "' AND RoleName!='Admin' ");
                                            echo "<option value=''>Select</option>";
                                            while ($row = mysql_fetch_array($sql)) {
                                                echo "<option value='" . $row['RoleId'] . "'>" . $row['RoleName'];
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Branch</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control" name="branch" style="width: 100%;" required>
                                            <?php
                                            $sql = mysql_query("SELECT BranchId, BranchName FROM branch WHERE Active=1");
                                            echo "<option value=''>Select</option>";
                                            while ($row = mysql_fetch_array($sql)) {
                                                echo "<option value='" . $row['BranchId'] . "'>" . $row['BranchName'];
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Designation</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="design" class="form-control" required="">
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
                                            include 'config.php';
                                            $sql = mysql_query("SELECT CityId, CityName FROM city WHERE Active=1");
                                            echo "<option value=''>Select</option>";
                                            while ($row = mysql_fetch_array($sql)) {
                                                echo "<option value='" . $row['CityId'] . "'>" . $row['CityName'];
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Password</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="password"  name="upass" id="password" class="form-control" required>
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
                                            include 'config.php';
                                            $sql = mysql_query("SELECT StateId, StateName FROM state WHERE Active=1");
                                            echo "<option value=''>Select</option>";
                                            while ($row = mysql_fetch_array($sql)) {
                                                echo "<option value='" . $row['StateId'] . "'>" . $row['StateName'];
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>   
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="password" name="retypepass" id="confirmpassword" class="form-control" required>
                                        <div id="passworderror" style="color:red; display: none; height: 5px;" >Password And Confirm Password does not match</div>
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
                                            echo "<option value=''>Select</option>";
                                            while ($row = mysql_fetch_array($sql)) {
                                                echo "<option value='" . $row['CountryId'] . "'>" . $row['CountryName'];
                                            }
                                            ?>
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
        <script type="text/javascript">
            function validation()
            {

                var password = $("#password").val();
                var confirmpassword = $("#confirmpassword").val();
                if (password != confirmpassword) {

                    $("#passworderror").show();
                    setTimeout(function () {
                        $('#traTypeNoerror').fadeOut()
                    }, 3000);
                    document.myForm.confirmpassword.focus();
                    return false;
                }

            }
        </script>

        <script type="text/javascript">
            function empcode1()
            {

                var code = $("#empcode").val();

                $.ajax({url: 'unique_empcode_ajax.php',
                    data: {code: code},
                    type: 'post',
                    success: function (output)
                    {
                        //alert(output);
                        $("#empcode_umique").html(output);
                    }
                });

            }
        </script>

        <script type="text/javascript">
            function username1()
            {

                var user = $("#username").val();

                $.ajax({url: 'unique_username_ajax.php',
                    data: {user: user},
                    type: 'post',
                    success: function (output)
                    {
                        // alert(output);
                        $("#username_umique").html(output);
                    }
                });
            }
        </script>


    </body>
</html>


