<?php
include '../superadmin-session.php';
error_reporting(0);

if (isset($_POST['submit'])) {
    $getloanOTP = mysql_fetch_array(mysql_query("SELECT CustomerOTP FROM `loan`where CustomerOTP='" . $_POST['OTP'] . "' "));
    if ($getloanOTP == 0) {
        $getno = mysql_fetch_array(mysql_query("SELECT LoanNumber FROM `loan` ORDER BY LoanNumber DESC LIMIT 1"));
        if ($getno['LoanNumber'] == Null) {
            $acc_no = mysql_fetch_array(mysql_query("SELECT LoanAccountno FROM intializeaccountno"));
            $no = $acc_no['LoanAccountno'];
            $loan_no = $no + 1;
        } else {
            $l_no = $getno['LoanNumber'];
            $loan_no = $l_no + 1;
        }

        $selectdata = mysql_fetch_array(mysql_query("SELECT ga.*, goldloantype.InterestRate, goldloantype.Durationinmonth, goldloantype.NoofInstallments
, goldloantype.GoldLoanTypeid FROM goldloanapplication ga INNER JOIN goldloantype ON ga.LoanTypeid =goldloantype.GoldLoanTypeid WHERE ApplyGoldLoanID='" . $_GET['id'] . "' "));

        if ($_POST['Status'] == 'active') {
            $p = $selectdata['ApproveAmount'];
            $rate = $selectdata['InterestRate'];
            $n = $selectdata['Durationinmonth'];
            $r = $rate / 1200;
            $formula = ($p * $r * (pow(1 + $r, $n))) / ((pow(1 + $r, $n)) - 1);
            $installment_amount = round($formula, 2);

            $date = date('Y-m-d', strtotime($_POST['firstdate']));
            $insert = mysql_query("insert into loan set 
                        CustomerID='" . $_POST['CustomerID'] . "',
                        LoanNumber='" . $loan_no . "',
                        LoanDate=CURDATE(),
                        Amount='" . $selectdata['ApproveAmount'] . "',
                        Interestrate='" . $selectdata['InterestRate'] . "',
                        Durationinmonth='" . $selectdata['Durationinmonth'] . "',
                        installmentamount='" . $installment_amount . "',
                        NoofInstallments='" . $selectdata['NoofInstallments'] . "',
                        LoanTypeid='" . $selectdata['GoldLoanTypeid'] . "',
                        Remark='" . $_POST['Remark'] . "',            
                        Balance='" . $selectdata['ApproveAmount'] . "',
                        FirstInstallmentDate='" . $date . "',
                        Status='" . $_POST['Status'] . "',
                        BranchId ='" . $_SESSION['branch_id'] . "',
                        DisburseDate=CURDATE(),
                        CustomerOTP = '" . $selectdata['OTP'] . "',
                        ApplyLoanID = '" . $selectdata['ApplyGoldLoanID'] . "',
                        Type = 'gold',
                        Createdby ='" . $_SESSION['userid'] . "' ") or die(mysql_error());


            $lastid = mysql_insert_id();
            if ($insert) {
                $update = mysql_query("UPDATE goldloanapplication SET GoldLoanStatus='alloted' WHERE ApplyGoldLoanID='" . $_GET['id'] . "' ");
                if ($update) {

                    $sqlemail = mysql_fetch_array(mysql_query("SELECT * from  customer where CustomerID='" . $_POST['CustomerID'] . "' ")) or die(mysql_error());
                    if ($_POST['Status'] == 'active') {
                        $sql1emailsetup = mysql_query("SELECT * FROM emailsetup ");
                        $rowemail = mysql_fetch_array($sql1emailsetup);
                        $email = $sqlemail['EmailID'];
                        $to = $email;
                        $subject = "Gant Loan Approve";
                        $message = "Your grant loan is approve";
                        $message .= "<b>Copyright © 2016-2017 Codefever Pvt Ltd, All Rights Reserved.</b><br/>";
                        $header = $rowemail['EmailId'];
                        $retval = mail($to, $subject, $message, $header);
                    } else {
                        $sql1emailsetup = mysql_query("SELECT * FROM emailsetup ");
                        $rowemail = mysql_fetch_array($sql1emailsetup);
                        $email = $sqlemail['EmailID'];
                        $to = $email;
                        $subject = "Gant Loan Deline";
                        $message = "Your grant loan is decline";
                        $message .= "<b>Copyright © 2016-2017 Codefever Pvt Ltd, All Rights Reserved.</b><br/>";
                        $header = $rowemail['EmailId'];
                        $retval = mail($to, $subject, $message, $header);
                    }

                    header('location:loanReport.php?id=' . $lastid);
                }
            }
        } else {
            $update = mysql_query("UPDATE goldloanapplication SET GoldLoanStatus='decline' WHERE ApplyGoldLoanID='" . $_GET['id'] . "' ");
            if ($update) {

                $sqlemail = mysql_fetch_array(mysql_query("SELECT * from  customer where CustomerID='" . $_POST['CustomerID'] . "' ")) or die(mysql_error());
                $sql1emailsetup = mysql_query("SELECT * FROM emailsetup ");
                $rowemail = mysql_fetch_array($sql1emailsetup);
                $email = $sqlemail['EmailID'];
                $to = $email;
                $subject = "Gant Loan Deline";
                $message = "Your grant loan is decline";
                $message .= "<b>Copyright © 2016-2017 Codefever Pvt Ltd, All Rights Reserved.</b>/n";
                $header = $rowemail['EmailId'];
                $retval = mail($to, $subject, $message, $header);
                ?><script>alert('Your Request is decline')</script><?php
            }
        }
    } else {
        $_SESSION['alertmsg'] = "This customer Id And OPT already approve grand gold loan, dotn't repeted ";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
<?php include 'include/mang_nav.php'; ?>

        <script type="text/javascript">
            function validation()
            {
                var Status = $("#Status").val();
                if (Status == 'active') {

                    if (document.myForm.firstdate.value == "")
                    {
                        $("#firstdateerror").show();
                        setTimeout(function () {
                            $('#firstdateerror').fadeOut()
                        }, 3000);
                        document.myForm.firstdate.focus();
                        return false;
                    }
                }




            }
        </script>

    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

<?php include 'include/mang_sidenav.php'; ?>

            <div class="content-wrapper">

                <span class="" style="text-align:center; ">
<?php if (isset($_SESSION["alertmsg"]) && $_SESSION["alertmsg"] !== 0) {
    echo $_SESSION["alertmsg"];
    unset($_SESSION["alertmsg"]);
} ?>
                </span>
                <section class="content">
                    <form method="post" action=""  name="myForm" onsubmit="return(validation());">
                        <div class="box box-warning">
                            <div class="box-header with-border">
                                <h3 class="box-title"> <i class="fa fa-diamond"></i> Grant Gold Loan</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">              
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Customer ID</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="cid" name="CustomerID" placeholder="Enter Customer ID" >
                                    </div>
                                </div>    
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>OTP</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <input type="text" name="OTP" id="otp" required class="form-control"  >
                                        <input type="hidden" name="getid" id="getid" value="<?php echo $_GET['id'];
; ?>" required class="form-control"  >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-warning" id="" name="Search" onclick="search()">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>  
                        <div id="goldloaninfo"></div>


                        <div class="box box-warning"> 
                            <div class="box-header with-border">
                                <h3 class="box-title"> <i class="fa fa-diamond"></i> Approval Status</h3>
                            </div>
                            <div class="box-body">      
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label> Approval</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control" name="Status" id="Status" required style="width: 100%;" onchange="changetextbox()" required>
                                            <option value="">--Select--</option>
                                            <option value="active">Alloted</option>
                                            <option value="decline">Decline</option>
                                        </select>  
                                    </div>
                                </div>	  		   
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>First Installment Date</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="firstdate" id="fid"  class="form-control txtenddate" >
                                        <div id="firstdateerror" style="color:red; display: none;height: 5px;" >Please select First Installment Date<</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Remark</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="Remark" class="form-control">
                                    </div>
                                </div>
                            </div>    

                            <div class="box-footer text-center">
                                <button type="submit" name="submit" class="btn btn-warning">Save</button>
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
        <script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>
        <script>
                                        $(".txtstartdate").datepicker({
                                            minDate: 0,
                                            onSelect: function (date) {
                                                $(".txtenddate").datepicker('option', 'minDate', date);
                                                format: 'dd-mm-yyyy'
                                            }
                                        });

                                        $(".txtenddate").datepicker({});
        </script>  
        <script type="text/javascript">
            function search()
            {
                var custid = $("#cid").val();
                var otp = $("#otp").val();
                var getid = $("#getid").val();
                //var  datastring = custid ("#cid"), otp("#otp");
                datastring = 'custid=' + custid + '&otp=' + otp + '&getid=' + getid;
                $.ajax({url: 'goldloan_customer_ajax.php',
                    data: {custid: custid, otp: otp, getid: getid},
                    type: 'post',
                    success: function (output)
                    {
                        // alert(output);

                        $("#goldloaninfo").html(output);
                    }
                });
            }

        </script>

        <script type="text/javascript">
            function changetextbox()
            {
                if (document.getElementById("Status").value == "decline") {
                    document.getElementById("fid").disabled = 'true';
                } else {
                    document.getElementById("fid").disabled = '';
                }
            }
        </script>

    </body>
</html>

