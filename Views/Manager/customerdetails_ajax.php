<?php 
include '../superadmin-session.php';
error_reporting(0);

  $sqlbranch = mysql_fetch_array(mysql_query("SELECT * from  customer where CustomerID='".$_POST['val']."'  " ));

 if($sqlbranch){
?>
                

                <div class="col-md-2" >
                   <div class="form-group">
                        <label>Customer photo/signature</label>
                   </div>
                </div>
                <div class="col-md-4" >
                    <div class="form-group">
                        <?php echo '<img src="../upload/'.$sqlbranch['mphoto'].'" style="width:100px; height:100px" />' ?>
                        <?php echo '<img src="../upload/'.$sqlbranch['CSign'].'" style="width:100px; height:100px" />' ?>
                    </div>
                </div>

                <div class="col-md-2" >
                   <div class="form-group">
                        <label> Customer Name</label>
                   </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" name="CustomerName"  id="CustomerName" class="form-control" readonly value=<?php echo $sqlbranch['CustomerName']?> >
                    </div>
                </div>
 <?php }else {
     ?><script>alert("CustomerID should not be empty.")</script><?php
 } ?>
              