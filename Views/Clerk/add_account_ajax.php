<?php
include '../superadmin-session.php';


$sqlbranch = mysql_query("SELECT * from  accounttype where Type='" . $_POST['accounttype'] . "'  ");
?>
<option value="0">Select Account Type </option>
<?php
while ($rowbranch = mysql_fetch_array($sqlbranch)) {
    ?>
    <option value="<?php echo $rowbranch['AccountTypeid']; ?>"><?php echo $rowbranch['Accounttypename']; ?></option>
<?php } ?>