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

            <div class="content-wrapper">
                <form role="form" method="post" enctype="multipart/form-data">
                    <section class="content">    
                        <div class="box box-warning">
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-bank"></i> Transaction Details</h3>
                            </div>

                            <div class="box-body">               
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Share Account No</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="shareno" id="shareno" class="form-control" name="" required >
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
                                <button type="button" name="submit" class="btn btn-warning" onclick="accountdetails()"><i class="fa fa-search"></i> Search</button>				
                            </div>

                        </div>
                        <!-- /.content-wpper -->

                        <div id="customerinfo" ></div>



                    </section>
                </form>    
                <!-- /.content -->
            </div><?php include 'include/cash_script.php'; ?>

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
            function accountdetails()
            {

                var shareno = $("#shareno").val();
                var trasaction_date = $("#trasactiondate").val();
                var trasaction_mode = $("#trasactionmode").val();
                var trasaction_end_date = $("#trasactionenddate").val();
                dataString = 'shareno=' + shareno + '&trasactiondate=' + trasaction_date + '&trasactionmode=' + trasaction_mode + '&trasactionenddate=' + trasaction_end_date;


                $.ajax({url: 'share_accountStatement_ajax.php',
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
