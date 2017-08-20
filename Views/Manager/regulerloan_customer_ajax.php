<?php
include '../superadmin-session.php';
//echo $_POST['custid'];
//echo $_POST['otp'];
$search = mysql_fetch_array(mysql_query("SELECT * FROM `loanapplication` WHERE CustomerID='" . $_POST['custid'] . "' AND OTP='" . $_POST['otp'] . "' and ApplyLoanID='" . $_POST['getid'] . "'")) or die(mysql_error());

$searchloan = mysql_fetch_array(mysql_query("SELECT * FROM `loan` WHERE CustomerID='" . $_POST['custid'] . "' AND CustomerOTP='" . $_POST['otp'] . "' and ApplyLoanID='" . $_POST['getid'] . "' "));

$selectdata = mysql_fetch_array(mysql_query("SELECT * FROM `customer` WHERE CustomerID='" . $_POST['custid'] . "'  "));

$selectloandetail = mysql_fetch_array(mysql_query("SELECT * FROM `loantype` WHERE LoanTypeid='" . $search['LoanTypeid'] . "'  ")); 


if ($searchloan['CustomerID'] == $_POST['custid'] && $searchloan['CustomerOTP'] == $_POST['otp']) {
    echo 'This Customer is already present in the table';
} else {
    if ($search['CustomerID'] == $_POST['custid'] && $search['OTP'] == $_POST['otp']) {
        ?>
        <!-- Mortgage Details -->


        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-user"></i> Customer Details</h3>
            </div>

            <div class="box-body">               
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Customer Name</label>
                        <input type="text" name ="CustomerName" id="CustomerName"  class="form-control" readonly="true" readonly="true"  value="<?php echo $selectdata['CustomerName']; ?>">
                    </div>  
                    <div class="form-group">
                        <label> Gaurantor2Id</label>
                        <input type="text"  class="form-control" readonly="true"  readonly="" value="<?php echo $search['Gaurantor2Id']; ?>" >
                    </div>       
                </div>
                <div class="col-md-6">             
                    <div class="form-group">
                        <label>Gaurantor1Id </label>
                        <input type="text" name ="CustomerName" id="CustomerName"  class="form-control" readonly="true" readonly="true"  value="<?php echo $search['Gaurantor1Id']; ?>">
                    </div>  
                    <div class="form-group">
                        <label> Gaurantor 1 Name </label>
                        <input type="text" name ="MobileNo" id="MobileNo" class="form-control" readonly="true"  value="<?php
        $selectcustname = mysql_fetch_array(mysql_query("SELECT * from customer la
                                   where CustomerID='" . $search['Gaurantor1Id'] . "'  "));
        echo $selectcustname['CustomerName'];
        ?>" >
                    </div>
                </div>
                <div class="col-md-6">             

                    <div class="form-group">
                        <label> Gaurantor 2 Name </label>
                        <input type="text" name ="MobileNo" id="MobileNo" class="form-control" readonly="true"  value="<?php
        $selectcustname1 = mysql_fetch_array(mysql_query("SELECT * from customer la
                                   where CustomerID='" . $search['Gaurantor2Id'] . "'  "));
        echo $selectcustname1['CustomerName'];
        ?>" >
                    </div>
                </div>


            </div>
        </div>
        </div>


        <!--Loan Approval -->

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-edit"></i> Loan Approval</h3>
            </div>

            <div class="box-body">               
                <div class="col-md-6">
                    <div class="form-group">
                        <label> Approval Status</label>
                        <input type="text"class="form-control" readonly="" value="<?php echo $search['Approval']; ?>">
                    </div>
                    <div class="form-group">
                        <label> Loan Type </label>   
                        <input type="text"class="form-control" readonly="" value="<?php echo $search['LoanTypeid']; ?>">

                    </div>           
                </div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Frequency</label>
				<input type="text" class="form-control" readonly="" value="<?php echo $selectloandetail['Frequency']; ?>">
			</div>
			<div class="form-group">
				<label> Rate of Interest </label>
				<input type="text" class="form-control" readonly="" value="<?php echo $selectloandetail['InterestRate']; ?>">
			</div>
		</div>

				
                    <div class="col-md-6 form-group">
                        <label>Approved Amount</label>
                        <input type="text" class="form-control" readonly="" value="<?php echo $search['ApproveAmount']; ?>"  >
                    </div>  
                    <div class="col-md-6 form-group">
                        <label>Approver Remark </label>
                        <input type="text" class="form-control" readonly="" value="<?php echo $search['ApproverRemark'] ?>" name=""  >
                    </div>
            </div> 

        </div>
    <?php } else { ?>
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-diamond"></i>Mortgage Details</h3>
        </div>
        <div>
            <?php echo 'CustomerID and OTP are not Matched'; ?>
        </div>
    <?php }
} ?>         
