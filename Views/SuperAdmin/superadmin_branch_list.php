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

            <div class="content-wrapper">

                <section class="content">

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">View Branch</h3>
                        </div>
                        <form role="form" method="post" action="add_branch.php" >
                            <div class="box-header with-border text-center">
                                <input type="submit" name="addbranch" class="btn btn-primary" value="Add Branch">
                            </div>
                            <div class="box-body">  
                                <div class="col-md-12">
                                    <div class="form-group">

                                        <?php $sql = mysql_query("SELECT branch.*, city.CityName, country.CountryName, state.StateName, region.Regionname FROM branch INNER JOIN city ON branch.CityId=city.CityId INNER JOIN country ON branch.CountryId=country.CountryId INNER JOIN state ON branch.StateId=state.StateId LEFT JOIN region ON branch.RegionId=region.RegionId") or die(mysql_error());
                                        ?><br>
                                        <table id="example1" class="table table-responsive table-condensed table-striped table-hover table-bordered">
                                            <thead>
                                                <tr>  
                                                    <th>Branch Name</th>
                                                    <th>Branch Address</th>
                                                    <th>Country Name</th>
                                                    <th>State Name</th>
                                                    <th>City Name</th>
                                                    <th>Region Name</th>
                                                    <th>Branch Code</th>
                                                    <th>Branch Date</th>
                                                    <th>Branch Status</th>
                                                    <th>View</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            while ($row = mysql_fetch_array($sql)) {

                                                echo "<tr>"
                                                . "<td>" . $row['BranchName'] . "</td>"
                                                . "<td>" . $row['BranchAddress'] . "</td>"
                                                . "<td>" . $row['CountryName'] . "</td>"
                                                . "<td>" . $row['StateName'] . "</td>"
                                                . "<td>" . $row['CityName'] . "</td>"
                                                . "<td>" . $row['Regionname'] . "</td>"
                                                . "<td>" . $row['BranchCode'] . "</td>"
                                                . "<td>" . date('d-m-Y', strtotime($row['bdate'])) . "</td>";
                                                if ($row['Active'] == 1) {
                                                    echo '<td><span class="label bg-green">' . $a = "Active" . '</span></td>';
                                                } else {
                                                    echo '<td><span class="label bg-red">' . $a = "Deactive" . '</span></td>';
                                                }
                                                echo
                                                "<td><a href='superadmin_view_branch.php?id=", $row['BranchId'], "' '><span class='badge bg-yellow'>View</span></a></td>"
                                                . "</tr>";
                                            }
                                            ?> </table> <?php
                                            ?>
                                    </div>
                                </div>
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
