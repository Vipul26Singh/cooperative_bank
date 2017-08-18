<?php
include '../superadmin-session.php';
error_reporting(0);

if (isset($_POST['submit'])) {

    $getcust = mysql_fetch_array(mysql_query("SELECT count(*) as countCust FROM `shareaccount` where CustomerID='" . $_POST['CustomerID'] . "' "));
    //print_r($getcust['countCust']); exit;

    if ($getcust['countCust'] == 0) {
        $getno = mysql_fetch_array(mysql_query("SELECT ShareAccountNo
            FROM `shareaccount` ORDER BY ShareAccountNo DESC LIMIT 1"));
        if ($getno['ShareAccountNo'] == Null) {
            $acc_no = mysql_fetch_array(mysql_query("SELECT ShareAccountNo FROM intializeaccountno"));
            $no = $acc_no['ShareAccountNo'];
            $share_no = $no;
        } else {
            $no = $getno['ShareAccountNo'];
            $share_no = $no + 1;
        }

        $currentdate = date('Y-m-d');
        $insert = mysql_query("insert into shareaccount set 
                                    ShareAccountNo='" . $share_no . "',
									CustomerID='" . $_POST['CustomerID'] . "',
									Balance='" . $_POST['Balance'] . "',
									SActive=1,
									OpenDate='" . $currentdate . "',
									BranchId ='" . $_SESSION['branch_id'] . "',
									CreatedBy='" . $_SESSION['userid'] . "',
									CreatedDate='" . $currentdate . "'
		                 ");

        $lastid = mysql_insert_id();

        if ($insert) {
            //echo 'inserted 1st table';
            $selectdata = mysql_fetch_array(mysql_query("SELECT sh.ShareAccountNo FROM shareaccount sh where 
                                                        sh.CustomerID='" . $_POST['CustomerID'] . "' "));

            $chequedate = date('Y-m-d', strtotime($_POST['ChequeDate']));
            $Transactiondate = date("Y-m-d");
            $sqlinsert = mysql_query("insert into sharetransaction set
									ShareAccountID='" . $lastid . "',
									ShareAccountNo='" . $selectdata['ShareAccountNo'] . "',
									CustomerID='" . $_POST['CustomerID'] . "',
									TransactionDate='" . $Transactiondate . "',
									BalanceShare='" . $_POST['Balance'] . "', 
									Deposit='" . $_POST['Balance'] . "',
                                    TransactionType='Deposit',
									Transactionmode='" . $_POST['Transactionmode'] . "',
									Chequeno='" . $_POST['Chequeno'] . "',
									BankName='" . $_POST['BankName'] . "',
									ChequeDate='" . $chequedate . "',
									ShareAmount='" . $_POST['ShareAmount'] . "',
									Remark='" . $_POST['Remark'] . "',
									BranchId ='" . $_SESSION['branch_id'] . "',
									CreatedBy='" . $_SESSION['userid'] . "'
		                    ");


            if ($sqlinsert) { //echo '2nd table inserted';
            }



            header('location: ShareAccountList.php');
        }
    } else {
        echo "<script>";
        echo "alert('This Customer already created share account');
             </script>";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
<?php include 'include/mang_nav.php'; ?>
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

<?php include 'include/mang_sidenav.php'; ?>

            <script type="text/javascript">
                function validation()
                {

                    var Transactionmode = $("#Transactionmode").val();

                    var traTypeNoerror = $("#traTypeNoerror").val();
                    var traTypBankeerror = $("#traTypBankeerror").val();
                    var traTypeChequeError = $("#traTypeChequeError").val();

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

                }
            </script>



            <div class="content-wrapper"> 
                <!--  <form role="form"  method="post" name="myForm" onsubmit="return(validation());"> -->

                <form role="form" method="post" action="" enctype="multipart/form-data"  name="myForm" onsubmit="return(validation());">
                    <section class="content">    
                        <!-- Customer Account Details-->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-user"></i> Customer Account Details</h3>
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
                                            <input type="text" class="form-control" name="CustomerID" id="CustomerID" placeholder="Enter Customer ID" required>
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

                        <!-- Open Share Account -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-bank"></i> Open Share Account</h3>
                            </div>
                            <div class="box-body">               
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>No of shares</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="Balance" id="Balance" class="form-control" onkeyup="mul()" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Account Open Date</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" value="<?php echo date('d-m-Y'); ?>" name="Opendate" class="form-control" readonly="true"  >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Current Share Price</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
<?php
$price = mysql_fetch_array(mysql_query("SELECT OneSharePrice
                                             FROM `sharedetails` ORDER BY OneSharePrice DESC LIMIT 1"));
$share_price = $price['OneSharePrice'];
?>
                                        <input type="text" value="<?php echo $share_price; ?>" id="CurrentSharePrice" name="CurrentSharePrice" class="form-control" readonly="true"  >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Total Amount</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="ShareAmount" id="ShareAmount" readonly="true"  >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Transaction Type</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control"  name="Transactionmode" id="Transactionmode"  required onchange="showid(this.value);">
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
                                        <input type="text" name="BankName"  id="BankName" class="form-control"  >
                                        <div id="traTypBankeerror" style="color:red; display: none;" >Please enter bank name</div>
                                    </div>
                                </div>
                                <div class="" style="display: none;" id="ChequeDateshow">
                                    <div class="form-group col-md-2">
                                        <label> Cheque Date</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" name="ChequeDate"  id="datepicker" class="form-control"  placeholder="dd/mm/yy">
                                        <div id="traTypeChequeError" style="color:red; display: none;" >Please enter cheque date</div>
                                    </div>
                                </div>
                                <div class="col-md-2" >
                                    <div class="form-group">
                                        <label>Remarks</label>
                                    </div>
                                </div>
                                <div class="col-md-4" >
                                    <div class="form-group">
                                        <input type="text" name="Remark"  class="form-control"  >
                                    </div>
                                </div>

                            </div>
                            <div class="box-footer text-center">
                                <input type="submit" name="submit" class="btn btn-primary" value="Save">
                            </div>
                        </div>
                    </section>
                </form>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
<?php include 'include/mang_script.php'; ?>

            <!-- /.content-wrapper -->

            <!-- Control Sidebar -->

            <div class="control-sidebar-bg"></div>
        </div>

        <script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>
        <script>
                                $('#datepicker').datepicker({
                                    autoclose: true,
                                    format: 'dd/mm/yyyy'
                                });
        </script>
        <script type="text/javascript">
            function customerdetails()
            {
                var val = $("#CustomerID").val();
                $.ajax({url: 'shareacc_customerdetails_ajax.php',
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
            function mul() {
                var txtFirstNumberValue = document.getElementById('Balance').value;
                var txtSecondNumberValue = document.getElementById('CurrentSharePrice').value;
                var result = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
                if (!isNaN(result)) {
                    document.getElementById('ShareAmount').value = result;
                }
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


    </body>
</html>
