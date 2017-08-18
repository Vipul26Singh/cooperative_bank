<?php
include '../superadmin-session.php';



$saving = mysql_fetch_array(mysql_query("SELECT bankaccount.*, accounttype.* FROM `bankaccount`
                                                   INNER JOIN accounttype ON accounttype.AccountTypeid=bankaccount.AccountTypeid
                                                   WHERE Type='Saving' AND CustomerID='" . $_POST['val'] . "' AND BranchId='" . $_SESSION['branch_id'] . "' "));
$count = count($saving['Type']);

if ($count == 0) {
    ?><script>alert("You do not have Saving Account")</script><?php
} else {

    $sqlbranch = mysql_fetch_array(mysql_query("SELECT * from  customer where CustomerID='" . $_POST['val'] . "'  "));
    //print_r($sqlbranch['CustomerName']); 
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
            <label>Customer Name</label>
            <input type="text" class="form-control" value="<?php echo $sqlbranch['CustomerName']; ?>" readonly="true" >
        </div> 
    </div>
    <div class="col-md-6"> 
        <div class="form-group">
            <label>Email ID</label>
            <input type="text" class="form-control" value="<?php echo $sqlbranch['EmailID']; ?>" readonly="true" >
        </div>				   
    </div>

    <div class="col-md-6"> 
        <div class="form-group">
            <label>Mobile No </label>
            <input type="text" class="form-control" value="<?php echo $sqlbranch['MobileNo']; ?>" readonly="true" >
        </div>
    </div>

    <div class="col-md-6"> 
        <div class="form-group">
            <label>Account Open Date </label>
            <input type="text" class="form-control" value="<?php echo date('d-m-Y', strtotime($sqlbranch['Approvaldate'])); ?>" readonly >
        </div>
    </div>     

<?php } ?>  


