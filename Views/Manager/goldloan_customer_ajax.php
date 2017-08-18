<?php
include '../superadmin-session.php';
//echo $_POST['custid'];
//echo $_POST['otp'];
$search = mysql_fetch_array(mysql_query("SELECT * FROM `goldloanapplication` 
        WHERE CustomerID='" . $_POST['custid'] . "' AND OTP='" . $_POST['otp'] . "' 
        AND ApplyGoldLoanID='" . $_POST['getid'] . "' ")) or die(mysql_error());
?>
<!-- Mortgage Details -->


<?php
if ($search['CustomerID'] != $_POST['custid'] && $search['OTP'] != $_POST['otp']) {
    ?>
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-diamond"></i>Mortgage Details</h3>
    </div>
    <div>
    <?php echo 'CustomerID and OTP are not Matched'; ?>
    </div>

    <?php } else { ?>

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
           <!-- <image width="130px" height="130px"> -->

    <?php echo '<img src="../goldimage/' . $search['Photo'] . '" style="width:100px; height:100px" />' ?>
                </div>
            </div>
            <div class="col-md-2"> 
                <div class="form-group">
                    <label>Bill Verification</label>
                </div>
            </div>
            <div class="col-md-4"> 
                <div class="form-group">
                    <input type="text" name="GoldValue" id="GoldValue" class="form-control" readonly="" value="<?php echo $search['BillVerification']; ?>"  >
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Today Value of Gold</label>
                </div>
            </div>
            <div class="col-md-4"> 
                <div class="form-group">
                    <input type="text" name="GoldValue" id="GoldValue" class="form-control" readonly="" value="<?php echo $search['GoldValue']; ?>"  >
                </div>
            </div>
            <div class="col-md-2"> 
                <div class="form-group">
                    <label>Weight In Gram</label>
                </div>
            </div>
            <div class="col-md-4"> 
                <div class="form-group">
                    <input type="text" name="WeightofOrnament" class="form-control" readonly="" value="<?php echo $search['GoldValue']; ?>" >
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Gold In Karat</label>
                </div>
            </div>
            <div class="col-md-4"> 
                <div class="form-group">
                    <input type="text" name="GoldKarat" class="form-control"   readonly="" value="<?php echo $search['GoldKarat']; ?>">
                </div>
            </div>
            <div class="col-md-2"> 
                <div class="form-group">
                    <label>Gold Purity Check</label>
                </div>
            </div>
            <div class="col-md-4"> 
                <div class="form-group">
                    <input type="text"class="form-control" name="GoldPurityCheck"  readonly="" value="<?php echo $search['GoldValue']; ?>">
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
            <div class="col-md-2">
                <div class="form-group">
                    <label> Approval Status</label>
                </div>
            </div>
            <div class="col-md-4"> 
                <div class="form-group">
                    <input type="text"class="form-control" readonly="" value="<?php echo $search['Approval']; ?>">
                </div>
            </div>
            <div class="col-md-2"> 
                <div class="form-group">
                    <label> Loan Type </label>  
                </div>
            </div>
            <div class="col-md-4"> 
                <div class="form-group">
                    <input type="text"class="form-control" readonly="" value="<?php echo $search['LoanTypeid']; ?>">
                </div>
            </div>
    <!--   <select class="form-control" name="LoanTypeid" id="LoanTypeid" required  >
          
    <?php /* $sqlgoldloan = mysql_query("SELECT * from  goldloantype  " );

      while($goldloan = mysql_fetch_array($sqlgoldloan))
      {


      ?>
      <option value="<?php echo $goldloan['GoldLoanTypeid']; ?>"><?php echo 'Rate Interest ='.$goldloan['InterestRate'].'%'.'&nbsp'.'Duration='.$goldloan['Durationinmonth'].'Month'; ?></option>
      <?php } */ ?>

    </select> -->

            <div class="col-md-2">             
                <div class="form-group">
                    <label>Approved Amount</label>
                </div>
            </div>
            <div class="col-md-4">             
                <div class="form-group">
                    <input type="text" class="form-control" value="<?php echo $search['ApproveAmount']; ?>" readonly="" >
                </div>  
            </div>
            <div class="col-md-2">             
                <div class="form-group">
                    <label>Approver Remark </label>
                </div>
            </div>
            <div class="col-md-4">             
                <div class="form-group">
                    <input type="text" class="form-control" value="<?php echo $search['ApproverRemark'] ?>" name=""  readonly="" >
                </div>
            </div>




<?php } ?>         