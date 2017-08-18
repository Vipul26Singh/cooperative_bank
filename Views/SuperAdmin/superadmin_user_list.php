<?php
include '../superadmin-session.php';
error_reporting(0);
?>    

<!DOCTYPE html>
<html>
    <head>
        <?php include 'include/nav.php'; ?>
    </head>

    <body class="hold-transition skin-blue sidebar-mini" link="white">
        <div class="wrapper">
            <?php include 'include/sidenav.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                <section class="content">

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Active Users</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="add_user.php">
                            <div class="box-header text-center">
                                <input type="submit" name="add" class="btn btn-primary" value="Add User">
                            </div>
                            <div class="box-body">
                                <div class="col-md-12">
                                    <div class="form-group">

                                        <?php $sql = mysql_query("SELECT userinfo.*, branch.BranchName, city.CityName, role.RoleName 
                                             FROM userinfo 
                                             INNER JOIN branch ON userinfo.BranchId = branch.BranchId 
                                             INNER JOIN city ON userinfo.CityId = city.CityId 
                                             INNER JOIN role ON userinfo.RoleId = role.RoleId 
                                             WHERE RoleName!='Admin'
                                             ORDER by EmployeeName ASC") or die(mysql_error());
                                        ?><br>
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>  
                                                    <th>Employee Name</th>  
                                                    <th>Employee Code</th>
                                                    <th>Designation</th>
                                                    <th>Username</th>
                                                    <th>Role Name</th>
                                                    <th>City Name</th>
                                                    <th>Branch Name</th>
                                                    <th>Status</th>
                                                    <th>View</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            while ($row = mysql_fetch_array($sql)) {
                                                echo "<tr>"
                                                . "<td>" . $row['EmployeeName'] . "</td>"
                                                . "<td>" . $row['EmpCode'] . "</td>"
                                                . "<td>" . $row['Designation'] . "</td>"
                                                . "<td>" . $row['Username'] . "</td>"
                                                . "<td>" . $row['RoleName'] . "</td>"
                                                . "<td>" . $row['CityName'] . "</td>"
                                                . "<td>" . $row['BranchName'] . "</td>";
                                                if ($row['Active'] == 1) {
                                                    echo '<td><span class="label bg-green">' . $a = "Active" . '</span></td>';
                                                } else {
                                                    echo '<td><span class="label bg-red">' . $a = "Deactive" . '</span></td>';
                                                }
                                                echo
                                                "<td><a href='superadmin_view_user.php?id=", $row['UserId'], "' '><span class='badge bg-yellow'>View</span></a></td>"
                                                . "</tr>";
                                            }
                                            ?> </table> <?php
                                            ?>
                                    </div>
                                </div>
                            </div>

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

