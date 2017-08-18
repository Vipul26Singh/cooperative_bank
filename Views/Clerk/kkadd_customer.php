<?php
//session_start();
//include_once('config.php');
include '../superadmin-session.php';
$filepath = $_SESSION['filepath'];
if (isset($_POST['submit'])) {
    $cname = $_POST['cname'];
    $cno = $_POST['cmno'];
    $dob = $_POST['cdob'];
    $age = $_POST['cage'];
    $fathername = $_POST['cfathername'];
    $gen = $_POST['cgen'];
    $email = $_POST['cemail'];
    $teleno = $_POST['cteleno'];
    $caste = $_POST['ccaste'];
    $religion = $_POST['creligion'];
    $radd = $_POST['radds'];
    $oadd = $_POST['oadds'];
    $city = $_POST['ccity'];
    $pin = $_POST['pincode'];
    $state = $_POST['cstate'];
    $country = $_POST['ccountry'];
    $maritalstatus = $_POST['maritalstatus'];
    $spousename = $_POST['cspousename'];
    $nomiename = $_POST['cnomiee_name'];
    $nomieage = $_POST['cnomiee_age'];
    $spousedob = $_POST['spousedob'];
    $family_detail = $_POST['familydetail'];
    $nomie_reln = $_POST['nomiee_relation'];
    $freln = $_POST['family_reln'];
    $uid = $_POST['cuidno'];
    $panno = $_POST['cpan_no'];
    $idno = $_POST['idno'];
    // $cust_no = $_POST['cust_no'];
    $fees = $_POST['membership'];
    $idtype = $_POST['idtype'];
    $approve = $_POST['status'];



    $panimage = rand(1000, 100000) . "-" . $_FILES['pan_image']['name'];
    $panimage_loc = $_FILES['pan_image']['tmp_name'];
    $adharimage = rand(1000, 100000) . "-" . $_FILES['adhar_image']['name'];
    $adharimage_loc = $_FILES['adhar_image']['tmp_name'];
    $signimage = rand(1000, 100000) . "-" . $_FILES['csignimage']['name'];
    $signimage_loc = $_FILES['csignimage']['tmp_name'];

    $photoid = rand(1000, 100000) . "-" . $_FILES['id_image']['name'];
    $photoid_loc = $_FILES['id_image']['tmp_name'];
    $folder = "../upload/";
    //$cimage_loc = $_FILES['cimage']['tmp_name'];
    //$filename =  date('YmdHis') . '.jpg';
    //read the raw POST data and save the file with file_put_contents()
    // $result = file_put_contents( $folder.$cimage, file_get_contents('php://input') );
    /* if (!$result) {
      //print "ERROR: Failed to write data to $filename, check permissions\n";
      exit();
      } */

    //echo $folder.$filename; 

    if (move_uploaded_file($panimage_loc, $folder . $panimage) && move_uploaded_file($adharimage_loc, $folder . $adharimage) && move_uploaded_file($signimage_loc, $folder . $signimage) && move_uploaded_file($photoid_loc, $folder . $photoid)) {
        ?><script>alert('All files are successfully uploaded');</script><?php
    } else {
        ?><script>alert('error while uploading file');</script><?php
    }
    if (isset($_POST['cimage'])) {

        $cimage = rand(1000, 100000) . "-" . $_FILES['cimage']['name'];
        $cimage_loc = $_FILES['cimage']['tmp_name'];


        if (!empty(move_uploaded_file($cimage_loc, $folder . $cimage))) {
            $sql = mysql_query("INSERT INTO customer(CustomerName, ResAddress,  OffAddress, TelPhoneNo, MobileNo, BirthDate,  Age, CityId, StateId, CountryId, EmailID, pincode, MartialStatus, SpouseName, SpouseDOB, NomineeName, NomineeAge, NomineeRelation, Religion, Caste, Gender, ApplicantFather, FamilyDetails, FamilyRelation, PanCardNo, Uidno, mphoto, IDProof1, IDProof2, CSign, AccountDate, PhotoIdentityNumber, MemberShipFees, idtype, photoid, BranchId, ActiveBy, Approval) VALUES "
                    . "('" . $cname . "', '" . $radd . "', '" . $oadd . "', '" . $teleno . "', '" . $cno . "', '" . $dob . "', '" . $age . "', '" . $city . "', '" . $state . "', '" . $country . "', '" . $email . "', '" . $pin . "', '" . $maritalstatus . "', '" . $spousename . "', '" . $spousedob . "', '" . $nomiename . "', '" . $nomieage . "', '" . $nomie_reln . "', '" . $religion . "', '" . $caste . "', '" . $gen . "', '" . $fathername . "', '" . $family_detail . "', '" . $freln . "', '" . $panno . "', '" . $uid . "', '" . $cimage . "', '" . $adharimage . "', '" . $panimage . "', '" . $signimage . "', CURDATE(), '" . $idno . "', '" . $fees . "',  '" . $idtype . "', '" . $photoid . "', '" . $_SESSION['branch_id'] . "', '" . $_SESSION['userid'] . "', '" . $approve . "', '" . $folder . "' )") or die(mysql_error());

            echo "INSERT INTO customer(CustomerName, ResAddress,  OffAddress, TelPhoneNo, MobileNo, BirthDate,  Age, CityId, StateId, CountryId, EmailID, pincode, MartialStatus, SpouseName, SpouseDOB, NomineeName, NomineeAge, NomineeRelation, Religion, Caste, Gender, ApplicantFather, FamilyDetails, FamilyRelation, PanCardNo, Uidno, mphoto, IDProof1, IDProof2, CSign, AccountDate, PhotoIdentityNumber, MemberShipFees, idtype, photoid, BranchId, ActiveBy, Approval) VALUES "
            . "('" . $cname . "', '" . $radd . "', '" . $oadd . "', '" . $teleno . "', '" . $cno . "', '" . $dob . "', '" . $age . "', '" . $city . "', '" . $state . "', '" . $country . "', '" . $email . "', '" . $pin . "', '" . $maritalstatus . "', '" . $spousename . "', '" . $spousedob . "', '" . $nomiename . "', '" . $nomieage . "', '" . $nomie_reln . "', '" . $religion . "', '" . $caste . "', '" . $gen . "', '" . $fathername . "',  '" . $family_detail . "', '" . $freln . "', '" . $panno . "', '" . $uid . "', '" . $cimage . "', '" . $adharimage . "', '" . $panimage . "', '" . $signimage . "', CURDATE(), '" . $idno . "', '" . $fees . "',  '" . $idtype . "', '" . $photoid . "', '" . $_SESSION['branch_id'] . "', '" . $_SESSION['userid'] . "', '" . $approve . "')";
        }
    } else {

        $sql = mysql_query("INSERT INTO customer(CustomerName, ResAddress,  OffAddress, TelPhoneNo, MobileNo, BirthDate,  Age, CityId, StateId, CountryId, EmailID, pincode, MartialStatus, SpouseName, SpouseDOB, NomineeName, NomineeAge, NomineeRelation, Religion, Caste, Gender, ApplicantFather, FamilyDetails, FamilyRelation, PanCardNo, Uidno, mphoto, IDProof1, IDProof2, CSign, AccountDate, PhotoIdentityNumber, MemberShipFees, idtype, photoid, BranchId, ActiveBy, Approval) VALUES "
                . "('" . $cname . "', '" . $radd . "', '" . $oadd . "', '" . $teleno . "', '" . $cno . "', '" . $dob . "', '" . $age . "', '" . $city . "', '" . $state . "', '" . $country . "', '" . $email . "', '" . $pin . "', '" . $maritalstatus . "', '" . $spousename . "', '" . $spousedob . "', '" . $nomiename . "', '" . $nomieage . "', '" . $nomie_reln . "', '" . $religion . "', '" . $caste . "', '" . $gen . "', '" . $fathername . "', '" . $family_detail . "', '" . $freln . "', '" . $panno . "', '" . $uid . "', '" . $filepath . "', '" . $adharimage . "', '" . $panimage . "', '" . $signimage . "', CURDATE(), '" . $idno . "', '" . $fees . "',  '" . $idtype . "', '" . $photoid . "', '" . $_SESSION['branch_id'] . "', '" . $_SESSION['userid'] . "', '" . $approve . "' )") or die(mysql_error());
        echo "INSERT INTO customer(CustomerName, ResAddress,  OffAddress, TelPhoneNo, MobileNo, BirthDate,  Age, CityId, StateId, CountryId, EmailID, pincode, MartialStatus, SpouseName, SpouseDOB, NomineeName, NomineeAge, NomineeRelation, Religion, Caste, Gender, ApplicantFather, FamilyDetails, FamilyRelation, PanCardNo, Uidno, mphoto, IDProof1, IDProof2, CSign, AccountDate, PhotoIdentityNumber, MemberShipFees, idtype, photoid, BranchId, ActiveBy, Approval) VALUES "
        . "('" . $cname . "', '" . $radd . "', '" . $oadd . "', '" . $teleno . "', '" . $cno . "', '" . $dob . "', '" . $age . "', '" . $city . "', '" . $state . "', '" . $country . "', '" . $email . "', '" . $pin . "', '" . $maritalstatus . "', '" . $spousename . "', '" . $spousedob . "', '" . $nomiename . "', '" . $nomieage . "', '" . $nomie_reln . "', '" . $religion . "', '" . $caste . "', '" . $gen . "', '" . $fathername . "', '" . $family_detail . "', '" . $freln . "', '" . $panno . "', '" . $uid . "', '" . $filepath . "', '" . $adharimage . "', '" . $panimage . "', '" . $signimage . "', CURDATE(), '" . $idno . "', '" . $fees . "',  '" . $idtype . "', '" . $photoid . "', '" . $_SESSION['branch_id'] . "', '" . $_SESSION['userid'] . "', '" . $approve . "' )";
    }


    if ($sql) {
        echo "Successfully inserted";
        //header("location: clerk_dashboard.php");
    } else {
        echo "Not inserted";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
<?php include 'include/clerk_nav.php'; ?>
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

<?php include 'include/clerk_sidenav.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                <section class="content">

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Customer</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="col-md-12">  
                                    <div class="col-md-6">           
                                        <div class="form-group">
                                            <label>Photo/Signature</label><br>

                                            <!-- show captured image -->

                                            <div  id="image" class="form-group" src="" style="border:1px solid lightgrey;float:left;height:150px; width:150px;" ></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <img id="output_image1" src="" alt=""  height="100px" width="170px"  /> 

                                        </div><br><br><br>
                                        <div class="btn btn-sm btn-default btn-file" id="divphoto" runat="server">
                                            <i class="fa fa-image"></i>&nbsp;&nbsp;&nbsp; User Photo
                                            <input type="file"  accept="upload/*" onchange="preview_image(event)" onchange="readURL(this);" name="cimage" id="imgInp" width="100px" >
                                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <div class="btn btn-sm btn-default btn-file" id="div1" runat="server">
                                            <i class="fa fa-image"></i>&nbsp; Signature Photo
                                            <input type="file" accept="upload/*" onchange="preview_image1(event)" name="csignimage" id="cust" width="100px" >
                                        </div>
                                    </div>
                                    <div class="col-md-6"> 
                                        <div class="row" id="ggg">
                                            &nbsp;&nbsp;&nbsp;&nbsp;

                                            <div  id="camera_wrapper"><div id="image" style="float:right;border:1px solid lightgrey ;width:150px;height:150px;margin-right:70px;"></div>
                                                <div id="camera"></div><br>

                                                <input type="submit" name="cimage"  id="capture_btn" class="btn btn-sm btn-defaultbtn btn-sm btn-default" value="Upload"><br><br>

                                            </div> 
                                        </div>	


                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Customer Name</label>
                                        <input type="text" name="cname" class="form-control" id="custname" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Mobile No</label>
                                        <input type="text" name="cmno" class="form-control" id="cust" required>
                                    </div>
                                </div>



                                <div class="col-md-6">             
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <input type="date" name="cdob" class="form-control" id="cust" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Age</label>
                                        <input type="text" name="cage" class="form-control" id="cust" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Applicant Father Name</label>
                                        <input type="text" name="cfathername" class="form-control" id="custname">
                                    </div>
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select class="form-control" name="cgen" style="width: 100%;" required>
                                            <option value="">Select</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>                 
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email ID</label>
                                        <input type="email" name="cemail" class="form-control" id="cust">
                                    </div>
                                    <div class="form-group">
                                        <label>Telephone No</label>
                                        <input type="text" name="cteleno" class="form-control" id="cust" >
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Caste</label>
                                        <input type="text" name="ccaste" class="form-control" id="custname">
                                    </div>
                                    <div class="form-group">
                                        <label>Religion</label>
                                        <input type="text" name="creligion" class="form-control" id="cust">
                                    </div>
                                </div>

                                <div class="col-md-6">             
                                    <div class="form-group">
                                        <label>Residential Address</label>
                                        <input type="text" name="radds" class="form-control" id="cust" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Official Address</label>
                                        <input type="text" name="oadds" class="form-control" id="cust" >
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>City</label>
                                        <select class="form-control" name="ccity" style="width: 100%;" >
<?php
$sql = mysql_query("SELECT CityId, CityName FROM city WHERE Active=1");
echo "<option value=''>Select</option>";
while ($row = mysql_fetch_array($sql)) {
    echo "<option value='" . $row['CityId'] . "'>" . $row['CityName'];
}
?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Pincode</label>
                                        <input type="text" name="pincode" class="form-control" id="cust" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>State</label>
                                        <select class="form-control" name="cstate" style="width: 100%;" >
<?php
$sql = mysql_query("SELECT StateId, StateName FROM state WHERE Active=1");
echo "<option value=''>Select</option>";
while ($row = mysql_fetch_array($sql)) {
    echo "<option value='" . $row['StateId'] . "'>" . $row['StateName'];
}
?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Country</label>
                                        <select class="form-control" name="ccountry" style="width: 100%;" >
                                            <?php
                                            $sql = mysql_query("SELECT CountryId, CountryName FROM country WHERE Active=1");
                                            echo "<option value=''>Select</option>";
                                            while ($row = mysql_fetch_array($sql)) {

                                                echo "<option value='" . $row['CountryId'] . "'>" . $row['CountryName'];
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Marital Status</label>
                                        <select class="form-control" name="maritalstatus" style="width: 100%;">
                                            <option value="">Select</option>
                                            <option value="married">Married</option>
                                            <option value="single">Single</option>
                                            <option value="divorsed">Divorsed</option>
                                            <option value="widow">Widow</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Spouse Name</label>
                                        <input type="text" name="cspousename" class="form-control" id="custname">
                                    </div>
                                </div>

                                <div class="col-md-6">             
                                    <div class="form-group">
                                        <label>Nominee Name</label>
                                        <input type="text"  name="cnomiee_name" class="form-control" id="cust">
                                    </div>
                                    <div class="form-group">
                                        <label>Nominee Age</label>
                                        <input type="text" name="cnomiee_age" class="form-control" id="cust">
                                    </div>
                                </div>

                                <div class="col-md-6">             
                                    <div class="form-group">
                                        <label>Spouse DOB</label>
                                        <input type="date" name="spousedob" class="form-control" id="cust">
                                    </div>
                                    <div class="form-group">
                                        <label>Family Details</label>
                                        <input type="text"  name="familydetail" class="form-control" id="cust">
                                    </div>
                                </div>

                                <div class="col-md-6">             
                                    <div class="form-group">
                                        <label>Nominee Relation</label>
                                        <input type="text" name="nomiee_relation" class="form-control" id="cust">
                                    </div>
                                </div>

                                <div class="col-md-6">   
                                    <div class="form-group">
                                        <label>Family Relation</label>
                                        <input type="text" name="family_reln" class="form-control" id="cust">
                                    </div>
                                </div>

                                <div class="col-md-6">             
                                    <div class="form-group">
                                        <label>UID Number</label>
                                        <input type="text" name="cuidno" class="form-control" id="cust">
                                    </div>
                                    <div class="form-group">
                                        <image id="output_image2" src="" alt="" width="100px" height="100px"/><br>
                                        <label>Upload Aadhar Card</label>
                                        <div class="btn btn-sm btn-default btn-file" id="div1" runat="server">
                                            <i class="fa fa-image"></i>&nbsp; Aadhar Photo
                                            <input type="file" accept="upload/*" onchange="preview_image2(event)" name="adhar_image" id="cust" width="100px" >
                                        </div>
                                        <!--<input type="file" name="adhar_image" accept="upload/*" onchange="preview_image2(event)" onchange="readURL(this);" class="form-control" id="cust"> -->
                                    </div>

                                </div>

                                <div class="col-md-6">             
                                    <div class="form-group">
                                        <label>Pancard No</label>
                                        <input type="text" name="cpan_no" class="form-control" id="cust" required>
                                    </div>
                                    <div class="form-group">
                                        <image id="output_image3" src="" alt="" width="100px" height="100px"/><br>
                                        <label>Upload Pancard</label>
                                        <div class="btn btn-sm btn-default btn-file" id="div1" runat="server">
                                            <i class="fa fa-image"></i>&nbsp; Pancard Photo
                                            <input type="file" accept="upload/*" onchange="preview_image3(event)" name="pan_image" id="cust" width="100px" >
                                        </div>
                                       <!-- <input type="file" name="pan_image" accept="upload/*" onchange="preview_image3(event)" onchange="readURL(this);" class="form-control" id="cust">-->
                                    </div>
                                </div>

                                <div class="col-md-6">             
                                    <div class="form-group">
                                        <label>PhotoId No</label>
                                        <input type="text" name="idno" class="form-control" id="cust">
                                    </div>
                                    <div class="form-group">
                                        <image id="output_image4" src="" alt="" width="100px" height="100px"/><br>
                                        <label>Upload PhotoID</label>
                                        <div class="btn btn-sm btn-default btn-file" id="div1" runat="server">
                                            <i class="fa fa-image"></i>&nbsp; Pancard Photo
                                            <input type="file" accept="upload/*" onchange="preview_image4(event)" name="id_image" id="cust" width="100px" >
                                        </div>
                                        <!-- <input type="file" name="id_image" accept="upload/*" onchange="preview_image4(event)" onchange="readURL(this);" class="form-control" id="cust"> -->
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>MemberShip Fees</label>
<?php
$sql = mysql_query("SELECT * FROM `membershipfees` ORDER BY MemberShipFeesId DESC LIMIT 1");
//$row = mysql_fetch_array($sql);
?>
                                        <input type="text" value="<?php echo $row['MemberShipFees'] ?>" class="form-control" name="membership" id="cust" readonly>

                                    </div>
                                    <div class="form-group">
                                        <label>Id type</label>
                                        <input type="text" name="idtype" class="form-control" id="cust" >
                                    </div>
                                    <div class="form-group">

                                        <select style="display: none;" class="form-control" name="status" style="width: 100%;">
                                            <option  value="pending">Pending</option>
                                        </select>

                                    </div> 
                                </div>

                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer text-center">
                                <input type="submit" name="submit" class="btn btn-primary" value="Save">
                            </div>
                        </form>
                    </div>

                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">

                <strong>Copyright &copy; 2017-2018 <a href="#">CodeFever</a>.</strong> All rights
                reserved.
            </footer>

            <!-- Control Sidebar -->

            <div class="control-sidebar-bg"></div>
        </div>

        <!-- webcam link -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
        <!-- image upload -->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> 


    </script>
    <script type='text/javascript'>
                                                $(document).ready(function () {
                                                    $("#imgInp").on('change', function () {
                                                        //Get count of selected files
                                                        var countFiles = $(this)[0].files.length;
                                                        var imgPath = $(this)[0].value;
                                                        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
                                                        var image_holder = $("#image");
                                                        image_holder.empty();
                                                        if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
                                                            if (typeof (FileReader) != "undefined") {
                                                                //loop for each file selected for uploaded.
                                                                for (var i = 0; i < countFiles; i++)
                                                                {
                                                                    var reader = new FileReader();
                                                                    reader.onload = function (e) {
                                                                        $("<img />", {
                                                                            "src": e.target.result,
                                                                            "class": "thumb-image"

                                                                        }).height(150).width(150).appendTo(image_holder);
                                                                    }
                                                                    document.getElementById("capture_btn").disabled = true;
                                                                    image_holder.show();
                                                                    reader.readAsDataURL($(this)[0].files[i]);
                                                                }
                                                            } else {
                                                                alert("This browser does not support FileReader.");
                                                            }
                                                        } else {
                                                            alert("Pls select only images");
                                                        }
                                                    });
                                                });

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

    <script type="text/javascript" src="../js/webcam.js"></script>
    <script>
                                                $(function () {
                                                    //give the php file path
                                                    webcam.set_api_url('upload.php');
                                                    webcam.set_swf_url('../js/webcam.swf');//flash file (SWF) file path
                                                    webcam.set_quality(100); // Image quality (1 - 100)
                                                    webcam.set_shutter_sound(true); // play shutter click sound

                                                    var camera = $('#camera');
                                                    camera.html(webcam.get_html(250, 150)); //generate and put the flash embed code on page

                                                    $('#capture_btn').click(function () {
                                                        //take snap
                                                        webcam.snap();

                                                    });


                                                    //after taking snap call show image
                                                    webcam.set_hook('onComplete', function (img) {
                                                        document.getElementById('image').innerHTML =
                                                                '<img src="' + img + '" width="150px" height="150px"/>';
                                                        //reset camera for the next shot
                                                        webcam.reset();
                                                        //reset camera for the next shot
                                                        document.getElementById("imgInp").disabled = true;

                                                    });

                                                });
    </script>

    <style>
        #camera_wrapper
    </style>
<?php include 'include/clerk_script.php'; ?>
</body>
</html>
