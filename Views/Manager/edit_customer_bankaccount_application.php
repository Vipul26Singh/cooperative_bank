<?php
include '../superadmin-session.php';
error_reporting(0);
$sqlbanckapplication = mysql_fetch_array(mysql_query("SELECT * from  bankaccapplication where  BankAccountAppId='" . $_GET['id'] . "' "));
if (isset($_POST['submit'])) {


// mysql_query("START TRANSACTION");
    $selectdata = mysql_fetch_array(mysql_query("SELECT count(*) as rowcount FROM bankaccount ba left JOIN  accounttype at ON at.AccountTypeid=ba.AccountId where 
ba.CustomerID='" . $_POST['CustomerID'] . "' and ba.AccountTypeid='" . $_POST['AccountTypeid'] . "'"));

    if ($_POST['Active'] == '1') {
        if ($selectdata['rowcount'] == 0) {
            /* $sqlbranch =  mysql_fetch_array(mysql_query("SELECT count(accountNo) as accountno from  bankaccount " ));
              $currentdate=date('Y-m-d H:i:s');
              if($_POST['Balance'] <'1000')
              {
              echo "Your Balance is less than 1000 that why account not create";
              }
              else{ */
            $insert = mysql_query("insert into bankaccount set 
                       CustomerID='" . $_POST['CustomerID'] . "',
                       AccountTypeid='" . $_POST['AccountTypeid'] . "',
                       accountNo='" . $_POST['accountNo'] . "',
                       Balance='" . $_POST['Balance'] . "',
                       OpenDate='" . $currentdate . "',
                       BranchId ='" . $_SESSION['branch_id'] . "',
                       CreatedBy='" . $_SESSION['userid'] . "',
                       BankAccountAppId ='" . $sqlbanckapplication['BankAccountAppId'] . "',
                       CreatedDate='" . $currentdate . "'
                     ") or die(mysql_error());

            //print_r();

            $lastid = mysql_insert_id();

            if ($insert) {
                $chequedate = date('Y-m-d', strtotime($_POST['ChequeDate']));
                $Transactiondate = date("Y-m-d H:i:s");
                $sqlinser = mysql_query("insert into bankaccounttransactions set 
                       BankAccountId='$lastid',
                       CustomerID='" . $_POST['CustomerID'] . "',
                       accountNo='" . $_POST['accountNo'] . "',
                       Balance='" . $_POST['Balance'] . "',  
                       TransactionType='" . $_POST['TransactionType'] . "',
                       Chequeno='" . $_POST['Chequeno'] . "',
                       BankName='" . $_POST['BankName'] . "',
                       ChequeDate='$chequedate',
                       Transactiondate='$Transactiondate',
                       Deposit='" . $_POST['Balance'] . "',
                       Remarks='" . $_POST['Remarks'] . "',
                       CreatedBy='" . $_SESSION['userid'] . "'
                        ") or die(mysql_error());
            }

            if ($sqlinser) {
                if ($_POST['Active'] == '1') {
                    $_POST['Active'] = 'approve';
                } else {
                    $_POST['Active'] = 'decline';
                }
                $insertdata = mysql_query("update bankaccapplication set 
                      ModifiedBy='" . $_SESSION['userid'] . "',
                      ModifiedDate='" . $currentdate . "',
                      ApproverId='" . $_SESSION['userid'] . "',
                      Approvaldate='" . $currentdate . "',
                      ApproverRemark='" . $_POST['Remarks'] . "',
                      ApplicationStatus='" . $_POST['Active'] . "' 
                      where BankAccountAppId='" . $_GET['id'] . "' ")or die(mysql_error());
            }

            //}
            if ($insert and $sqlinser and $insertdata) {
                mysql_query("COMMIT");
		echo "<script>";
		            echo "alert('Approved sucessfully');   
			    </script>";
                header("Location:BankAccountList.php");
            } else {
                mysql_query("ROLLBACK");
		echo "<script>";
		                            echo "alert('Internal error');   
					                                </script>";
            }
        } else {
            echo "<script>";
            echo "alert('Please Select different account type');   
</script>";
        }
    } else {
        $_POST['Active'] = 'decline';
        $insertdata = mysql_query("update bankaccapplication set 
                      ModifiedBy='" . $_SESSION['userid'] . "',
                      ModifiedDate='" . $currentdate . "',
                      ApproverId='" . $_SESSION['userid'] . "',
                      Approvaldate='" . $currentdate . "',
                      ApproverRemark='" . $_POST['Remarks'] . "',
                      ApplicationStatus='" . $_POST['Active'] . "' 
                      where BankAccountAppId='" . $_GET['id'] . "' ")or die(mysql_error());
        header("location:pendingbankapplication_list.php");
    }
}

$sqlbranch = mysql_fetch_array(mysql_query("SELECT count(accountNo) as accountno from  bankaccount "));

$intializaccount = mysql_fetch_array(mysql_query("SELECT * from  intializeaccountno "));

$string = $intializaccount['AccountNo'];
if ($sqlbranch['accountno'] == 0) {
    $accNo = ($string);
} else {
    $accNo = ($string) + ($sqlbranch['accountno']);
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

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Bank Account Detail</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="">

<?php
if (isset($_GET['id'])) {
    $sql = mysql_query("SELECT * 
                                        FROM  bankaccapplication ba
                                        INNER JOIN  customer c ON c.CustomerID=ba.CustomerID 
                                        LEFT JOIN  accounttype at ON at.AccountTypeid=ba.AccountTypeid 
                                        LEFT JOIN branch b ON b.BranchId=ba.BranchId 
                                        WHERE ba.BankAccountAppId='" . $_GET['id'] . "' ") or die(mysql_error());
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
                                            <input type="text" name="accountNo" class="form-control" value="<?php echo $accNo; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Opening Balance</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="Balance" class="form-control" value="<?php echo $row['OpenBalance']; ?>" required readonly>
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
                                            <label>Account Type</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">                    
                                            <input type="text" name="Type" value="<?php echo $row['Type']; ?>" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group"> 
                                            <label>Account Type Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"> 
                                            <select class="form-control" name="AccountTypeid" id="accounttypedata" required  onchange="showbal(this.value);" readonly>
    <?php
    $sqlacount = mysql_query("SELECT * from accounttype where AccountTypeid='" . $row['AccountTypeid'] . "' ");
    while ($account = mysql_fetch_array($sqlacount)) {
        ?>
                                                    <option value="<?php echo $account['AccountTypeid']; ?>"><?php echo $account['Accounttypename']; ?></option>
    <?php } ?>

                                            </select>
                                                <!-- <input type="text" name="Type" value="<?php //echo $sqlacount['Accounttypename'];  ?>" class="form-control" readonly> -->
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group"> 
                                            <label>Opening Date</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"> 
                                            <input type="text" name="OpenDate" class="form-control" value="<?php echo date('d-m-Y', strtotime($row['CreatedDate'])); ?>" required readonly>
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
        $a = "Approve";
        $b = "Decline";
        echo "<option  value='1'>" . $a . "</option>"
        . "<option  value='0'>" . $b . "</option>";
    } else {
        $a = "Approve";
        $b = "Decline";
        echo "<option  value='0'>" . $b . "</option>"
        . "<option  value='1'>" . $a . "</option>";
    }
    ?> 
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group"> 
                                            <label>Remark</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"> 
                                            <input type="text" name="Remarks" value="<?php //echo $row['Remarks']; ?>" class="form-control" required >
                                        </div>
                                    </div>

                                </div>

                                <div class="box-footer text-center">
                                    <input type="submit" name="submit" class="btn btn-primary" value="Submit">
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


