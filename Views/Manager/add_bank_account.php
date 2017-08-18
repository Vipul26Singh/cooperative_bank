<?php
include '../superadmin-session.php';
error_reporting(0);
//print_r($_SESSION['userid']);

if (isset($_POST['submit'])) {

    $selectdata = mysql_fetch_array(mysql_query("SELECT count(*) as rowcount FROM bankaccapplication ba
  left JOIN  accounttype at ON at.AccountTypeid=ba.AccountTypeid 
  where ba.CustomerID='" . $_POST['CustomerID'] . "' and ba.AccountTypeid='" . $_POST['AccountTypeid'] . "' and ba.BranchId='" . $_SESSION['branch_id'] . "' and ba.ApplicationStatus!='decline'"));


    if ($selectdata['rowcount'] == 0) {
        $currentdate = date('Y-m-d H:i:s');

        $bal = $_POST['Balance'];

        $bal1 = trim($_POST['Balance_hidden']);

        if ($bal < $bal1) {
            echo "<script>";
            echo "alert('Youer Balance is less than minimum Balance that why account not create');
     </script>"; //exit;
        } else {
            $insert = mysql_query("insert into bankaccount set 
		                   CustomerID='" . $_POST['CustomerID'] . "',
		                   AccountTypeid='" . $_POST['AccountTypeid'] . "',
		                   accountNo='" . $_POST['accountNo'] . "',
		                   Balance='" . $_POST['Balance'] . "',
		                   OpenDate='" . $currentdate . "',
		                   BranchId ='" . $_SESSION['branch_id'] . "',
		                   CreatedBy='" . $_SESSION['userid'] . "',
		                   CreatedDate='" . $currentdate . "'
		                 ");
            $lastid = mysql_insert_id();

            if ($insert) {

                $chequedate = date('Y-m-d', strtotime($_POST['ChequeDate']));
                $Transactiondate = date("Y-m-d H:i:s");
                $sqlinser = mysql_query("insert into  bankaccounttransactions set 
		                   CustomerID='" . $_POST['CustomerID'] . "',
		                   accountNo='" . $_POST['accountNo'] . "',
		                   Balance='" . $_POST['Balance'] . "',  
		                   TransactionType='" . $_POST['TransactionType'] . "',
		                   Chequeno='" . $_POST['Chequeno'] . "',
		                   BankName='" . $_POST['BankName'] . "',
		                   ChequeDate='$chequedate',
		                   Transactiondate='$Transactiondate',
		                   Deposit='" . $_POST['Balance'] . "',
		                   Remarks='" . $_POST['Remarks'] . "',
		                   CreatedBy='" . $_SESSION['userid'] . "',
		                   BankAccountId=$lastid ");
            }
            //}
            if ($insert and $sqlinser) {
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
                $message .= "If you have any questions or feedback please contact us at <b>Codefever.co</b> < br /><br /> ";
                $message .= "<b>Copyright © 2016-2017 Codefever.co, All Rights Reserved.</b><br />";
                $header = $rowemail['EmailId'];
                $retval = mail($to, $subject, $message, $header);

                mysql_query("COMMIT");
                //echo "COMMIT"; exit;
                header("Location:BankAccountList.php");
                exit;
            } else {
                mysql_query("ROLLBACK");
                // echo "ROLLBACK"; exit;
            }
        }
    } else {
        echo "<script>";
        echo "alert('Please Select different account type');
</script>"; //exit;
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

<?php
include 'include/mang_nav.php';
include '../../alerts.php';
?>


    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
<?php include 'include/mang_sidenav.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper"> 
                <section class="content">
                    <form role="form" method="post"  enctype="multipart/form-data">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Add Bank Account</h3>
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
                                            <input type="text" name="CustomerID" id="CustomerID" class="form-control" required >
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-primary" id="" name="Search" onclick="customerdetails()">Search</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div id="customerinfo" ></div>
                                </div>
                            </div>
                        </div>

                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Add Bank Account</h3>
                            </div>
                            <div class="box-body">  
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Account Type</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">  
                                        <select class="form-control"   name="AccountTypename"  id="accounttype" required onchange="changeamount();">
                                            <option value="">Select Type </option>
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
                                        <input type="text" name="accountNo" class="form-control"  readonly value="<?php echo $accNo ?>">
                                    </div>
                                </div>

                                <div class="col-md-2">  
                                    <div class="form-group">
                                        <label>Opening Balance</label>
                                    </div>
                                </div>
                                <div class="col-md-4">  
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="Balance"  id="Balance"  required >
                                        <input type="hidden" name="Balance_hidden" id="Balance_hidden" class="form-control" required>
                                    </div>  
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Branch Name</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="BranchId"  id="BranchId" class="form-control"  readonly="" value="<?php echo $sqlbranchname['BranchName']; ?>">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Transaction Type</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control"   name="TransactionType"  required onchange="showid(this.value);">
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
                                        <input type="text" name="ChequeDate"  id="datepicker" class="form-control"  placeholder="mm/dd/yy">
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
                                <input type="submit"  name="submit" value="Create Account"  class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Control Sidebar -->

<?php include 'include/mang_script.php';
?>

            <div class="control-sidebar-bg"></div>
        </div>
        <!--Script-->


    </body>
</html>
<script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>
<link href="../plugins_new/alerts/jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" />
<script src="../plugins_new/jQuery/jQuery-2.1.4.min.js"></script>
<script src="../plugins_new/alerts/jquery.alerts.js" type="text/javascript"></script>
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
            //jAlert('Please enter Customer ID', 'Alert Dialog');
            alert("Please enter Customer ID");
        } else
        {
            $.ajax({url: 'customerdetails_ajax.php',
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


