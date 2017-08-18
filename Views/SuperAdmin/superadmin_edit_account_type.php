<?php
include '../superadmin-session.php';
error_reporting(0);
$cid = $_GET['id'];

if (isset($_POST['submit'])) {

    $aname = $_POST['a_name'];
    $rate = $_POST['i_rate'];
    $bal = $_POST['m_bal'];
    $caln = $_POST['i_caln'];
    $type = $_POST['type'];
    $active = $_POST['active'];

    $sql1 = mysql_query("UPDATE `accounttype` SET `Accounttypename`='" . $aname . "', `InterestRate`='" . $rate . "',`MinimumBal`='" . $bal . "',`InterestCalculationDays`='" . $caln . "',`Type`='" . $type . "',`Active`='" . $active . "',`ModifiedBy`='" . $_SESSION['userid'] . "', `ModifiedDate`=CURTIME() WHERE AccountTypeid ='" . $cid . "' ") or die(mysql_error());


    if ($sql1) {
        //echo "Successfully Updated";
        header("location: account_typelist.php");
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
<?php include 'include/nav.php'; ?>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
        <!-- image upload -->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>

        <script type='text/javascript'>
            function preview_image(event)
            {
                var reader = new FileReader();
                reader.onload = function ()
                {
                    var output = document.getElementById('output_image');
                    output.src = reader.result;
                }
                reader.readAsDataURL(event.target.files[0]);
            }

            function preview_image1(event)
            {
                var reader = new FileReader();
                reader.onload = function ()
                {
                    var output = document.getElementById('output_image1');
                    output.src = reader.result;
                }
                reader.readAsDataURL(event.target.files[0]);
            }

            function preview_image2(event)
            {
                var reader = new FileReader();
                reader.onload = function ()
                {
                    var output = document.getElementById('output_image2');
                    output.src = reader.result;
                }
                reader.readAsDataURL(event.target.files[0]);
            }

            function preview_image3(event)
            {
                var reader = new FileReader();
                reader.onload = function ()
                {
                    var output = document.getElementById('output_image3');
                    output.src = reader.result;
                }
                reader.readAsDataURL(event.target.files[0]);
            }

            function preview_image4(event)
            {
                var reader = new FileReader();
                reader.onload = function ()
                {
                    var output = document.getElementById('output_image4');
                    output.src = reader.result;
                }
                reader.readAsDataURL(event.target.files[0]);
            }
        </script>
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
<?php include 'include/sidenav.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                <section class="content">

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Account Type Detail</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="" >

<?php
//echo $cid;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = mysql_query("SELECT * FROM `accounttype` WHERE AccountTypeid ='" . $cid . "' ") or die(mysql_error());

    while ($row = mysql_fetch_array($sql)) {
        ?>

                                    <div class="box-body">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Account Type Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" value="<?php echo $row['Accounttypename']; ?>" name="a_name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Interest Rate</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" value="<?php echo $row['InterestRate']; ?>" class="form-control" name="i_rate">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Minimum Balance</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" value="<?php echo $row['MinimumBal']; ?>" class="form-control" name="m_bal" >
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Interest Days</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" value="<?php echo $row['InterestCalculationDays']; ?>" class="form-control" name="i_caln">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Type</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select class="form-control" name="type" style="width: 100%;" >
        <?php
        if ($row['Type'] == 'saving') {
            $a = "Saving";
            $b = "Current";
            echo "<option  value='saving'>" . $a . "</option>"
            . "<option  value='current'>" . $b . "</option>";
        } else {
            $a = "Saving";
            $b = "Current";
            echo "<option  value='current'>" . $b . "</option>"
            . "<option  value='saving'>" . $a . "</option>";
        }
        ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Active</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select class="form-control" name="active" style="width: 100%;" >
        <?php
        if ($row['Active'] == 1) {
            $a = "Active";
            $b = "Deactive";
            echo "<option  value='1'>" . $a . "</option>"
            . "<option  value='0'>" . $b . "</option>";
        } else {
            $a = "Active";
            $b = "Deactive";
            echo "<option  value='0'>" . $b . "</option>"
            . "<option  value='1'>" . $a . "</option>";
        }
        ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="box-footer text-center">
                                        <input type="submit" name="submit" class="btn btn-primary" value="Update">
                                    </div>
    <?php
    }
}
?>

                        </form>
                    </div>
                </section>           

                <!-- /.box-body -->


                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
<?php include 'include/script.php'; ?>


            <!-- Control Sidebar -->

            <div class="control-sidebar-bg"></div>
        </div>

        <!-- webcam link -->

    </body>
</html>
