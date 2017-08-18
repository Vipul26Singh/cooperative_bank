<?php
include '../superadmin-session.php';

$sqlaccount = mysql_fetch_array(mysql_query("SELECT * from fdaccount  where  FdNo='" . $_POST['val'] . "'  "));
$sqlbranch = mysql_fetch_array(mysql_query("SELECT * from  customer where CustomerID='" . $sqlaccount['CustomerID'] . "'  "));

$datacount = count($sqlaccount['FdNo']);
if ($datacount == 1) {

    $sqlFDtrans = mysql_fetch_array(mysql_query("SELECT * from  fdaccount where FdNo='" . $_POST['val'] . "' and WithdrawDate IS NULL "));

    // print_r($sqlFDtrans); exit;

    if ($sqlFDtrans > 0) {
        ?>

        <div class="box box-primary" >
            <div class="box-body"> 
                <div class="col-md-6">  
                    <div class="form-group">
                        <label>Photo/Signature</label><br>
                        <?php echo '<img src="../upload/' . $sqlbranch['mphoto'] . '" style="width:100px; height:100px" />' ?>
                        <?php echo '<img src="../upload/' . $sqlbranch['CSign'] . '" style="width:100px; height:100px" />' ?>
                    </div>			   
                </div>
                <div class="col-md-6" >
                    <div class="form-group">
                        <label> Customer Name</label>
                        <input type="text" name="CustomerName"  id="CustomerName" class="form-control" value="<?php echo $sqlbranch['CustomerName'] ?>" readonly="">
                    </div>
                </div>
                <div class="col-md-6" >
                    <div class="form-group">
                        <label> Customer ID</label>
                        <input type="text" name="CustomerID"  id="CustomerID" class="form-control" value="<?php echo $sqlbranch['CustomerID'] ?>" readonly="">
                    </div>
                </div>
                <div class="col-md-6" >
                    <div class="form-group">
                        <label>Mobile No.</label>
                        <input type="text" name="MobileNo"  id="MobileNo" readonly="" class="form-control" value="<?php echo $sqlbranch['MobileNo'] ?>"  >
                    </div>
                </div>
                <div class="col-md-6" >
                    <div class="form-group">
                        <label>FD Amount</label>
                        <br> <input type="text" name="FDAmount" readonly="" id="FDAmount" class="form-control" value=<?php echo $sqlaccount['FDAmount'] ?> >
                    </div>
                </div>
                <div class="col-md-6" >
                    <div class="form-group">
                        <label>Duration</label>
                        <br> <input type="text" name="" readonly="" id="" class="form-control" value=<?php echo $sqlaccount['Duration'] ?> >
                    </div>
                </div>
                <div class="col-md-6" >
                    <div class="form-group">
                        <label>Maturity Date</label>
                        <br> <input type="text" name="MaturityDate" readonly="" id="MaturityDate" class="form-control" value="<?php echo $sqlaccount['MaturityDate'] ?>" >
                    </div>
                </div>
                <div class="col-md-6" >
                    <div class="form-group">
                        <label>Maturity Amount</label>
                        <br> <input type="text" name="MaturityAmount" readonly="" id="MaturityAmount" class="form-control" value="<?php echo $sqlaccount['MaturityAmount'] ?>" >
                    </div>
                </div>
            </div>
        </div>

        <div class="box box-primary" >
            <div class="box-body"> 
                <div>
                    <h3 class="box-title"><i class="fa fa-bank"></i> FD Transaction</h3>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Transaction Type</label>
                        <input type="text"  name="TransactionType" id="TransactionType" class="form-control" value="<?php echo 'Withdraw'; ?>" readonly="true" >
                       <!-- <select class="form-control" style="width: 100%;" required name="TransactionType" id="TransactionType" >
                           <option value='Withdraw'>Withdraw</option>                 
                        </select> -->
                    </div>       
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Amount</label>
                        <?php
                        if (date("Y-m-d") >= $sqlaccount['MaturityDate']) {
                            $amount = $sqlaccount['MaturityAmount'];
                        } else {
                            $amount = $sqlaccount['FDAmount'];
                        }
                        ?>
                        <input type="text" name="Amountnew" id="Amount" class="form-control" value="<?php echo $amount; ?>" readonly  onload="calculation(this.value)" >
                    </div>  
                </div> 
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Transaction Mode</label>
                        <input type="text"  name="Transactionmode" id="Transactionmode" class="form-control" value="<?php echo 'Cash'; ?>" readonly="true" >
                 <!-- <select class="form-control"   name="Transactionmode"  required >
                        <option value="0">Select Transaction Type </option>
                        <option value="cash">Cash</option>
                    </select> -->
                    </div>
                </div>
                <div class="col-md-6" >
                    <div class="form-group">
                        <label>Transaction Date</label>
                        <input type="text"  name="TransactionDate" id="TransactionDate" class="form-control" value="<?php echo date("d-m-Y"); ?>" readonly="true" >
                    </div>
                </div>
                <div class="col-md-6" >
                    <div class="form-group">
                        <label>Remarks</label>
                        <input type="text" name="Remarknew"  class="form-control"  >
                    </div>
                </div>
            </div>

            <div class="box-footer text-center">
                <input type="submit"  name="submit" value="Submit"  class="btn btn-primary">
            </div>   
        </div>
        <?php
    }
}
?>
