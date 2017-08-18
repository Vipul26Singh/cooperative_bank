<?php
include '../superadmin-session.php';
error_reporting(0);

if (isset($_POST['submit'])) {

    mysql_query("START TRANSACTION");
    $getno = mysql_fetch_array(mysql_query("SELECT FdNo
                                                FROM `fdaccount` ORDER BY FdNo DESC LIMIT 1"));

    if ($getno['FdNo'] == Null) {
        $acc_no = mysql_fetch_array(mysql_query("SELECT FDAccountNo FROM intializeaccountno"));
        $no = $acc_no['FDAccountNo'];
        $fd_no = $no;
    } else {
        $no = $getno['FdNo'];
        $fd_no = $no + 1;
    }

    $maturitydate = date('Y-m-d', strtotime($_POST['MaturityDate']));
    $currentdate = date('Y-m-d');
    $a1 = mysql_query("insert into fdaccount set 
                                    FdNo='" . $fd_no . "',
									CustomerID='" . $_POST['CustomerID'] . "',
									FDAmount='" . $_POST['Balance'] . "',
									Interest='" . $_POST['Interest'] . "',
									Duration='" . $_POST['Duration'] . "',
									FDDate='" . $currentdate . "',
									MaturityAmount='" . $_POST['MaturityAmount'] . "',
									MaturityDate='" . $maturitydate . "',
									fdsetupid='" . $_POST['Fdtype'] . "',
									BranchId ='" . $_SESSION['branch_id'] . "',
									CreatedBy='" . $_SESSION['userid'] . "'
		                 ") or die(mysql_error());
    $lastid = mysql_insert_id();
    $selectdata = mysql_fetch_array(mysql_query("SELECT f.FdNo FROM fdaccount f where 
                                                        f.CustomerID='" . $_POST['CustomerID'] . "' "));

    $chequedate = date('Y-m-d', strtotime($_POST['ChequeDate']));
    $Transactiondate = date("Y-m-d");

    $a2 = mysql_query("insert into fdtransaction set
									FDId='" . $lastid . "' ,
									FdNo='" . $fd_no . "',
									CustomerID='" . $_POST['CustomerID'] . "',
									TransactionDate='$Transactiondate',
									Balance='" . $_POST['Balance'] . "', 
									Deposit='" . $_POST['Balance'] . "',
									Transactionmode='" . $_POST['Transactionmode'] . "',
									TransactionType='Deposit',
									ChequeNo='" . $_POST['Chequeno'] . "',
									BankName='" . $_POST['BankName'] . "',
									ChequeDate='$chequedate',
									BranchId ='" . $_SESSION['branch_id'] . "',
									CreatedBy='" . $_SESSION['userid'] . "'") or die(mysql_error());

    if ($a1 and $a2) {
        mysql_query("COMMIT");
        //echo 'Commit';
        // exit;
    } else {
        mysql_query("ROLLBACK");
        //echo 'rollback';
        // exit;
    }
    header("Location: fd_acc_list.php");
}
?>    

<!DOCTYPE html>
<html>
    <head>
        <?php include 'include/mang_nav.php'; ?>

        <link href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="Stylesheet" type="text/css" />
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

        <script type="text/javascript">
            function customerdetails()
            {
                var val = $("#CustomerID").val();
                $.ajax({url: 'fd_customerdetails_ajax.php',
                    data: {val: val},
                    type: 'post',
                    success: function (output)
                    {
                        $("#customerinfo").html(output);
                    }
                });
            }
        </script>

        <script>
            function maturitydate(val) {

                $.ajax({url: 'fd_maturity_date.php',
                    data: {val: val},
                    type: 'post',
                    success: function (output)
                    {
                        var json_data = JSON.parse(output);
                        //alert(output);
                        $("#Duration").val(json_data['durationindays']);
                        $("#Interest").val(json_data['fdinterest']);
                        $("#MaturityDate").val(json_data['maturitydate']);
                        $("#Balance").val("");
                        $("#MaturityAmount").val("");
                    }
                });

            }
        </script>

        <script>
            function maturityamount(val) {
                var Balance = $("#Balance").val();
                var Interest = $("#Interest").val();
                var Duration = $("#Duration").val();
                var Fdtype = $("#Fdtype").val();

                if (Fdtype == 0) {
                    alert("Please Select FD Type");
                    $("#Balance").val("");
                } else {
                    $.ajax({url: 'fd_maturity_amount.php',
                        data: {Balance: Balance, Interest: Interest, Duration: Duration},
                        type: 'post',
                        success: function (output)
                        {
                            $("#MaturityAmount").val(output);
                        }
                    });
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

    </head>

    <body class="hold-transition skin-blue sidebar-mini" link="white">
        <div class="wrapper">

            <?php include 'include/mang_sidenav.php'; ?>
            <div class="content-wrapper">
                <form role="form" method="post" action="" enctype="multipart/form-data"  name="myForm" onsubmit="return(validation());">
                    <section class="content">    

                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-user"></i> Customer FD Account Details</h3>
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
                                            <input type="text" class="form-control" id="CustomerID" name="CustomerID" required >
                                        </div> 
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-warning" id="" name="Search" onclick="customerdetails()">Search</button>
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
                                <h3 class="box-title"><i class="fa fa-bank"></i>Open FD Account</h3>
                            </div>

                            <div class="box-body">               
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>FD Type</label>
                                    </div>
                                </div>
                                <div class="col-md-4"> 
                                    <div class="form-group">
                                        <select class="form-control" name="Fdtype" id="Fdtype" style="width: 100%;" onchange="maturitydate(this.value)" required>
                                            <?php
                                            $sqlsetup = mysql_query("SELECT * FROM `fdsetup`");
                                            echo "<option value=''>--Select--</option>";
                                            while ($row = mysql_fetch_array($sqlsetup)) {
                                                //echo "<option>--Select--</option>";
                                                echo "<option value='" . $row['fdsetupid'] . "'>" . 'interest=' . $row['fdinterest'] . '&nbsp Days=' . $row['durationindays'] . "</optio>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2"> 
                                    <div class="form-group">
                                        <label>Duration In Days</label>
                                    </div>
                                </div>
                                <div class="col-md-4"> 
                                    <div class="form-group">
                                        <input type="text" name="Duration" id="Duration" class="form-control" value="" readonly="true" >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>FD Amount </label>
                                    </div>
                                </div>
                                <div class="col-md-4"> 
                                    <div class="form-group">
                                        <input type="number" name="Balance" id="Balance" class="form-control" oninput="maturityamount(this.value)" required>
                                    </div>
                                </div>
                                <div class="col-md-2"> 
                                    <div class="form-group">
                                        <label>FD Interest</label>
                                    </div>
                                </div>
                                <div class="col-md-4"> 
                                    <div class="form-group">
                                        <input type="text" name="Interest" id="Interest" class="form-control" value="" readonly="true" >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Mature Amount</label>
                                    </div>
                                </div>
                                <div class="col-md-4"> 
                                    <div class="form-group">
                                        <input type="text" name="MaturityAmount" id="MaturityAmount" class="form-control" readonly="true" >
                                    </div>
                                </div>
                                <div class="col-md-2"> 
                                    <div class="form-group">
                                        <label>Maturity Date</label>
                                    </div>
                                </div>
                                <div class="col-md-4"> 
                                    <div class="form-group">
                                        <input type="text" name="MaturityDate" id="MaturityDate" class="form-control" placeholder="dd/mm/yyyy" readonly="true" >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>FD Opening Date</label>
                                    </div>
                                </div>
                                <div class="col-md-4"> 
                                    <div class="form-group">
                                        <input type="text" id="fddate" name="FDDate" value="<?php echo date('d-m-Y'); ?>" class="form-control" readonly >
                                    </div>
                                </div>


                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Transaction Mode</label>
                                    </div>
                                </div>
                                <div class="col-md-4"> 
                                    <div class="form-group">
                                        <select class="form-control"   name="Transactionmode"   id="Transactionmode"   onchange="showid(this.value);" required>
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
                                        <input type="text" name="BankName"  id="BankName" class="form-control"  >   <div id="traTypBankeerror" style="color:red; display: none;" >Please enter bank name</div>
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
                            </div>

                            <div class="box-footer text-center">
                                <button type="submit" name="submit" class="btn btn-warning">Save</button>
                            </div>

                        </div>
                    </section>
                </form>
                <!-- /.content -->
            </div><?php include 'include/mang_script.php'; ?>

            <!-- /.content-wrapper -->


            <!-- Control Sidebar -->

            <div class="control-sidebar-bg"></div>
        </div>
        <script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>
        <script>
                                            var today = new Date();
                                            $('#datepicker').datepicker({
                                                minDate: today,
                                                format: 'dd-mm-yyyy',
                                            });
                                            $('#fddate').datepicker({
                                                autoclose: true,
                                                format: 'dd-mm-yyyy'
                                            });
                                            $("#fddate").datepicker().datepicker("setDate", new Date());
        </script>

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
                //return false;
            }
        </script>



    </body>
</html>
