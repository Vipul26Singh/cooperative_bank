<?php
include '../superadmin-session.php';
error_reporting(0);
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
                            <h3 class="box-title">Transaction List</h3>
                        </div>
                        <form role="form" method="post" action="add_transaction_account.php" >
                            <div class="box-header with-border text-center">
                                <input type="submit" name="addtran" class="btn btn-primary" value="Add Share Transaction">
                            </div>
                            <div class="box-body">               
                                <div class="col-md-12">
                                    <div class="form-group">

                                        <?php //$sql = mysql_query("SELECT * FROM ``") or die(mysql_error()); 
                                        ?><br>
                                        <table class="table table-responsive table-condensed table-striped table-hover table-bordered">
                                            <thead>
                                                <tr>  
                                                    <th>Transaction</th>
                                                    <th>Active Status</th>
                                                    <th>View</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            /* while ($row = mysql_fetch_array($sql)) 
                                              {?>
                                              if($row['Active']==1)
                                              {
                                              echo '<td><span class="label bg-green">'.$a="Active".'</span></td>';
                                              }
                                              else{
                                              echo '<td><span class="label bg-red">'.$a="Deactive".'</span></td>';
                                              }
                                              echo
                                              "<td><a href=' '><span class='badge bg-blue'>View</span></a></td>"
                                              . "</tr>";
                                              } */
                                            ?> </table> 
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>


                </section>
                <!-- /.content -->
            </div><?php include 'include/mang_script.php'; ?>

            <!-- /.content-wrapper -->


            <!-- Control Sidebar -->

            <div class="control-sidebar-bg"></div>
        </div>

    </body>
</html>
