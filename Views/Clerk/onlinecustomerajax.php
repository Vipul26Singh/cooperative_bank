<?php
include '../superadmin-session.php';

$sql = mysql_fetch_array(mysql_query("SELECT * from  customer c
inner join bankaccount ba on c.CustomerID=ba.CustomerID   
where  c.CustomerID='" . $_POST['val'] . "' ")) or die(mysql_error());



/* $sqlbranch = mysql_fetch_array(mysql_query("SELECT * from customer where CustomerID='".$_POST['val']."'  " )); */
?>

<div id="divhide">

    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-title">Apply for Internet/Mobile Banking </h3>
        </div>

        <div class="box-body">

            <div class="col-md-2">
                <div class="form-group">
                    <label>Customer Name</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" class="form-control" id="custname" value="<?php echo $sql['CustomerName'] ?>" readonly>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label>Mobile No</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" class="form-control" name="MobileNo" id="MobileNo" value="<?php echo $sql['MobileNo'] ?>" readonly>
                </div>
            </div>

            <div class="col-md-2">             
                <div class="form-group">
                    <label>Photo/Signature</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo '<img src="../upload/' . $sql['CSign'] . '" style="width:100px; height:100px" />' ?>
                    <?php echo '<img src="../upload/' . $sql['mphoto'] . '" style="width:100px; height:100px" />' ?>
                </div>
            </div>

            <div class="col-md-2">             
                <div class="form-group">
                    <label>Email ID</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" class="form-control" name="EmailID" id="EmailID" value="<?php echo $sql['EmailID'] ?>"readonly>
                </div>
            </div>

            <div class="col-md-2">             
                <div class="form-group">
                    <label>Residential Address</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" class="form-control" id="cust" value="<?php echo $sql['ResAddress'] ?>"readonly>
                </div>
            </div>

            <div class="col-md-2">             
                <div class="form-group">
                    <label>Official Address</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" class="form-control"  value="<?php echo $sql['OffAddress'] ?>"id="cust" readonly>
                </div>
            </div>

            <div class="col-md-2">             
                <div class="form-group">
                    <label>Mobile Banking</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <select class="form-control" style="width: 100%;" name="MobileAccess" id="MobileAccess" rquired>
                        <option value="">--Select--</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>                 
                    </select>              
                </div>
            </div>

            <div class="col-md-2">             
                <div class="form-group">
                    <label>Select Account No</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <select class="form-control" style="width: 100%;" name="accountNo" id="accountNo" onchange="showbal(this.value);" required>
                        <option value="">--Select--</option>
                        <?php
                        $sqldata = mysql_query("SELECT * from bankaccount where CustomerID='" . $_POST['val'] . "' ");
                        while ($row = mysql_fetch_array($sqldata)) {
                            ?>
                            <option value="<?php echo $row['accountNo']; ?>"><?php echo $row['accountNo']; ?></option>
                        <?php } ?> 
                    </select> 
                </div>
            </div>

            <div class="col-md-2">             
                <div class="form-group">
                    <label>Internet Banking</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <select class="form-control" style="width: 100%;" name="InternetAccess" id="InternetAccess"  required>
                        <option value="">--Select--</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>                    
                    </select>
                </div>
            </div>

            <div class="col-md-2">             
                <div class="form-group">
                    <label>Account Balance</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" class="form-control" name="balshow" id="balshow" readonly>
                </div> 
            </div>

            <div class="col-md-2">             
                <div class="form-group">
                    <label>Customer Type</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <select class="form-control" style="width: 100%;" name="OnlineCustomertypeId" id="OnlineCustomertypeId" required>
                        <option value="">--Select--</option>
                        <?php
                        $sqldata1 = mysql_query("SELECT * from onlinecutomertype ");
                        while ($row1 = mysql_fetch_array($sqldata1)) {
                            ?>
                            <option value="<?php echo $row1['OnlineCustomertypeId']; ?>"><?php echo $row1['OnlineCustomertypename']; ?></option>
                        <?php } ?>
                    </select> 
                </div>
            </div>

            <div class="col-md-2">             
                <div class="form-group">
                    <label>User ID 1</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" class="form-control" name="RequestedUsername1" id=" RequestedUsername1">
                </div>
            </div>

            <div class="col-md-2">             
                <div class="form-group">
                    <label>Application Date</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="date" class="form-control" name="" id=" "
                           value="<?php echo date("Y-m-d"); ?>" readonly>
                </div>
            </div>

            <div class="col-md-2">             
                <div class="form-group">
                    <label>User ID 2</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" class="form-control" name="RequestedUsername2" id=" RequestedUsername2" >
                </div>
            </div>

            <div class="col-md-2">             
                <div class="form-group">
                    <label>Branch Name</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" class="form-control" name="BranchId" id="BranchId" value="<?php echo $_SESSION['branch_id']; ?>" readonly>
                </div>
            </div>

            <div class="col-md-2">             
                <div class="form-group">
                    <label>User ID 3</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" class="form-control" name="RequestedUsername3" id="RequestedUsername3">
                </div>
            </div>
        </div>
        <div class="box-footer text-center">
            <input type="submit" name="submit" value="Submit" class="btn btn-warning"/>
        </div>
    </div>
</div>         

<div id="divshow"></div>

<!-- /.content -->

<script type="text/javascript">
    function showbal(val)
    {

        $.ajax({url: 'balshow_ajax123.php',
            data: {val: val},
            type: 'post',
            success: function (output)
            {

                $("#balshow").val(output);
            }

        });
        $.ajax({url: 'balshow_ajax1234.php',
            data: {val: val},
            type: 'post',
            success: function (output)
            {

                $("#OnlineCustomertypeId").html(output);


            }

        });
    }
</script>
