<?php
error_reporting(0);
include '../superadmin-session.php';
$companysetup = mysql_query("SELECT * FROM companysetup ");
$companysetupvale = mysql_fetch_array($companysetup);
$companyname = $companysetupvale['CompanyName'];

if (isset($_POST['submit'])) {
	$panimage = null;
	$panimage_loc = null;
	$adharimage = null;
	$adharimage_loc = null;
	$photoid = null;
	$photoid_loc = null;
	if($_FILES['pan_image']['name']!=""){
		$panimage = rand(1000, 100000) . "-" . $_FILES['pan_image']['name'];
		$panimage_loc = $_FILES['pan_image']['tmp_name'];
	}

	if($_FILES['adhar_image']['name']!=""){
		$adharimage = rand(1000, 100000) . "-" . $_FILES['adhar_image']['name'];
		$adharimage_loc = $_FILES['adhar_image']['tmp_name'];
	}

	$signimage = rand(1000, 100000) . "-" . $_FILES['csignimage']['name'];
	$signimage_loc = $_FILES['csignimage']['tmp_name'];

	if($_FILES['id_image']['name']!=""){
		$photoid = rand(1000, 100000) . "-" . $_FILES['id_image']['name'];
		$photoid_loc = $_FILES['id_image']['tmp_name'];
	}
	$folder = "../upload/";
	$cimage = rand(1000, 100000) . "-" . $_FILES['cimage']['name'];
	$cimage_loc = $_FILES['cimage']['tmp_name'];

	if(!empty($panimage_loc))
	{
		move_uploaded_file($panimage_loc, $folder . $panimage);
	}

	if(!empty($adharimage_loc)){
		move_uploaded_file($adharimage_loc, $folder . $adharimage);
	}

	if(!empty($photoid_loc)){
		move_uploaded_file($photoid_loc, $folder . $photoid);
	}

	if (!empty(move_uploaded_file($cimage_loc, $folder . $cimage)) && !empty(move_uploaded_file($signimage_loc, $folder . $signimage))) {
		$sql = mysql_query("insert into customer set
				CustomerName = '" . $_POST['cname'] . "', 
				ResAddress = '" . $_POST['radds'] . "',
				OffAddress = '" . $_POST['oadds'] . "', 
				TelPhoneNo = '" . $_POST['cteleno'] . "',
				MobileNo = '" . $_POST['cmno'] . "', 
				BirthDate = '" . $_POST['cdob'] . "',
				Age = '" . $_POST['cage'] . "',
				CityId = '" . $_POST['ccity'] . "',
				StateId = '" . $_POST['cstate'] . "',
				CountryId = '" . $_POST['ccountry'] . "',
				EmailID = '" . $_POST['cemail'] . "',
				pincode = '" . $_POST['pincode'] . "',
				MartialStatus = '" . $_POST['maritalstatus'] . "',
				SpouseName = '" . $_POST['cspousename'] . "',
				SpouseDOB = '" . $_POST['spousedob'] . "',
				NomineeName = '" . $_POST['cnomiee_name'] . "',
				NomineeAge = '" . $_POST['cnomiee_age'] . "', 
				NomineeRelation = '" . $_POST['nomiee_relation'] . "',
				Gender = '" . $_POST['cgen'] . "',
				ApplicantFather = '" . $_POST['cfathername'] . "',
				FamilyDetails = '" . $_POST['familydetail'] . "',
				FamilyRelation = '" . $_POST['family_reln'] . "',
				PanCardNo = '" . $_POST['cpan_no'] . "',
				Uidno = '" . $_POST['cuidno'] . "',
				mphoto = '" . $cimage . "',
				IDProof1 = '" . $panimage . "',
				IDProof2 = '" . $adharimage . "',
				CSign =  '" . $signimage . "',
				AccountDate = CURDATE(),
				PhotoIdentityNumber = '" . $_POST['idno'] . "',
				MemberShipFees = '" . $_POST['membership'] . "',
				idtype = '" . $_POST['idtype'] . "',
				photoid = '" . $photoid . "',
				BranchId = '" . $_SESSION['branch_id'] . "',
				ActiveBy = '" . $_SESSION['userid'] . "',
				Approval = '" . $_POST['status'] . "'
					") or die(mysql_error());
	}


	/**if (empty(move_uploaded_file($cimage_loc, $folder . $cimage)) && !empty(move_uploaded_file($panimage_loc, $folder . $panimage)) && !empty(move_uploaded_file($adharimage_loc, $folder . $adharimage)) && !empty(move_uploaded_file($signimage_loc, $folder . $signimage)) && !empty(move_uploaded_file($photoid_loc, $folder . $photoid))) {
		$filepath = $_SESSION['filepath'];
		$sql = mysql_query("insert into customer set
				CustomerName = '" . $_POST['cname'] . "', 
				ResAddress = '" . $_POST['radds'] . "',
				OffAddress = '" . $_POST['oadds'] . "', 
				TelPhoneNo = '" . $_POST['cteleno'] . "',
				MobileNo = '" . $_POST['cmno'] . "', 
				BirthDate = '" . $_POST['cdob'] . "',
				Age = '" . $_POST['cage'] . "',
				CityId = '" . $_POST['ccity'] . "',
				StateId = '" . $_POST['cstate'] . "',
				CountryId = '" . $_POST['ccountry'] . "',
				EmailID = '" . $_POST['cemail'] . "',
				pincode = '" . $_POST['pincode'] . "',
				MartialStatus = '" . $_POST['maritalstatus'] . "',
				SpouseName = '" . $_POST['cspousename'] . "',
				SpouseDOB = '" . $_POST['spousedob'] . "',
				NomineeName = '" . $_POST['cnomiee_name'] . "',
				NomineeAge = '" . $_POST['cnomiee_age'] . "', 
				NomineeRelation = '" . $_POST['nomiee_relation'] . "',
				Gender = '" . $_POST['cgen'] . "',
				ApplicantFather = '" . $_POST['cfathername'] . "',
				FamilyDetails = '" . $_POST['familydetail'] . "',
				FamilyRelation = '" . $_POST['family_reln'] . "',
				PanCardNo = '" . $_POST['cpan_no'] . "',
				Uidno = '" . $_POST['cuidno'] . "',
				mphoto = '" . $filepath . "',
				IDProof1 = '" . $panimage . "',
				IDProof2 = '" . $adharimage . "',
				CSign =  '" . $signimage . "',
				AccountDate = CURDATE(),
				PhotoIdentityNumber = '" . $_POST['idno'] . "',
				MemberShipFees = '" . $_POST['membership'] . "',
				idtype = '" . $_POST['idtype'] . "',
				photoid = '" . $photoid . "',
				BranchId = '" . $_SESSION['branch_id'] . "',
				ActiveBy = '" . $_SESSION['userid'] . "',
				Approval = '" . $_POST['status'] . "'
					") or die(mysql_error());
	}**/
	$lastid = mysql_insert_id();

	if ($sql) {

		$sql1emailsetup = mysql_query("SELECT * FROM emailsetup ");
		$rowemail = mysql_fetch_array($sql1emailsetup);
		$email = $_POST['cemail'];
		$to = $email;
		$subject = "Member Application";
		$message = "Welcome to $companyname !<br />";
		$message .= "We are excited that you have chosen Bank Name a cloud based Banking spa automation software.<br/>";
		$message .= "We are continually developing and improving our software, and will be adding amazing new features over the time that will help you run a more successful business. <br/> ";
		$message .= "It's our pleasure to have you on board <br />";
		$message .= "Team Salonzap  <br />";
		$message .= "If you have any questions or feedback please contact us at <b>support@salonzap.com</b> <br/><br/> ";
		$message .= "<b>Copyright © 2016-2017 Salonzap.com, All Rights Reserved.</b><br/>";
		$header = $rowemail['EmailId'];
		$retval = mail($to, $subject, $message, $header);

		if ($retval == true) {
			header("location: clerk_dashboard.php");
		} else {
			header("location: clerk_dashboard.php");
		}
	}
}
?>

<!DOCTYPE html>
<html>
    <head>
<?php include 'include/clerk_nav.php'; ?>
<?php include 'alerts.php'; ?>  
        <style >
            .space{
                margin-bottom: 6px;
            }
        </style>

        <!--<link href="../plugins_new/alerts/jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" />
       <script src="../plugins_new/jQuery/jQuery-2.1.4.min.js"></script>
       <script src="../plugins_new/alerts/jquery.alerts.js" type="text/javascript"></script>-->
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
                        <form role="form" method="post" action="" enctype="multipart/form-data" onsubmit="validationcheck()">
                            <div class="box-body">
                                <div class="form-group">  

                                    <div class="col-md-2 space" >
                                        <label>Applicant Name<span style="color:red;">*</span></label>
                                    </div>
                                    <div class="col-md-4 space">
                                        <input type="text" name="cname" class="form-control" id="custname" required>
                                    </div>
                                    <div class="col-md-2 space">
                                        <label>Mobile No<span style="color:red;">*</span></label>
                                    </div>
                                    <div class="col-md-4 space">
                                        <input type="text" name="cmno" class="form-control" id="mno" required maxlength="12">
                                    </div>

                                    <div class="col-md-2 space" >
                                        <label>Applicant Photo/Signature<span style="color:red;">*</span></label><br>
                                    </div>
                                    <div class="col-md-4 space" >

                                        <div  id="image" class="form-group" style="border:1px solid lightgrey;float:left;height:100px; width:100px;" >
                                            <img id="image" src="../DefaultImage/user.jpg"  style="border:1px solid lightgrey;float:left;height:100px; width:100px;"/>
                                        </div> 
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <img id="output_image1" src="../DefaultImage/signature.jpg" alt=""  height="100px" width="170px" style="border:1px solid lightgrey;height:100px; width:170px;" />
                                        <br><br>
                                        <img src="" alt=""/>
                                        <div class="btn btn-sm  " id="divphoto" runat="server">
                                           <!--  <i class="fa fa-image"></i>&nbsp;&nbsp;&nbsp; User Photo -->
                                            <input type="file" required  name="cimage" accept="upload/*" class="form-control" onchange="preview_image(event)" onchange="readURL(this);" id="imgInp" width="100px" >


                                        </div>

                                        <div class="btn btn-sm  " id="div1" runat="server">
                                        <!-- <i class="fa fa-image"></i>&nbsp; Signature Photo -->
                                            <input type="file" required  accept="upload/*" class="form-control" onchange="preview_image1(event)" name="csignimage" id="cust" width="100px" >

                                        </div>
                                    </div>
                                    <div id="photoerror" style="color:red; display: none;" >Please select Photo</div>
                                    <div id="signatureerror" style="color:red; display: none;" >Please select signature Photo</div>
                                    <div class="col-md-2 space"> </div>
                                    <div class="col-md-4 space">
                                        <div id="camera_wrapper">
                                            <div id="camera"></div><br>
                                            <input type="submit" name="cimage"  id="capture_btn" class="btn btn-sm btn-defaultbtn btn-sm btn-default" value="Upload"><br><br>
                                        </div> 
                                    </div>

                                    <div class="col-md-2 space"> 
                                        <label>Applicant DOB <span style="color:red;">*</span></label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="date" name="cdob" class="form-control"  id="datepick" onblur="getAge();" placeholder="dd-mm-yyyy" required>
                                    </div>
                                    <div class="col-md-2 space"> 
                                        <label>Applicant Age<span style="color:red;">*</span></label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="text" name="cage" class="form-control" id="age" readonly>
                                    </div>

                                    <div class="col-md-2 space"> 
                                        <label>Applicant Father</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="text" name="cfathername" class="form-control" id="cfathername">
                                    </div>
                                    <div class="col-md-2 space"> 
                                        <label>Gender <span style="color:red;">*</span></label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <select class="form-control" name="cgen"  style="width: 100%;" required>
                                            <option value="">--Select--</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>                 
                                        </select>
                                    </div>

                                    <div class="col-md-2 space"> 
                                        <label>Email ID <span style="color:red;"></span></label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="email" name="cemail" class="form-control" id="cust" >
                                    </div>
                                    <div class="col-md-2 space"> 
                                        <label>Telephone No</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="text" name="cteleno" class="form-control" id="cust" maxlength="10">
                                    </div>

                                    <!--    <div class="col-md-2 space"> 
                                                <label>Religion </label>
                                        </div>
                                        <div class="col-md-4 space"> 
                                            <select class="form-control" name="creligion" style="width: 100%;" >
                                                <option value="">--Select--</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Muslim">Muslim</option> 
                                                <option value="Christrian">Christrian</option>
                                                <option value="Others">Others</option> 
                                            </select>
                                        </div> -->
                                    <div class="col-md-2 space"> 
                                        <label>Residential Address<span style="color:red;">*</span></label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="text" name="radds" class="form-control" id="cust" required>
                                    </div>

                                    <!--    <div class="col-md-2 space"> 
                                            <label>Category</label>
                                        </div>
                                        <div class="col-md-4 space"> 
                                            <select class="form-control" name="ccaste" style="width: 100%;" >
                                                <option value="">--Select--</option>
                                                <option value="OBC">OBC</option>
                                                <option value="Open">Open</option> 
                                                <option value="SC">SC</option>
                                                <option value="ST">ST</option>
                                                <option value="Others">Others</option> 
                                            </select>
                                        </div> -->
                                    <div class="col-md-2 space"> 
                                        <label>Official Address</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="text" name="oadds" class="form-control" id="cust" >
                                    </div>

                                    <div class="col-md-2 space"> 
                                        <label>Marital Status</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <select class="form-control" name="maritalstatus" style="width: 100%;">
                                            <option value="">Select</option>
                                            <option value="married">Married</option>
                                            <option value="single">Single</option>
                                            <option value="divorsed">Divorsed</option>
                                            <option value="widow">Widow</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 space"> 
                                        <label>Pincode<span style="color:red;">*</span></label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="text" name="pincode" class="form-control" id="cust" maxlength="6" required>
                                    </div>

                                    <div class="col-md-2 space"> 
                                        <label>Spouse Name</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="text" name="cspousename" class="form-control" id="custname">
                                    </div>
                                    <div class="col-md-2 space"> 
                                        <label>City<span style="color:red;">*</span></label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <select class="form-control" name="ccity" style="width: 100%;" required>
<?php
$sql = mysql_query("SELECT CityId, CityName FROM city WHERE Active=1");
echo "<option value=''>Select</option>";
while ($row = mysql_fetch_array($sql)) {
    echo "<option value='" . $row['CityId'] . "'>" . $row['CityName'];
}
?>
                                        </select>
                                    </div>

                                    <div class="col-md-2 space"> 
                                        <label>Spouse DOB</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="date" name="spousedob" class="form-control" id="cust">
                                    </div>
                                    <div class="col-md-2 space"> 
                                        <label>State<span style="color:red;">*</span></label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <select class="form-control" name="cstate" style="width: 100%;" required>
<?php
$sql = mysql_query("SELECT StateId, StateName FROM state WHERE Active=1");
echo "<option value=''>Select</option>";
while ($row = mysql_fetch_array($sql)) {
    echo "<option value='" . $row['StateId'] . "'>" . $row['StateName'];
}
?>
                                        </select>
                                    </div>
                                    <div class="col-md-2 space"> 
                                        <label>Family Relation</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="text" name="family_reln" class="form-control" id="cust">
                                    </div>
                                    <div class="col-md-2 space"> 
                                        <label>Country<span style="color:red;">*</span></label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <select class="form-control" name="ccountry" style="width: 100%;" required>
<?php
$sql = mysql_query("SELECT CountryId, CountryName FROM country WHERE Active=1");
echo "<option value=''>Select</option>";
while ($row = mysql_fetch_array($sql)) {

    echo "<option value='" . $row['CountryId'] . "'>" . $row['CountryName'];
}
?>
                                        </select>
                                    </div>

                                    <div class="col-md-2 space"> 
                                        <label>Family Details</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="text"  name="familydetail" class="form-control" id="cust">
                                    </div>
                                    <div class="col-md-2 space"> 
                                        <label>Nominee Name</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="text"  name="cnomiee_name" class="form-control" id="cust">
                                    </div>
                                    <div class="col-md-2 space"> 
                                        <label>Nominee Age</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="text" name="cnomiee_age" class="form-control" id="cust">
                                    </div>

                                    <div class="col-md-2 space"> 
                                        <label>Nominee Relation</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="text" name="nomiee_relation" class="form-control" id="cust">
                                    </div>


                                    <div class="col-md-2 space"> 
                                        <label>UID/Adhaar No</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="text" name="cuidno" class="form-control" id="cust" maxlength="16">
                                    </div>
                                    <div class="col-md-2 space"> 
                                        <label>Attach Aadhar Card</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="file"  name="adhar_image" id="" class="form-control" maxlength="20">
                                    </div>

                                    <div class="col-md-2 space"> 
                                        <label>Pancard No<span style="color:red;"></span></label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="text"  name="cpan_no" class="form-control" id="cust" maxlength="20" >
                                    </div>
                                    <div class="col-md-2 space"> 
                                        <label>Attach Pancard</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="file" name="pan_image" id="" class="form-control" >
                                    </div>
                                    <div class="col-md-2 space"> 
                                        <label>Id type</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="text" name="idtype" class="form-control" id="cust" >
                                    </div>
                                    <div class="col-md-2 space"> 
                                        <label>Attach PhotoID</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="file" name="id_image" id="" class="form-control" />
                                    </div>
                                    <div class="col-md-2 space"> 
                                        <label>PhotoIdentity No</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="text"  name="idno" class="form-control" id="cust" maxlength="20" >
                                    </div>
                                    <div class="col-md-2 space"> 
                                        <label>MemberShip Fees</label>
                                    </div>
                                    <div class="col-md-4 space"> 
<?php
$sql = mysql_query("SELECT * FROM `membershipfees` ORDER BY MemberShipFeesId DESC LIMIT 1");
$row = mysql_fetch_array($sql);
?>
                                        <input type="text" value="<?php echo $row['MemberShipFees'] ?>" class="form-control" name="membership" id="cust" readonly>
                                    </div>


                                    <div class="col-md-2 space"> 

                                    </div>
                                    <div class="col-md-4 space"> 
                                        <select style="display: none;" class="form-control" name="status" style="width: 100%;">
                                            <option  value="pending">Pending</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer text-center">
                                <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Save">
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


        <script>
            $('#datepick').datepicker({
            autoclose: true;
            format: 'dd-mm-yyyy';
            });
        </script>
        <script type="text/javascript">
            function getAge(){
            var dob = document.getElementById('datepick').value;
            dob = new Date(dob);
            var today = new Date();
            var age = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));
            document.getElementById('age').value = age;
            }

        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> 
        <!-- webcam link -->
        <script type='text/javascript'>
            $(document).ready(function() {
            $("#imgInp").on('change', function() {
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
            reader.onload = function(e) {
            $("<img />", {
            "src": e.target.result,
                    "class": "thumb-image"
            }).height(100).width(100).appendTo(image_holder);
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
        </script>

        <script>
            function preview_image1(event)
            {
            var reader = new FileReader();
            reader.onload = function()
            {
            var output = document.getElementById('output_image1');
            output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
            }

            function preview_image2(event)
            {
            var reader = new FileReader();
            reader.onload = function()
            {
            var output = document.getElementById('output_image2');
            output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
            }

            function preview_image3(event)
            {
            var reader = new FileReader();
            reader.onload = function()
            {
            var output = document.getElementById('output_image3');
            output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
            }

            function preview_image4(event)
            {
            var reader = new FileReader();
            reader.onload = function()
            {
            var output = document.getElementById('output_image4');
            output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
            }
        </script>

        <script type="text/javascript" src="../js/webcam.js"></script>
        <script>
            $(function(){
            //give the php file path
            webcam.set_api_url('upload.php');
            webcam.set_swf_url('../js/webcam.swf'); //flash file (SWF) file path
            webcam.set_quality(100); // Image quality (1 - 100)
            webcam.set_shutter_sound(true); // play shutter click sound

            var camera = $('#camera');
            camera.html(webcam.get_html(250, 150)); //generate and put the flash embed code on page

            $('#capture_btn').click(function(){
            //take snap
            webcam.snap();
            });
            //after taking snap call show image
            webcam.set_hook('onComplete', function(img){
            document.getElementById('image').innerHTML =
                    '<img src="' + img + '" width="100px" height="100px"/>';
            //reset camera for the next shot
            webcam.reset();
            //reset camera for the next shot
            document.getElementById("imgInp").disabled = true;
            });
            });
        </script>

        <script type="text/javascript">

            function validationcheck()
            {

            /* var imgInp=$("#imgInp").val(); 
             var signatureerror=$("#signatureerror").val();   
             if(imgInp=='')
             {
             alert("fgfd");
             $("#photoerror").show();
             setTimeout(function(){ $('#photoerror').fadeOut() }, 5000);
             return false;
             }
             
             else if(signatureerror=='')
             {
             $("#signatureerror").show();
             setTimeout(function(){ $('#signatureerror').fadeOut() }, 5000);
             return false;
             }
             else
             {*/
            jSuccess('Customer Added succesfully', 'Success Dialog');
            // }
            }
        </script>


<?php include 'customer_script.php'; ?>

    </body>
</html>
