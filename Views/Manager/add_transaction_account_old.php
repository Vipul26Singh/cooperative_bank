<?php
include '../superadmin-session.php';
error_reporting(0);
if (isset($_POST['submit'])) {
    mysql_query("START TRANSACTION");
    $currentdate = date('Y-m-d');

    if ($_POST['Balance'] == 0) {
        echo "Your Balance is 0.";
    } else {

        $selectdata = mysql_fetch_array(mysql_query("SELECT * FROM shareaccount 
                   where CustomerID='" . $_POST['CustomerID'] . "' and ShareAccountNo='" . $_POST['ShareAccountNo'] . "' "));

        $lastid = $selectdata['ShareAccountID'];
        $chequedate = date('Y-m-d', strtotime($_POST['ChequeDate']));
        $Transactiondate = date('Y-m-d', strtotime($_POST['TransactionDate']));

        if ($_POST['TransactionType'] == 'Deposit') {
            $deposit = $_POST['Balance'];
            //$share_amount = $selectdata['']
            $bal_share = $_POST['Balance'] + $selectdata['Balance'];
            $Withdraw = '';
        } else {
            $deposit = '';
            $Withdraw = $_POST['Balance'];
            $bal_share = $_POST['Balance'] - $selectdata['Balance'];
        }
        $sqlinsert = mysql_query("insert into sharetransaction set
									ShareAccountID='" . $lastid . "',
									ShareAccountNo='" . $_POST['ShareAccountNo'] . "',
									CustomerID='" . $_POST['CustomerID'] . "',
                                   TransactionDate='$Transactiondate',
									BalanceShare='" . $_POST['totalbalance'] . "', 
									TransactionType='" . $_POST['TransactionType'] . "',
                                   Deposit='$deposit',
                                   Withdraw='$Withdraw',
                                   TransactionMode='" . $_POST['Transactionmode'] . "',
									Chequeno='" . $_POST['Chequeno'] . "',
									BankName='" . $_POST['BankName'] . "',
									ChequeDate='$chequedate',
                                   ShareAmount='" . $_POST['ShareAmount'] . "',
									Remark='" . $_POST['Remark'] . "',
                                   BranchId ='" . $_SESSION['branch_id'] . "',
									ModifiedBy='" . $_SESSION['userid'] . "',
                                   ModifiedDate='" . $currentdate . "' ");

        $insert = mysql_query("update shareaccount set 
                       Balance='" . $_POST['totalbalance'] . "',
                       SActive=1,
                       ModifiedBy='" . $_SESSION['userid'] . "',
                       ModifiedDate='" . $currentdate . "' 
                       where CustomerID='" . $_POST['CustomerID'] . "' and ShareAccountNo='" . $_POST['ShareAccountNo'] . "' ");



        if ($insert and $sqlinsert) {
            mysql_query("COMMIT");
            // 'Commit';
        } else {
            mysql_query("ROLLBACK");
            //echo 'rollback';
            //exit;
        }
    }
    header("Location: share_transaction_list.php");
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

            <div class="content-wrapper">
                <form role="form" method="post" action="">
                    <section class="content">    
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-user"></i> Customer Transaction Details</h3>
                            </div>

                            <div class="box-body">               
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Share Account No</label>
                                        <input type="text" class="form-control" id="ShareAccountNo" placeholder="Enter Account No" name="ShareAccountNo" >
                                    </div>
                                </div>
                                <br>
                                <div class="col--md-3">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary" id="" name="Search" onclick="customerdetails()">Search</button>
                                    </div>
                                </div><br>
                                <div id="customerinfo" ></div>
                            </div>
                        </div>
                        <!-- /.content-wrapper -->

                        <!-- Share Account Transaction -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-bank"></i>  Share Account Transaction</h3>
                            </div>
                            <div class="box-body">               
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Transaction Type</label>
                                        <select class="form-control" style="width: 100%;" name="TransactionType" id="TransactionType" onchange="changetype();">
                                            <option selected="selected" value='0'>--Select--</option>
                                            <option value='Deposit'>Deposit</option>
                                            <option value='Withdraw'>Withdraw</option>                 
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>No of Shares</label>
                                        <input type="text" name="Balance" class="form-control" id="Balance"  onkeyup="mul()" oninput="calculation(this.value)">
                                    </div>

                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Transaction Amount</label>
                                        <input type="text" class="form-control" name="ShareAmount" id="ShareAmount" readonly="true" >
                                    </div>
                                    <div class="form-group">
                                        <label>Transaction Date</label>
                                        <input type="text" class="form-control" value="<?php echo date('d-m-Y'); ?>" name="TransactionDate" readonly="true" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Available Shares</label>
                                        <input type="text" id="totalbalance" name="totalbalance" class="form-control"  required readonly>
                                    </div> 
                                    <div class="form-group">
                                        <label>Current Share Price</label>
<?php
$price = mysql_fetch_array(mysql_query("SELECT OneSharePrice
                                             FROM `sharedetails` ORDER BY OneSharePrice DESC LIMIT 1"));
$share_price = $price['OneSharePrice'];
?>
                                        <input type="text" value="<?php echo $share_price; ?>" id="CurrentSharePrice" name="CurrentSharePrice" class="form-control" readonly="true"  >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Transaction Mode</label>
                                        <select class="form-control"   name="Transactionmode"  required onchange="showid(this.value);">
                                            <option value="">Select Transaction Mode</option>
                                            <option value="cash">Cash</option>
                                            <option value="cheque">Cheque</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6" style="display: none;"  id="Chequenoshow">
                                    <div class="form-group">
                                        <label> Cheque No</label>
                                        <input type="text" name="Chequeno"  id="Chequeno" class="form-control"  >
                                    </div>
                                </div>
                                <div class="col-md-6" style="display: none;" id="BankNameshow">
                                    <div class="form-group">
                                        <label>Bank Name</label>
                                        <input type="text" name="BankName"  id="BankName" class="form-control"  >
                                    </div>
                                </div>
                                <div class="col-md-6" style="display: none;" id="ChequeDateshow">
                                    <div class="form-group">
                                        <label>Cheque Date</label>
                                        <input type="text" name="ChequeDate"  id="datepicker" class="form-control"  placeholder="dd/mm/yy">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Remark</label>
                                        <input type="text" name="Remark" class="form-control" >
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
            <!-- /.content -->


<?php include 'include/mang_script.php'; ?>

            <!-- /.content-wrapper -->


            <!-- Control Sidebar -->

            <div class="control-sidebar-bg"></div>
        </div>
        <script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>
        <script>
                            $('#datepicker').datepicker({
                                autoclose: true
                            });

        </script>
        <script type="text/javascript">
            function customerdetails()
            {
                var val = $("#ShareAccountNo").val();
                $.ajax({url: 'transaction_customerdetails_ajax.php',
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
            function calculation(val)
            {
                var val = val;
                var Balance = $("#available").val();
                var TransactionType = $("#TransactionType").val();


                if (TransactionType == 0)
                {
                    alert("Please Select Transaction Type");
                    $("#Balance").val('');
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
                        //alert("Total amount should be greter than 1000 ");
                        //$("#balance").val('');
                        $("#Balance").val('');
                        $("#totalbalance").val('');
                    }
                }



            }
        </script>
        <script type="text/javascript">
            function changetype()
            {

            }
        </script>
    </body>
</html>
