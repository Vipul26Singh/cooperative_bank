<?php
include '../superadmin-session.php';
error_reporting(0);

if (isset($_POST['submit'])) {
    $getno = mysql_fetch_array(mysql_query("SELECT LoanNumber FROM `loan` ORDER BY LoanNumber DESC LIMIT 1"));
    if ($getno['LoanNumber'] == Null) {
        $acc_no = mysql_fetch_array(mysql_query("SELECT LoanAccountno FROM intializeaccountno"));
        $no = $acc_no['LoanAccountno'];
        $loan_no = $no + 1;
    } else {
        $l_no = $getno['LoanNumber'];
        $loan_no = $l_no + 1;
    }

    $selectdata = mysql_fetch_array(mysql_query("SELECT la.*, loantype.InterestRate, loantype.Durationinmonth, loantype.NoofInstallments,la.Gaurantor1Id,la.Gaurantor2Id FROM loanapplication la INNER JOIN loantype ON loantype.LoanTypeid =loantype.LoanTypeid WHERE la.ApplyLoanID='" . $_GET['id'] . "' "));

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
                        Gaurantor1Id='" . $selectdata['Gaurantor1Id'] . "',
                        Gaurantor2Id='" . $selectdata['Gaurantor2Id'] . "',
                        Interestrate='" . $selectdata['InterestRate'] . "',
                        Durationinmonth='" . $selectdata['Durationinmonth'] . "',
                        installmentamount='" . $installment_amount . "',
                        NoofInstallments='" . $selectdata['Durationinmonth'] . "',
                        LoanTypeid='" . $selectdata['LoanTypeid'] . "',
                        Remark='" . $_POST['Remark'] . "',            
                        Balance='" . $selectdata['ApproveAmount'] . "',
                        FirstInstallmentDate='" . $date . "',
                        Status='" . $_POST['Status'] . "',
                        BranchId ='" . $_SESSION['branch_id'] . "',
                        DisburseDate=CURDATE(),
                        CustomerOTP = '" . $selectdata['OTP'] . "',
                        ApplyLoanID = '" . $selectdata['ApplyLoanID'] . "',
                        Type = 'reguler',
                        Createdby ='" . $_SESSION['userid'] . "' ") or die(mysql_error());
        $lastid = mysql_insert_id();


        if ($insert) {
            $update = mysql_query("UPDATE loanapplication SET LoanStatus='alloted' WHERE ApplyLoanID='" . $_GET['id'] . "' ");
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
        $update = mysql_query("UPDATE loanapplication SET LoanStatus='decline' WHERE ApplyLoanID='" . $_GET['id'] . "' ");
        if ($update) {

            $sqlemail = mysql_fetch_array(mysql_query("SELECT * from  customer where CustomerID='" . $_POST['CustomerID'] . "' ")) or die(mysql_error());

            $sql1emailsetup = mysql_query("SELECT * FROM emailsetup ");
            $rowemail = mysql_fetch_array($sql1emailsetup);
            $email = $sqlemail['EmailID'];
            $to = $email;
            $subject = "Gant Loan Deline";
            $message = "Your grant loan is decline";
            $message .= "<b>Copyright © 2016-2017 Codefever Pvt Ltd, All Rights Reserved.</b><br/>";
            $header = $rowemail['EmailId'];
            $retval = mail($to, $subject, $message, $header);
            ?><script>alert('Your Request is decline')</script><?php
        }
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
                <section class="content">
                    <form method="post" action="" name="myForm" onsubmit="return(validation());">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title"> <i class="fa fa-diamond"></i> Grant Regular Loan</h3>
                            </div>
                            <!-- /.box-header -->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Customer ID</label>
                                    <input type="text" class="form-control" id="cid" name="CustomerID" placeholder="Enter Customer ID" >
                                </div>
                            </div>    
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>OTP</label>
                                    <input type="text" name="OTP" id="otp" class="form-control" >
                                    <input type="hidden" name="getid" id="getid" value="<?php echo $_GET['id'] ?>" class="form-control" >
                                </div>
                            </div><br>
                            <div class="col--md-3">
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary" id="" name="Search" onclick="search()">Search</button>
                                </div>
                            </div><br>
                        </div>
                        <div id="goldloaninfo"></div>
                        <div class="box box-body">    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Approval</label>
                                    <select class="form-control" name="Status" id="Status" style="width: 100%;" onchange="changetextbox()" required>
                                        <option value="">--Select--</option>
                                        <option value="active">Alloted</option>
                                        <option value="decline">Decline</option>
                                    </select>  
                                </div>
                            </div>	  		   
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>First Installment Date</label>
                                    <input type="text" name="firstdate" id="fid" class="form-control txtenddate" >
                                    <div id="firstdateerror" style="color:red; display: none;height: 5px;" >Please select First Installment Date<</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Remark</label>
                                    <input type="text" name="Remark" class="form-control">
                                </div>
                            </div>
                            <br>
                        </div>
                        <div class="box-footer text-center">
                            <button type="submit" name="submit" class="btn btn-primary">Save</button>
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
                $.ajax({url: 'regulerloan_customer_ajax.php',
                    data: {custid: custid, otp: otp, getid: getid},
                    type: 'post',
                    success: function (output)
                    {
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
