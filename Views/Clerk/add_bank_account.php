<?php
include '../superadmin-session.php';
error_reporting(0);
include 'alerts.php';

//print_r($_SESSION['userid']);

if (isset($_POST['submit'])) {

    mysql_query("START TRANSACTION");
    $selectdata = mysql_fetch_array(mysql_query("SELECT count(*) as rowcount FROM bankaccapplication ba
  left JOIN  accounttype at ON at.AccountTypeid=ba.AccountTypeid 
   where ba.CustomerID='" . $_POST['CustomerID'] . "' and ba.AccountTypeid='" . $_POST['AccountTypeid'] . "' and ba.BranchId='" . $_SESSION['branch_id'] . "'"));


    if ($selectdata['rowcount'] == 0) {
        $currentdate = date('Y-m-d H:i:s');

        $bal = $_POST['Balance'];

        $bal1 = trim($_POST['Balance_hidden']);

        if ($bal < $bal1) {
            echo "<script>";
            echo "alert('Youer Balance is less than minimum Balance that why account not create');
     </script>"; //exit;
            //header("Location:add_bank_account.php");//exit;
            // $_SESSION['useriderror']="Youer Balance is less than minimum Balance that why account not create";
        } else {

            $insert = mysql_query("insert into bankaccapplication set 
		                   CustomerID='" . $_POST['CustomerID'] . "',
                       BranchId ='" . $_SESSION['branch_id'] . "',
		                   AccountTypeid='" . $_POST['AccountTypeid'] . "',
                       OpenBalance='" . $_POST['Balance'] . "',
                       ApplicationStatus='pending',
                       CreatedBy='" . $_SESSION['userid'] . "',
		                   CreatedDate='" . $currentdate . "'
		                 ");
        }
        if ($insert) {
            $sqlemail = mysql_fetch_array(mysql_query("SELECT * from  customer where CustomerID='" . $_POST['CustomerID'] . "' ")) or die(mysql_error());

            $sql1emailsetup = mysql_query("SELECT * FROM emailsetup ");
            $rowemail = mysql_fetch_array($sql1emailsetup);
            $email = $sqlemail['EmailID'];
            $to = $email;
            $subject = "Application activation";
            $message = "Welcome to $companyname !<br />";
            $message .= "We are excited that you have chosen Bank Name a cloud based Banking spa automation software.<br />";
            $message .= "We are continually developing and improving our software, and will be adding amazing new features over the time that will help you run a more successful business. <br /> ";
            $message .= "It's our pleasure to have you on board Team Salonzap ";
            $message .= "If you have any questions or feedback please contact us at <b>support@salonzap.com</b> <br /><br /> ";
            $message .= "<b>Copyright © 2016-2017 Salonzap.com, All Rights Reserved.</b><br />";
            $header = $rowemail['EmailId'];
            $retval = mail($to, $subject, $message, $header);

            mysql_query("COMMIT");
            //echo "COMMIT"; exit;
            header("Location:BankAccountList_clerk.php");
            exit;
        } else {
            mysql_query("ROLLBACK");
            // echo "ROLLBACK"; exit;
            // header("Location:BankAccountList_clerk.php");exit;
        }
    } else {
        echo "<script>";
        echo "alert('Please Select different account type');
</script>";
        //  $_SESSION['useriderror']="Please Select different account type";
    }
}

$sqlbranch = mysql_fetch_array(mysql_query("SELECT count(accountNo) as accountno from  bankaccount "));
$intializaccount = mysql_fetch_array(mysql_query("SELECT * from  intializeaccountno "));

$string = $intializaccount['AccountNo'];
if ($sqlbranch['accountno'] == 0) {
    $accNo = ($string);
} else {
    $accNo = ($string) + ($sqlbranch['accountno']);
}

$sqlbranchname = mysql_fetch_array(mysql_query("SELECT * from branch where BranchId='" . $_SESSION['branch_id'] . "' "));
?>    

<!DOCTYPE html>
<html>

<?php include 'include/clerk_nav.php'; ?>

    <link href="../plugins_new/alerts/jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" />
    <script src="../plugins_new/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="../plugins_new/alerts/jquery.alerts.js" type="text/javascript"></script>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
<?php include 'include/clerk_sidenav.php'; ?>

            <!-- Content Wrapper. Contains page content -->

            <script type="text/javascript">

                function validationcheck()
                {
                    jSuccess('Customer Added succesfully', 'Success Dialog');
                }
            </script>
            <div class="content-wrapper"> 

                <!-- <div><?php
if (isset($_SESSION['useriderror'])) {
    $error = $_SESSION['useriderror'];
    session_unset($_SESSION['useriderror']);
} else {
    $error = "";
}

echo $error;
?></div> -->


                <section class="content">
                    <form role="form" method="post"  enctype="multipart/form-data" name="myForm" onsubmit="return(validation());" >

                        <div class="box box-warning">
                            <div class="box-header with-border">
                                <h3 class="box-title">
                                    <i class="fa fa-user">  </i>Customer Details</h3>
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
                                            <input type="text" name="CustomerID" required id="CustomerID" class="form-control"  >
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-warning" id="" name="Search" onclick="customerdetails()" >Search</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div id="customerinfo" ></div>
                                </div>
                            </div>
                        </div>

                        <div class="box box-warning">
                            <div class="box-header with-border">
                                <h3 class="box-title">
                                    <i class="fa fa-bank" > </i>Apply For Current/Saving Account</h3>
                            </div>

                            <div class="box-body">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Account Type</label><br>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">    
                                        <select class="form-control"   name="AccountTypename" required  id="accounttype"  onchange="changeamount();">
                                            <option value="0">Select Type </option>
                                            <option value="current">Current</option>
                                            <option value="saving">Saving</option>
                                        </select>
                                    </div>       
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Account Type Name</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">  
                                        <select class="form-control"   name="AccountTypeid"  id="accounttypedata" required  onchange="showbal(this.value);">
                                        </select>
                                    </div>  
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Account No</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">                         
                                        <input type="text" name="accountNo" class="form-control" required readonly="" value="<?php echo $accNo ?>">
                                    </div>
                                </div>

                                <div class="col-md-2">  
                                    <div class="form-group">
                                        <label>Opening Balance</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">                         
                                        <input type="text" name="Balance"  id="Balance" class="form-control" required >
                                        <input type="hidden" name="Balance_hidden"  id="Balance_hidden" class="form-control" required >
                                    </div> 
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Branch Name</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">   
                                        <input type="text" name="BranchId"  id="BranchId" class="form-control"  readonly="" value="<?php echo $sqlbranchname['BranchName'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Transaction Type</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control"   name="TransactionType" id="TransactionType" required onchange="showid(this.value);">
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
                                        <input type="text" name="Chequeno"  id="Chequeno" class="form-control"  >
                                        <div id="traTypeNoerror" style="color:red; display: none;height: 5px;" >Please enter Chequeno</div>
                                    </div>

                                </div>

                                <div class="" style="display: none;" id="BankNameshow">
                                    <div class="form-group col-md-2">
                                        <label>Bank Name</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" name="BankName"  id="BankName" class="form-control"   >
                                        <div id="traTypBankeerror" style="color:red; display: none;" >Please enter bank name</div>
                                    </div>

                                </div>

                                <div class="" style="display: none;" id="ChequeDateshow">
                                    <div class="form-group col-md-2">
                                        <label> Cheque Date</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" name="ChequeDate"  id="datepicker" class="form-control"  placeholder="mm/dd/yy">
                                        <span id="traTypeChequeError" style="color:red; display: none;" >Please enter cheque date</span>
                                    </div>

                                </div>


                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Remarks</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="Remarks"  class="form-control"  >
                                    </div>
                                </div>
                            </div>


                            <div class="box-footer text-center">
                                <input type="submit"  name="submit" value="Add Application"  class="btn btn-warning">
                            </div>
                        </div>


                    </form>

                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Control Sidebar -->

<?php include 'include/clerk_script.php'; ?>

            <div class="control-sidebar-bg"></div>
        </div>
        <!--Script-->


    </body>
</html>
<script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>
<script>
                                            $('#datepicker').datepicker({
                                                autoclose: true
                                            });
</script>
<script>
    function changeamount(val)
    {
        var accounttype = $("#accounttype").val();

        $.ajax({url: 'add_account_ajax.php',
            data: {accounttype: accounttype},
            type: 'post',
            success: function (output)
            {
                $("#accounttypedata").html(output);
            }
        });

    }




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
            $.ajax({url: 'customerdetails_ajax.php',
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
<script type="text/javascript">
    function showbal(val)
    {
        $.ajax({url: 'balshow_ajax.php',
            data: {val: val},
            type: 'post',
            success: function (output)
            {
                $("#Balance").val(output);
                $("#Balance_hidden").val(output);
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
    function validation()
    {
        var TransactionType = $("#TransactionType").val();
        var traTypeNoerror = $("#traTypeNoerror").val();
        var traTypBankeerror = $("#traTypBankeerror").val();
        var traTypeChequeError = $("#traTypeChequeError").val();
        if (TransactionType == 'cheque')
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




