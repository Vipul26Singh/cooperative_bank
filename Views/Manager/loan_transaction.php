<?php
include '../superadmin-session.php';
error_reporting(0);

if (isset($_POST['submit'])) {
    mysql_query("START TRANSACTION");
    $DepositDate = date('Y-m-d', strtotime($_POST['DepositDate']));
    $installment_date = date('Y-m-d', strtotime($_POST['installment_date']));
    $currentdate = date("Y-m-d");

    $insertloantransaction = mysql_query("insert into loantransaction set 
                          LoanId='" . $_POST['LoanId'] . "',
                          LoanNumber='" . $_POST['LoanNo'] . "',
                          CustomerID='" . $_POST['CustomerID'] . "',
                          DepositDate='" . $DepositDate . "',
                          Balance='" . $_POST['outstandingbal'] . "',
                          principal ='" . $_POST['principal'] . "',
                          Amount='" . $_POST['Amountnew'] . "',
                          TransactionType='" . $_POST['TransactionType'] . "',
                          Transactionmode='" . $_POST['Transactionmode'] . "',
                          ODInterestAmount='" . $_POST['odintrest'] . "',
                          interestamount='" . $_POST['interestamount'] . "',
                          installment_date='" . $installment_date . "',
                          Remark='" . $_POST['Remarknew'] . "',
                          ChequeNo='" . $_POST['ChequeNo'] . "',
                          BankName='" . $_POST['BankName'] . "',
                          ChequeDate='" . $_POST['ChequeDate'] . "',
                          BranchId ='" . $_SESSION['branch_id'] . "',
                          CreatedBy='" . $_SESSION['userid'] . "' ");
    $lastid = mysql_insert_id();


    $update = mysql_query("update loan set 
	                        Balance='" . $_POST['outstandingbal'] . "',
	                        ODInterestAmount='" . $_POST['odintrest'] . "'
	                        where LoanId='" . $_POST['LoanId'] . "' ");

    if ($insertloantransaction && $update) {
        mysql_query("COMMIT");
        header("Location:loan_transaction_receipt.php?id=$lastid ");
    } else {
        mysql_query("ROLLBACK");
        echo "ROLLBACK";
    }
}
?>    

<!DOCTYPE html>
<html>
    <head>
<?php include 'include/mang_nav.php'; ?>
    </head>

    <body class="hold-transition skin-blue sidebar-mini" link="white">
        <div class="wrapper">
<?php include 'include/mang_sidenav.php'; ?>

            <div class="content-wrapper">

                <section class="content">
                    <form role="form" method="post"  enctype="multipart/form-data">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-user"></i>Customer Loan Transaction</h3>
                            </div>

                            <div class="box-body"> 
                                <div class="col-md-12">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Loan No</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="LoanNo" name="LoanNo" required >
                                        </div> 
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-primary" id="" name="Search" onclick="accountdetails()">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="customerinfo"></div>



                        <div class="box box-primary" id="FDTransaction">
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
                                        <label>Amount</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">                     
                                        <input type="text" id="Amount" class="form-control" value="<?php //echo $bal_amount;  ?>" readonly name="Amount" onload="calculation(this.value)" >
                                    </div>  
                                </div> 
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Transaction Mode</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control"   name="Transactionmode"  required >
                                            <option value="0">Select Transaction Type </option>
                                            <option value="cash">Cash</option>
                                            <option value="cheque">Cheque</option>
                                        </select> 
                                    </div>
                                </div>
                                <div class="col-md-2" >
                                    <div class="form-group">
                                        <label>Transaction Date</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text"  name="TransactionDate" id="TransactionDate" class="form-control" value="<?php echo date("d-m-Y"); ?>" readonly="true" >
                                    </div>
                                </div>
                                <div class="col-md-2" >
                                    <div class="form-group">
                                        <label>Remarks</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="Remark"  class="form-control"  >
                                    </div>
                                </div>
                            </div>

                            <div class="box-footer text-center">
                                <input type="submit"  name="submit" value="Submit"  class="btn btn-primary">
                            </div>   
                        </div>

                    </form>
                </section>

                <!-- /.content -->
            </div><?php include 'include/mang_script.php'; ?>

            <!-- /.content-wrapper -->


            <!-- Control Sidebar -->

            <div class="control-sidebar-bg"></div>
        </div>

        <script type="text/javascript">
            function accountdetails()
            {
                var val = $("#LoanNo").val();
                $.ajax({url: 'loanTransection_ajax.php',
                    data: {val: val},
                    type: 'post',
                    success: function (output)
                    {

                        $("#customerinfo").html(output);
                        $("#FDTransaction").hide();
                    }

                });
            }
        </script>

        <script>
            function payamount(val)
            {
                var Amountnew = $("#Amountnew").val();
                var Amountnew1 = $("#Amountnew1").val();
                var interestamount = $("#interestamount").val();
                var LoanId = $("#LoanId").val();
                var LoanNo = $("#LoanNo").val();
                var Balance = $("#Balance").val();
                var val = val;

                /*if(val > Balance)
                 {
                 alert("Youer enter amount is geater than Balance, please re-enter EMI amount");
                 }
                 else
                 {*/
                $.ajax({
                    url: 'loanTransectionchangeAmount_ajax.php',
                    data: {Amountnew: Amountnew, Amountnew1: Amountnew1, interestamount: interestamount, LoanId: LoanId, val: val, LoanNo: LoanNo
                    },
                    type: 'post',
                    success: function (output)
                    {
                        //alert(output);

                        var json_data = JSON.parse(output);
                        $("#outstandingbal").val(json_data['outstanding']);
                        $("#odintrest").val(json_data['odintrest']);
                        $("#principal").val(json_data['principal']);
                    }

                });
                // }
            }
        </script>



    </body>
</html>
