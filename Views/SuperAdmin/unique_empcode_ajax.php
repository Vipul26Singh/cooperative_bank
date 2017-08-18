<?php

//echo $_POST['code'];
include '../superadmin-session.php';

$sqlcode = mysql_fetch_array(mysql_query("SELECT count(EmpCode) as code FROM `userinfo` where EmpCode = '" . $_POST['code'] . "' ")) or die(mysql_error());

if ($sqlcode['code'] != 0) {
    ?>

    <span style="color: #FF0000;">Entered code is already present</span>
    <?php

}
?>

