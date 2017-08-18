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
                            <h3 class="box-title">Loan List</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->

                        <form role="form" method="post" action="">
                            <div class="col-md-12">
                                <div class="form-group">

                                    <?php $sql = mysql_query("select * from loan  where status='Active'") or die(mysql_error());
                                    ;
                                    ?><br>
                                    <table class="table table-responsive table-condensed table-striped table-hover table-bordered">
                                        <thead>
                                            <tr>  
                                                <th>CustomerID</th>
                                                <th>Customer Name</th>
                                                <th>LoanDate</th>
                                                <th>Loan Amount</th>
                                                <th>Loan Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        while ($row = mysql_fetch_array($sql)) {
                                            $selectdata = mysql_fetch_array(mysql_query("SELECT * FROM customer 
                                            where CustomerID='" . $row['CustomerID'] . "'"));
                                            echo "<tr>";
                                            echo "<td>" . $row['CustomerID'] . "</td>"
                                            . "<td>" . $selectdata['CustomerName'] . "</td>"
                                            . "<td>" . date('d-m-Y', strtotime($row['LoanDate'])) . "</td>"
                                            . "<td>" . $row['Amount'] . "</td>"
                                            . "<td>" . $row['Type'] . "</td>"
                                            . "<td><a href='loanReport.php?id=" . $row['LoanId'] . "' '><span class='badge bg-yellow'>Print</span></a></td>"
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
            <!-- /.content-wrapper -->
            <?php include 'include/mang_script.php'; ?>

            <!-- Control Sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>

        <script type="text/javascript">
            function customerdetails(val)
            {


                $.ajax({url: 'customerdetails_ajax.php',
                    data: {val: val},
                    type: 'post',
                    success: function (output)
                    {
                        //alert(output);
                        // $("#CustomerName").val(output);

                        $("#customerinfo").html(output);
                    }

                });

            }
        </script>


    </body>
</html>