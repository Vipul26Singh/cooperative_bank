<?php
include '../superadmin-session.php';
//include '../../alerts.php'; 
error_reporting(0);

if (isset($_POST['submit'])) {
//mysql_query("START TRANSACTION"); 
    //$currentdate=date('Y-m-d',strtotime($_POST['ApplyLoanDate']));


    $currentdate = date('Y-m-d');
    $insert = mysql_query("insert into custonlinebankingapplication set 
                        CustomerID='" . $_POST['CustomerID'] . "',
                        BranchId ='" . $_SESSION['branch_id'] . "',
                        AccountId='" . $_POST['accountNo'] . "',
                        accountNo='" . $_POST['accountNo'] . "',
                        OnlineCustomertypeId='" . $_POST['OnlineCustomertypeId'] . "',
                        RequestedUsername1='" . $_POST['RequestedUsername1'] . "',
                        RequestedUsername2='" . $_POST['RequestedUsername2'] . "',
                        RequestedUsername3='" . $_POST['RequestedUsername3'] . "',
                        MobileAccess='" . $_POST['MobileAccess'] . "',
                        InternetAccess='" . $_POST['InternetAccess'] . "',
                        ApplicationStatus='pending',
                        CreatedBy='" . $_SESSION['userid'] . "',
                        CreatedDate='" . $currentdate . "'
                     ");
    header("location:clerk_dashboard.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include 'include/clerk_nav.php'; ?>
    </head>

    <body class="hold-transition skin-yellow sidebar-mini">
        <div class="wrapper">
            <?php include 'include/clerk_sidenav.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <form role="form" method="post"  enctype="multipart/form-data" action="">
                    <section class="content">

                        <div class="box box-warning">
                            <div class="box-header with-border">
                                <h3 class="box-title">Customer Detail</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->

                            <div class="box-body">

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Customer ID</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="CustomerID" required id="CustomerID" class="form-control"  >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-warning" id="" name="Search" onclick="customerdetails(this.value)" >Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="divshow"></div>

                        <div id="divhide">
                            <div class="box box-warning">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Apply for Internet/Mobile Banking </h3>
                                </div>

                                <div class="box-body">

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Customer Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="custname" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Mobile No</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="cust" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-2">             
                                        <div class="form-group">
                                            <label>Photo/Signature</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <image width="100px" height="100px" readonly>
                                            <image width="200px" height="80px" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-2">             
                                        <div class="form-group">
                                            <label>Email ID</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="cust" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-2">             
                                        <div class="form-group">
                                            <label>Residential Address</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="cust" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-2">             
                                        <div class="form-group">
                                            <label>Official Address</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="cust" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-2">             
                                        <div class="form-group">
                                            <label>Mobile Banking</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select class="form-control" style="width: 100%;">
                                                <option selected="selected">--Select--</option>
                                                <option>Yes</option>
                                                <option>No</option>                 
                                            </select>              
                                        </div>
                                    </div>
                                    <div class="col-md-2">             
                                        <div class="form-group">
                                            <label>Select Account No</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select class="form-control" style="width: 100%;">
                                                <option selected="selected">--Select--</option>
                                            </select>   
                                        </div>
                                    </div>

                                    <div class="col-md-2">             
                                        <div class="form-group">
                                            <label>Internet Banking</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select class="form-control" style="width: 100%;">
                                                <option selected="selected">--Select--</option>
                                                <option>Yes</option>
                                                <option>No</option>                    
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">             
                                        <div class="form-group">
                                            <label>Account Balance</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="cust">
                                        </div> 
                                    </div>

                                    <div class="col-md-2">             
                                        <div class="form-group">
                                            <label>Customer Type</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select class="form-control" style="width: 100%;">
                                                <option selected="selected">--Select--</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">             
                                        <div class="form-group">
                                            <label>User ID 1</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="cust">
                                        </div>
                                    </div>

                                    <div class="col-md-2">             
                                        <div class="form-group">
                                            <label>Application Date</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="date" class="form-control" id="cust" 
                                                   value="<?php echo date("Y-m-d"); ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-2">             
                                        <div class="form-group">
                                            <label>User ID 2</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="cust" >
                                        </div>
                                    </div>

                                    <div class="col-md-2">             
                                        <div class="form-group">
                                            <label>Branch Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="cust"  value="<?php echo $_SESSION['branch_id']; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-2">             
                                        <div class="form-group">
                                            <label>User ID 3</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="cust">
                                        </div>
                                    </div>
                                </div>

                                <div class="box-footer text-center">
                                    <button type="submit" name="submit" class="btn btn-warning">Submit</button>
                                </div>
                            </div> 
                        </div>


                    </section>
                    <!-- /.content -->
                </form>
            </div>


            <?php include 'include/clerk_script.php'; ?>
            <!-- Control Sidebar -->

            <div class="control-sidebar-bg"></div>

        </div>
        <?php include '../../alerts.php'; ?>
    </body>
</html>
<script type="text/javascript">
    function customerdetails(val)
    {

        var val = $("#CustomerID").val();

        if (val == '')
        {
            jAlert('Please enter Customer ID', 'Alert Dialog');
        } else
        {
            $.ajax({url: 'onlinecustomerajax.php',
                data: {val: val},
                type: 'post',
                success: function (output)
                {

                    $("#divhide").hide();
                    $("#divshow").html(output);
                }

            });

        }
    }
</script>
