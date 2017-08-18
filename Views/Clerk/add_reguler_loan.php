<?php
include '../superadmin-session.php';
error_reporting(0);
if (isset($_POST['submit'])) {

    $ApplyLoanDate = date('Y-m-d', strtotime($_POST['ApplyLoanDate']));
    $insert = mysql_query("insert into loanapplication set 
            		                CustomerID='" . $_POST['CustomerID'] . "',
            		                ApplyLoanDate='$ApplyLoanDate',
            		                AppliedAmount='" . $_POST['AppliedAmount'] . "',
                      			ForDurationinMonth='" . $_POST['ForDurationinMonth'] . "',
                      		        Remark='" . $_POST['Remark'] . "',
                      			LoanPurpose='" . $_POST['LoanPurpose'] . "',
                      			Gaurantor1Id='" . $_POST['Gaurantor1Id'] . "',
                      			Gaurantor2Id='" . $_POST['Gaurantor2Id'] . "',
                      			Approval='pending',
                      			LoanStatus='pending',
            		                BranchId ='" . $_SESSION['branch_id'] . "',
            		                CreatedBy='" . $_SESSION['userid'] . "' ");

    if ($insert) { //echo 'inserted'; 
        $sql1emailsetup = mysql_query("SELECT * FROM emailsetup ");
        $rowemail = mysql_fetch_array($sql1emailsetup);
        $sqlemail = mysql_fetch_array(mysql_query("SELECT * from  customer where CustomerID='" . $_POST['CustomerID'] . "' ")) or die(mysql_error());
        $email = $sqlemail['EmailID'];
        $to = $email;
        $subject = "Application activation";
        $message = "Welcome to $companyname !<br />";
        $message .= "Your application has been submited succesfully.";
        $message .= "If you have any questions or feedback please contact us at <b>codefever </b> <br /> ";
        $message .= "Thank You <br /><br />";
        $message .= "<b>Copyright © 2016-2017 CodeFever.co, All Rights Reserved.</b><br />";
        $header = $rowemail['EmailId'];
        $retval = mail($to, $subject, $message, $header);

        if ($retval == true) {
            $_SESSION['message'] = 'Successfully insert loan application';
            header("Location: clerk_dashboard.php");
        } else {
            $_SESSION['message'] = 'Loan application insertion fail';
            header("Location: clerk_dashboard.php");
        }
    }

    //  header("Location: clerk_dashboard.php");
}
?>    

<!DOCTYPE html>
<html>
    <head>
        <?php include 'include/clerk_nav.php'; ?>

        <?php include 'alerts.php'; ?>
    </head>

    <body class="hold-transition skin-blue sidebar-mini" link="white">
        <div class="wrapper">

            <?php include 'include/clerk_sidenav.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                <section class="content">   
                    <form role="form" method="post" enctype="multipart/form-data">
                        <div class="box box-warning">
                            <div class="box-header with-border">
                                <h2 class="box-title"><i class="fa fa-user"></i> Customer Details</h2>
                            </div>

                            <div class="box-body"> 
                                <div class="col-md-12">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Customer ID</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">    
                                            <input type="text" class="form-control" name="CustomerID" id="CustomerID" placeholder="Enter Customer ID" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-warning" id="" name="Search" onclick="customerdetails()">Search</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div id="customerinfo" ></div>
                                </div>
                            </div>
                        </div>
                        <!-- /.Mortgage details-->

                        <div class="box box-warning">
                            <div class="box-header with-border">
                                <h3 class="box-title">Apply Loan</h3>
                            </div>
                            <!-- /.box-header -->

                            <div class="box-body">               
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Applied Amount<span style="color:red;">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" required="" name="AppliedAmount" id="AppliedAmount">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Gaurantor1 ID<span style="color:red;">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="Gaurantor1Id" id="Gaurantor1Id" onblur="verifedgaurantor(this.value);" id="gaurantor1" required="">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Duration In Month<span style="color:red;">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="ForDurationinMonth" id="ForDurationinMonth">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Gaurantor2 ID<span style="color:red;">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control"  name="Gaurantor2Id" id="Gaurantor2Id" onblur="verifedgaurantor2(this.value);" required="" >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Gaurantor1 Name</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="Gaurantor1name" id="Gaurantor1name" readonly="true" required="" >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Loan Apply Date</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="date" class="form-control"  name="ApplyLoanDate"  readonly="true" value="<?php echo date("Y-m-d"); ?>" required="">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Gaurantor2 Name</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" readonly="true" name="Gaurantor2name" id="Gaurantor2name" required="" >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Remark</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="Remark" id="Remark" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Loan Purpose<span style="color:red;">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <textarea class="form-control" name="LoanPurpose" required ></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer text-center">
                                <button type="submit"  name="submit" class="btn btn-warning">Save</button>
                            </div>
                        </div>
                    </form>
            </div>

        </form>
    </section>
    <!-- /.content -->


    <?php include 'include/clerk_script.php'; ?>

    <!-- /.content-wrapper -->
    <!--  <footer class="main-footer">
      
       <strong>Copyright &copy; 2017-2018 <a href="#">CodeFever</a>.</strong> All rights
       reserved.
     </footer> -->

    <!-- Control Sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>
<script>
                                            $('#datepicker').datepicker({
                                                autoclose: true
                                            });
</script>


<script type="text/javascript">
    function customerdetails(val)
    {
        var val = $("#CustomerID").val();
        if (val == '')
        {
            jAlert('Please enter Customer ID', 'Alert Dialog');
        } else
        {
            $.ajax({url: 'clerk_customerdetails_ajax.php',
                data: {val: val},
                type: 'post',
                success: function (output)
                {
                    $("#customerinfo").html(output);
                }

            });
        }
    }
</script>
<script type='text/javascript'>
    function preview_image(event)
    {
        var reader = new FileReader();
        reader.onload = function ()
        {
            var output = document.getElementById('output_image');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

<script type="text/javascript">
    function verifedgaurantor(val)
    {
        var Gaurantor2Id = $("#Gaurantor2Id").val();
        var CustomerID = $("#CustomerID").val();

        if ((val == Gaurantor2Id) || (CustomerID == val)) {
            alert(" Gaurantor1 and Gaurantor2 are same ,please enter another Gaurantor Id ");
            $("#Gaurantor1Id").val("");

        } else {
            $.ajax({url: 'gaurantor_verification.php',
                data: {val: val},
                type: 'post',
                success: function (output)
                {//alert(output);
                    var json_data = JSON.parse(output);
                    if (json_data['CustomerName'] == '')
                    {
                        alert("This gaurantor name not available in records ");

                    } else
                    {
                        $("#Gaurantor1name").val(json_data['CustomerName']);
                    }
                }


            });
        }
    }
</script>

<script type="text/javascript">
    function verifedgaurantor2(val)
    {
        var Gaurantor1Id = $("#Gaurantor1Id").val();
        var CustomerID = $("#CustomerID").val();
        var Gaurantor2Id = $("#Gaurantor2Id").val();


        if ((val == Gaurantor1Id) || (CustomerID == val) || (CustomerID == Gaurantor1Id)) {
            alert(" Gaurantor1 and Gaurantor2 are same ,please enter another Gaurantor Id ");
            $("#Gaurantor2Id").val("");

        } else {

            $.ajax({url: 'gaurantor_verification.php',
                data: {val: val},
                type: 'post',
                success: function (output)
                {
                    var json_data = JSON.parse(output);

                    if (json_data['CustomerName'] == '')
                    {
                        alert("This gaurantor name not available in records ");
                    } else
                    {
                        $("#Gaurantor2name").val(json_data['CustomerName']);
                    }
                }


            });
        }
    }


</script>
</body>
</html>


