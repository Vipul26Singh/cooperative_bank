<?php
include '../superadmin-session.php';
error_reporting(0);
?>    

<!DOCTYPE html>
<html>

    <?php include 'include/mang_nav.php'; ?>


    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php include 'include/mang_sidenav.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper"> 
                <section class="content">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Users</h3>

                        </div>
                        <form role="form" method="post" action="" enctype="multipart/form-data">
                            <div class="box-body">               
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Employee Name</label>
                                        <input type="text" name="emp-name" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Employee Code</label>
                                        <input type="text" name="emp-code" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">             
                                    <div class="form-group">
                                        <label>Employee Photo</label><br>
                                        <image id="output_image" src="#" alt="your image" width="100px" height="100px"/>
                                    </div>
                                    <div class="row">
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <div class="btn btn-sm btn-default btn-file">
                                            <i class="fa fa-image"></i>&nbsp;Select Photo
                                            <input type="file" accept="upload/*" onchange="preview_image(event)" onchange="readURL(this);" name="eimage" width="100px" />
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-defaultbtn btn-sm btn-default">Upload</button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Employee Role</label>
                                        <select class="form-control" name="role" style="width: 100%;" required>
                                            <?php
                                            $sql = mysql_query("SELECT * FROM role WHERE RoleName!='" . $login_session . "' AND RoleName!='SuperAdmin' ");
                                            echo "<option value=''>Select</option>";
                                            while ($row = mysql_fetch_array($sql)) {
                                                echo "<option value='" . $row['RoleId'] . "'>" . $row['RoleName'];
                                            }
                                            ?>
                                            <!--  <option selected="selected">--Select--</option> -->
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Branch</label>
                                        <select class="form-control" name="branch" style="width: 100%;" required>
                                            <?php
                                            $sql = mysql_query("SELECT BranchId, BranchName FROM branch");
                                            echo "<option value=''>Select</option>";
                                            while ($row = mysql_fetch_array($sql)) {
                                                echo "<option value='" . $row['BranchId'] . "'>" . $row['BranchName'];
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Designation</label>
                                        <input type="text" name="design" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text"  name="uname" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password"  name="upass" id="txtPassword" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>City</label>
                                        <select class="form-control" name="city" style="width: 100%;" required>
                                            <?php
                                            include 'config.php';
                                            $sql = mysql_query("SELECT CityId, CityName FROM city");
                                            echo "<option value=''>Select</option>";
                                            while ($row = mysql_fetch_array($sql)) {
                                                echo "<option value='" . $row['CityId'] . "'>" . $row['CityName'];
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>State</label>
                                        <select class="form-control" name="state" style="width: 100%;" required>
                                            <?php
                                            include 'config.php';
                                            $sql = mysql_query("SELECT StateId, StateName FROM state");
                                            echo "<option value=''>Select</option>";
                                            while ($row = mysql_fetch_array($sql)) {
                                                echo "<option value='" . $row['StateId'] . "'>" . $row['StateName'];
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Country</label>
                                        <select class="form-control" name="country" style="width: 100%;" required>
                                            <?php
                                            $sql = mysql_query("SELECT CountryId, CountryName FROM country");
                                            echo "<option value=''>Select</option>";
                                            while ($row = mysql_fetch_array($sql)) {
                                                echo "<option value='" . $row['CountryId'] . "'>" . $row['CountryName'];
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="password" name="retypepass" id="txtConfirmPassword" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer text-center">
                                <input type="submit"  name="submit" value="Add" onclick="return Validate()" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <!--  <footer class="main-footer">
               <strong>Copyright &copy; 2017-2018 <a href="#">CodeFever</a>.</strong> All rights
               reserved.
             </footer> -->
            <!-- Control Sidebar -->

            <?php include 'include/mang_script.php'; ?>

            <div class="control-sidebar-bg"></div>
        </div>
        <!--Script-->


    </body>
</html>


