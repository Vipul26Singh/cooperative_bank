<?php
include '../superadmin-session.php';
//print_r($_SESSION['branch_id']);
$useractive = mysql_fetch_array(mysql_query("SELECT count(UserId) as activeUser FROM  userinfo where  Active=1 and BranchId='" . $_SESSION['branch_id'] . "'"));
$userInactive = mysql_fetch_array(mysql_query("SELECT count(UserId) as inactiveUser FROM  userinfo where  Active=0 and BranchId='" . $_SESSION['branch_id'] . "'"));

$customeractive = mysql_fetch_array(mysql_query("SELECT count(CustomerID) as activecustomer FROM  customer where  memactive=1 and BranchId='" . $_SESSION['branch_id'] . "'"));

$customerInactive = mysql_fetch_array(mysql_query("SELECT count(CustomerID) as inactivecustomer FROM  customer where  memactive=0 and BranchId='" . $_SESSION['branch_id'] . "' "));


$loandata = mysql_fetch_array(mysql_query("SELECT * FROM loan where  BranchId='" . $_SESSION['branch_id'] . "' "));

if (isset($_POST['submit'])) {
    //print_r($_POST);

    $pic = rand(1000, 100000) . "-" . $_FILES['eimage']['name'];
    $pic_loc = $_FILES['eimage']['tmp_name'];
    $folder = "../upload/";

    $sql = mysql_fetch_array(mysql_query("SELECT * FROM `userinfo` WHERE UserId='" . $login_session_id . "' AND Apassword='" . $_POST['oldpassword'] . "'"));
    //print_r("SELECT * FROM `userinfo` WHERE UserId='".$login_session_id."' AND Apassword='".$_POST['oldpassword']."'"); 

    if (!$sql) {
        echo 'wrong password';
        exit;
    } else {

        if ($_POST['newpassword'] != $_POST['upass']) {
            ?><script>alert('New password and confirm password is not match.');</script><?php
        } else {

            if (move_uploaded_file($pic_loc, $folder . $pic)) {
                ?><script>alert('successfully uploaded');</script><?php
            } else {
                ?><script>alert('error while uploading file');</script><?php
            }


            $sql1 = mysql_query("UPDATE `userinfo` SET `Apassword`='" . $_POST['upass'] . "',`ModifiedBy`='" . $_SESSION['userid'] . "', `ModifiedDate`=CURTIME(),`Userimage`='" . $pic . "' WHERE UserId='" . $login_session_id . "' ") or die(mysql_error());
            //echo "UPDATE `userinfo` SET `EmployeeName`='".$e_name."',`Designation`='".$e_design."',`Username`='".$uname."',`Apassword`='".$upass."',`CityId`='".$city."',`StateId`='".$state."',`CountryId`='".$country."',`EmpCode`='".$e_code."',`Active`='".$status."',`ModifiedBy`='".$_SESSION['userid']."', `ModifiedDate`='CURTIME()',`Userimage`='".$pic."' WHERE UserId='".$cid."' "; 

            if ($sql1) {
                //echo "Successfully Updated";
                header("location: manager_dashboard.php");
            }
        }
    }
}
//print_r($loandata);
?>
<!DOCTYPE html>
<html>
    <head>
<?php include 'include/mang_nav.php'; ?>
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

<?php include 'include/mang_sidenav.php'; ?>

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
//echo $cid;

$sql = mysql_query("SELECT userinfo.*, branch.BranchName, city.CityName, state.StateName, country.CountryName FROM userinfo INNER JOIN branch ON userinfo.BranchId = branch.BranchId INNER JOIN city ON userinfo.CityId = city.CityId INNER JOIN state ON userinfo.StateId=state.StateId INNER JOIN country ON userinfo.CountryId = country.CountryId WHERE UserId ='" . $login_session_id . "' ") or die(mysql_error());
//$sql = mysql_query("select ");
while ($row = mysql_fetch_array($sql)) {
    ?>

                                <div class="box-body col-md-12">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>User Photo </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                <?php
                                //echo $row['mphoto']; 
                                echo '<img src="../upload/' . $row['Userimage'] . '" id="output_image" style="width:100px; height:100px" />'
                                ?>
                                        </div>
                                        <div class="btn btn-sm btn-default btn-file">
                                            <i class="fa fa-image"></i>&nbsp;Select Photo
                                            <input type="file" accept="upload/*" onchange="preview_image(event)" onchange="readURL(this);" name="eimage" width="100px" />
                                        </div>
                                    </div><br>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Employee Code</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" value="<?php echo $row['EmpCode']; ?>" class="form-control" name="empcode" readonly="">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Designation</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" value="<?php echo $row['Designation']; ?>" class="form-control" name="design" readonly="">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Branch Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" value="<?php echo $row['BranchName']; ?>" name="emp_name" class="form-control" readonly="">
    <?php //echo $row['BranchName'];  ?>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Employee Name </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" value="<?php echo $row['EmployeeName']; ?>" name="emp_name" class="form-control" readonly="">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>City</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" value="<?php echo $row['CityName']; ?>" name="ccity" class="form-control" readonly="">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Password</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="oldpassword" id="oldpassword" placeholder="Enter Old password">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>State</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" value="<?php echo $row['StateName']; ?>" name="cstate" class="form-control" readonly="">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Change Password</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" value="" id="newpassword" name="newpassword" name="upass" class="form-control" placeholder="Enter New password">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Country</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" value="<?php echo $row['CountryName']; ?>" name="ccountry" class="form-control" readonly="">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" value="" id="confirmpassword" name="upass" class="form-control" placeholder="ReEnter password">
                                        </div>
                                    </div>
                                </div>

                                <div class="box-footer text-center">
                                    <input type="submit" name="submit" class="btn btn-primary" value="Update detail" >
                                </div>
<?php }
?>

                        </form>
                    </div>

                </section>
            </div>     

            <!-- /.content -->

                            <?php include 'include/mang_script.php'; ?>

            <!-- /.content-wrapper -->


            <!-- Control Sidebar -->

            <div class="control-sidebar-bg"></div>
        </div>
        <script>
            function userpass()
            {
                var oldpass = $('#oldpassword').val();
                alert(oldpass);
            }
        </script>
    </body>
</html>
