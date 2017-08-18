<?php
include '../superadmin-session.php';
error_reporting(0);

if (isset($_POST['submit'])) {
    $ApprovalDate = date('Y-m-d');
    $genOTP = rand(100000, 110000);

    if ($_POST['Approval'] == 'approve') {
        $insert = mysql_query("update goldloanapplication set 
                    Approval='" . $_POST['Approval'] . "',
                    GoldLoanStatus='" . $_POST['Approval'] . "',
                    ApprovalDate='$ApprovalDate ',
                    ApproverRemark='" . $_POST['ApproverRemark'] . "',
                    approve_by='" . $_SESSION['userid'] . "',
                    LoanTypeid ='" . $_POST['LoanTypeid'] . "',
                    OTP ='$genOTP',
                    ApproveAmount='" . $_POST['ApproveAmount'] . "'
                    where ApplyGoldLoanID='" . $_GET['id'] . "'         
                    ");

        if ($insert) {
            $sql1emailsetup = mysql_query("SELECT * FROM emailsetup ");
            $rowemail = mysql_fetch_array($sql1emailsetup);
            $email = $_POST['EmailID'];
            $to = $email;
            $subject = "OTP";
            //$message = "Welcome to $companyname !<br />";
            $message = "This is your OTP number $genOTP";
            $message .= "<b>Copyright © 2016-2017 Codefever Pvt Ltd, All Rights Reserved.</b><br/>";
            $header = $rowemail['EmailId'];
            $retval = mail($to, $subject, $message, $header);
            if ($retval == true) {
                header("Location:approve_goldloan_list.php");
                exit;
            } else {
                
            }
        }
        // header("Location:approve_goldloan_list.php");exit;
    } else {
        $insert = mysql_query("update goldloanapplication set 
                    Approval='" . $_POST['Approval'] . "',
                    GoldLoanStatus='" . $_POST['Approval'] . "',
                    ApprovalDate='$ApprovalDate ',
                    ApproverRemark='" . $_POST['ApproverRemark'] . "',
                    approve_by='" . $_SESSION['userid'] . "'
                    where ApplyGoldLoanID='" . $_GET['id'] . "'         
                    ");


        if ($insert) {
            $sql1emailsetup = mysql_query("SELECT * FROM emailsetup ");
            $rowemail = mysql_fetch_array($sql1emailsetup);
            $email = $_POST['EmailID'];
            $to = $email;
            $subject = "Loan Application Decline";
            //$message = "Welcome to $companyname !<br />";
            $message = "Dear Customer your Loan Application is Decline";
            $message .= "<b>Copyright © 2016-2017 Codefever Pvt Ltd, All Rights Reserved.</b><br/>";
            $header = $rowemail['EmailId'];
            $retval = mail($to, $subject, $message, $header);
            if ($retval == true) {
                header("Location:pending_loan_customer.php");
                exit;
            } else {
                
            }
        }
        header("Location:pending_loan_customer.php");
        exit;
    }
}

$selectdata = mysql_fetch_array(mysql_query("SELECT * from goldloanapplication ga
   inner join customer c on c.CustomerID=ga.CustomerID  where   ga.ApplyGoldLoanID='" . $_GET['id'] . "'  "));
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
                    <form role="form" method="post" enctype="multipart/form-data" name="myForm" onsubmit="return(validation());">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-user"></i> Customer Details</h3>
                            </div>

                            <div class="col-md-2">                    
                                <div class="form-group">
                                    <label>Photo/Signature</label>
                                </div>
                            </div>
                            <div class="col-md-4">                    
                                <div class="form-group">
<?php echo '<img src="../upload/' . $selectdata['mphoto'] . '" style="width:100px; height:100px" />' ?>
<?php echo '<img src="../upload/' . $selectdata['CSign'] . '" style="width:100px; height:100px" />' ?> 
                                </div>         
                            </div>
                            <div class="col-md-2">             
                                <div class="form-group">
                                    <label>Customer Name</label>
                                </div>
                            </div>
                            <div class="col-md-4">             
                                <div class="form-group">
                                    <input type="text" name ="CustomerName" id="CustomerName"  class="form-control" readonly="true" readonly="true"  value="<?php echo $selectdata['CustomerName']; ?>">
                                </div>  
                            </div>
                            <div class="box-body">               
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Customer ID</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name ="CustomerID" class="form-control" placeholder="Enter Customer ID" oninput="customerdetails(this.value)"  readonly="" value="<?php echo $selectdata['CustomerID']; ?>" >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Email ID</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name ="EmailID" id="EmailID" class="form-control" readonly="true"  readonly="" value="<?php echo $selectdata['EmailID']; ?>" >
                                    </div>           
                                </div>

                                <div class="col-md-2">             
                                    <div class="form-group">
                                        <label>Mobile No </label>
                                    </div>
                                </div>
                                <div class="col-md-4">             
                                    <div class="form-group">
                                        <input type="text" name ="MobileNo" id="MobileNo" class="form-control" readonly="true"  value="<?php echo $selectdata['MobileNo']; ?>" >
                                    </div>
                                </div>

                                <div class="col-md-2">  
                                    <div class="form-group">
                                        <label>Account Open Date </label>
                                    </div>
                                </div>
                                <div class="col-md-4">                    
                                    <div class="form-group">
                                        <input type="date" name ="ApplyLoanDate" id ="ApplyLoanDate" class="form-control" readonly="true" readonly="true"  value="<?php echo $selectdata['ApplyLoanDate']; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.Mortgage details-->
                        <div class="box box-primary">
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
<?php echo '<img src="../goldimage/' . $selectdata['Photo'] . '" style="width:100px; height:100px" />' ?>
                                    </div>
                                </div>
                                <div class="col-md-2">             
                                    <div class="form-group">
                                        <label>Bill Verification</label>
                                    </div>
                                </div>
                                <div class="col-md-4">             
                                    <div class="form-group">
                                        <input type="text" name="GoldValue" id="GoldValue" class="form-control" readonly="" value="<?php echo $selectdata['BillVerification']; ?>"  >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Today Value of Gold</label>
                                    </div>
                                </div>
                                <div class="col-md-4">             
                                    <div class="form-group">
                                        <input type="text" name="GoldValue" id="GoldValue" class="form-control" readonly="" value="<?php echo $selectdata['GoldValue']; ?>"  >
                                    </div>
                                </div>
                                <div class="col-md-2">             
                                    <div class="form-group">
                                        <label>Weight In Gram</label>
                                    </div>
                                </div>
                                <div class="col-md-4">             
                                    <div class="form-group">
                                        <input type="text" name="WeightofOrnament" class="form-control" readonly="" value="<?php echo $selectdata['GoldValue']; ?>" >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Gold In Karat</label>
                                    </div>
                                </div>
                                <div class="col-md-4">             
                                    <div class="form-group">
                                        <input type="text" name="GoldKarat" class="form-control"   readonly="" value="<?php echo $selectdata['GoldKarat']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-2">             
                                    <div class="form-group">
                                        <label>Gold Purity Check</label>
                                    </div>
                                </div>
                                <div class="col-md-4">             
                                    <div class="form-group">
                                        <input type="text"class="form-control" name="GoldPurityCheck"  readonly="" value="<?php echo $selectdata['GoldValue']; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Loan Details -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-inr"></i> Loan Details</h3>
                            </div>

                            <div class="box-body">               
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Apply Loan Amount</label>
                                    </div>
                                </div>
                                <div class="col-md-4">             
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="AppliedAmount"   readonly="" value="<?php echo $selectdata['AppliedAmount']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-2">             
                                    <div class="form-group">
                                        <label>Apply Loan Date</label>
                                    </div>
                                </div>
                                <div class="col-md-4">             
                                    <div class="form-group">
                                        <input type="date" class="form-control" readonly="true" value="<?php echo $selectdata['ApplyLoanDate']; ?>"  >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Duration In Month</label>
                                    </div>
                                </div>
                                <div class="col-md-4">             
                                    <div class="form-group">
                                        <input type="text" class="form-control" readonly="true" value="<?php echo $selectdata['ForDurationinMonth']; ?>" >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Remark</label>
                                    </div>
                                </div>
                                <div class="col-md-4">             
                                    <div class="form-group">
                                        <input type="text" class="form-control" readonly="true" value="<?php echo $selectdata['Remark']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Customer Income</label>
                                    </div>
                                </div>
                                <div class="col-md-4">             
                                    <div class="form-group">
                                        <input type="text" name="CustomerIncome" id="CustomerIncome" class="form-control" readonly="true" value="<?php echo $selectdata['CustomerIncome']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Loan Purpose</label>
                                    </div>
                                </div>
                                <div class="col-md-4">             
                                    <div class="form-group">
                                        <textarea class="form-control" readonly="true"><?php echo $selectdata['LoanPurpose']; ?></textarea>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Loan Approval -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-edit"></i> Loan Approval</h3>
                            </div>

                            <div class="box-body">               
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Select Approval</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control" style="width: 100%;" name="Approval" id="Approval" required>
                                            <option value="">--Select--</option>
                                            <option value="approve">Approve</option>
                                            <option value="decline">Decline</option>
                                        </select>  
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label> Loan Type </label>   
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control" name="LoanTypeid" id="LoanTypeid" >
                                            <option value="0">--Select--</option>
<?php
$sqlgoldloan = mysql_query("SELECT * from  goldloantype  ");
while ($goldloan = mysql_fetch_array($sqlgoldloan)) {
    ?>
                                                <option value="<?php echo $goldloan['GoldLoanTypeid']; ?>"><?php echo 'Rate Interest =' . $goldloan['InterestRate'] . '%' . '&nbsp' . 'Duration=' . $goldloan['Durationinmonth'] . 'Month'; ?></option>
<?php } ?> 
                                        </select>
                                        <div id="traTypBankeerror" style="color:red; display: none;" >Please select Loan Type</div>
                                    </div>				   
                                </div>
                                <div class="col-md-2">             
                                    <div class="form-group">
                                        <label>Approved Amount</label>
                                    </div>
                                </div>
                                <div class="col-md-4">             
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="ApproveAmount" id="ApproveAmount" onkeyup="amount()" >
                                        <div id="traTypeNoerror" style="color:red; display: none;height: 5px;" >Please enter Approve Amount</div>
                                    </div> 
                                </div>
                                <div class="col-md-2">             
                                    <div class="form-group">
                                        <label>Approver Remark </label>
                                    </div>
                                </div>
                                <div class="col-md-4">             
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="ApproverRemark"  >
                                    </div>
                                </div>
                            </div> 
                            <div class="box-footer text-center">
                                <button type="submit" name ="submit" class="btn btn-primary">Approve/Decline</button>
                            </div>			  

                        </div>

                    </form>
                </section>
                <!-- /.content -->
            </div>
<?php include 'include/mang_script.php'; ?>
            <!-- /.content-wrapper -->
            <!--  <footer class="main-footer">
              
               <strong>Copyright &copy; 2017-2018 <a href="#">CodeFever</a>.</strong> All rights
               reserved.
             </footer> -->

            <!-- Control Sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>

    </body>
</html>
<link href="../plugins_new/alerts/jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" />
<script src="../plugins_new/jQuery/jQuery-2.1.4.min.js"></script>
<script src="../plugins_new/alerts/jquery.alerts.js" type="text/javascript"></script>
<script type="text/javascript">
                                function customerdetails(val)
                                {


                                    $.ajax({url: 'loan_customerdetails_ajax.php',
                                        data: {val: val},
                                        type: 'post',
                                        success: function (output)
                                        {
                                            var json_data = JSON.parse(output);

                                            $("#EmailID").val(json_data['EmailID']);
                                            $("#CustomerName").val(json_data['CustomerName']);
                                            $("#MobileNo").val(json_data['MobileNo']);
                                            $("#Approvaldate").val(json_data['Approvaldate']);

                                            $("#Approvaldate").val(json_data['Approvaldate']);
                                            $("#Approvaldate").val(json_data['Approvaldate']);
                                            $("#Approvaldate").val(json_data['Approvaldate']);

                                        }

                                    });


                                }
</script>
<script>
    function amount() {
        var val = $('#Approval').val();
        if (val == '')
        {
            jAlert('Please Select ApprovalType.');
        }
    }
</script>
<script type="text/javascript">
    function validation()
    {
        var Approval = $("#Approval").val();
        var LoanTypeid = $("#LoanTypeid").val();
        var ApproveAmount = $("#ApproveAmount").val();

        if (Approval == 'approve')
        {


            if (document.myForm.ApproveAmount.value == "")
            {
                $("#traTypBankeerror").show();
                setTimeout(function () {
                    $('#traTypBankeerror').fadeOut()
                }, 3000);
                document.myForm.ApproveAmount.focus();
                return false;
            }
            if (document.myForm.LoanTypeid.value == "0")
            {
                $("#traTypeNoerror").show();
                setTimeout(function () {
                    $('#traTypeNoerror').fadeOut()
                }, 3000);
                document.myForm.LoanTypeid.focus();
                return false;
            }



        } else
        {

            //jAlert('Please enter Customer ID', 'Alert Dialog');
        }






        //return false;
    }
</script>

