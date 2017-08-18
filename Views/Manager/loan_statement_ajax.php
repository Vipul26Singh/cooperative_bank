<?php
include '../superadmin-session.php';


$sqlname = mysql_fetch_array(mysql_query("SELECT loantransaction.*, customer.CustomerName FROM `loantransaction` 
		INNER JOIN customer ON customer.CustomerID = loantransaction.CustomerID 
		WHERE LoanNumber = '" . $_POST['loanno'] . "' "));
?>  
<form method="post" action="">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-list"></i> Loan Transactions</h3>
        </div>
        <div class="box-body">               
            <div class="col-md-12">
                <table class="table table-responsive table-condensed table-striped table-hover table-bordered">
                    <thead>
                        <tr>  
                            <th>Loan No</th>
                            <th>Customer Name</th>
                            <th>Deposit Date</th>
                            <th>Amount</th>
                            <th>Transaction Type</th>
                            <th>Principal</th>
                            <th>Interest Amount </th>
                            <th>Installment Date</th>
                            <th>Print</th>                   
                        </tr>
                    </thead>

                    <?php
                    $startdate = date('Y-m-d', strtotime($_POST['trasaction_date']));
                    $enddate = date('Y-m-d', strtotime($_POST['trasaction_end_date']));

                    /*                     * * Account no and transaction date and transaction mode ** */
                    if ($_POST['loanno'] && $_POST['trasaction_date'] && $_POST['trasaction_end_date'] && $_POST['trasaction_mode']) {

                        $sqlaccount = mysql_query("SELECT * FROM loantransaction WHERE LoanNumber='" . $_POST['loanno'] . "' 
                                            AND (DepositDate BETWEEN '" . $startdate . "' AND '" . $enddate . "') 
                                            AND TransactionType='" . $_POST['trasaction_mode'] . "' ");

                        while ($row = mysql_fetch_array($sqlaccount)) {
                            $sqlbranch = mysql_fetch_array(mysql_query("SELECT * from  customer where CustomerID='" . $row['CustomerID'] . "' "));
                            ?>
                            <tr>
                                <td><?php echo $row['LoanNumber']; ?></td>
                                <td><?php echo $sqlbranch['CustomerName']; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($row['DepositDate'])); ?></td>
                                <td><?php echo $row['Amount']; ?></td>
                                <td><?php echo $row['TransactionType']; ?></td>
                                <td><?php echo $row['principal']; ?></td>
                                <td><?php echo $row['interestamount']; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($row['installment_date'])); ?></td>
                                <td><a href='loan_receipt.php?id=<?php echo $row['CustomerID'] ?>&LoanNumber=<?php echo $row['LoanNumber'] ?>&CustomerName=<?php echo $sqlbranch['CustomerName'] ?>&DepositDate=<?php echo $row['DepositDate'] ?>&Amount=<?php echo $row['Amount'] ?>&TransactionType=<?php echo $row['TransactionType'] ?>&principal=<?php echo $row['principal'] ?>&interestamount=<?php echo $row['interestamount'] ?>&installment_date=<?php echo $row['installment_date'] ?>' ><span class='badge bg-yellow'><i class='fa fa-print'></i>Print</span></a></td> 
                            </tr>
    <?php
    }
}
/* * * Display Acc no and date * */ else if ($_POST['loanno'] && $_POST['trasaction_date'] && $_POST['trasaction_end_date']) {

    $sqlaccount1 = mysql_query("SELECT * FROM  loantransaction WHERE LoanNumber='" . $_POST['loanno'] . "' 
                                            AND (DepositDate BETWEEN '" . $startdate . "' AND '" . $enddate . "') 
                                            OR TransactionType='" . $_POST['trasaction_mode'] . "' 
                                             ");

    while ($row = mysql_fetch_array($sqlaccount1)) {
        $sqlbranch = mysql_fetch_array(mysql_query("SELECT * from  customer where CustomerID='" . $row['CustomerID'] . "' "));
        ?>
                            <tr>
                                <td><?php echo $row['LoanNumber']; ?></td>
                                <td><?php echo $sqlbranch['CustomerName']; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($row['DepositDate'])); ?></td>
                                <td><?php echo $row['Amount']; ?></td>
                                <td><?php echo $row['TransactionType']; ?></td>
                                <td><?php echo $row['principal']; ?></td>
                                <td><?php echo $row['interestamount']; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($row['installment_date'])); ?></td>
                                <td><a href='loan_receipt.php?id=<?php echo $row['CustomerID'] ?>&LoanNumber=<?php echo $row['LoanNumber'] ?>&CustomerName=<?php echo $sqlbranch['CustomerName'] ?>&DepositDate=<?php echo $row['DepositDate'] ?>&Amount=<?php echo $row['Amount'] ?>&TransactionType=<?php echo $row['TransactionType'] ?>&principal=<?php echo $row['principal'] ?>&interestamount=<?php echo $row['interestamount'] ?>&installment_date=<?php echo $row['installment_date'] ?>' ><span class='badge bg-yellow'><i class='fa fa-print'></i>Print</span></a></td> 
                            </tr>
    <?php
    }
}
/* * * Account no and cash *** */ else if ($_POST['loanno'] && $_POST['trasaction_mode']) {
    $sqlaccount2 = mysql_query("SELECT * FROM loantransaction WHERE LoanNumber='" . $_POST['loanno'] . "' 
                                            AND TransactionType='" . $_POST['trasaction_mode'] . "' ");

    while ($row = mysql_fetch_array($sqlaccount2)) {

        $sqlbranch = mysql_fetch_array(mysql_query("SELECT * from  customer where CustomerID='" . $row['CustomerID'] . "'  "));
        ?>
                            <tr>
                                <td><?php echo $row['LoanNumber']; ?></td>
                                <td><?php echo $sqlbranch['CustomerName']; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($row['DepositDate'])); ?></td>
                                <td><?php echo $row['Amount']; ?></td>
                                <td><?php echo $row['TransactionType']; ?></td>
                                <td><?php echo $row['principal']; ?></td>
                                <td><?php echo $row['interestamount']; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($row['installment_date'])); ?></td>
                                <td><a href='loan_receipt.php?id=<?php echo $row['CustomerID'] ?>&LoanNumber=<?php echo $row['LoanNumber'] ?>&CustomerName=<?php echo $sqlbranch['CustomerName'] ?>&DepositDate=<?php echo $row['DepositDate'] ?>&Amount=<?php echo $row['Amount'] ?>&TransactionType=<?php echo $row['TransactionType'] ?>&principal=<?php echo $row['principal'] ?>&interestamount=<?php echo $row['interestamount'] ?>&installment_date=<?php echo $row['installment_date'] ?>' ><span class='badge bg-yellow'><i class='fa fa-print'></i>Print</span></a></td> 
                            </tr>
    <?php
    }
}
/* * * Account No ** */ else if ($_POST['loanno'] && empty($_POST['trasaction_date'] && $_POST['trasaction_end_date'] && $_POST['trasaction_mode'])) {
    $sqlaccount = mysql_query("SELECT * FROM  loantransaction WHERE LoanNumber='" . $_POST['loanno'] . "' 
                                            OR (DepositDate BETWEEN '" . $startdate . "' AND '" . $enddate . "') 
                                            OR TransactionType='" . $_POST['trasaction_mode'] . "' ") or die(mysql_error());

    while ($row = mysql_fetch_array($sqlaccount)) {
        $sqlbranch = mysql_fetch_array(mysql_query("SELECT * from  customer where CustomerID='" . $row['CustomerID'] . "' "));
        ?>
                            <tr>
                                <td><?php echo $row['LoanNumber']; ?></td>
                                <td><?php echo $sqlbranch['CustomerName']; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($row['DepositDate'])); ?></td>
                                <td><?php echo $row['Amount']; ?></td>
                                <td><?php echo $row['TransactionType']; ?></td>
                                <td><?php echo $row['principal']; ?></td>
                                <td><?php echo $row['interestamount']; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($row['installment_date'])); ?></td>
                                <td><a href='loan_receipt.php?id=<?php echo $row['CustomerID'] ?>&LoanNumber=<?php echo $row['LoanNumber'] ?>&CustomerName=<?php echo $sqlbranch['CustomerName'] ?>&DepositDate=<?php echo $row['DepositDate'] ?>&Amount=<?php echo $row['Amount'] ?>&TransactionType=<?php echo $row['TransactionType'] ?>&principal=<?php echo $row['principal'] ?>&interestamount=<?php echo $row['interestamount'] ?>&installment_date=<?php echo $row['installment_date'] ?>' ><span class='badge bg-yellow'><i class='fa fa-print'></i>Print</span></a></td> 
                            </tr>
    <?php
    }
}
?>  </table> 
            </div>  
        </div>
        <div class="box-footer text-center">
            <button type="button" name="submit" class="btn btn-primary" value="Print" onclick="accountdetails()"><i class="fa fa-print"></i> Print</button> 				
        </div>

    </div>
</form>

<div id="loaninfo" ></div>

<script type="text/javascript">
    function accountdetails()
    {

        var loanno = $("#loanno").val();
        var trasaction_date = $("#trasactiondate").val();
        var trasaction_mode = $("#trasactionmode").val();
        var trasaction_end_date = $("#trasactionenddate").val();
        //dataString = 'loanno='+ loanno + '&trasactionmode=' + trasaction_mode + '&trasactiondate='+ trasaction_date + '&trasactionenddate=' + trasaction_end_date;
        window.open("loan_statement_print_ajax.php?loanno=" + loanno + "&trasactiondate=" + trasaction_date + "&trasactionmode=" + trasaction_mode + "&trasactionenddate=" + trasaction_end_date);
    }
</script>



