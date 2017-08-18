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
                            <h3 class="box-title">Online Transaction Limit List</h3>
                        </div>
                        <form role="form" method="post" action="online_transaction_limit.php" >
                            <div class="box-body with-border text-center">
                                <input type="submit" class="btn btn-primary" name="add" value="Add Online Transaction Limit">
                            </div>
                            <div class="box-body">               
                                <div class="col-md-12">
                                    <div class="form-group">

                                        <?php $sql = mysql_query("SELECT o.*, oc.OnlineCustomertypename, at.Accounttypename FROM onlinetransactionlimit AS o
                                            INNER JOIN onlinecutomertype AS oc ON oc.OnlineCustomertypeId = o.OnlineCustomertypeId
                                            INNER JOIN accounttype AS at ON at.AccountTypeid = o.AccountTypeid") or die(mysql_error());
                                        ?><br>
                                        <table id="example1" class="table table-responsive table-condensed table-striped table-hover table-bordered">
                                            <thead>
                                                <tr>  
                                                    <th>Customer Type</th>
                                                    <th>Account Type</th>
                                                    <th>Via Mobile (Amount)</th>
                                                    <th>Via Internet (Amount)</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            while ($row = mysql_fetch_array($sql)) {
                                                echo "<tr>"
                                                . "<td>" . $row['OnlineCustomertypename'] . "</td>"
                                                . "<td>" . $row['Accounttypename'] . "</td>"
                                                . "<td>" . $row['ViaMobileAmount'] . "</td>"
                                                . "<td>" . $row['ViaInternetAmount'] . "</td>"
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
