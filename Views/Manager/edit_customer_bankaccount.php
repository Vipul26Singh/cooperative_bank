<?php
include '../superadmin-session.php';
error_reporting(0);

if (isset($_REQUEST['submit'])) {
    if ($selectdata['rowcount'] == 0) {
        $sqlbranch = mysql_fetch_array(mysql_query("SELECT count(accountNo) as accountno from  bankaccount "));
        $currentdate = date('Y-m-d');
        if ($_POST['Balance'] < '1000') {
            echo "Your Balance is less than 1000 that why account not create";
        } else {
            $insert = mysql_query("update bankaccount set 
	OpenDate='" . $currentdate . "',
	AccountTypeid='" . $_POST['AccountTypeid'] . "',
	ModifiedBy='" . $_SESSION['userid'] . "',
	ModifiedDate='" . $currentdate . "',
	Active='" . $_POST['Active'] . "' where AccountId='" . $_GET['id'] . "' ")or die(mysql_error());



            $lastid = mysql_query("");

            if ($insert) {

                $chequedate = date('Y-m-d', strtotime($_POST['ChequeDate']));
                $Transactiondate = date("Y-m-d H:i:s");
                $sqlinser = mysql_query("update bankaccounttransactions set 
		                   Transactionmode='" . $_POST['Transactionmode'] . "',
		                   Chequeno='" . $_POST['Chequeno'] . "',
		                   BankName='" . $_POST['BankName'] . "',
		                   ChequeDate='$chequedate',
		                   Remarks='" . $_POST['Remarks'] . "'
		                   where BankAccountId='" . $_GET['id'] . "'  ") or die(mysql_error());



                if ($sqlinser) {//echo 'updated';
                }
            }
        }

        header("Location: BankAccountList.php");
        exit;
    } else {

        echo "<script>";
        echo " alert('Please Select different account type');   
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

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                <section class="content">
                    <form role="form" method="post" action="">

                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Edit Bank Account Detail</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->

                            <?php
                            if (isset($_GET['id'])) {
                                $sql = mysql_query("SELECT ba.*,c.*,at.*,bat.*,b.BranchName
                                        FROM bankaccount ba
                                        INNER JOIN  customer c ON c.CustomerID=ba.CustomerID 
                                        LEFT JOIN  bankaccounttransactions bat ON bat.CustomerID=ba.CustomerID
                                        LEFT JOIN  accounttype at ON at.AccountTypeid=ba.AccountTypeid 
                                        LEFT JOIN branch b ON b.BranchId=ba.BranchId 
                                        WHERE ba.AccountId='" . $_GET['id'] . "' ") or die(mysql_error());
                                $row = mysql_fetch_array($sql);
                                ?>

                                <div class="box-body">

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Photo/Signature</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php echo '<img src="../upload/' . $row['mphoto'] . '" style="width:100px; height:100px" />' ?>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <?php echo '<img src="../upload/' . $row['CSign'] . '" style="width:100px; height:100px" />' ?>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Customer ID</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="CustomerID" class="form-control" value="<?php echo $row['CustomerID']; ?>" required readonly>
                                        </div> 
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Customer Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="CustomerName" class="form-control" value="<?php echo $row['CustomerName']; ?>" required readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Account Number</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">        
                                            <input type="text" name="accountNo" class="form-control" value="<?php echo $row['accountNo']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Opening Balance</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="Balance" class="form-control" value="<?php echo $row['Balance']; ?>" required readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Branch Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="BranchName" value="<?php echo $row['BranchName']; ?>" class="form-control" required readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Remark</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="Remarks" value="<?php echo $row['Remarks']; ?>" class="form-control" required readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Account Type</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">                    
                                            <select class="form-control" name="Type" id="accounttype" required onchange="changeamount();">
                                                <option value="Current" <?php if ($row['Type'] == "Current") echo ' selected'; ?> >Current</option> 
                                                <option value="Saving" <?php if ($row['Type'] == "Saving") echo ' selected'; ?> >Saving</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Account Type Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select class="form-control" name="AccountTypeid" id="accounttypedata" required  onchange="showbal(this.value);">

                                                <?php
                                                $sqlacount = mysql_query("SELECT * from accounttype where AccountTypeid='" . $row['AccountTypeid'] . "' ");

                                                while ($account = mysql_fetch_array($sqlacount)) {
                                                    ?>
                                                    <option value="<?php echo $account['AccountTypeid']; ?>"><?php echo $account['Accounttypename']; ?></option>
                                                <?php } ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Opening Date</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="OpenDate" class="form-control" value="<?php echo date('d-m-Y', strtotime($row['OpenDate'])); ?>" required readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Status</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select class="form-control" name="Active" style="width: 100%;" >
                                                <?php
                                                if ($row['Active'] == 1) {
                                                    $a = "Active";
                                                    $b = "Deactive";
                                                    echo "<option  value='1'>" . $a . "</option>"
                                                    . "<option  value='0'>" . $b . "</option>";
                                                } else {
                                                    $a = "Active";
                                                    $b = "Deactive";
                                                    echo "<option  value='0'>" . $b . "</option>"
                                                    . "<option  value='1'>" . $a . "</option>";
                                                }
                                                ?>
                                            </select> 
                                        </div>
                                    </div>

                                </div>

                                <div class="box-footer text-center">
                                    <input type="submit" name="submit" class="btn btn-primary" value="Edit">
                                </div>
                            </div>
                        <?php }
                        ?>

                    </form>
                </section>
            </div>

            <!-- /.box-body -->


            <!-- /.content -->

            <!-- /.content-wrapper -->
            <?php include 'include/mang_script.php'; ?>

            <!-- Control Sidebar -->

            <div class="control-sidebar-bg"></div>
        </div>
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

        <script>
            function changeamount(val)
            {
                var accounttype = $("#accounttype").val();
                $.ajax({url: 'add_account_ajax.php',
                    data: {accounttype: accounttype},
                    type: 'post',
                    success: function (output)
                    {
                        $("#accounttypedata").html(output);
                    }
                });
            }
        </script>

        <script type="text/javascript">
            function showbal(val)
            {
                $.ajax({url: 'balshow_ajax.php',
                    data: {val: val},
                    type: 'post',
                    success: function (output)
                    {
                        $("#Balance").val(output);
                    }
                });
            }
        </script>
    </body>
</html>


