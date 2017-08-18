<?php
include '../superadmin-session.php';
error_reporting(0);

if (isset($_POST['submit'])) {

    $insert = mysql_query("insert into goldloanapplication set 
                    CustomerID='" . $_POST['CustomerID'] . "',
                    ApplyLoanDate='" . $_POST['ApplyLoanDate'] . "',
                    AppliedAmount='" . $_POST['AppliedAmount'] . "',
                    LoanPurpose='" . $_POST['LoanPurpose'] . "',
                                ForDurationinMonth='" . $_POST['ForDurationinMonth'] . "',
                                GoldValue='" . $_POST['GoldValue'] . "',
                                WeightofOrnament='" . $_POST['WeightofOrnament'] . "',
                                GoldPurityCheck='" . $_POST['GoldPurityCheck'] . "',
                                GoldKarat='" . $_POST['GoldKarat'] . "',
                                LoanTypeid='" . $_POST['LoanTypeid'] . "',
                                Remark='" . $_POST['Remark'] . "',
                                GoldLoanStatus='pending',
                    OpenDate='" . $currentdate . "',
                    BranchId ='" . $_SESSION['branch_id'] . "',
                    CreatedBy='" . $_SESSION['userid'] . "',
                    CreatedDate='" . $currentdate . "'
                    ");
    $lastid = mysql_insert_id();

    header("Location:gold_appln_list.php");
    exit;
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

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                <section class="content">   
                    <form role="form" method="post" enctype="multipart/form-data">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-user"></i> Customer Details</h3>
                            </div>

                            <div class="box-body">               
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Customer ID</label>
                                        <input type="text" name ="CustomerID" class="form-control" placeholder="Enter Customer ID" oninput="customerdetails(this.value)"  >
                                    </div>
                                    <div class="form-group">
                                        <label>Email ID</label>
                                        <input type="text" name ="EmailID" id="EmailID" class="form-control" readonly="true" >
                                    </div>           
                                </div>
                                <div class="col-md-6">             
                                    <div class="form-group">
                                        <label>Customer Name</label>
                                        <input type="text" name ="CustomerName" id="CustomerName"  class="form-control" readonly="true" >
                                    </div>  
                                    <div class="form-group">
                                        <label>Mobile No </label>
                                        <input type="text" name ="MobileNo" id="MobileNo" class="form-control" readonly="true" >
                                    </div>
                                </div>
                                <div class="col-md-6">                    
                                    <div class="form-group">
                                        <label>Photo/Signature</label><br>
                                        <!--<?php echo '<img src="../upload/' . $sqlbranch['mphoto'] . '" style="width:100px; height:100px" />' ?>
<?php echo '<img src="../upload/' . $sqlbranch['CSign'] . '" style="width:100px; height:100px" />' ?> -->
                                    </div>         
                                </div>
                                <div class="col-md-6">  
                                    <div class="form-group">
                                        <label>Account Open Date </label>
                                        <input type="date" name ="CustomerID" id ="CustomerID" class="form-control" readonly="true" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.Mortgage details-->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-diamond"></i>Mortgage Details</h3>
                            </div>
                            <div class="box-body"> 
                                <div class="col-md-6">             
                                    <div class="form-group">
                                        <label>Gold Item Photo</label><br><br>
                                        <div class="col-md-4"> </div>
                                        <image width="130px" height="130px">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4"> </div>
                                        <div class="btn btn-sm btn-default btn-file" id="divphoto" runat="server">
                                            <i class="fa fa-image"></i>&nbsp;Select Photo
                                            <input type="file" name="Photo" id="cust" width="100px" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Bill Verification</label>
                                        <select class="form-control" name="BillVerification" style="width: 100%;">
                                            <option selected="selected">--Select--</option>
                                            <option value='Verified'>Verified</option>
                                            <option value='NotVerified'>Not Verified</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Today Value of Gold</label>
                                        <input type="text" name="GoldValue" id="GoldValue" class="form-control"  >
                                    </div>
                                    <div class="form-group">
                                        <label>Weight In Gram</label>
                                        <input type="text" name="WeightofOrnament" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gold In Karat</label>
                                        <input type="text" name="GoldKarat" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label>Gold Purity Check</label>
                                        <select class="form-control" name="GoldPurityCheck" style="width: 100%;">
                                            <option value="">--Select--</option>
                                            <option value="Verified">Verified</option>
                                            <option value="NotVerified">Not Verified</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Loan Details -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-inr"></i> Loan Details</h3>
                            </div>

                            <div class="box-body">               
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Apply Loan Amount</label>
                                        <select class="form-control" name="LoanTypeid" onrequired >
<?php
$sql = mysql_query("SELECT LoanTypeid, Amount FROM loantype");
echo "<option value=''>Select</option>";
while ($row = mysql_fetch_array($sql)) {

    echo "<option value='" . $row['LoanTypeid'] . "'>" . $row['Amount'];
}
?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Apply Loan Date</label>
                                        <input type="date" class="form-control" readonly="true" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Duration In Month</label>
                                        <input type="text" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label>Remark</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Customer Income</label>
                                        <input type="text" name="CustomerIncome" id="CustomerIncome" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Loan Purpose</label>
                                        <textarea class="form-control"  ></textarea>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Loan Approval -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-edit"></i> Loan Approval</h3>
                            </div>

                            <div class="box-body">               
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Approval</label>
                                        <select class="form-control" style="width: 100%;">
                                            <option selected="selected">--Select--</option>
                                            <option>Approve</option>
                                            <option>Decline</option>
                                        </select>  
                                    </div>
                                    <div class="form-group">
                                        <label> Loan Type </label>               
                                        <select class="form-control" style="width: 100%;">
                                            <option selected="selected">--Select--</option>
                                        </select>  
                                    </div>				   
                                </div>
                                <div class="col-md-6">             
                                    <div class="form-group">
                                        <label>Approved Amount</label>
                                        <input type="text" class="form-control" >
                                    </div>  
                                    <div class="form-group">
                                        <label>Approver Remark </label>
                                        <input type="text" class="form-control"  >
                                    </div>
                                </div>
                            </div> 
                            <div class="box-footer text-center">
                                <button type="submit" class="btn btn-primary">Approve/Decline</button>
                            </div>			  

                        </div>

                    </form>
                </section>
                <!-- /.content -->
            </div>
<?php include 'include/mang_script.php'; ?>
            <!-- /.content-wrapper -->
            <!--  <footer class="main-footer">
              
               <strong>Copyright &copy; 2017-2018 <a href="#">CodeFever</a>.</strong> All rights
               reserved.
             </footer> -->

            <!-- Control Sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>

    </body>
</html>
<script type="text/javascript">
    function customerdetails(val)
    {


        $.ajax({url: 'loan_customerdetails_ajax.php',
            data: {val: val},
            type: 'post',
            success: function (output)
            {
                var json_data = JSON.parse(output);

                $("#EmailID").val(json_data['EmailID']);
                $("#CustomerName").val(json_data['CustomerName']);
                $("#MobileNo").val(json_data['MobileNo']);
                $("#Approvaldate").val(json_data['Approvaldate']);

                $("#Approvaldate").val(json_data['Approvaldate']);
                $("#Approvaldate").val(json_data['Approvaldate']);
                $("#Approvaldate").val(json_data['Approvaldate']);

            }

        });


    }
</script>

