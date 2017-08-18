<?php
include '../superadmin-session.php';
error_reporting(0);

$sqlaccount = mysql_fetch_array(mysql_query("SELECT * from loan l 
                inner join customer c ON c.CustomerID=l.CustomerID where  LoanNumber='" . $_POST['val'] . "' "));
$currentdate = date("Y-m-d");

if ($sqlaccount > 0) {
    $sqlloanTransaction = mysql_fetch_array(mysql_query("SELECT * from  loantransaction  where  LoanNumber='" . $_POST['val'] . "' ORDER BY LoanNumber DESC "));

    $sqlloanTransaction2 = mysql_fetch_array(mysql_query("SELECT max(LoanTransactionId) as maxid from  loantransaction  where  LoanNumber='" . $_POST['val'] . "' ORDER BY LoanNumber DESC "));

    $sqlloanTransaction123 = mysql_fetch_array(mysql_query("SELECT installment_date,Amount,DepositDate from  loantransaction  where  LoanTransactionId='" . $sqlloanTransaction2['maxid'] . "' ORDER BY LoanNumber DESC "));


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

    /* ----Same date insttallment pay functionality start--- */
    if ($installDay == $currentDay) {
        if ($sqlloanTransaction == '') {
            if ($currentdate > $InstallmentDate) {
                $data = round(abs(strtotime($start) - strtotime($currentdate)) / 86400);
            } else {
                $data = round(abs(strtotime($start) - strtotime($end)) / 86400);
            }
        } else {

            $nextday = date('Y-m-d', strtotime($InstallmentDate . "+1 months"));

            if ($currentdate > $InstallmentDate) {
                $data = round(abs(strtotime($InstallmentDate) - strtotime($currentdate)) / 86400);
            } else {
                $data = round(abs(strtotime($installDay) - strtotime($currentDay)) / 86400);
            }
        }
    }

    /* ----Same date insttallment pay functionality end--- */


    /* ---- insttallment date greter than current date functionality start--- */ else if ($currentdate < $InstallmentDate) {
        if ($sqlloanTransaction == '') {
            $data = round(abs(strtotime($start) - strtotime($currentdate)) / 86400);
        } else {
            $data = round(abs(strtotime($InstallmentDate) - strtotime($InstallmentDate)) / 86400);
        }
    }

    /* ---- Insttallment date greter than current date functionality end-- */


    /* ---- Current date greter than  insttallment date functionality start-- */ else {

        if ($sqlloanTransaction == '') {
            $data = round(abs(strtotime($start) - strtotime($currentdate)) / 86400);
        } else {
            $nextday = date('Y-m-d', strtotime($InstallmentDate . "+1 months"));
            $data = round(abs(strtotime($InstallmentDate) - strtotime($currentdate)) / 86400);
        }
    }

    /* ---- Current date greter than  insttallment date functionality end-- */


    /* ---- First to second last functionality start - */

    if ($sqlaccount['Balance'] > $emi) {
        $outstanding = $sqlaccount['Balance'];

        if ($data == 0) {
            $nextday = date('Y-m-d', strtotime($InstallmentDate . "+1 months"));
            if ($sqlloanTransaction == '') {
                $days = round(abs(strtotime($start) - strtotime($currentdate)) / 86400);
            } else {

                if ($currentdate > $InstallmentDate) {
                    $days = round(abs(strtotime($InstallmentDate) - strtotime($nextday)) / 86400);
                } else {

                    if ($sqlloanTransaction123['installment_date'] == '') {
                        $lastinsttalment = $InstallmentDate;
                    } else {
                        $lastinsttalment = $sqlloanTransaction123['installment_date'];
                    }

                    $days = round(abs(strtotime($InstallmentDate) - strtotime($lastinsttalment)) / 86400);
                }
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
        $principal = ($emiamt - $intrestamount);
        $outstandingbal = ($outstanding - $principal);
    }

    /* ---- First to second last functionality End - */

    /* ----last EMI Entry functionality start- */ else {

        $outprincipal = $sqlaccount['Balance'];
        if ($data == 0) {
            $nextday = date('Y-m-d', strtotime($InstallmentDate . "+1 months"));

            if ($sqlloanTransaction == '') {
                $days = round(abs(strtotime($start) - strtotime($currentdate)) / 86400);
            } else {

                if ($currentdate > $InstallmentDate) {
                    $days = round(abs(strtotime($InstallmentDate) - strtotime($nextday)) / 86400);
                } else {

                    if ($sqlloanTransaction123['installment_date'] == '') {
                        $lastinsttalment = $InstallmentDate;
                    } else {
                        $lastinsttalment = $sqlloanTransaction123['installment_date'];
                    }
                    $days = round(abs(strtotime($InstallmentDate) - strtotime($lastinsttalment)) / 86400);
                }
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
        $principal = $outprincipal;
        $outstandingbal = $outprincipal - $principal;
        $emi = $principal + $intrestamount;
    }
    /* ----last EMI Entry functionality end- */
    ?>
    <form role="form" method="post" action="" name="myForm" onsubmit="return(validation());">
        <div class="box box-warning" >
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
                <div class="col-md-2">
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
                        <input type="text" name="installmentamountxx" readonly="" id="installmentamountxx" class="form-control" value="<?php echo round($sqlaccount['installmentamount'], 2); ?>" >
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
                        <label>Due Days</label>
                    </div>
                </div>
                <div class="col-md-4">  
                    <div class="form-group">
                        <input type="text"  readonly=""  class="form-control"  value="<?php echo $days; ?>">
                    </div>
                </div>
                <div class="col-md-2" >
                    <div class="form-group">
                        <label>DisburseDate</label>
                    </div>
                </div>
                <div class="col-md-4" >
                    <div class="form-group">
                        <input type="text"  readonly=""  class="form-control"  value="<?php echo date('d-m-Y', strtotime($sqlaccount['DisburseDate'])); ?>">
                    </div>
                </div>

            </div>
        </div>

        <div class="box box-warning" >
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-bank"></i>Loan Transaction</h3>
            </div>


            <div class="box-body"> 


    <?php if ($sqlaccount['Balance'] != '0') { ?>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Transaction Type</label>
                        </div>
                    </div>
                    <div class="col-md-4" >
                        <div class="form-group">
                            <input type="text"  name="TransactionType" id="TransactionType" class="form-control" value="<?php echo 'Deposit'; ?>" readonly="true" >
                        </div>       
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Transaction Mode</label>
                        </div>
                    </div>
                    <div class="col-md-4" >
                        <div class="form-group">
                            <select class="form-control"   name="Transactionmode" id="Transactionmode" onchange="showid(this.value);" required> 
                                <option value="">Select</option>  
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
                            <input type="text" name="Chequeno"  id="Chequeno" class="form-control" maxlength="20" >
                            <div id="traTypeNoerror" style="color:red; display: none; height: 5px;" >Please enter Chequeno</div>
                        </div>
                    </div>

                    <div class="" style="display: none;" id="BankNameshow">
                        <div class="form-group col-md-2">
                            <label>Bank Name</label>
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" name="BankName"  id="BankName" class="form-control"  >
                            <div id="traTypBankeerror" style="color:red; display: none;" >Please enter bank name</div>
                        </div>
                    </div>

                    <div class="" style="display: none;" id="ChequeDateshow">
                        <div class="form-group col-md-2">
                            <label>Cheque Date</label>
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" name="ChequeDate"  id="datepicker" class="form-control"  placeholder="dd/mm/yy">
                            <span id="traTypeChequeError" style="color:red; display: none;" >Please enter cheque date</span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Installment Date </label>
                        </div>
                    </div>
                    <div class="col-md-4" >
                        <div class="form-group">
                            <input type="text" name="installment_date" id="installment_date" class="form-control" readonly value="<?php echo date('d-m-Y', strtotime($InstallmentDate)); ?>" >
                        </div>
                    </div>

                    <div class="col-md-2" >
                        <div class="form-group">
                            <label>Deposit Date</label>
                        </div>
                    </div>
                    <div class="col-md-4" >
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

        if ($lastInstallmentDate == $currentdate) {
            ?>

                                <input type="text" name="Amountnew" id="Amountnew" class="form-control" oninput="payamount(this.value)" readonly="" value="<?php
            if ($sqlaccount['Balance'] > $emi) {
                echo round($emiamt, 2);
            } else {
                echo round($emi, 2);
            }
            ?>" >

                                <input type="hidden" name="Amountnew1" id="Amountnew1" class="form-control" readonly  value="<?php
            if ($sqlaccount['Balance'] > $emi) {
                echo round($emiamt, 2);
            } else {
                echo round($emi, 2);
            }
            ?>" >
        <?php } else { ?>

                                <input type="text" name="Amountnew" id="Amountnew" class="form-control" readonly oninput="payamount(this.value)" value="<?php
            if ($sqlaccount['Balance'] > $emi) {
                echo round($emiamt, 2);
            } else {
                echo round($emi, 2);
            }
            ?>" >

                                <input type="hidden" name="Amountnew1" id="Amountnew1" class="form-control"  readonly value="<?php
            if ($sqlaccount['Balance'] > $emi) {
                echo round($emiamt, 2);
            } else {
                echo round($emi, 2);
            }
            ?>" >
        <?php } ?>
                        </div>  
                    </div> 

                    <div class="col-md-2" >
                        <div class="form-group">
                            <label> Principal</label>
                        </div>
                    </div>
                    <div class="col-md-4" >
                        <div class="form-group">
                            <input type="text"  name="principal" id="principal" class="form-control"  readonly="true" value="<?php echo round($principal, 2); ?>" >
                        </div>
                    </div>
                    <div class="col-md-2" >
                        <div class="form-group">
                            <label>Interest Amount</label>
                        </div>
                    </div>
                    <div class="col-md-4" >
                        <div class="form-group">
                            <input type="text"  name="interestamount" id="interestamount" class="form-control"  readonly="true" value="<?php echo round($intrestamount, 2); ?>">
                        </div>
                    </div>
                    <div class="col-md-2" >
                        <div class="form-group">
                            <label>Total Balance Amount</label>
                        </div>
                    </div>
                    <div class="col-md-4" >
                        <div class="form-group">
                            <input type="text"  name="outstandingbal" id="outstandingbal" class="form-control"  readonly="true" value="<?php echo round($outstandingbal, 2); ?>" >
                        </div>
                    </div>

                    <div class="col-md-2" >
                        <div class="form-group">
                            <label>Remarks</label>
                        </div>
                    </div>
                    <div class="col-md-4" >
                        <div class="form-group">
                            <input type="text" name="Remarknew"  class="form-control"  >
                        </div>
                    </div>
                </div>
                <input type="hidden"  name="LoanId" id="LoanId" class="form-control" value="<?php echo $sqlaccount['LoanId'] ?>" readonly="true" >
                <input type="hidden"  name="LoanNo" id="LoanNo" class="form-control" value="<?php echo $_POST['val']; ?>" readonly="true" >
                <input type="hidden"  name="odintrest" id="odintrest" class="form-control"  readonly >

                <div class="box-footer text-center">
                    <input type="submit"  name="submit" value="Submit"  class="btn btn-warning">
                </div>  

            </div>
        </form>
                        <?php } else { ?>

        <div style="text-align:center; color:green; font-size: 20px;">Transaction has closed.</div>   

                        <?php } ?>

                    <?php
                    } else {
                        ?><script>alert("Loan number should not be empty.")</script><?php }
                    ?>
<script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>
<script>
         $('#datepicker').datepicker({
             autoclose: true,
             format: 'dd/mm/yyyy'
         });

</script>

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

<script type="text/javascript">
    function validation()
    {
        var Transactionmode = $("#Transactionmode").val();
        var traTypeNoerror = $("#traTypeNoerror").val();
        var traTypBankeerror = $("#traTypBankeerror").val();
        var traTypeChequeError = $("#traTypeChequeError").val();
        //alert(Transactionmode);
        //alert(traTypeNoerror);
        //alert(traTypBankeerror);
        //alert(traTypeChequeError);

        if (Transactionmode == 'cheque')
        {
            if (document.myForm.Chequeno.value == "")
            {
                $("#traTypeNoerror").show();
                setTimeout(function () {
                    $('#traTypeNoerror').fadeOut()
                }, 3000);
                document.myForm.Chequeno.focus();
                return false;
            }

            if (document.myForm.BankName.value == "")
            {
                $("#traTypBankeerror").show();
                setTimeout(function () {
                    $('#traTypBankeerror').fadeOut()
                }, 3000);
                document.myForm.BankName.focus();
                return false;
            }
            if (document.myForm.ChequeDate.value == "")
            {
                $("#traTypeChequeError").show();
                setTimeout(function () {
                    $('#traTypeChequeError').fadeOut()
                }, 5000);
                document.myForm.ChequeDate.focus();
                return false;
            }


        }
        //return false;
    }
</script>
