<?php
include '../superadmin-session.php';


$sqlbranch = mysql_fetch_array(mysql_query("SELECT * from  bankaccount where accountNo='" . $_POST['val'] . "' "));

$sqlbranch1 = mysql_fetch_array(mysql_query("SELECT * from  accounttype where AccountTypeid='" . $sqlbranch['AccountTypeid'] . "' "));


$sqldata1 = mysql_query("SELECT * from onlinecutomertype where AType='" . $sqlbranch1['Type'] . "' ");

while ($row1 = mysql_fetch_array($sqldata1)) {
    ?>
    <option value="<?php echo $row1['OnlineCustomertypeId']; ?>"><?php echo $row1['OnlineCustomertypename']; ?></option>
<?php } ?>

