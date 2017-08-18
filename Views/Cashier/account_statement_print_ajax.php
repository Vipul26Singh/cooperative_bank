<?php
include '../superadmin-session.php';
error_reporting(0);
//echo $_GET['loanno'] ;
?>    

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Cashier</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="../CSS/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../CSS/dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="../CSS/dist/css/skins/_all-skins.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="../CSS/plugins/iCheck/flat/blue.css">
        <!-- Morris chart -->
        <link rel="stylesheet" href="../CSS/plugins/morris/morris.css">
        <!-- jvectormap -->
        <link rel="stylesheet" href="../CSS/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
        <!-- Date Picker -->
        <link rel="stylesheet" href="../CSS/plugins/datepicker/datepicker3.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="../CSS/plugins/daterangepicker/daterangepicker.css">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="../CSS/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
        <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
        <style>      
            .body {
                background-color: #ECF0F5;
            }
            .border {

                border: 1px solid #000;
                padding: 10px;
            }
        </style>
    </head>

    <body class="body">

        <section class="content">	
            <br>
            <div class="box box-primary">
                <?php
                $sql2 = mysql_query("SELECT * FROM companysetup") or die(mysql_error());
                while ($row = mysql_fetch_array($sql2)) {
                    ?>
                    <br>
                    <div class="row">
                        <div class="col-xs-2 ">
    <?php echo '<img src="../upload/' . $row['companylogo'] . '" class="text-center" style="width:100px; height:120px; margin-left:20px;" />'; ?></div>
                        <div class="col-xs-10">
                            <div class="col-xs-10"><h3 class="text-center" ><b><?php echo $row['CompanyName']; ?>&emsp;&emsp;</b></h3></div>
                            <div class="col-xs-10 text-center"><i><b> <?php echo $row['CompanyAddress']; ?>&emsp;&emsp;</b></i></div>
                            <div class="col-xs-10 text-center"><i><b> Registration No:  <?php echo $row['registrationno']; ?>&emsp;&emsp;</b></i></div>
                            <div class="col-xs-10 text-center"><i><b> Contact No: <?php echo $row['phoneno']; ?>&emsp;&emsp;</b></i></div><br><br>
                        </div>
                    </div>
                    <div class="box-header with-border text-center">
    <?php
}
$sqlbranch = mysql_fetch_array(mysql_query("SELECT * FROM `branch` WHERE BranchId='" . $_SESSION['branch_id'] . "' ")) or die(mysql_error());
?>          <div class="row">
                        <div class="col-xs-4 text-left"><b>&emsp;&emsp;<?php echo $sqlbranch['BranchName']; ?></b><br></div>
                        <div class="col-xs-4 text-center"><b>&emsp; Bank Account Transaction</b></div>
                        <div class="col-xs-4 text-right"><p><b> Date: </b><?php echo date("d-m-Y"); ?>&emsp;&emsp;</p></div>
                    </div>
                </div>

                <div class="box-body with-borders">
                    <br><br>
                    <div class="col-xs-4 col-xs-offset-2">
                        <div class="form-group">
<?php
$sqlname = mysql_fetch_array(mysql_query("SELECT bankaccounttransactions.*, customer.CustomerName FROM `bankaccounttransactions` 
                                                                    INNER JOIN customer ON customer.CustomerID = bankaccounttransactions.CustomerID 
                                                                    WHERE accountNo = '" . $_GET['accountno'] . "' "));
?>

                            <label> Customer Name: <?php echo $sqlname['CustomerName']; ?></label>
                        </div>
                    </div>

                    <div class="col-xs-4 col-xs-offset-2 ">
                        <div class="form-group">
                            <label> Bank Account No : <?php echo $_GET['accountno']; ?></label>
                        </div>
                    </div>

                    <div class="col-xs-4 col-xs-offset-2">
                        <div class="form-group ">
                            <label> Transaction Mode : <?php echo $_GET['trasactionmode']; ?></label>
                        </div>
                    </div>

                    <div class="col-xs-4 col-xs-offset-2">
                        <div class="form-group ">
                            <label> Transaction Date : <?php echo $_GET['trasactiondate']; ?> to <?php echo $_GET['trasactionenddate']; ?> </label>
                        </div>
                    </div>

                    <br><br>		
                    <div class="col-xs-12"><br>
                        <table class="table table-responsive table-condensed table-striped table-hover">
                            <thead>
                                <tr>  
                                    <th>Transaction Date</th>
                                    <th>Transaction Type</th>
                                    <th>Withdraw</th>
                                    <th>Deposit </th>
                                    <th>Transaction Mode</th>
                                    <th> Balance </th>
                                </tr>
                            </thead>

<?php
$startdate = date('Y-m-d', strtotime($_GET['trasactiondate']));
$enddate = date('Y-m-d', strtotime($_GET['trasactionenddate']));

/* * * Account no and transaction date and transaction mode ** */
if ($_GET['accountno'] && $_GET['trasactiondate'] && $_GET['trasactionenddate'] && $_GET['trasactionmode']) {

    $sqlaccount = mysql_query("SELECT * FROM bankaccounttransactions WHERE accountNo='" . $_GET['accountno'] . "' 
                                            AND (Transactiondate BETWEEN '" . $startdate . "' AND '" . $enddate . "') 
                                            AND Transactionmode='" . $_GET['trasactionmode'] . "' ");

    while ($row = mysql_fetch_array($sqlaccount)) {
        ?>
                                    <tr>
                                        <td><?php echo date('d-m-Y', strtotime($row['Transactiondate'])); ?></td>
                                        <td><?php echo $row['TransactionType']; ?></td>
                                        <td><?php echo $row['Withdraw']; ?></td>
                                        <td><?php echo $row['Deposit']; ?></td>
                                        <td><?php echo $row['Transactionmode']; ?></td>
                                        <td><?php echo $row['Balance']; ?></td>
                                    </tr>
                                    </tr>
    <?php
    }
}
/* * * Display Acc no and date * */ else if ($_GET['accountno'] && $_GET['trasactiondate'] && $_GET['trasactionenddate']) {

    $sqlaccount1 = mysql_query("SELECT * FROM  bankaccounttransactions WHERE accountNo='" . $_GET['accountno'] . "' 
                                            AND (Transactiondate BETWEEN '" . $startdate . "' AND '" . $enddate . "') 
                                             ");

    while ($row = mysql_fetch_array($sqlaccount1)) {
        ?>
                                    <tr>
                                        <td><?php echo date('d-m-Y', strtotime($row['Transactiondate'])); ?></td>
                                        <td><?php echo $row['TransactionType']; ?></td>
                                        <td><?php echo $row['Withdraw']; ?></td>
                                        <td><?php echo $row['Deposit']; ?></td>
                                        <td><?php echo $row['Transactionmode']; ?></td>
                                        <td><?php echo $row['Balance']; ?></td>
                                    </tr>
    <?php
    }
}
/* * * Account no and cash *** */ else if ($_GET['accountno'] && $_GET['trasactionmode']) {
    $sqlaccount2 = mysql_query("SELECT * FROM bankaccounttransactions WHERE accountNo='" . $_GET['accountno'] . "' 
                                            AND Transactionmode='" . $_GET['trasactionmode'] . "' ");

    while ($row = mysql_fetch_array($sqlaccount2)) {
        ?>
                                    <tr>
                                        <td><?php echo date('d-m-Y', strtotime($row['Transactiondate'])); ?></td>
                                        <td><?php echo $row['TransactionType']; ?></td>
                                        <td><?php echo $row['Withdraw']; ?></td>
                                        <td><?php echo $row['Deposit']; ?></td>
                                        <td><?php echo $row['Transactionmode']; ?></td>
                                        <td><?php echo $row['Balance']; ?></td>
                                    </tr>
    <?php
    }
}
/* * * Account No ** */ else if ($_GET['accountno'] && empty($_GET['trasactiondate'] && $_GET['trasactionenddate'] && $_GET['trasactionmode'])) {
    $sqlaccount = mysql_query("SELECT * FROM  bankaccounttransactions WHERE accountNo='" . $_GET['accountno'] . "' 
                                           ") or die(mysql_error());

    while ($row = mysql_fetch_array($sqlaccount)) {
        ?>
                                    <tr>
                                        <td><?php echo date('d-m-Y', strtotime($row['Transactiondate'])); ?></td>
                                        <td><?php echo $row['TransactionType']; ?></td>
                                        <td><?php echo $row['Withdraw']; ?></td>
                                        <td><?php echo $row['Deposit']; ?></td>
                                        <td><?php echo $row['Transactionmode']; ?></td>
                                        <td><?php echo $row['Balance']; ?></td>
                                    </tr>
                                <?php
                                }
                            }
                            ?>  </table> <br><br>
                    </div>  

                </div>
            </div>

        </section>


    </body>
</html>