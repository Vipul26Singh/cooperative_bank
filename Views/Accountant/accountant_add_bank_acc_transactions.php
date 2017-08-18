<?php
include '../superadmin-session.php';
error_reporting(0);

if (isset($_POST['submit'])) {

    $currentdate = date('Y-m-d');

    if ($_POST['Balance'] < 0) {
        echo "Youer Balance is less than 0.";
    } else {

        $insert = mysql_query("UPDATE bankaccount set 
                       Balance='" . $_POST['balance'] . "',
                       ModifiedBy='" . $_SESSION['userid'] . "',
                       ModifiedDate='" . $currentdate . "' 
                       where CustomerID='" . $_POST['Customer_ID'] . "' and accountNo='" . $_POST['accountNo'] . "'
                     ");



        if ($insert) {
            $selectdata = mysql_fetch_array(mysql_query("SELECT * FROM bankaccount 
                   where CustomerID='" . $_POST['Customer_ID'] . "' and accountNo='" . $_POST['accountNo'] . "'"));

            $lastid = $selectdata['AccountId'];
            $chequedate = date('Y-m-d', strtotime($_POST['ChequeDate']));
            $Transactiondate = date('Y-m-d h:i:s', strtotime($_POST['Transactiondate']));
            //echo date('Y-m-d h:i:s');
//echo $Transactiondate; exit;
            if ($_POST['TransactionType'] == 'Deposit') {
                $deposit = $_POST['enteramt'];
                $Withdraw = '';
            } else {
                $deposit = '';
                $Withdraw = $_POST['enteramt'];
            }
            $sqlinser = mysql_query("insert into bankaccounttransactions set 
                             CustomerID='" . $_POST['Customer_ID'] . "',
                             accountNo='" . $_POST['accountNo'] . "',
                             Balance='" . $_POST['balance'] . "',  
                             TransactionType='" . $_POST['TransactionType'] . "',
                             Transactionmode='" . $_POST['Transactionmode'] . "',
                             Chequeno='" . $_POST['Chequeno'] . "',
                             BankName='" . $_POST['BankName'] . "',
                             ChequeDate='$chequedate',
                             Transactiondate='$Transactiondate',
                             Deposit='$deposit',
                             Withdraw='$Withdraw',
                             Remarks='" . $_POST['Remarks'] . "',
                             CreatedBy='" . $_SESSION['userid'] . "',
                             BranchId = '" . $_SESSION['branch_id'] . "',
                             modified_date='" . $currentdate . "',
                             BankAccountId='$lastid' ");
        }
        header("Location: accountant_transaction_list.php");
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
<?php include 'include/acc_nav.php'; ?>
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

<?php include 'include/acc_sidenav.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper"> 
                <section class="content">    
                    <form role="form" method="post"  enctype="multipart/form-data" name="myForm" onsubmit="return(validation());"> 
                        <!-- /.content-wrapper -->
                        <div class="box box-warning">
                            <!--  -->

                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-user"></i> Customer Account Details</h3>
                            </div>

                            <div class="box-body"> 
                                <div class="col-md-12">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Account No</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="accountNo" name="accountNo" required >
                                        </div> 
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-warning" id="" name="Search" onclick="accountdetails()">Search</button>
                                        </div>
                                    </div>
                                </div>
                                <div id="customerinfo" ></div>
                            </div>
                        </div>

                        <div class="box box-warning">

                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-user"></i>Bank Account Transaction</h3>
                            </div>
                            <div class="box-body">

                                <div class="col-md-2">

                                    <div class="form-group">
                                        <label>Transaction Type</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control" style="width: 100%;" required name="TransactionType" id="TransactionType" onchange="changetype();">
                                            <option selected="selected" value=''>--Select--</option>
                                            <option value='Deposit'>Deposit</option>
                                            <option value='Withdraw'>Withdraw</option>                 
                                        </select>
                                    </div>       
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Amount</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" id="enteramt" class="form-control"  required name="enteramt" oninput="calculation(this.value)" >
                                    </div>  
                                </div> 

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Total Amount</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">                    
                                        <input type="text" class="form-control"  required name="balance" readonly="" id="totalbalance">
                                    </div>  
                                </div>


                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Transaction Mode</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group"> 
                                        <select class="form-control"   name="Transactionmode" id="Transactionmode" required onchange="showid(this.value);">
                                            <option value="">Select Transaction Type </option>
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
                                        <input type="text" name="Chequeno"  id="Chequeno" class="form-control"  maxlength="20">
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

                                <div class="col-md-2" >
                                    <div class="form-group">
                                        <label>Transaction Date</label>
                                    </div>
                                </div>
                                <div class="col-md-4" >
                                    <div class="form-group">
                                        <input type="text"  name="Transactiondate" class="form-control" value="<?php echo date('d-m-Y'); ?>" readonly="true" >
                                    </div>
                                </div>


                                <div class="col-md-2" >
                                    <div class="form-group">
                                        <label>Remarks</label>
                                    </div>
                                </div>
                                <div class="col-md-4" >
                                    <div class="form-group">
                                        <input type="text" name="Remarks"  class="form-control"  >
                                    </div>
                                </div>
                            </div>


                            <div class="box-footer text-center">
                                <input type="submit"  name="submit" value="Submit"  class="btn btn-warning">
                            </div>

                        </div>

                    </form>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
<?php include 'include/acc_script.php'; ?>
            <!-- Control Sidebar -->

            <div class="control-sidebar-bg"></div>
        </div>

    </body>
</html>
<script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>
<script>
                            $('#datepicker').datepicker({
                                autoclose: true,
                                format: 'dd-mm-yyyy'
                            });

                            $('#datepickercheeque').datepicker({
                                autoclose: true,
                                format: 'dd-mm-yyyy'
                            });

</script>
<script type="text/javascript">
    function accountdetails()
    {
        var val = $("#accountNo").val();
        $.ajax({url: 'accountant_accountdetails_ajax.php',
            data: {val: val},
            type: 'post',
            success: function (output)
            {
                $("#customerinfo").html(output);
            }

        });


    }
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
    function calculation(val)
    {
        var val = val;
        var Balance = $("#Balance").val();
        var TransactionType = $("#TransactionType").val();


        if (TransactionType == 0)
        {
            alert("Please Select Transaction Type");
            $("#enteramt").val('');
        } else
        {
            if (TransactionType == 'Deposit')
            {
                var totaldata = parseFloat(Balance) + parseFloat(val);
            } else
            {
                var totaldata = parseFloat(Balance) - parseFloat(val);
            }

            if (totaldata > 0)
            {
                $("#totalbalance").val(totaldata);
            } else
            {
                alert("Total amount should be greater than minimum balance ");
                $("#balance").val('');
                $("#enteramt").val('');
                $("#totalbalance").val('');

            }


        }



    }
</script>


<script type="text/javascript">
    function changetype()
    {
        $("#balance").val('');
        $("#enteramt").val('');
        $("#totalbalance").val('');
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
