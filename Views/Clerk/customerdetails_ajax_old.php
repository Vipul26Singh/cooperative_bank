<?php
include '../superadmin-session.php';


$sqlbranch = mysql_fetch_array(mysql_query("SELECT * from  customer where CustomerID='" . $_POST['val'] . "'  "));

//print_r($sqlbranch['CustomerName']); 
?>
<div class="col-md-6" >
    <div class="form-group">
        <label> Customer Name</label>

        <input type="text" name="CustomerName"  id="CustomerName" class="form-control" value=<?php echo $sqlbranch['CustomerName'] ?> >
    </div>
</div>

<div class="col-md-6" >
    <div class="form-group">
        <label>Customer signature</label>

        <br> <?php echo '<img src="../upload/' . $sqlbranch['CSign'] . '" style="width:100px; height:100px" />' ?>

    </div>
</div>

<div class="col-md-6" >
    <div class="form-group">
        <label> Customer Photo</label>
        <br><?php echo '<img src="../upload/' . $sqlbranch['mphoto'] . '" style="width:100px; height:100px" />' ?>

    </div>
</div>