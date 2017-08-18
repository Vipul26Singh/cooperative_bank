<?php
include '../superadmin-session.php';
error_reporting(0);
?>    

<!DOCTYPE html>
<html>
    <head>
        <?php include 'include/mang_nav.php'; ?>
    </head>

    <body class="hold-transition skin-blue sidebar-mini" link="white">
        <div class="wrapper">

            <?php include 'include/mang_sidenav.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                <section class="content">

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Approve Customer</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="manager.php">
                            <div class="col-md-12">
                                <div class="form-group">

                                    <?php $sql = mysql_query("SELECT CustomerID, CustomerName, MobileNo, EmailID, BirthDate, ActiveBy, AccountDate, memactive,
                                            city.CityName, branch.BranchName, 
                                            userinfo.EmployeeName FROM customer 
                                            INNER JOIN city on city.CityId  = customer.CityId 
                                            LEFT JOIN userinfo on userinfo.UserId = customer.ActiveBy 
                                            INNER JOIN branch ON branch.BranchId = customer.BranchId
                                            WHERE customer.Approval='approve' AND
                                            customer.CityId = userinfo.CityId AND
                                            userinfo.BranchId = customer.BranchId ORDER BY CustomerName ASC ") or die(mysql_error());
                                    ?><br>
                                    <table class="table table-responsive table-condensed table-striped table-hover table-bordered">
                                        <thead>
                                            <tr>  
                                                <th>Customer ID</th>
                                                <th>Customer Name</th>
                                                <th>Mobile No</th>
                                                <th>Birth Date</th>
                                                <th>City Name</th>
                                                <th>EmailID</th>
                                                <th>Member Active</th>
                                                <th>Created By</th>
                                                <th>Account Date</th>
                                                <th>View</th>
                                                <th>Print</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        while ($row = mysql_fetch_array($sql)) {

                                            echo "<tr>"
                                            . "<td>" . $row['CustomerID'] . "</td>"
                                            . "<td>" . $row['CustomerName'] . "</td>"
                                            . "<td>" . $row['MobileNo'] . "</td>"
                                            . "<td>" . date('d-m-Y', strtotime($row['BirthDate'])) . "</td>"
                                            . "<td>" . $row['CityName'] . "</td>"
                                            . "<td>" . $row['EmailID'] . "</td>";
                                            if ($row['memactive'] == 1) {
                                                echo '<td><span class="label bg-green">' . $a = "Active" . '</span></td>';
                                            } else {
                                                echo '<td><span class="label bg-red">' . $a = "Deactive" . '</span></td>';
                                            }
                                            echo "<td>" . $row['EmployeeName'] . "</td>"
                                            . "<td>" . date('d-m-Y', strtotime($row['AccountDate'])) . "</td>"
                                            //. "<td><button name='id' href='manager.php?id=' class='btn btn-primary'>View</button></td>"
                                            . "<td><a href='view_approve_customer.php?id=", $row['CustomerID'], "' '><span class='badge bg-yellow'>View</span></a></td>"
                                            . "<td><a href='customer_form.php?id=", $row['CustomerID'], "' '><span class='badge bg-yellow'><i class='fa fa-print'></i></span></a></td>"
                                            . "</tr>";
                                        }
                                        ?> </table> <?php
                                        if (mysql_num_rows($sql) == 0) {
                                            echo 'Data is not avaible in the table';
                                        }
                                        ?>
                                </div>
                            </div>

                            <div class="box-footer">
                            </div>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </section>
                <!-- /.content -->
            </div>
<?php include 'include/mang_script.php'; ?>
            <!-- /.content-wrapper -->
            <!--  <footer class="main-footer">
              
               <strong>Copyright &copy; 2017-2018 <a href="#">CodeFever</a>.</strong> All rights
               reserved.
             </footer> -->

            <!-- Control Sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>

    </body>
</html>