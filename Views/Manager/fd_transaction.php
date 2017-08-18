<?php
include '../superadmin-session.php';
error_reporting(0);

if (isset($_POST['submit'])) {
    mysql_query("START TRANSACTION");
    $currentdate = date('Y-m-d H:i:s');

    $selectdata = mysql_fetch_array(mysql_query("SELECT * FROM fdaccount 
                                                         WHERE CustomerID='" . $_POST['CustomerID'] . "' and FdNo='" . $_POST['FdNo'] . "' "));
    $maturitydate = $selectdata['MaturityDate'];
    $maturityamount = $selectdata['MaturityAmount'];
    $lastid = $selectdata['FDId'];

    $Transactiondate = date('Y-m-d', strtotime($_POST['TransactionDate']));

    //if($_POST['Amountnew']!= 0){    

    if ($maturitydate >= $_POST['TransactionDate']) {
        ?><script>
            if (confirm('You withdraw the amount is before maturity date.. So, you dont get the benefit of maturity amount.. Thankyou..')) {


                //alert('jj');
        <?php
        $bal_amount = $selectdata['MaturityAmount'];
        $sqlinsert = mysql_query("insert into fdtransaction set
                           FDId='" . $lastid . "',
                                                                FdNo='" . $_POST['FdNo'] . "',
                           CustomerID='" . $_POST['CustomerID'] . "',
                           TransactionDate='$Transactiondate',
                                                                Balance='" . $_POST['Amount'] . "', 
                                                                TransactionType='" . $_POST['TransactionType'] . "',
                           Withdraw='" . $_POST['Amountnew'] . "',
                           Transactionmode='" . $_POST['Transactionmode'] . "',
                                                                Remark='" . $_POST['Remarknew'] . "',
                           BranchId ='" . $_SESSION['branch_id'] . "',
                                                                ModifiedBy='" . $_SESSION['userid'] . "',
                           ModifiedDate='" . $currentdate . "' ");

        $insert = mysql_query("update fdaccount set 
               FDAmount='" . $_POST['Amount'] . "',
               WithdrawDate='" . $currentdate . "',
               ModifiedBy='" . $_SESSION['userid'] . "',
               ModifiedDate='" . $currentdate . "' 
               where CustomerID='" . $_POST['CustomerID'] . "' and FdNo='" . $_POST['FdNo'] . "' ");

        if ($sqlinsert and $insert) {
            mysql_query("COMMIT");
            //echo 'Commit';
        } else {
            mysql_query("ROLLBACK");
            //echo 'rollback';
        }
        ?>


            }
        </script><?php
    } else if ($maturitydate <= $_POST['TransactionDate']) {

        $bal_amount = $selectdata['MaturityAmount'];
        $sqlinsert = mysql_query("insert into fdtransaction set
                                   FDId='" . $lastid . "',
		                   FdNo='" . $_POST['FdNo'] . "',
                                   CustomerID='" . $_POST['CustomerID'] . "',
                                   TransactionDate='$Transactiondate',
		                   Balance='" . $_POST['Amount'] . "', 
		                   TransactionType='" . $_POST['TransactionType'] . "',
                                   Withdraw='" . $_POST['Amountnew'] . "',
                                   Transactionmode='" . $_POST['Transactionmode'] . "',
		                   Remark='" . $_POST['Remarknew'] . "',
                                   BranchId ='" . $_SESSION['branch_id'] . "',
		                   ModifiedBy='" . $_SESSION['userid'] . "',
                                   ModifiedDate='" . $currentdate . "' ");

        $insert = mysql_query("update fdaccount set 
                       FDAmount='" . $_POST['Amount'] . "',
                       WithdrawDate='" . $currentdate . "',
                       ModifiedBy='" . $_SESSION['userid'] . "',
                       ModifiedDate='" . $currentdate . "' 
                       where CustomerID='" . $_POST['CustomerID'] . "' and FdNo='" . $_POST['FdNo'] . "' ");

        if ($sqlinsert and $insert) {
            mysql_query("COMMIT");
            //echo 'Commit';
        } else {
            mysql_query("ROLLBACK");
            //echo 'rollback';
        }
    }
    //header("Location:transaction_list.php");exit;
    // }
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
                                <h3 class="box-title"><i class="fa fa-user"></i>Customer FD Details</h3>
                            </div>

                            <div class="box-body"> 
                                <div class="col-md-12">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>FD No</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="FdNo" name="FdNo" required >
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
                                <h3 class="box-title"><i class="fa fa-bank"></i> FD Transaction</h3>
                            </div>
                            <div class="box-body">

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Transaction Type</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text"  name="TransactionType" id="TransactionType" class="form-control" value="<?php echo 'Withdraw'; ?>" readonly="true" >
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
                                        <input type="text"  name="Transactionmode" id="Transactionmode" class="form-control" value="<?php echo 'Cash'; ?>" readonly="true" >
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
                                <div class="col-md-4" >
                                    <div class="form-group">
                                        <input type="text" name="Remark"  class="form-control"  >
                                    </div>
                                </div>
                            </div>

                            <div class="box-footer text-center">
                                <!--  <button type="button"  name="submit" value=""  class="btn btn-primary" onclick="userinfo123()">Submit</button> -->
                            </div>   
                        </div>
                    </form>
                </section>

                <!-- /.content -->
            </div>
<?php include 'include/mang_script.php'; ?>



            <div class="control-sidebar-bg"></div>
        </div>

        <script type="text/javascript">
            function accountdetails()
            {
                var val = $("#FdNo").val();
                if (val == '')
                {
                    alert("Please enter FD Number");
                } else {

                    $.ajax({url: 'fddetails_ajax.php',
                        data: {val: val},
                        type: 'post',
                        success: function (output)
                        {
                            if (output == '2') {
                                alert("Please enter correct FD Number");
                            } else {
                                $("#FDTransaction").hide();
                                $("#customerinfo").html(output);
                            }


                        }

                    });
                }
            }
        </script>

        <script type="text/javascript">
            function calculation(val)
            {
                var val = val;
                var MAmount = $("#MaturityAmount").val();
                var MDate = $("#MaturityDate").val();
                var FDAmount = $("#FDAmount").val();
                var Tdate = $("#TransactionDate").val();

                alert(MAmount);
                alert(MDate);
                alert(FDAmount);
                alert(Tdate);

                if (Tdate > MDate)
                {
                    $("#Amount").val(MAmount);
                } else
                {
                    $("#Amount").val(FDAmount);
                }

            }
        </script>

    </body>
</html>
