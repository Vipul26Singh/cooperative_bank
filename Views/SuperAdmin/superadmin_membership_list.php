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
                            <h3 class="box-title">Membership Fees List</h3>
                        </div>
                        <form role="form" method="post" action="add_membershipfees.php" >
                            <div class="box-body with-border text-center">
                                <input type="submit" class="btn btn-primary" name="addcity" value="Add Membershipfees">
                            </div>
                            <div class="box-body">               
                                <div class="col-md-12">
                                    <div class="form-group">

                                        <?php $sql = mysql_query("SELECT * FROM `membershipfees`") or die(mysql_error());
                                        ?><br>
                                        <table class="table table-responsive table-condensed table-striped table-hover table-bordered">
                                            <thead>
                                                <tr>  
                                                    <th>Membership Fees</th>
                                                    <th>MemberShip Fees Date</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            while ($row = mysql_fetch_array($sql)) {
                                                echo "<tr>"
                                                . "<td>" . $row['MemberShipFees'] . "</td>"
                                                . "<td>" . date('d-m-Y', strtotime($row['MemberShipFeeDate'])) . "</td>"
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

