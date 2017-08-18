<?php
include '../superadmin-session.php';
error_reporting(0);
$sql = mysql_query("SELECT * FROM `companysetup`");
$count = mysql_num_rows($sql);
echo $count;
if ($count == 0) {
    header('location: companysetup.php');
} else {
    header('location: update_companysetup.php');
}

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
        ?><script>alert('successfully uploaded');</script><?php
    } else {
        ?><script>alert('error while uploading file');</script><?php
    }

    $sql = mysql_query("INSERT INTO `companysetup`(`CompanyName`, `CompanyAddress`, `registrationno`, `phoneno`, `footer`, `companylogo`, `CreatedBy`, `CreatedDate` ) VALUES "
            . "('" . $cname . "', '" . $cadd . "', '" . $reg . "', '" . $pno . "', '" . $footer . "', '" . $pic . "', '" . $_SESSION['userid'] . "', CURDATE())") or die(mysql_error());

    if ($sql) {
        //echo "Successfully inserted";
        header("location: superadmin_branch_list.php");
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
<?php include 'include/nav.php'; ?>
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
                            <h3 class="box-title">Company Setup</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="" enctype="multipart/form-data">
                            <div class="box-body">               
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Company Name</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="compy_name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Company Address</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="compy_add" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Registration No</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="reg" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Phone No</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="p_no" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>footer</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="footer" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">   
                                        <label>Employee Photo</label><br>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group"> 
                                        <image id="output_image" src="#" alt="your image" width="100px" height="100px"/>

                                        <div class="row">
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <div class="btn btn-sm btn-default btn-file">
                                                <i class="fa fa-image"></i>&nbsp;Select Photo
                                                <input type="file" accept="upload/*" onchange="preview_image(event)" onchange="readURL(this);" name="eimage" width="100px" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" name="addcompy" class="btn btn-primary">Save</button>
                            </div>
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

<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>-->


    </body>
</html>
