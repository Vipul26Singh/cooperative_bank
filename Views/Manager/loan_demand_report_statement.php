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
                <form role="form" method="post" enctype="multipart/form-data">
                    <section class="content">    
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-bank"></i>Loan Demand Report</h3>
                            </div>

                            <div class="box-body">               
                                <div class="col-md-2">            
                                    <div class="form-group">
                                        <label>Installment Date From </label>
                                    </div>
                                </div>
                                <div class="col-md-4">            
                                    <div class="form-group">
                                        <input type="text" name="trasactiondate" id="trasactiondate" class="form-control startdate">
                                    </div>
                                </div>
                                <div class="col-md-2"> 
                                    <div class="form-group">
                                        <label>to End Date </label>
                                    </div>
                                </div>
                                <div class="col-md-4">            
                                    <div class="form-group">
                                        <input type="text" name="trasactionenddate" id="trasactionenddate" class="form-control enddate">
                                    </div>	
                                </div>
                            </div>
                            <div class="box-footer text-center">
                                <button type="button" name="submit" class="btn btn-warning" onclick="accountdetails1()"><i class="fa fa-search"></i> Search</button>				
                            </div>

                        </div>

                        <div id="customerinfo" ></div>



                    </section>
                </form>    
                <!-- /.content -->
            </div><?php include 'include/mang_script.php'; ?>

            <!-- /.content-wrapper -->


            <!-- Control Sidebar -->

            <div class="control-sidebar-bg"></div>
        </div>
        <script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>
        <script>
                                $('.startdate').datepicker({
                                    autoclose: true,
                                    format: 'dd-mm-yyyy'
                                });

                                $('.enddate').datepicker({
                                    autoclose: true,
                                    format: 'dd-mm-yyyy'
                                });
        </script>
        <script type="text/javascript">
            function accountdetails1()
            {

                var trasactiondate = $("#trasactiondate").val();
                var trasactionenddate = $("#trasactionenddate").val();
                dataString = 'trasactiondate=' + trasactiondate + '&trasactionenddate=' + trasactionenddate;
                // alert(dataString);

                $.ajax({url: 'loan_demand_report_statement_ajax.php',
                    data: dataString,
                    type: 'post',
                    success: function (output)
                    {
                        //alert(loanno);
                        $("#customerinfo").html(output);
                    }
                });
            }
        </script>

    </body>
</html>
