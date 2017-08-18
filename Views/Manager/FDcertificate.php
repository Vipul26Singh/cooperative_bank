<?php
include '../superadmin-session.php';
error_reporting(0);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Manager</title>
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
            .border {

                border: 1px solid #000;
                padding: 10px;
            }
            .color {
                color: blue;
            }
        </style>
    </head>
    <body>

        <div class="container" style="border:4px solid blue ; margin-top:20px; height:1000px;">
            <?php
            if (isset($_GET['id'])) {
                //echo $_GET['id'];
                $id = $_GET['id'];

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
                        <div class="col-xs-4 text-left"><b>&emsp;<?php echo $sqlbranch['BranchName']; ?></b><br></div>
                        <div class="col-xs-4 text-center"><b>&nbsp; Form Letter</b></div>
                        <div class="col-xs-4 text-right"><p><b> Date: </b><?php echo date("d-m-Y"); ?>&emsp;</p></div>
                    </div>
                </div>

                <div class="row">

                    <p style="background-color:blue; color:white;text-align:center;padding:10px;"><b>Fixed Deposit Certificate</b></p>

                </div><br>
    <?php
    $sqlfd = mysql_query("SELECT customer.CustomerName, fdaccount.*, branch.BranchName FROM fdaccount
                                        INNER JOIN customer ON customer.CustomerID=fdaccount.CustomerID 
                                        INNER JOIN branch ON branch.BranchId=fdaccount.BranchId 
                                        WHERE FDId='" . $id . "' ") or die(mysql_error());
    while ($fd = mysql_fetch_array($sqlfd)) {
        ?>

                    <div class="col-xs-12" style="border-bottom:3px solid blue;">
                        <div class="row" style="padding:10px;">
                            <div class="col-xs-6">
                                <b>FD Account No  :</b>  <?php echo $fd['FdNo']; ?>
                            </div>
                            <div class="col-xs-6">
                                <b> Print Date  : </b><?php echo date("d-m-Y"); ?>
                            </div>
                        </div>
                        <div class="row" style="padding:10px;">
                            <div class="col-xs-6">
                                <b>Customer Name  : </b><?php echo $fd['CustomerName']; ?>
                            </div>
                            <div class="col-xs-6">
                                <b>Customer ID  : </b><?php echo $fd['CustomerID']; ?>
                            </div>
                        </div>
                        <div class="row" style="padding:10px;">
                            <div class="col-xs-6">
                                <b>FD Amount  : </b><?php echo $fd['FDAmount']; ?>
                            </div>
                            <div class="col-xs-6">
                                <b>Maturity Amount  : </b><?php echo $fd['MaturityAmount']; ?>
                            </div>
                        </div>
                        <div class="row" style="padding:10px;">
                            <div class="col-xs-6">
                                <b>FD Date  : </b><?php echo date('d-m-Y', strtotime($fd['FDDate'])); ?>
                            </div>
                            <div class="col-xs-6">
                                <b>Maturity Date  : </b><?php echo date('d-m-Y', strtotime($fd['MaturityDate'])); ?>
                            </div>
                        </div>
                        <div class="row" style="padding:10px;">
                            <div class="col-md-6">
                                <b>Interest in %  : </b><?php echo $fd['Interest']; ?>
                            </div>
                            <div class="col-md-6">
                                <b>Branch Name : </b><?php echo $fd['BranchName']; ?>
                            </div>
                        </div>
                        <div class="row" style="padding:10px;">
                            <div class="col-xs-6" >
                                <b>Duration in Days  : </b><?php echo $fd['Duration']; ?> 
                            </div>
                        </div>
                    </div><?php } ?>
<?php } ?>

            <div class="row" >
                <div class="col-xs-8">
                </div>
                <div class="col-xs-4">
                    <br><br><br><br>
                    <p style=" margin-top:60px;color:blue; ">Authority Seal And Stamp</p>
                </div>
            </div>
        </div>
    </body>
</html>