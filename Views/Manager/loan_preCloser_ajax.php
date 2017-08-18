<?php
include '../superadmin-session.php';

$sqlaccount = mysql_fetch_array(mysql_query("SELECT * from loan l 
                inner join customer c ON c.CustomerID=l.CustomerID where  LoanNumber='" . $_POST['val'] . "' "));
$currentdate = date("Y-m-d");

if ($sqlaccount > 0) {
    $sqlloanTransaction = mysql_fetch_array(mysql_query("SELECT * from  loantransaction  where  LoanNumber='" . $_POST['val'] . "' ORDER BY LoanNumber DESC "));

    $sqlloanTransaction2 = mysql_fetch_array(mysql_query("SELECT max(LoanTransactionId) as maxid from  loantransaction  where  LoanNumber='" . $_POST['val'] . "' ORDER BY LoanNumber DESC "));

    $sqlloanTransaction123 = mysql_fetch_array(mysql_query("SELECT installment_date,Amount,DepositDate from  loantransaction  where  LoanTransactionId='" . $sqlloanTransaction2['maxid'] . "' ORDER BY LoanNumber DESC "));

    //print_r($sqlloanTransaction); exit;

    if ($sqlloanTransaction == '') {
        $InstallmentDate = $sqlaccount['FirstInstallmentDate'];
    } else {
        $InstallmentDate = date('Y-m-d', strtotime($sqlloanTransaction123['installment_date'] . "+1 months"));
    }

    $installDay = date('d', strtotime($InstallmentDate));
    $currentDay = date('d', strtotime($currentdate));
    $emi = $sqlaccount['installmentamount'];
    $interest = $sqlaccount['Interestrate'];
    $start = date('Y-m-d', strtotime($sqlaccount['DisburseDate']));
    $end = date('Y-m-d', strtotime($sqlaccount['FirstInstallmentDate']));

    if ($installDay == $currentDay) {
        if ($sqlloanTransaction == '') {
            if ($currentdate > $InstallmentDate) {
                $data = round(abs(strtotime($start) - strtotime($currentdate)) / 86400);
            } else {
                $data = round(abs(strtotime($start) - strtotime($end)) / 86400);
            }
        } else {
            $nextday = date('Y-m-d', strtotime($InstallmentDate . "+1 months"));
            $data = round(abs(strtotime($InstallmentDate) - strtotime($currentdate)) / 86400);
        }
    } else if ($currentdate < $InstallmentDate) {
        //print_r("true2"); exit; 
        if ($sqlloanTransaction == '') {
            $data = round(abs(strtotime($start) - strtotime($currentdate)) / 86400);
        } else {
            // print_r("true3"); exit; 
            $data = round(abs(strtotime($InstallmentDate) - strtotime($InstallmentDate)) / 86400);
        }
    } else {

        if ($sqlloanTransaction == '') {
            $data = round(abs(strtotime($start) - strtotime($currentdate)) / 86400);
        } else {

            $nextday = date('Y-m-d', strtotime($InstallmentDate . "+1 months"));
            $data = round(abs(strtotime($InstallmentDate) - strtotime($currentdate)) / 86400);
        }
    }



    if ($sqlaccount['Balance'] > $emi) {

        $outstanding = $sqlaccount['Balance'];

        if ($data == 0) {
            $nextday = date('Y-m-d', strtotime($InstallmentDate . "+1 months"));
            if ($sqlloanTransaction == '') {
                $days = round(abs(strtotime($start) - strtotime($currentdate)) / 86400);
            } else {
                $days = round(abs(strtotime($InstallmentDate) - strtotime($nextday)) / 86400);
            }
        } else {
            $nextday = date('Y-m-d', strtotime($InstallmentDate . "+1 months"));
            if ($sqlloanTransaction == '') {
                $days = round(abs(strtotime($start) - strtotime($currentdate)) / 86400);
            } else {
                $days = round(abs(strtotime($InstallmentDate) - strtotime($nextday)) / 86400) + $data;
            }
        }

        $intrestamount = ((($outstanding) * ($interest)) / 36500) * $days;
        if ($InstallmentDate >= $currentdate) {
            $emiamt = $emi;
        } else {
            $emiamt = $emi + $intrestamount;
        }


        $totalbal = $sqlaccount['Balance'];
        $totalemiamt = $totalbal + $intrestamount;
        $totalbalance = ($totalemiamt) - ($totalbal);
        $totalval = ($intrestamount - $intrestamount);
        $principal = ($totalemiamt - $intrestamount);
        $outstandingbal = ($outstanding - $principal);
    } else {

        $outprincipal = $sqlaccount['Balance'];

        if ($data == 0) {
            $nextday = date('Y-m-d', strtotime($InstallmentDate . "+1 months"));

            if ($sqlloanTransaction == '') {
                $days = round(abs(strtotime($start) - strtotime($currentdate)) / 86400);
            } else {
                $days = round(abs(strtotime($InstallmentDate) - strtotime($nextday)) / 86400);
            }
        } else {
            $nextday = date('Y-m-d', strtotime($InstallmentDate . "+1 months"));
            if ($sqlloanTransaction == '') {
                $days = round(abs(strtotime($start) - strtotime($currentdate)) / 86400);
            } else {
                $days = round(abs(strtotime($InstallmentDate) - strtotime($nextday)) / 86400) + $data;
            }
        }

        $intrestamount = ((($outprincipal) * ($interest)) / 36500) * $days;

        if ($InstallmentDate >= $currentdate) {
            $emiamt = $emi;
        } else {
            $emiamt = $emi + $intrestamount;
        }

        $totalbal = $sqlaccount['Balance'];
        $totalemiamt = $totalbal + $intrestamount;
        $totalbalance = ($totalemiamt) - ($totalbal);
        $totalval = ($intrestamount - $intrestamount);

        $principal = ($totalemiamt - $intrestamount);
        $outstandingbal = ($outstanding - $principal);

        /* $principal = $outprincipal;
          $outstandingbal = $outprincipal - $principal;
          $emi= $principal + $intrestamount; */
    }
    ?>
    <div class="box box-primary" >
        <div class="box-body"> 
            <div class="col-md-2">  
                <div class="form-group">
                    <label>Photo/Signature</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
    <?php echo '<img src="../upload/' . $sqlaccount['mphoto'] . '" style="width:100px; height:100px" />' ?>
    <?php echo '<img src="../upload/' . $sqlaccount['CSign'] . '" style="width:100px; height:100px" />' ?>
                </div>			   
            </div>
            <div class="col-md-2" >
                <div class="form-group">
                    <label>Customer Name</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" name="CustomerName"  id="CustomerName" class="form-control" value="<?php echo $sqlaccount['CustomerName'] ?>" readonly="">
                </div>
            </div>
            <div class="col-md-2" >
                <div class="form-group">
                    <label>Customer ID</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" name="CustomerID"  id="CustomerID" class="form-control" value="<?php echo $sqlaccount['CustomerID'] ?>" readonly="">
                </div>
            </div>
            <div class="col-md-2" >
                <div class="form-group">
                    <label>Mobile No.</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" name="MobileNo"  id="MobileNo" readonly="" class="form-control" value="<?php echo $sqlaccount['MobileNo'] ?>"  >
                </div>
            </div>
            <div class="col-md-2" >
                <div class="form-group">
                    <label>Loan Amount</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" name="Balancezzz" readonly="" id="Balancezzz" class="form-control" value=<?php echo $sqlaccount['Amount'] ?> >
                </div>
            </div>
            <div class="col-md-2" >
                <div class="form-group">
                    <label>Loan Duration</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" name="Durationinmonth" readonly="" id="Durationinmonth" class="form-control" value=<?php echo $sqlaccount['Durationinmonth'] ?> >
                </div>
            </div>
            <div class="col-md-2" >
                <div class="form-group">
                    <label>Last Pay Date</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text"  readonly=""  class="form-control" value="<?php echo date('d-m-Y', strtotime($sqlloanTransaction123['DepositDate'])); ?>" >
                </div>
            </div>
            <div class="col-md-2" >
                <div class="form-group">
                    <label>EMI Amount</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" name="installmentamountxx" readonly="" id="installmentamountxx" class="form-control" value="<?php echo round($sqlaccount['Balance'], 2); ?>" >
                </div>
            </div>
            <div class="col-md-2" >
                <div class="form-group">
                    <label>Last Pay</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" name="installmentamountzz" readonly="" id="installmentamountzz" class="form-control"  value="<?php echo round($sqlloanTransaction123['Amount'], 2) ?>">
                </div>
            </div>
            <div class="col-md-2" >
                <div class="form-group">
                    <label>Balance</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text"  readonly="" id="Balancezz" name="Balancezz" class="form-control"  value="<?php echo round($sqlaccount['Balance'], 2) ?>">
                </div>
            </div>
            <div class="col-md-2" >
                <div class="form-group">
                    <label>Deu Days</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text"  readonly=""  class="form-control"  value="<?php echo $data; ?>">
                </div>
            </div>
        </div>
    </div>

    <div class="box box-primary" >
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-bank"></i> Loan Transaction</h3>
        </div>
        <div class="box-body"> 

            <div class="col-md-2">
                <div class="form-group">
                    <label>Transaction Type</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text"  name="TransactionType" id="TransactionType" class="form-control" value="<?php echo 'Deposit'; ?>" readonly="true" >
                </div>       
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label>Transaction Mode</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <select class="form-control"   name="Transactionmode"  onchange="showid(this.value);" required> 
                        <option value="cash">Cash</option>
                        <option value="cheque">Cheque</option>
                    </select> 
                </div>
            </div>
            <div class="" style="display: none;"  id="Chequenoshow">
                <div class="form-group col-md-2">
                    <label> Cheque No</label>
                </div>
                <div class="form-group col-md-4">
                    <input type="text" name="Chequeno"  id="Chequeno" class="form-control"  >
                </div>
            </div>
            <div class="" style="display: none;" id="BankNameshow">
                <div class="form-group col-md-2">
                    <label>Bank Name</label>
                </div>
                <div class="form-group col-md-4">
                    <input type="text" name="BankName"  id="BankName" class="form-control"  >
                </div>
            </div>
            <div class="" style="display: none;" id="ChequeDateshow">
                <div class="form-group col-md-2">
                    <label> Cheque Date</label>
                </div>
                <div class="form-group col-md-4">
                    <input type="text" name="ChequeDate"  id="datepicker" class="form-control"  placeholder="dd/mm/yy">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Installment Date </label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" name="installment_date" id="installment_date" class="form-control" readonly value="<?php echo date('d-m-Y', strtotime($InstallmentDate)); ?>" >
                </div>
            </div>

            <div class="col-md-2" >
                <div class="form-group">
                    <label>Deposit Date</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text"  name="DepositDate" id="DepositDate" class="form-control" value="<?php echo date('d-m-Y', strtotime($currentdate)); ?>" readonly="true" > 
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label>Pay Amount</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
    <?php
    $duration = $sqlaccount['Durationinmonth'];
    $lastInstallmentDate = date('Y-m-d', strtotime($sqlaccount['FirstInstallmentDate'] . "+$duration months"));
    ?>
                    <input type="text" name="Amountnew" id="Amountnew" class="form-control" oninput="payamount(this.value)"  value="<?php echo round($totalemiamt, 2); ?>" readonly>

                    <input type="hidden" name="Amountnew1" id="Amountnew1" class="form-control"  value="<?php echo round($totalemiamt, 2); ?>" >

                </div>  
            </div> 

            <div class="col-md-2" >
                <div class="form-group">
                    <label> Principal</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text"  name="principal" id="principal" class="form-control"  readonly="true" value="<?php echo round($principal, 2); ?>" >
                </div>
            </div>
            <div class="col-md-2" >
                <div class="form-group">
                    <label>Interest Amount</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text"  name="interestamount" id="interestamount" class="form-control"  readonly="true" value="<?php echo round($intrestamount, 2); ?>">
                </div>
            </div>

            <div class="col-md-2" >
                <div class="form-group">
                    <label>Total Balance Amount</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text"  name="outstandingbal" id="outstandingbal" class="form-control"  readonly="true" value="<?php echo round($totalval, 2); ?>" >
                </div>
            </div>

            <div class="col-md-2" >
                <div class="form-group">
                    <label>Remarks</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" name="Remarknew"  class="form-control"  >
                </div>
            </div>
        </div>
        <input type="hidden"  name="LoanId" id="LoanId" class="form-control" value="<?php echo $sqlaccount['LoanId'] ?>" readonly="true" >
        <input type="hidden"  name="LoanNo" id="LoanNo" class="form-control" value="<?php echo $_POST['val']; ?>" readonly="true" >
        <input type="text"  name="odintrest" id="odintrest" class="form-control"  readonly="true" >

        <div class="box-footer text-center">
            <input type="submit"  name="submit" value="Submit"  class="btn btn-primary">
        </div>   
    </div>
<?php } else {
    echo "No record found"; ?>

<?php } ?>
<script type="text/javascript">
    function showid(val)
    {
        if (val == 'cheque')
        {
            $("#Chequenoshow").show();
            $("#BankNameshow").show();
            $("#ChequeDateshow").show();
        } else
        {
            $("#Chequenoshow").hide();
            $("#BankNameshow").hide();
            $("#ChequeDateshow").hide();
        }
    }
</script>
