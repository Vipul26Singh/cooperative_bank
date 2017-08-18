<?php
include '../superadmin-session.php';
error_reporting(0);

$sqlaccount = mysql_fetch_array(mysql_query("SELECT * from  shareaccount where  ShareAccountNo='" . $_POST['val'] . "'  "));
$sqlbranch = mysql_fetch_array(mysql_query("SELECT * from  customer where CustomerID='" . $sqlaccount['CustomerID'] . "'  "));
$datacount = count($sqlaccount['ShareAccountNo']);

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
            <label>Customer ID</label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <input type="text" class="form-control" name="CustomerID" value="<?php echo $sqlbranch['CustomerID']; ?>" readonly>
        </div> 
    </div>

    <div class="col-md-2">          
        <div class="form-group">
            <label>Customer Name</label>
        </div>
    </div>
    <div class="col-md-4">          
        <div class="form-group">
            <input type="text" class="form-control" value="<?php echo $sqlbranch['CustomerName']; ?>" readonly >
        </div> 
    </div>
    <div class="col-md-2"> 
        <div class="form-group">
            <label>Account Balance</label>
        </div>
    </div>
    <div class="col-md-4"> 
        <div class="form-group">
            <input type="text" class="form-control" id="available" value="<?php echo $sqlaccount['Balance']; ?>" readonly >
        </div>
    </div>

    <div class="col-md-2"> 
        <div class="form-group">
            <label>Account Open Date </label>
        </div>
    </div>
    <div class="col-md-4"> 
        <div class="form-group">
            <input type="text" class="form-control" value="<?php echo date('d-m-Y', strtotime($sqlbranch['Approvaldate'])); ?>" readonly>
        </div>
    </div> 
    <div class="col-md-2"> 
        <div class="form-group">
            <label>Mobile No </label>
        </div>
    </div>
    <div class="col-md-4"> 
        <div class="form-group">
            <input type="text" class="form-control" value="<?php echo $sqlbranch['MobileNo']; ?>" readonly>
        </div>
    </div>

<?php } else {
    ?><script>alert("Share Account No is empty.")</script><?php }
?>           



