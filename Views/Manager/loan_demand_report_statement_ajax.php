<?php
include '../superadmin-session.php';

//echo $_POST['trasaction_date'];
//echo $_POST['trasaction_end_date'];
?>


<form method="post" action="">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-list"></i> Loan Demand List</h3>
        </div>

        <div class="box-body">               
            <div class="col-md-12">
                <table class="table table-responsive table-condensed table-striped table-hover table-bordered">
                    <thead>
                        <tr>  
                            <th>Customer ID</th>
                            <th>Customer Name</th>

                            <th>Loan Date</th>
                            <th>Loan Amount</th>
                            <th>Loan No</th>
                            <th>Loan Type</th>
                            <th>Installment Amount</th>
                            <th>Installment Date</th>                 
                        </tr>
                    </thead>

                    <?php
                    $startdate = date('Y-m-d', strtotime($_POST['trasactiondate']));
                    $enddate = date('Y-m-d', strtotime($_POST['trasactionenddate']));

                    $sqlname = mysql_query("SELECT loan.*,customer.CustomerName FROM loan
                                INNER JOIN customer ON customer.CustomerID=loan.CustomerID 
                                WHERE Status='active' AND
                                EXTRACT(DAY FROM loan.FirstInstallmentDate) BETWEEN EXTRACT(DAY FROM '" . $startdate . "') and EXTRACT(DAY FROM '" . $enddate . "') and (loan.FirstInstallmentDate <= '" . $enddate . "')
                                ORDER BY loan.CustomerID") or die(mysql_error());

                    while ($row = mysql_fetch_array($sqlname)) {
                        $p = $row['Amount'];
                        $rate = $row['Interestrate'];
                        $n = $row['Durationinmonth'];
                        $r = $rate / 1200;
                        $formula = ($p * $r * (pow(1 + $r, $n))) / ((pow(1 + $r, $n)) - 1);
                        $installment_amount = round($formula, 2);
                        $date = date('d-m-Y', strtotime($row['FirstInstallmentDate']));
                        $maturitydate = date('d-m-Y', strtotime($date . "+1 months"));
                        echo "<tr>";
                        echo "<td>" . $row['CustomerID'] . "</td>"
                        . "<td>" . $row['CustomerName'] . "</td>"
                        //. "<td>".$row['accountNo']."</td>" 
                        . "<td>" . date('d-m-Y', strtotime($row['LoanDate'])) . "</td>"
                        . "<td>" . $row['Amount'] . "</td>"
                        . "<td>" . $row['LoanNumber'] . "</td>"
                        . "<td>" . $row['Type'] . "</td>"
                        . "<td>" . $installment_amount . "</td>"
                        . "<td>" . date('d-m-Y', strtotime($row['FirstInstallmentDate'])) . "</td>"
                        //. "<td>".date('d-m-Y',strtotime($row['FirstInstallmentDate']))."</td>"
                        . "</tr>";
                    }
                    ?>  </table> <?php
                    /* if(mysql_num_rows($sqlname) == 0) {
                      echo 'Customer Loan List are not avialable.';
                      } */
                    ?>
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
        var trasactiondate = $("#trasactiondate").val();
        var trasactionenddate = $("#trasactionenddate").val();
        //dataString = 'lanno='+ loanno + '&trasactionmode=' + trasaction_mode + '&trasactiondate='+ trasaction_date + '&trasactionenddate=' + trasaction_end_date;
        window.open("demand_report.php?trasactiondate=" + trasactiondate + "&trasactionenddate=" + trasactionenddate);
    }
</script>



