<?php
include '../superadmin-session.php';


$sqlbranch = mysql_fetch_array(mysql_query("SELECT * from  customer 
          where CustomerID='" . $_POST['val'] . "' 
          and  Approval='approve' 
          and memactive=1 
          and BranchId = '" . $_SESSION['branch_id'] . "' ")) or die(mysql_error());

//$sqlloan = mysql_fetch_array(mysql_query(""))

if ($sqlbranch > 1) {
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
            <input type="date" class="form-control" value=<?php echo $sqlbranch['Approvaldate'] ?> readonly="true" >
        </div>
    </div>     

<?php } else { ?>

    <div > 
        <br> <div >
            Customer application pending, please approve your application
        </div>                 
    </div>

<?php } ?>       

