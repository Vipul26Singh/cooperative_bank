<?php
include '../superadmin-session.php';
error_reporting(0);
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include 'include/cash_nav.php'; ?>
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <?php include 'include/cash_sidenav.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper"> 
                <form role="form" method="post"  enctype="multipart/form-data">
                    <section class="content">    

                        <!-- /.content-wrapper -->
                        <div class="box box-primary">

                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-user"></i> Customer Transactions Statement</h3>
                            </div>

                            <div class="box-body">               
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Account No</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" id="accountno" class="form-control" name="accountNo" required >
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
                                <button type="button" name="submit" class="btn btn-primary" onclick="accountdetails()"><i class="fa fa-search"></i> Search</button>				
                            </div>

                        </div>
                        <div id="customerinfo" ></div>




                    </section>
                </form>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <?php include 'include/cash_script.php'; ?>
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
            function accountdetails()
            {

                var accountno = $("#accountno").val();
                var trasaction_date = $("#trasactiondate").val();
                var trasaction_mode = $("#trasactionmode").val();
                var trasaction_end_date = $("#trasactionenddate").val();
                dataString = 'accountno=' + accountno + '&trasaction_date=' + trasaction_date + '&trasaction_mode=' + trasaction_mode + '&trasaction_end_date=' + trasaction_end_date;
                // alert(dataString);

                $.ajax({url: 'cash_accountStatament_ajax.php',
                    data: dataString,
                    type: 'post',
                    success: function (output)
                    {
                        //alert(shareno);
                        $("#customerinfo").html(output);
                    }
                });


            }
        </script>

    </body>
</html>



