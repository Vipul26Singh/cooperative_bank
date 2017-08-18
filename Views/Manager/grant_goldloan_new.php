<?php
include '../superadmin-session.php';
error_reporting(0);
//global $id;
//$selectdata = mysql_fetch_array(mysql_query("SELECT * from goldloanapplication where          
//WHERE GoldLoanTypeid='".$_GET['id']."' ")) OR die(mysql_error()); 

/* $acc_no=mysql_fetch_row(mysql_query("SELECT LoanAccountno FROM intializeaccountno ORDER BY LoanAccountno DESC LIMIT 1");
  IF($acc_no)
  {
  $loan_acc_no=$acc_no++;
  }

  $p = $selectdata['ApproveAmount'];
  $r = $selectdata['InterestRate']/12*100;
  $n =  $selectdata['Durationinmonth'];
  $installment_amount=($p*$r*(1+$r)^$n/(1+$r)^$n-1);

  $insert = mysql_query("insert into loan set
  CustomerID='".$_POST['CustomerID']."',
  LoanDate='CURDATE()',
  Amount='".$selectdata['ApproveAmount']."',
  Interestrate='".$selectdata['InterestRate']."',
  Durationinmonth='".$selectdata['Durationinmonth']."',
  installmentamount='".$installment_amount."',
  NoofInstallments='".$selectdata['NoofInstallments']."',
  LoanTypeid='".$selectdata['GoldLoanTypeid']."',
  Remark='".$_POST['Remark']."',
  Balance='".$selectdata['ApproveAmount']."',
  FirstInstallmentDate='',
  Status='".$_POST['Status']."',
  BranchId ='".$_SESSION['branch_id']."',
  CustomerOTP = '".$selectdata['OTP']."',
  ApplyLoanID = '".$selectdata['ApplyGoldLoanID']."';
  Createdby ='".$_SESSION['userid']."' ") or die(mysql_error()); */

/*   if($_POST['CustomerID'] == $selectdata['CustomerID'] && $selectdata['OTP'] == $_POST['OTP'])
  {
  ?>   <div id="customerinfo"></div>

  <?php  } */
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

                <section class="content">

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"> <i class="fa fa-diamond"></i>Grant Gold Loan</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form">
                            <div class="box-body">               
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Customer ID</label>
                                        <input type="text" class="form-control" name="CustomerID" placeholder="Enter Customer ID" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>OTP</label>
                                        <input type="text" class="form-control" name="OTP" required oninput="customerdetails(this.value)" >
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> Approval</label>
                                        <select class="form-control" style="width: 100%;">
                                            <option selected="selected">--Select--</option>
                                            <option>Approve</option>
                                            <option>Decline</option>
                                        </select>  
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Installment Date</label>
                                        <input type="Date" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ramark</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>

                </section>
                <!-- /.content -->
            </div><?php include 'include/mang_script.php'; ?>

            <!-- /.content-wrapper -->


            <!-- Control Sidebar -->

            <div class="control-sidebar-bg"></div>
        </div>

        <script type="text/javascript">
            function customerdetails(val)
            {


                $.ajax({url: 'goldloan_customer_ajax.php',
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


    </body>
</html>
