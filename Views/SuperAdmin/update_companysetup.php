<?php
include '../superadmin-session.php';
error_reporting(0);
if (isset($_POST['addcompy'])) {
    $cname = $_POST['compy_name'];
    $cadd = $_POST['compy_add'];
    $reg = $_POST['reg'];
    $pno = $_POST['p_no'];
    $footer = $_POST['footer'];

    $pic = rand(1000, 100000) . "-" . $_FILES['eimage']['name'];
    $pic_loc = $_FILES['eimage']['tmp_name'];
    $folder = "../upload/";
    if (move_uploaded_file($pic_loc, $folder . $pic)) {
        $sql = mysql_query("UPDATE `companysetup` SET `companylogo`='" . $pic . "',
                                 `ModifiedBy`='" . $_SESSION['userid'] . "', 
                                 `ModifiedDate`=CURTIME() WHERE CompanySetupId=1");
        ?><script>alert('successfully uploaded');</script><?php
    } else {
        ?><script>alert('error while uploading file');</script><?php
    }

    $sql = mysql_query("UPDATE `companysetup` SET `CompanyName`='" . $cname . "', `CompanyAddress`='" . $cadd . "', `registrationno`='" . $reg . "', `phoneno`='" . $pno . "', `footer`='" . $footer . "', `ModifiedBy`='" . $_SESSION['userid'] . "', `ModifiedDate`=CURTIME() WHERE CompanySetupId=1") or die(mysql_error());
    //echo "UPDATE `companysetup` SET `CompanyName`='".$cname."', `CompanyAddress`='".$cadd."', `registrationno`='".$reg."', `phoneno`='".$pno."', `companylogo`='".$pic."', `footer`='".$footer."', `ModifiedBy`='".$_SESSION['userid']."', `ModifiedDate`=CURTIME() WHERE CompanySetupId=1";
    if ($sql) {
        $_SESSION['message'] = 'Successfully update';
        header("location: superadmin_dashboard.php");
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
<?php include 'include/nav.php'; ?>
        <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>-->
        <script src="../js/googlejs.js"></script>
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
                            <h3 class="box-title">Update Company Setup</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="" enctype="multipart/form-data">
<?php
$sql = mysql_query("SELECT * FROM companysetup WHERE CompanySetupId=1") or die(mysql_error());
while ($row = mysql_fetch_array($sql)) {
    ?>

                                <div class="box-body">   
                                    <div class="col-md-2">
                                        <label>Company Logo </label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
    <?php
    echo '<img src="../upload/' . $row['companylogo'] . '" id="output_image" style="width:100px; height:100px" />'
    ?>
                                        </div>
                                        <div class="btn btn-sm btn-default btn-file">
                                            <i class="fa fa-image"></i>&nbsp;Select Logo
                                            <input type="file" accept="upload/*" onchange="preview_image(event)" onchange="readURL(this);" name="eimage" width="100px" />
                                        </div>
                                    </div><br>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Company Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" value="<?php echo $row['CompanyName']; ?>" name="compy_name" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Company Address</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" value="<?php echo $row['CompanyAddress']; ?>" name="compy_add" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Registration No</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" value="<?php echo $row['registrationno']; ?>" name="reg" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Phone No</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" value="<?php echo $row['phoneno']; ?>" name="p_no" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>footer</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" value="<?php echo $row['footer']; ?>" name="footer" class="form-control" required>
                                        </div>
                                    </div>

                                </div>

                                <!-- /.box-body -->

                                <div class="box-footer text-center">
                                    <input type="submit" name="addcompy" class="btn btn-primary" value="Update" id="btnclick">
                                </div>
<?php } ?>
                        </form>
                    </div>

                </section>
                <!-- /.content -->
            </div>

            <!-- /.content-wrapper -->
<?php include 'include/script.php'; ?>

            <!-- Control Sidebar -->

            <div class="control-sidebar-bg"></div>
        </div>



    </body>
</html>
