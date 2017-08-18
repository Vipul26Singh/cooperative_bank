<?php
include '../superadmin-session.php';
error_reporting(0);
$cid = $_GET['id'];
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include 'include/nav.php'; ?>
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php include 'include/sidenav.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                <section class="content">

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">User Information</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="superadmin_edit_user_detail.php?id=<?php echo $cid ?>">

                            <?php
                            if (isset($_GET['id'])) {
                                //echo $_GET['id'];
                                $id = $_GET['id'];
                                $sql = mysql_query("SELECT userinfo.*, branch.BranchName, city.CityName, state.StateName, country.CountryName FROM userinfo INNER JOIN branch ON userinfo.BranchId = branch.BranchId INNER JOIN city ON userinfo.CityId = city.CityId INNER JOIN state ON userinfo.StateId=state.StateId INNER JOIN country ON userinfo.CountryId = country.CountryId WHERE UserId ='" . $id . "' ") or die(mysql_error());
                                while ($row = mysql_fetch_array($sql)) {
                                    ?>

                                    <div class="box-body">

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>User Photo </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
        <?php
        //echo $row['mphoto']; 
        echo '<img src="../upload/' . $row['Userimage'] . '" style="width:100px; height:100px" />'
        ?>
                                            </div>
                                        </div>    

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Employee Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="cname" value="<?php echo $row['EmployeeName']; ?>" class="form-control" id="custname" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Designation</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="cname" value="<?php echo $row['Designation']; ?>" class="form-control" id="custname" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-2">             
                                            <div class="form-group">
                                                <label>User Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="cname" value="<?php echo $row['Username']; ?>" class="form-control" id="custname" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Password</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="password" value="<?php echo $row['Apassword']; ?>" class="form-control" name="upass" readonly="">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Branch</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="cname" value="<?php echo $row['BranchName']; ?>" class="form-control" id="custname" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>City</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="cname" value="<?php echo $row['CityName']; ?>" class="form-control" id="custname" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>State</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="cname" value="<?php echo $row['StateName']; ?>" class="form-control" id="custname" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Country</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="cname" value="<?php echo $row['CountryName']; ?>" class="form-control" id="custname" readonly>
                                            </div>
                                        </div>


                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Employee Code</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="cname" value="<?php echo $row['EmpCode']; ?>" class="form-control" id="custname" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Active Status</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">                     
                                                <?php
                                                if ($row['Active'] == 1)
                                                    $a = "Active";
                                                else
                                                    $a = "Deactive";
                                                ?>
                                                <input type="text" name="cname" value="<?php echo $a; ?>" class="form-control" id="custname" readonly>
                                            </div>
                                        </div>	 
                                    </div>
                                    <div class="box-footer text-center">
                                        <input type="submit" name="edit" class="btn btn-primary" value="Edit">
                                    </div>

                                <?php
                                }
                            }
                            ?>

                        </form>


                    </div>
                    <!-- /.box-body -->

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
