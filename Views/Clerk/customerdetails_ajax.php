<?php
include '../superadmin-session.php';


$sqlbranch = mysql_fetch_array(mysql_query("SELECT * from  customer where CustomerID='" . $_POST['val'] . "'  "));

//print_r($sqlbranch['CustomerName']); 
?>
<div class="col-md-2" >
    <div class="form-group">
        <label>Customer signature</label>
    </div>
</div>
<div class="col-md-4" >
    <div class="form-group">
        <?php echo '<img src="../upload/' . $sqlbranch['CSign'] . '" style="width:100px; height:100px" />' ?>
        <?php echo '<img src="../upload/' . $sqlbranch['mphoto'] . '" style="width:100px; height:100px" />' ?>
    </div>
</div>

<div class="col-md-2" >
    <div class="form-group">
        <label> Customer Name</label>
    </div>
</div>
<div class="col-md-4" >
    <div class="form-group">
        <input type="text" name="CustomerName"  id="CustomerName" class="form-control" value=<?php echo $sqlbranch['CustomerName'] ?> readonly >
    </div>
</div>


