<?php
include '../superadmin-session.php';

/* echo $_POST['accountno'];
  echo $_POST['trasaction_date'];
  echo $_POST['trasaction_end_date'];
  echo $_POST['trasaction_mode']; */
?>    <div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-list"></i> Bank Transactions</h3>
    </div>

    <div class="box-body">               
        <div class="col-md-12">
            <table class="table table-responsive table-condensed table-striped table-hover table-bordered">
                <thead>
                    <tr>  
                        <th>Account No</th>
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
                $startdate = date('Y-m-d', strtotime($_POST['trasaction_date']));
                $enddate = date('Y-m-d', strtotime($_POST['trasaction_end_date']));

                /*                 * * Account no and transaction date and transaction mode ** */
                if ($_POST['accountno'] && $_POST['trasaction_date'] && $_POST['trasaction_end_date'] && $_POST['trasaction_mode']) {

                    $sqlaccount = mysql_query("SELECT * FROM  bankaccounttransactions WHERE accountNo='" . $_POST['accountno'] . "' 
                                            AND (Transactiondate BETWEEN '" . $startdate . "' AND '" . $enddate . "') 
                                            AND Transactionmode='" . $_POST['trasaction_mode'] . "' ");

                    while ($row = mysql_fetch_array($sqlaccount)) {
                        $sqlbranch = mysql_fetch_array(mysql_query("SELECT * from  customer where CustomerID='" . $row['CustomerID'] . "' "));
                        ?>
                        <tr>
                            <td><?php echo $row['accountNo']; ?></td>
                            <td><?php echo $sqlbranch['CustomerName']; ?></td>
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
/* * * Display Acc no and date * */ else if ($_POST['accountno'] && $_POST['trasaction_date'] && $_POST['trasaction_end_date']) {

    $sqlaccount1 = mysql_query("SELECT * FROM  bankaccounttransactions WHERE accountNo='" . $_POST['accountno'] . "' 
                                            AND (Transactiondate BETWEEN '" . $startdate . "' AND '" . $enddate . "') 
                                                 ");

    while ($row = mysql_fetch_array($sqlaccount1)) {
        $sqlbranch = mysql_fetch_array(mysql_query("SELECT * from  customer where CustomerID='" . $row['CustomerID'] . "' "));
        ?>
                        <tr>
                            <td><?php echo $row['accountNo']; ?></td>
                            <td><?php echo $sqlbranch['CustomerName']; ?></td>
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
/* * * Account no and cash *** */ else if ($_POST['accountno'] && $_POST['trasaction_mode']) {
    $sqlaccount2 = mysql_query("SELECT * FROM  bankaccounttransactions WHERE accountNo='" . $_POST['accountno'] . "' 
                                            AND Transactionmode='" . $_POST['trasaction_mode'] . "' ");

    while ($row = mysql_fetch_array($sqlaccount2)) {

        $sqlbranch = mysql_fetch_array(mysql_query("SELECT * from  customer where CustomerID='" . $row['CustomerID'] . "'  "));
        ?>
                        <tr>
                            <td><?php echo $row['accountNo']; ?></td>
                            <td><?php echo $sqlbranch['CustomerName']; ?></td>
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
/* * * Account No ** */ else if ($_POST['accountno'] && empty($_POST['trasaction_date'] && $_POST['trasaction_end_date'] && $_POST['trasaction_mode'])) {
    $sqlaccount = mysql_query("SELECT * FROM  bankaccounttransactions WHERE accountNo='" . $_POST['accountno'] . "' 
                                             ");

    while ($row = mysql_fetch_array($sqlaccount)) {
        $sqlbranch = mysql_fetch_array(mysql_query("SELECT * from  customer where CustomerID='" . $row['CustomerID'] . "' "));
        ?>
                        <tr>
                            <td><?php echo $row['accountNo']; ?></td>
                            <td><?php echo $sqlbranch['CustomerName']; ?></td>
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

        var accountno = $("#accountno").val();
        var trasaction_date = $("#trasactiondate").val();
        var trasaction_mode = $("#trasactionmode").val();
        var trasaction_end_date = $("#trasactionenddate").val();
        dataString = 'accountno=' + accountno + '&trasactiondate=' + trasaction_date + '&trasactionmode=' + trasaction_mode + '&trasactionenddate=' + trasaction_end_date;
        // alert(dataString);

        window.open("acc_account_statement_print_ajax.php?accountno=" + accountno + "&trasactiondate=" + trasaction_date + "&trasactionmode=" + trasaction_mode + "&trasactionenddate=" + trasaction_end_date);


    }
</script>


