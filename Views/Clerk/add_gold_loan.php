<?php
include '../superadmin-session.php';
error_reporting(0);
if (isset($_POST['submit'])) {
    $pic = rand(1000, 100000) . "-" . $_FILES['Photo']['name'];
    $pic_loc = $_FILES['Photo']['tmp_name'];
    $folder = "../goldimage/";

    if (move_uploaded_file($pic_loc, $folder . $pic)) {
        ?><script>alert('successfully uploaded');</script><?php
    } else {
        ?><script>alert('error while uploading file');</script><?php
    }

    $ApplyLoanDate = date('Y-m-d', strtotime($_POST['ApplyLoanDate']));
    $insert = mysql_query("insert into goldloanapplication set 
		                CustomerID='" . $_POST['CustomerID'] . "',
		                ApplyLoanDate='$ApplyLoanDate',
		                AppliedAmount='" . $_POST['AppliedAmount'] . "',
		                LoanPurpose='" . $_POST['LoanPurpose'] . "',
                                ForDurationinMonth='" . $_POST['ForDurationinMonth'] . "',
                                GoldValue='" . $_POST['GoldValue'] . "',
                                WeightofOrnament='" . $_POST['WeightofOrnament'] . "',
                                GoldPurityCheck='" . $_POST['GoldPurityCheck'] . "',
                                GoldKarat='" . $_POST['GoldKarat'] . "',
                                Remark='" . $_POST['Remark'] . "',
                                BillVerification='" . $_POST['BillVerification'] . "',
                                CustomerIncome='" . $_POST['CustomerIncome'] . "',
                                Approval='pending',
                                Photo='" . $pic . "',
                                GoldLoanStatus='pending',
		                BranchId ='" . $_SESSION['branch_id'] . "',
		                CreatedBy='" . $_SESSION['userid'] . "' ") or die(mysql_error());


    if ($insert) {

        // 	$_SESSION['message'] = 'Successfully inserted';
        $sql1emailsetup = mysql_query("SELECT * FROM emailsetup ");
        $rowemail = mysql_fetch_array($sql1emailsetup);
        $sqlemail = mysql_fetch_array(mysql_query("SELECT * from  customer where CustomerID='" . $_POST['CustomerID'] . "' ")) or die(mysql_error());
        $email = $sqlemail['EmailID'];
        $to = $email;
        $subject = "Application activation";
        $message = "Welcome to $companyname !<br />";
        $message .= "Your application has been submited succesfully.";
        $message .= "If you have any questions or feedback please contact us at <b>support@salonzap.com</b> <br /> ";
        $message .= "Thank You <br /><br />";
        $message .= "<b>Copyright © 2016-2017 CodeFever.co, All Rights Reserved.</b><br />";
        $header = $rowemail['EmailId'];
        $retval = mail($to, $subject, $message, $header);

        if ($retval == true) {
            header("Location: clerk_dashboard.php");
        } else {
            header("Location: clerk_dashboard.php");
        }
    }
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
                    <form role="form" method="post" enctype="multipart/form-data" onsubmit="validationcheck()">

                        <div class="box box-warning">
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-user"></i> Customer Details</h3>
                            </div>

                            <div class="box-body"> 
                                <div class="col-md-12">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Customer ID<span style="color:red;">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" required class="form-control" name="CustomerID" id="CustomerID" placeholder="Enter Customer ID" >
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-warning" id="" name="Search"  onclick="customerdetails()" >Search</button>
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
                                <h3 class="box-title"><i class="fa fa-diamond"></i>Mortgage Details</h3>
                            </div>
                            <div class="box-body"> 
                                <div class="col-md-2">             
                                    <div class="form-group">
                                        <label>Gold Item Photo</label>
                                    </div>
                                </div>
                                <div class="col-md-4">             
                                    <div class="form-group">
                                        <image id="output_image" width="130px" height="130px"/>
                                    </div>
                                    <div class="row">
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <div class="btn btn-sm btn-default btn-file" id="divphoto" runat="server">
                                            <i class="fa fa-image"></i>&nbsp;Select Photo
                                            <input type="file" name="Photo" onchange="preview_image(event)" id="cust" width="100px" >
                                        </div>
                                    </div> 
                                </div>

                                <div class="col-md-2"> 
                                    <div class="form-group">
                                        <label>Bill Verification<span style="color:red;">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-4"> 
                                    <div class="form-group">
                                        <select  class="form-control" name="BillVerification"  style="width: 100%;" required>
                                            <option value="">--Select--</option>
                                            <option value='Verified'>Verified</option>
                                            <option value='NotVerified'>Not Verified</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Today Value of Gold<span style="color:red;">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">    
                                        <input type="text"  name="GoldValue" required class="form-control"  >
                                    </div>
                                </div>
                                <div class="col-md-2">    
                                    <div class="form-group">
                                        <label>Weight In Gram<span style="color:red;">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-4">    
                                    <div class="form-group">
                                        <input type="text" required  name="WeightofOrnament" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Gold In Karat<span style="color:red;">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-4">    
                                    <div class="form-group">
                                        <input type="text"  required name="GoldKarat" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-2">    
                                    <div class="form-group">
                                        <label>Gold Purity Check<span style="color:red;">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-4">    
                                    <div class="form-group">
                                        <select class="form-control" name="GoldPurityCheck"  style="width: 100%;" required>
                                            <option value="">--Select--</option>
                                            <option value="Verified">Verified</option>
                                            <option value="NotVerified">Not Verified</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box box-warning">
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-inr"></i> Loan Details</h3>
                            </div>
                            <div class="box-body">               
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Apply Loan Amount<span style="color:red;">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="AppliedAmount"  required class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">   
                                        <label>Apply Loan Date<span style="color:red;">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">  
                                        <input type="text" name="ApplyLoanDate" required   class="form-control" value="<?php echo date("d-m-Y"); ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Duration In Month<span style="color:red;">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">  
                                        <input type="text" name="ForDurationinMonth" required class="form-control" >
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

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Customer Income<span style="color:red;">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">  
                                        <input type="text" name="CustomerIncome" required class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Remark</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">  
                                        <input type="text" name="Remark"  class="form-control" >
                                    </div>
                                </div>
                            </div>

                            <div class="box-footer text-center">
                                <button type="submit" name="submit" class="btn btn-warning">Save</button>
                            </div>
                        </div>
                    </form>
                </section>
                <!-- /.content -->
            </div>

<?php include 'include/clerk_script.php'; ?>

            <!-- /.content-wrapper -->
            <!--  <footer class="main-footer">
              
               <strong>Copyright &copy; 2017-2018 <a href="#">CodeFever</a>.</strong> All rights
               reserved.
             </footer> -->

            <!-- Control Sidebar -->
            <div class="control-sidebar-bg"></div>


        </div>


        <script>
            $('#datepicker').datepicker({
                autoclose: true
            });
        </script>


        <script type="text/javascript">
            function customerdetails()
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
                            //alert(output);
                            // $("#CustomerName").val(output);

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

            /* function validationcheck()
             {   
             jSuccess('Your application submited succesfully', 'Success Dialog');
             return false;
             }*/
        </script>
    </body>
</html>


