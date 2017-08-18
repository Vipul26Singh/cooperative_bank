<?php
include '../superadmin-session.php';

$sqlaccount = mysql_fetch_array(mysql_query("SELECT * from  bankaccount where  accountNo='" . $_POST['val'] . "'  "));
$sqlbranch = mysql_fetch_array(mysql_query("SELECT * from  customer where CustomerID='" . $sqlaccount['CustomerID'] . "'  "));

$sqlaccounttype = mysql_fetch_array(mysql_query("SELECT * from  accounttype where  AccountTypeid='" . $sqlaccount['AccountTypeid'] . "'  "));


$datacount = count($sqlaccount['accountNo']);
if ($datacount == 1) {
    ?>

    <div class="col-md-2">  
        <div class="form-group">
            <label>Photo/Signature</label>
        </div>
    </div>
    <div class="col-md-4">  
        <div class="form-group">
            <?php echo '<img src="../upload/' . $sqlbranch['mphoto'] . '" style="width:100px; height:100px" />' ?>
            <?php echo '<img src="../upload/' . $sqlbranch['CSign'] . '" style="width:100px; height:100px" />' ?>
        </div>			   
    </div>
    <div class="col-md-2">
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
            <input type="text" name="Customer ID"  id="Customer ID" class="form-control" value="<?php echo $sqlbranch['CustomerID'] ?>" readonly="">
        </div>
    </div>
    <div class="col-md-2" >
        <div class="form-group">
            <label>Mobile No.</label>
        </div>
    </div>
    <div class="col-md-4">  
        <div class="form-group">
            <input type="text" name="MobileNo"  id="MobileNo" class="form-control" value="<?php echo $sqlbranch['MobileNo'] ?>" readonly="" >
        </div>
    </div>

    <div class="col-md-2" >
        <div class="form-group">
            <label> Account Type</label>
        </div>
    </div>
    <div class="col-md-4">  
        <div class="form-group">
            <input type="text" name="CustomerName"  id="CustomerName" class="form-control" value="<?php echo $sqlaccounttype['Type'] ?>" readonly="" >
        </div>
    </div>

    <div class="col-md-2" >
        <div class="form-group">
            <label>Account Open Date</label>
        </div>
    </div>
    <div class="col-md-4" >
        <div class="form-group">
            <input type="text" name="CustomerName"  id="CustomerName" class="form-control" value="<?php echo date('d-m-Y', strtotime($sqlaccount['OpenDate'])); ?>"  readonly="">
        </div>
    </div>

    <div class="col-md-2" >
        <div class="form-group">
            <label>Balance Amount</label>
        </div>
    </div>
    <div class="col-md-4">  
        <div class="form-group">
            <input type="text" name="Balance" readonly="" id="Balance" class="form-control" value="<?php echo $sqlaccount['Balance'] ?>" >
        </div>
    </div>
<?php
} else {
    ?><script>alert("Account number should not be empty.")</script><?php
}
?>
