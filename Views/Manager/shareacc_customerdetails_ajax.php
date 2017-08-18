<?php
include '../superadmin-session.php';

$sqlbranch = mysql_fetch_array(mysql_query("SELECT * from  customer where CustomerID='" . $_POST['val'] . "'  "));
//print_r($sqlbranch['CustomerName']); 
if ($sqlbranch) {
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
            <label>Email ID</label>
        </div>
    </div>
    <div class="col-md-4">  
        <div class="form-group">
            <input type="text" class="form-control" value=<?php echo $sqlbranch['EmailID'] ?> readonly="true" >
        </div>				   
    </div>
    <div class="col-md-2">          
        <div class="form-group">
            <label>Customer Name</label>
        </div>
    </div>
    <div class="col-md-4">  
        <div class="form-group">
            <input type="text" class="form-control" value=<?php echo $sqlbranch['CustomerName'] ?> readonly="true" >
        </div> 
    </div>
    <div class="col-md-2"> 
        <div class="form-group">
            <label>Mobile No </label>
        </div>
    </div>
    <div class="col-md-4">  
        <div class="form-group">
            <input type="text" class="form-control" value=<?php echo $sqlbranch['MobileNo'] ?> readonly="true" >
        </div>
    </div>
    <div class="col-md-2"> 
        <div class="form-group">
            <label>Account Open Date </label>
        </div>
    </div>
    <div class="col-md-4">  
        <div class="form-group">
            <input type="text" class="form-control" value=<?php echo date('d-m-Y', strtotime($sqlbranch['Approvaldate'])); ?> readonly >
        </div>
    </div>     

<?php } else {
    ?><script>alert("CustomerID Should not be empty")</script> <?php }
?>            

