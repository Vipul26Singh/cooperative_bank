<?php
include '../superadmin-session.php';
error_reporting(0);

if (isset($_POST['submit'])) {
    $ApprovalDate = date('Y-m-d');
    $genOTP = rand(100000, 110000);
    if ($_POST['Approval'] == 'approve') {
        $insert = mysql_query("update loanapplication set 
                    Approval='" . $_POST['Approval'] . "',
                    LoanStatus='" . $_POST['Approval'] . "',
                    ApprovalDate='$ApprovalDate ',
                    ApproverRemark='" . $_POST['ApproverRemark'] . "',
                    approve_by='" . $_SESSION['userid'] . "',
                    LoanTypeid ='" . $_POST['LoanTypeid'] . "',
                    OTP ='$genOTP',
                    ApproveAmount='" . $_POST['ApproveAmount'] . "'
                    where ApplyLoanID='" . $_GET['id'] . "'         
                    ");

        if ($insert) {
            $sql1emailsetup = mysql_query("SELECT * FROM emailsetup ");
            $rowemail = mysql_fetch_array($sql1emailsetup);
            $email = $_POST['EmailID'];
            $to = $email;
            $subject = "OTP";
            $message = "This is your OTP number $genOTP";
            $message .= "<b>Copyright © 2016-2017 Codefever Pvt Ltd, All Rights Reserved.</b><br/>";
            $header = $rowemail['EmailId'];
            $retval = mail($to, $subject, $message, $header);
            if ($retval == true) {
                header("Location:approve_regulerloan_list.php");
                exit;
            } else {
                
            }
        }


        header("Location:approve_regulerloan_list.php");
        exit;
    } else {
        $insert = mysql_query("update loanapplication set 
                    Approval='" . $_POST['Approval'] . "',
                    LoanStatus='" . $_POST['Approval'] . "',
                    ApprovalDate='$ApprovalDate ',
                    ApproverRemark='" . $_POST['ApproverRemark'] . "',
                    approve_by='" . $_SESSION['userid'] . "',
                   
                    ApproveAmount='" . $_POST['ApproveAmount'] . "'
                    where ApplyLoanID='" . $_GET['id'] . "'         
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
                header("Location:pending_regulerloan_applicationList.php");
                exit;
            } else {
                
            }
        }


        header("Location:pending_regulerloan_applicationList.php");
        exit;
    }
}

$selectdata = mysql_fetch_array(mysql_query("SELECT * from loanapplication la
   inner join customer c on c.CustomerID=la.CustomerID  where   la.ApplyLoanID='" . $_GET['id'] . "'  "));
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

                            <div class="box-body">               
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Customer ID</label>
                                        <input type="text" name ="CustomerID" class="form-control" placeholder="Enter Customer ID" oninput="customerdetails(this.value)"  readonly="" value="<?php echo $selectdata['CustomerID']; ?>" >
                                    </div>
                                    <div class="form-group">
                                        <label>Email ID</label>
                                        <input type="text" name ="EmailID" id="EmailID" class="form-control" readonly="true"  readonly="" value="<?php echo $selectdata['EmailID']; ?>" >
                                    </div>           
                                </div>
                                <div class="col-md-6">             
                                    <div class="form-group">
                                        <label>Customer Name</label>
                                        <input type="text" name ="CustomerName" id="CustomerName"  class="form-control" readonly="true" readonly="true"  value="<?php echo $selectdata['CustomerName']; ?>">
                                    </div>  
                                    <div class="form-group">
                                        <label>Mobile No </label>
                                        <input type="text" name ="MobileNo" id="MobileNo" class="form-control" readonly="true"  value="<?php echo $selectdata['MobileNo']; ?>" >
                                    </div>
                                </div>
                                <div class="col-md-6">                    
                                    <div class="form-group">
                                        <label>Photo/Signature</label><br>
<?php echo '<img src="../upload/' . $selectdata['mphoto'] . '" style="width:100px; height:100px" />' ?>
<?php echo '<img src="../upload/' . $selectdata['CSign'] . '" style="width:100px; height:100px" />' ?> 
                                    </div>         
                                </div>
                                <div class="col-md-6">  
                                    <div class="form-group">
                                        <label>Account Open Date </label>
                                        <input type="date" name ="ApplyLoanDate" id ="ApplyLoanDate" class="form-control" readonly="true" readonly="true"  value="<?php echo $selectdata['ApplyLoanDate']; ?>">
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
                                    <div class="col-md-6 form-group">
                                        <label>Apply Loan Amount</label>
                                        <input type="text" class="form-control" name="AppliedAmount"   readonly="" value="<?php echo $selectdata['AppliedAmount']; ?>">

                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Apply Loan Date</label>
                                        <input type="date" class="form-control" readonly="true" value="<?php echo $selectdata['ApplyLoanDate']; ?>"  >
                                    </div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Frequency</label>
						<input type="text" class="form-control" readonly="true" value="<?php echo $selectdata['Frequency']; ?>" >
					</div>
				</div>
                                    <div class="col-md-6 form-group">
                                        <label>Duration</label>
                                        <input type="text" class="form-control" readonly="true" value="<?php echo $selectdata['ForDurationinMonth']; ?>" >
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Remark</label>
                                        <input type="text" class="form-control" readonly="true" value="<?php echo $selectdata['Remark']; ?>">
                                    </div>
                                
                                    <div class="col-md-6 form-group">
                                        <label>Gaurantor1 ID</label>
                                        <input type="text" name="Gaurantor1Id" id="Gaurantor1Id" class="form-control" readonly="true" value="<?php echo $selectdata['Gaurantor1Id']; ?>">
                                    </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gaurantor2 ID</label>
                                        <input type="text" class="form-control" name="Gaurantor2Id" id="Gaurantor2Id" required="" value="<?php echo $selectdata['Gaurantor2Id']; ?>" readonly="true">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gaurantor1 Name</label>
                                        <input type="text" name="Gaurantor1name" id="Gaurantor1name" class="form-control" readonly="true" value="<?php
$selectcustname = mysql_fetch_array(mysql_query("SELECT * from customer la
                                   where CustomerID='" . $selectdata['Gaurantor1Id'] . "'  "));

echo $selectcustname['CustomerName'];
?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gaurantor2 Name</label>
                                        <input type="text" class="form-control" name="Gaurantor2Name" id="Gaurantor2Name"   required="" readonly="true" value="<?php
                                               $selectcustname2 = mysql_fetch_array(mysql_query("SELECT * from customer la
                                   where CustomerID='" . $selectdata['Gaurantor2Id'] . "'  "));

                                               echo $selectcustname2['CustomerName'];
                                               ?>">
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Approval</label>
                                        <select class="form-control" style="width: 100%;" name="Approval" id="Approval" required>
                                            <option value="">--Select--</option>
                                            <option value="approve">Approve</option>
                                            <option value="decline">Decline</option>
                                        </select>  

                                    </div>
                                    <div class="form-group">
                                        <label> Loan Type </label>               
                                        <select class="form-control" name="LoanTypeid" id="LoanTypeid"   ">
                                            <option value="0">--Select--</option>   
<?php
$sqlgoldloan = mysql_query("SELECT * from   loantype  ");

while ($goldloan = mysql_fetch_array($sqlgoldloan)) {
    ?>

                                                <option value="<?php echo $goldloan['LoanTypeid']; ?>"><?php echo 'Rate Interest =' . $goldloan['InterestRate'] . '%' . '&nbsp' . 'Duration=' . $goldloan['Durationinmonth'] . ' '. $goldloan['Frequency']; ?></option>
                                            <?php } ?>

                                        </select>
                                        <div id="traTypBankeerror" style="color:red; display: none;" >Please select Loan Type</div>
                                    </div>				   
                                </div>
                                <div class="col-md-6">             
                                    <div class="form-group">
                                        <label>Approved Amount</label>
                                        <input type="text" class="form-control" name="ApproveAmount" id="ApproveAmount" >
                                        <div id="traTypeNoerror" style="color:red; display: none;height: 5px;" >Please enter Approve Amount</div>
                                    </div>  
                                    <div class="form-group">
                                        <label>Approver Remark </label>
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
<script type="text/javascript">
    function validation()
    {
        var Approval = $("#Approval").val();
        var LoanTypeid = $("#LoanTypeid").val();
        var ApproveAmount = $("#ApproveAmount").val();

        if (Approval == 'approve')
        {

            if (document.myForm.LoanTypeid.value == "0")
            {
                $("#traTypBankeerror").show();
                setTimeout(function () {
                    $('#traTypBankeerror').fadeOut()
                }, 3000);
                document.myForm.LoanTypeid.focus();
                return false;
            }

            if (document.myForm.ApproveAmount.value == "")
            {
                $("#traTypeNoerror").show();
                setTimeout(function () {
                    $('#traTypeNoerror').fadeOut()
                }, 3000);
                document.myForm.ApproveAmount.focus();
                return false;
            }



        } else
        {


        }







    }
</script>

