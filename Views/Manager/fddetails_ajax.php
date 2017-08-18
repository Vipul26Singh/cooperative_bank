<?php
include '../superadmin-session.php';

$sqlaccount = mysql_fetch_array(mysql_query("SELECT * from fdaccount  where  FdNo='" . $_POST['val'] . "'  "));
$sqlbranch = mysql_fetch_array(mysql_query("SELECT * from  customer where CustomerID='" . $sqlaccount['CustomerID'] . "'  "));

$datacount = count($sqlaccount['FdNo']);


$sqlFDtrans = mysql_fetch_array(mysql_query("SELECT WithdrawDate from  fdaccount where FdNo='" . $_POST['val'] . "' and WithdrawDate IS NULL "));
?>
<?php if ($datacount == 1) {
    ?>
    <div class="box box-primary" >
        <div class="box-body"> 
            <div class="col-md-2">  
                <div class="form-group">
                    <label>Photo/Signature</label>
                </div>
            </div>
            <div class="col-md-4">  
                <div class="form-group">
    <?php echo '<img src="../upload/' . $sqlbranch['mphoto'] . '" id="userphoto" style="width:100px; height:100px" />' ?>
    <?php echo '<img src="../upload/' . $sqlbranch['CSign'] . '" id="usersign" style="width:100px; height:100px" />' ?>
                </div>			   
            </div>
            <div class="col-md-2" >
                <div class="form-group">
                    <label> Customer Name</label>
                </div>
            </div>
            <div class="col-md-4">  
                <div class="form-group">
                    <input type="text" name="CustomerName"  id="CustomerName" class="form-control" value="<?php echo $sqlbranch['CustomerName'] ?>" readonly="">
                </div>
            </div>
            <div class="col-md-2" >
                <div class="form-group">
                    <label> Customer ID</label>
                </div>
            </div>
            <div class="col-md-4">  
                <div class="form-group">
                    <input type="text" name="CustomerID"  id="CustomerID" class="form-control" value="<?php echo $sqlbranch['CustomerID'] ?>" readonly="">
                </div>
            </div>
            <div class="col-md-2" >
                <div class="form-group">
                    <label>Mobile No.</label>
                </div>
            </div>
            <div class="col-md-4">  
                <div class="form-group">
                    <input type="text" name="MobileNo"  id="MobileNo" readonly="" class="form-control" value="<?php echo $sqlbranch['MobileNo'] ?>"  >
                </div>
            </div>
            <div class="col-md-2" >
                <div class="form-group">
                    <label>FD Amount</label>
                </div>
            </div>
            <div class="col-md-4" >
                <div class="form-group">
                    <input type="text" name="FDAmount" readonly="" id="FDAmount" class="form-control" value=<?php echo $sqlaccount['FDAmount'] ?> >
                </div>
            </div>
            <div class="col-md-2" >
                <div class="form-group">
                    <label>Duration In Days</label>
                </div>
            </div>
            <div class="col-md-4" >
                <div class="form-group">
                    <input type="text" name="Duration" readonly="" id="Duration" class="form-control" value=<?php echo $sqlaccount['Duration'] ?> >
                </div>
            </div>
            <div class="col-md-2" >
                <div class="form-group">
                    <label>Maturity Date</label>
                </div>
            </div>
            <div class="col-md-4" >
                <div class="form-group">
                    <input type="text" name="MaturityDate" readonly="" id="MaturityDate" class="form-control" value="<?php echo date('d-m-Y', strtotime($sqlaccount['MaturityDate'])) ?>" >
                </div>
            </div>
            <div class="col-md-2" >
                <div class="form-group">
                    <label>Maturity Amount</label>
                </div>
            </div>
            <div class="col-md-4" >
                <div class="form-group">
                    <input type="text" name="MaturityAmount" readonly="" id="MaturityAmount" class="form-control" value="<?php echo $sqlaccount['MaturityAmount'] ?>" >
                </div>
            </div>
        </div>
    </div>
    <?php if ($sqlFDtrans != '') { ?>
        <div class="box box-primary" >
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-bank"></i> FD Transaction</h3>
            </div>
            <div class="box-body"> 
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Transaction Type</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text"  name="TransactionType" id="TransactionType" class="form-control" value="<?php echo 'Withdraw'; ?>" readonly="true" >
                    </div>       
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Amount</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
        <?php
        if (date("Y-m-d") >= $sqlaccount['MaturityDate']) {
            $amount = $sqlaccount['MaturityAmount'];
        } else {
            $amount = $sqlaccount['FDAmount'];
        }
        ?>
                        <input type="text" name="Amountnew" id="Amountnew" class="form-control" value="<?php echo $amount; ?>" readonly  onload="calculation(this.value)" >
                    </div>  
                </div> 
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Transaction Mode</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text"  name="Transactionmode" id="Transactionmode" class="form-control" value="<?php echo 'Cash'; ?>" readonly="true" >
                    </div>
                </div>
                <div class="col-md-2" >
                    <div class="form-group">
                        <label>Transaction Date</label>
                    </div>
                </div>
                <div class="col-md-4" >
                    <div class="form-group">
                        <input type="text"  name="TransactionDate" id="TransactionDate" class="form-control" value="<?php echo date("d-m-Y"); ?>" readonly="true" >
                    </div>
                </div>
                <div class="col-md-2" >
                    <div class="form-group">
                        <label>Remarks</label>
                    </div>
                </div>
                <div class="col-md-4" >
                    <div class="form-group">
                        <input type="text" name="Remarknew" id="Remarknew"  class="form-control"  >
                    </div>
                </div>
            </div>

            <div class="box-footer text-center">
                <input type="button" name="submit" class="btn btn-primary" value="Submit" onclick="userinfo();"></button>
            </div>   
        </div>
    <?php } else { ?>



        <div class="box box-primary" >
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-bank"></i> FD Transaction</h3>
            </div>
            <div class="box-body"> 
                <div class="col-md-6">
                    <div class="form-group">
                        <h4>Your FD is withdraw .</h4>
                    </div>
                </div>

            </div>
        </div>

        <?php
    }
} else {

    echo "2";
}
?>
<script type="text/javascript">
    function userinfo()
    {
        var userphoto = $('#userphoto').val();
        var usersign = $('#usersign').val();
        var CName = $('#CustomerName').val();
        var CustomerID = $('#CustomerID').val();
        var MobileNo = $('#MobileNo').val();
        var FDAmount = $('#FDAmount').val();
        var Duration = $('#Duration').val();
        var TransactionType = $('#TransactionType').val();
        var Amountnew = $('#Amountnew').val();
        var Transactionmode = $('#Transactionmode').val();
        var TransactionDate = $('#TransactionDate').val();
        var Remarknew = $('#Remarknew').val();
        var FdNo = $('#FdNo').val();

        dataString = 'userphoto=' + userphoto + '&usersign=' + usersign + '&CustomerName=' + CName
                + '&CustomerID=' + CustomerID + '&MobileNo=' + MobileNo + '&FDAmount=' + FDAmount + '&Duration=' + Duration
                + '&MaturityDate=' + MaturityDate + '&MaturityAmount=' + MaturityAmount
                + '&TransactionType=' + TransactionType + '&Amountnew=' + Amountnew + '&Transactionmode=' + Transactionmode
                + '&TransactionDate=' + TransactionDate
                + '&Remarknew=' + Remarknew + '&FdNo=' + FdNo;

        $.ajax({url: 'fdamount_ajax1.php',
            data: dataString,
            type: 'post',
            success: function (output)
            {
                //alert(output);
                var json_data = JSON.parse(output);

                if (json_data['result'] == 2)
                {
                    alert("Your FD is Withdraw");
                    window.location = "fd_transaction.php";
                    return false;
                }
                if (json_data['result'] == 1)
                    ;
                {
                    if (confirm('You dont get the maturity amount before maturity date.. Are you confirm,you want to withdraw your FD Amonut before maturity date?'))
                    {
                        var cid = json_data['cid'];
                        var fdno = json_data['fdno'];
                        var Amountnew = json_data['Amountnew'];
                        var Remarknew = json_data['Remarknew'];
                        var TransactionType = json_data['TransactionType'];
                        var Transactionmode = json_data['Transactionmode'];
                        dataString = 'cid=' + cid + '&fdno=' + fdno + '&Amountnew=' + Amountnew + '&Remarknew=' + Remarknew + '&TransactionType=' + TransactionType + '&Transactionmode=' + Transactionmode;

                        $.ajax({
                            url: 'fdamount_ajax_ok.php',
                            data: dataString,
                            type: 'post',
                            success: function (output)
                            {
                                window.location = "fd_transaction.php";
                                return false;
                            }
                        });
                    }


                }








            }

        });
    }
</script>


