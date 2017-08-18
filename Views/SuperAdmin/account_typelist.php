<?php
include '../superadmin-session.php';
error_reporting(0);
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
                            <h3 class="box-title">Account Type List</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="account_type.php">
                            <div class="box-header with-border text-center">
                                <input type="submit" name="addaccount" class="btn btn-primary" value="Add Account Type">
                            </div>
                            <div class="box-body">
                                <div class="col-md-12">
                                    <div class="form-group">

                                        <?php
                                        $sql = mysql_query("SELECT * FROM `accounttype`") or die(mysql_error());
                                        ;
                                        //$sql = mysql_query("SELECT customer.*, city.CityName, userinfo.EmployeeName FROM customer INNER JOIN city ON customer.CityId=city.CityId INNER JOIN userinfo ON customer.CityId=userinfo.CityId WHERE customer.Approval IS NULL") or die(mysql_error()); 
                                        ?><br>
                                        <table class="table table-responsive table-condensed table-striped table-hover table-bordered">
                                            <thead>
                                                <tr>  
                                                    <th>AccountTypeid</th>
                                                    <th>Accounttypename</th>
                                                    <th>InterestRate</th>
                                                    <th>MinimumBal</th>
                                                    <th>InterestCalculationDays</th>
                                                    <th>Type</th>
                                                    <th>Active</th>
                                                    <th>View</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            while ($row = mysql_fetch_array($sql)) {
                                                echo "<tr>"
                                                . "<td>" . $row['AccountTypeid'] . "</td>"
                                                . "<td>" . $row['Accounttypename'] . "</td>"
                                                . "<td>" . $row['InterestRate'] . "</td>"
                                                . "<td>" . $row['MinimumBal'] . "</td>"
                                                . "<td>" . $row['InterestCalculationDays'] . "</td>"
                                                . "<td>" . $row['Type'] . "</td>";
                                                if ($row['Active'] == 1) {
                                                    echo '<td><span class="label bg-green">' . $a = "Active" . '</span></td>';
                                                } else {
                                                    echo '<td><span class="label bg-red">' . $a = "Deactive" . '</span></td>';
                                                }
                                                echo
                                                "<td><a href='superadmin_view_account_type.php?id=", $row['AccountTypeid'], "' '><span class='badge bg-yellow'>View</span></a></td>"
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