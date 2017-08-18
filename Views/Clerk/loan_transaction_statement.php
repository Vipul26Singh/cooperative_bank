<?php
include '../superadmin-session.php';
error_reporting(0);
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include 'include/clerk_nav.php'; ?>
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <?php include 'include/clerk_sidenav.php'; ?>

            <div class="content-wrapper">
                <form role="form" method="post" enctype="multipart/form-data">
                    <section class="content">    
                        <div class="box box-warning">
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-bank"></i>Loan Transaction Details</h3>
                            </div>

                            <div class="box-body">               
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Loan No</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="loanno" id="loanno" class="form-control" name="" required >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Transaction Mode</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control" name="trasactionmode" id="trasactionmode" style="width: 100%;">
                                            <option value="">Select</option>
                                            <option value="cash">Cash </option>
                                            <option value="cheque">Cheque</option>                                  
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">            
                                    <div class="form-group">
                                        <label>Transaction Start Date </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="trasactiondate" id="trasactiondate" class="form-control startdate">
                                    </div>
                                </div>
                                <div class="col-md-2"> 
                                    <div class="form-group">
                                        <label>Transaction End Date </label>
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
                        <!-- /.content-wpper -->

                        <div id="customerinfo" ></div>



                    </section>
                </form>    
                <!-- /.content -->
            </div><?php include 'include/clerk_script.php'; ?>

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

                var loanno = $("#loanno").val();
                var trasaction_date = $("#trasactiondate").val();
                var trasaction_mode = $("#trasactionmode").val();
                var trasaction_end_date = $("#trasactionenddate").val();
                dataString = 'loanno=' + loanno + '&trasaction_mode=' + trasaction_mode + '&trasaction_date=' + trasaction_date + '&trasaction_end_date=' + trasaction_end_date;
                // alert(dataString);

                $.ajax({url: 'loan_statement_ajax.php',
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
