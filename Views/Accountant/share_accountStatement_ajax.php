<?php
include '../superadmin-session.php';
error_reporting(0);
/*   print_r("SELECT * FROM  sharetransaction WHERE ShareAccountNo='".$_POST['shareno']."' 
  AND (TransactionDate BETWEEN '".$startdate."' AND '".$enddate."') and BranchId='".$_SESSION['branch_id']."'
  AND Transactionmode='".$_POST['trasactionmode']."' "); exit;
 */
?>    <div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-list"></i> Share Transactions</h3>
    </div>

    <div class="box-body">               
        <div class="col-md-12">
            <table class="table table-responsive table-condensed table-striped table-hover table-bordered">
                <thead>
                    <tr>  
                        <th>Share Account No</th>
                        <th>Customer Name</th>
                        <th>Transaction Date</th>
                        <th>Transaction Type</th>
                        <th>Withdraw</th>
                        <th>Deposit </th>
                        <th>Transaction Mode</th>
                        <th>Share Balance </th>
                    </tr>
                </thead>

                <?php
                $startdate = date('Y-m-d', strtotime($_POST['trasactiondate']));
                $enddate = date('Y-m-d', strtotime($_POST['trasactionenddate']));

                /*                 * * Account no and transaction date and transaction mode ** */

                if ($_POST['shareno'] && $_POST['trasactiondate'] && $_POST['trasactionenddate'] && $_POST['trasactionmode']) {
                    $sqlaccount = mysql_query("SELECT * FROM  sharetransaction WHERE ShareAccountNo='" . $_POST['shareno'] . "' 
                                            AND (TransactionDate BETWEEN '" . $startdate . "' AND '" . $enddate . "') and BranchId='" . $_SESSION['branch_id'] . "' 
                                            AND Transactionmode='" . $_POST['trasactionmode'] . "' ");

                    while ($row = mysql_fetch_array($sqlaccount)) {
                        $sqlbranch = mysql_fetch_array(mysql_query("SELECT * from  customer where CustomerID='" . $row['CustomerID'] . "' "));
                        ?>
                        <tr>
                            <td><?php echo $row['ShareAccountNo']; ?></td>
                            <td><?php echo $sqlbranch['CustomerName']; ?></td>
                            <td><?php echo date('d-m-Y', strtotime($row['TransactionDate'])); ?></td>
                            <td><?php echo $row['TransactionType']; ?></td>
                            <td><?php echo $row['Withdraw']; ?></td>
                            <td><?php echo $row['Deposit']; ?></td>
                            <td><?php echo $row['Transactionmode']; ?></td>
                            <td><?php echo $row['BalanceShare']; ?></td>
                        </tr>
                    <?php
                    }
                }
                /*                 * * Display Acc no and date * */ else if ($_POST['shareno'] && $_POST['trasactiondate'] && $_POST['trasactionenddate']) {

                    $sqlaccount1 = mysql_query("SELECT * FROM  sharetransaction WHERE ShareAccountNo='" . $_POST['shareno'] . "' 
                                            AND (TransactionDate BETWEEN '" . $startdate . "' AND '" . $enddate . "') and BranchId='" . $_SESSION['branch_id'] . "'");

                    while ($row = mysql_fetch_array($sqlaccount1)) {
                        $sqlbranch = mysql_fetch_array(mysql_query("SELECT * from  customer where CustomerID='" . $row['CustomerID'] . "' "));
                        ?>
                        <tr>
                            <td><?php echo $row['ShareAccountNo']; ?></td>
                            <td><?php echo $sqlbranch['CustomerName']; ?></td>
                            <td><?php echo date('d-m-Y', strtotime($row['TransactionDate'])); ?></td>
                            <td><?php echo $row['TransactionType']; ?></td>
                            <td><?php echo $row['Withdraw']; ?></td>
                            <td><?php echo $row['Deposit']; ?></td>
                            <td><?php echo $row['Transactionmode']; ?></td>
                            <td><?php echo $row['BalanceShare']; ?></td>
                        </tr>
    <?php
    }
}
/* * * Account no and cash *** */ else if ($_POST['shareno'] && $_POST['trasactionmode']) {

    $sqlaccount2 = mysql_query("SELECT * FROM  sharetransaction WHERE ShareAccountNo='" . $_POST['shareno'] . "' AND Transactionmode='" . $_POST['trasactionmode'] . "' and BranchId='" . $_SESSION['branch_id'] . "' ");
    // print_r("SELECT * FROM  sharetransaction WHERE ShareAccountNo='".$_POST['shareno']."' 
    //AND Transactionmode='".$_POST['trasactionmode']."' and BranchId='".$_SESSION['branch_id']."' ");

    while ($row = mysql_fetch_array($sqlaccount2)) {


        $sqlbranch = mysql_fetch_array(mysql_query("SELECT * from  customer where CustomerID='" . $row['CustomerID'] . "'  "));
        ?>
                        <tr>
                            <td><?php echo $row['ShareAccountNo']; ?></td>
                            <td><?php echo $sqlbranch['CustomerName']; ?></td>
                            <td><?php echo date('d-m-Y', strtotime($row['TransactionDate'])); ?></td>
                            <td><?php echo $row['TransactionType']; ?></td>
                            <td><?php echo $row['Withdraw']; ?></td>
                            <td><?php echo $row['Deposit']; ?></td>
                            <td><?php echo $row['Transactionmode']; ?></td>
                            <td><?php echo $row['BalanceShare']; ?></td>
                        </tr>
    <?php
    }
}
/* * * Account No ** */ else if ($_POST['shareno'] && empty($_POST['trasactiondate'] && $_POST['trasactionenddate'] && $_POST['trasactionmode'])) {

    $sqlaccount = mysql_query("SELECT * FROM  sharetransaction WHERE ShareAccountNo='" . $_POST['shareno'] . "' ");

    while ($row = mysql_fetch_array($sqlaccount)) {

        $sqlbranch = mysql_fetch_array(mysql_query("SELECT * from  customer where CustomerID='" . $row['CustomerID'] . "' "));
        ?>
                        <tr>
                            <td><?php echo $row['ShareAccountNo']; ?></td>
                            <td><?php echo $sqlbranch['CustomerName']; ?></td>
                            <td><?php echo date('d-m-Y', strtotime($row['TransactionDate'])); ?></td>
                            <td><?php echo $row['TransactionType']; ?></td>
                            <td><?php echo $row['Withdraw']; ?></td>
                            <td><?php echo $row['Deposit']; ?></td>
                            <td><?php echo $row['Transactionmode']; ?></td>
                            <td><?php echo $row['BalanceShare']; ?></td>
                        </tr>
    <?php
    }
}
?>  </table> 
        </div>  
    </div>
    <div class="box-footer text-center">
        <button type="button" class="btn btn-primary" onclick="accountdetails1()"><i class="fa fa-print"></i> Print</button>				
    </div>

</div>

<script type="text/javascript">
    function accountdetails1()
    {

        var shareno = $("#shareno").val();
        var trasaction_date = $("#trasactiondate").val();
        var trasaction_mode = $("#trasactionmode").val();
        var trasaction_end_date = $("#trasactionenddate").val();
        //dataString = 'shareno='+ shareno + '&trasaction_date='+ trasaction_date + '&trasaction_mode='+ trasaction_mode + '&trasaction_end_date=' + trasaction_end_date;
        // alert(dataString);

        window.open("share_statement_print_ajax.php?shareno=" + shareno + "&trasactiondate=" + trasaction_date + "&trasactionmode=" + trasaction_mode + "&trasactionenddate=" + trasaction_end_date);
    }
</script>


