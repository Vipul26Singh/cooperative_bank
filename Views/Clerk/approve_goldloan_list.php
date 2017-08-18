<?php
include '../superadmin-session.php';
error_reporting(0);
?>    

<!DOCTYPE html>
<html>
    <head>
        <?php include 'include/clerk_nav.php'; ?>
    </head>

    <body class="hold-transition skin-blue sidebar-mini" link="white">
        <div class="wrapper">

            <?php include 'include/clerk_sidenav.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                <section class="content">


                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Approve Gold Loan Customer</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->

                        <form role="form" method="post" action="">
                            <div class="col-md-12">
                                <div class="form-group">

                                    <?php $sql = mysql_query("select * from goldloanapplication 
                                                where Approval='approve' and GoldLoanStatus='approve' and BranchId='" . $_SESSION['branch_id'] . "' ") or die(mysql_error());
                                    ;
                                    ?><br>
                                    <table class="table table-responsive table-condensed table-striped table-hover table-bordered">
                                        <thead>
                                            <tr>  
                                                <th>CustomerID</th>
                                                <th>Customer Name</th>
                                                <th>ApplyLoanDate</th>
                                                <th>AppliedAmount</th>
                                                <th>Approval</th>
                                                <th>Createdby</th>
                                                <th>ApprovalDate</th>
                                                <!-- <th>View</th> -->
                                            </tr>
                                        </thead>
<?php
while ($row = mysql_fetch_array($sql)) {
    $selectdata = mysql_fetch_array(mysql_query("SELECT * FROM customer 
                                            where CustomerID='" . $row['CustomerID'] . "'"));

    $sqldata = mysql_fetch_array(mysql_query("select * from userinfo where UserId='" . $row['Createdby'] . "' "));

    echo "<tr>";
    echo "<td>" . $row['CustomerID'] . "</td>"
    . "<td>" . $selectdata['CustomerName'] . "</td>"
    . "<td>" . date('d-m-Y', strtotime($row['ApplyLoanDate'])) . "</td>"
    . "<td>" . $row['AppliedAmount'] . "</td>"
    . "<td>" . $row['Approval'] . "</td>"
    . "<td>" . $sqldata['EmployeeName'] . "</td>"
    . "<td>" . date('d-m-Y', strtotime($row['ApprovalDate'])) . "</td>"
    /* . "<td><a href='grant_goldloan_old.php?id=",$row['ApplyGoldLoanID'],"' '><span class='badge bg-blue'>View</span></a></td>" */
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
            </div><?php include 'include/clerk_script.php'; ?>
            <!-- /.content-wrapper -->


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