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
                            <h3 class="box-title">Pending Customer</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="">
                            <div class="col-md-12">
                                <div class="form-group">

                                    <?php
                                    $sql = mysql_query("SELECT CustomerID, CustomerName, MobileNo, EmailID, BirthDate, ActiveBy, AccountDate, 
                                            city.CityName, branch.BranchName, 
                                            userinfo.EmployeeName FROM customer 
                                            INNER JOIN city on city.CityId  = customer.CityId 
                                            LEFT JOIN userinfo on userinfo.UserId = customer.ActiveBy 
                                            INNER JOIN branch ON branch.BranchId = customer.BranchId
                                            WHERE customer.Approval='pending' AND
                                            customer.BranchId ='" . $_SESSION['branch_id'] . "' ORDER BY CustomerName ASC") or die(mysql_error());

                                    //$sql = mysql_query("SELECT CustomerID,CustomerName,MobileNo,EmailID,BirthDate,ActiveBy,AccountDate,city.CityName,userinfo.EmployeeName from customer inner join city on city.CityId=customer.CityId LEFT join userinfo on userinfo.UserId=customer.ActiveBy WHERE customer.Approval='pending' ORDER BY CustomerName ASC ") or die(mysql_error()) ;
                                    ?><br>
                                    <table class="table table-responsive table-condensed table-striped table-hover table-bordered">
                                        <thead>
                                            <tr>  

                                                <th>CustomerName</th>
                                                <th>CustomerID</th>
                                                <th>MobileNo</th>
                                                <th>BirthDate</th>
                                                <th>CityName</th>
                                                <th>EmailID</th>
                                                <th>CreatedBy</th>
                                                <th>AccountDate</th>
                                                <th>View</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        while ($row = mysql_fetch_array($sql)) {
                                            //$id = $row['CustomerID'];
                                            //$_SESSION['cust_id'] = $row['CustomerID'];
                                            // echo $_SESSION['cust_id'];
                                            echo "<tr>"
                                            . "<td>" . $row['CustomerName'] . "</td>"
                                            . "<td>" . $row['CustomerID'] . "</td>"
                                            . "<td>" . $row['MobileNo'] . "</td>"
                                            . "<td>" . date('d-m-Y', strtotime($row['BirthDate'])) . "</td>"
                                            . "<td>" . $row['CityName'] . "</td>"
                                            . "<td>" . $row['EmailID'] . "</td>"
                                            . "<td>" . $row['EmployeeName'] . "</td>"
                                            . "<td>" . date('d-m-Y', strtotime($row['AccountDate'])) . "</td>"
                                            //. "<td><button name='id' href='manager.php?id=' class='btn btn-primary'>View</button></td>"
                                            . "<td><a href='view_pending_customer.php?id=", $row['CustomerID'], "' '><span class='badge bg-yellow'>View</span></a></td>"
                                            . "</tr>";
                                        }
                                        ?> </table> <?php
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
            <!-- /.content-wrapper -->

<?php include 'include/mang_script.php'; ?>
            <!-- Control Sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>

    </body>
</html>