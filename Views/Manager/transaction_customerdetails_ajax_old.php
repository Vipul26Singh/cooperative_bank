<?php
include '../superadmin-session.php';

$sqlaccount = mysql_fetch_array(mysql_query("SELECT * from  shareaccount where  ShareAccountNo='" . $_POST['val'] . "'  "));
$sqlbranch = mysql_fetch_array(mysql_query("SELECT * from  customer where CustomerID='" . $sqlaccount['CustomerID'] . "'  "));
$datacount = count($sqlaccount['ShareAccountNo']);

if ($datacount == 1) {
    ?>
    <div class="col-md-6">  
        <div class="form-group">
            <label>Photo/Signature</label><br>
            <?php echo '<img src="../upload/' . $sqlbranch['mphoto'] . '" style="width:100px; height:100px" />' ?>
            <?php echo '<img src="../upload/' . $sqlbranch['CSign'] . '" style="width:100px; height:100px" />' ?>
        </div>			   
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Customer ID</label>
            <input type="text" class="form-control" name="CustomerID" value="<?php echo $sqlbranch['CustomerID']; ?>" readonly>
        </div> 
    </div>
    <div class="col-md-6">          
        <div class="form-group">
            <label>Customer Name</label>
            <input type="text" class="form-control" value="<?php echo $sqlbranch['CustomerName']; ?>" readonly >
        </div> 
    </div>

    <div class="col-md-6"> 
        <div class="form-group">
            <label>Account Balance</label>
            <input type="text" class="form-control" id="available" value="<?php echo $sqlaccount['Balance']; ?>" readonly >
        </div>
    </div>

    <div class="col-md-6"> 
        <div class="form-group">
            <label>Account Open Date </label>
            <input type="text" class="form-control" value="<?php echo date('d-m-Y', strtotime($sqlbranch['Approvaldate'])); ?>" readonly>
        </div>
    </div> 

    <div class="col-md-6"> 
        <div class="form-group">
            <label>Mobile No </label>
            <input type="text" class="form-control" value="<?php echo $sqlbranch['MobileNo']; ?>" readonly>
        </div>
    </div>

<?php } ?>           



