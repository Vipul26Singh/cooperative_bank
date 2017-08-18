<?php
include '../superadmin-session.php';
error_reporting(0);
$cid = $_GET['id'];

if (isset($_REQUEST['submit'])) {
    $c_name = $_POST['cust_name'];
    $c_cno = $_POST['cust_mno'];
    $c_dob = $_POST['cdob'];
    $cage = $_POST['cage'];
    $cfather = $_POST['cfather'];
    $cgen = $_POST['cgen'];
    $cemail = $_POST['cemailid'];
    $ctele = $_POST['ctele'];
    $ccaste = $_POST['ccaste'];
    $crel = $_POST['crelign'];
    $cradd = $_POST['cresadd'];
    $coadd = $_POST['coffadd'];
    $ccity = $_POST['ccity'];
    $cpin = $_POST['pin'];
    $cstate = $_POST['cstate'];
    $ccountry = $_POST['ccountry'];
    $mstatus = $_POST['mstatus'];
    $sname = $_POST['spname'];
    $nname = $_POST['nname'];
    $nage = $_POST['nage'];
    $sdob = $_POST['spdob'];
    $fdetail = $_POST['familydetail'];
    $nrel = $_POST['nrelatn'];
    $frel = $_POST['familyrelatn'];
    $uid = $_POST['uid'];
    $pan = $_POST['panno'];
    $photoidno = $_POST['photoid'];
    $id_type = $_POST['idtype'];

    $panimage = rand(1000, 100000) . "-" . $_FILES['panimage']['name'];
    $panimage_loc = $_FILES['panimage']['tmp_name'];
    $adharimage = rand(1000, 100000) . "-" . $_FILES['adharimage']['name'];
    $adharimage_loc = $_FILES['adharimage']['tmp_name'];
    $signimage = rand(1000, 100000) . "-" . $_FILES['csignimage']['name'];
    $signimage_loc = $_FILES['csignimage']['tmp_name'];
    $cimage = rand(1000, 100000) . "-" . $_FILES['cimage']['name'];
    $cimage_loc = $_FILES['cimage']['tmp_name'];
    $photoid = rand(1000, 100000) . "-" . $_FILES['idimage']['name'];
    $photoid_loc = $_FILES['idimage']['tmp_name'];
    $folder = "../upload/";

    if (move_uploaded_file($panimage_loc, $folder . $panimage)) {
        $sql5 = mysql_query("UPDATE `customer` SET `IDProof2`='" . $panimage . "' WHERE CustomerID ='" . $cid . "' ");
    }
    if (move_uploaded_file($adharimage_loc, $folder . $adharimage)) {
        $sql4 = mysql_query("UPDATE `customer` SET `IDProof1`='" . $adharimage . "' WHERE CustomerID ='" . $cid . "' ");
    }
    if (move_uploaded_file($signimage_loc, $folder . $signimage)) {
        $sql6 = mysql_query("UPDATE `customer` SET `CSign`='" . $signimage . "' WHERE CustomerID ='" . $cid . "' ");
    }
    if (move_uploaded_file($cimage_loc, $folder . $cimage)) {
        $sql2 = mysql_query("UPDATE `customer` SET `mphoto`='" . $cimage . "' WHERE CustomerID ='" . $cid . "' ") or die(mysql_error());
    }
    if (move_uploaded_file($photoid_loc, $folder . $photoid)) {
        $sql3 = mysql_query("UPDATE `customer` SET `photoid`='" . $photoid . "' WHERE CustomerID ='" . $cid . "' ");
    }


    $sql1 = mysql_query("UPDATE `customer` SET 
                `CustomerName`='" . $c_name . "', 
                `ResAddress`='" . $cradd . "',
                `OffAddress`='" . $coadd . "',
                `TelPhoneNo`='" . $ctele . "',
                `MobileNo`='" . $c_cno . "', 
                `BirthDate`='" . $c_dob . "',
                `Age`='" . $cage . "',
                `CityId`='" . $ccity . "',
                `StateId`='" . $cstate . "',
                `CountryId`='" . $ccountry . "',
                `EmailID`='" . $cemail . "',
                `pincode`='" . $cpin . "', 
                `MartialStatus`='" . $mstatus . "',
                `SpouseName`='" . $sname . "',
                `SpouseDOB`='" . $sdob . "',
                `NomineeName`='" . $nname . "', 
                `NomineeAge`='" . $nage . "',
                `NomineeRelation`='" . $nrel . "',
                `Religion`='" . $crel . "',
                `Caste`='" . $ccaste . "',
                `Gender`='" . $cgen . "',
                `ApplicantFather`='" . $cfather . "',
                `FamilyDetails`='" . $fdetail . "',
                `FamilyRelation`='" . $frel . "',
                `PanCardNo`='" . $pan . "',
                `Uidno`='" . $uid . "',
                `idtype`='" . $id_type . "',
                `PhotoIdentityNumber`='" . $photoidno . "',
                `LastModifiedBy`='" . $login_session_id . "', 
                `LastModifiedDate`=CURTIME() 
                WHERE CustomerID ='" . $cid . "' ") or die(mysql_error());

    if ($sql1) {
        header("location: approvedcustomer_list.php");
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
<?php include 'include/mang_nav.php'; ?>
        <style >
            .space{
                margin-bottom: 6px;
            }
        </style>

        <script src="../js/3.1.1.js" type="text/javascript"></script>
        <script src="../js/3.37.js" type="text/javascript"></script>
        <!-- image upload -->
        <script src="../js/1.5.2.js" type="text/javascript"></script>
        <script src="../js/1.10.1.js" type="text/javascript"></script>


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

<?php include 'include/mang_sidenav.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                <section class="content">

                    <form role="form" method="post" action="" enctype="multipart/form-data">

<?php
//echo $cid;

$sql = mysql_query("SELECT customer.*,state.StateName,city.CityName,country.CountryName,branch.BranchName FROM customer INNER JOIN state ON customer.StateId=state.StateId INNER JOIN city ON city.CityId = customer.CityId INNER JOIN country ON customer.CountryId=country.CountryId INNER JOIN branch ON customer.BranchId = branch.BranchId WHERE CustomerID ='" . $cid . "' ") or die(mysql_error());
//$sql = mysql_query("select ");
while ($row = mysql_fetch_array($sql)) {
    ?>

                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Update Customer Detail</h3>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->

                                <div class="box-body">

                                    <div class="col-md-2 space">
                                        <label>Applicant Name</label>
                                    </div>
                                    <div class="col-md-4 space">
                                        <input type="text" name="cust_name" value="<?php echo $row['CustomerName']; ?>" class="form-control" id="custname" >
                                    </div>
                                    <div class="col-md-2 space">
                                        <label>Mobile No</label>
                                    </div>
                                    <div class="col-md-4 space">
                                        <input type="text" name="cust_mno" value="<?php echo $row['MobileNo']; ?>" class="form-control" id="mno"  >
                                    </div>

                                    <div class="col-md-2 space">
                                        <label>Applicant Photo/Signature</label><br>
                                    </div>
                                    <div class="col-md-4 space">

                                        <div  id="image" class="form-group" style="border:1px solid lightgrey;float:left;height:100px; width:100px;" >
    <?php
    echo '<img src="../upload/' . $row['mphoto'] . '" id="output_image" style="width:100px; height:100px" />'
    ?>
                                        </div> 
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <?php
                                            echo '<img src="../upload/' . $row['CSign'] . '" id="output_image1" style="width:100px; height:100px" />'
                                            ?>
                                        <br><br>

                                        <div class="btn btn-sm btn-default btn-file" id="divphoto" runat="server">
                                            <i class="fa fa-image"></i>&nbsp;&nbsp;&nbsp; User Photo
                                            <input type="file" name="cimage" accept="upload/*" onchange="preview_image(event)" onchange="readURL(this);" id="imgInp" width="100px" >
                                        </div>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <div class="btn btn-sm btn-default btn-file" id="div1" runat="server">
                                            <i class="fa fa-image"></i>&nbsp; Signature Photo
                                            <input type="file" accept="upload/*" onchange="preview_image1(event)" name="csignimage" id="cust" width="100px" >
                                        </div>
                                    </div>

                                    <div class="col-md-2 space">
                                        <label>Branch Name</label>
                                    </div>
                                    <div class="col-md-4 space">
                                        <input type="text" value="<?php echo $row['BranchName']; ?>" class="form-control" id="custname" readonly>
                                    </div>

                                    <div class="col-md-2 space"> 
                                        <label>Applicant DOB</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="text" name="cdob" value="<?php echo date('d-m-Y', strtotime($row['BirthDate'])); ?>" class="form-control" placeholder="dd-mm-yyyy" >
                                    </div>
                                    <div class="col-md-2 space"> 
                                        <label>Applicant Age</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="text" name="cage" value="<?php echo $row['Age']; ?>" class="form-control" id="age" >
                                    </div>

                                    <div class="col-md-2 space"> 
                                        <label>Applicant Father</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="text" name="cfather" value="<?php echo $row['ApplicantFather']; ?>" class="form-control" id="custname" >
                                    </div>
                                    <div class="col-md-2 space"> 
                                        <label>Gender</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="text" name="cgen" value="<?php echo $row['Gender']; ?>" class="form-control" id="custname" >
                                    </div>

                                    <div class="col-md-2 space"> 
                                        <label>Email ID</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="email" name="cemailid" value="<?php echo $row['EmailID']; ?>" class="form-control" id="cust" >
                                    </div>
                                    <div class="col-md-2 space"> 
                                        <label>Telephone No</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="text" name="ctele" value="<?php echo $row['TelPhoneNo']; ?>" class="form-control" id="cust" >
                                    </div>

                                    <!--  <div class="col-md-2 space"> 
                                         <label>Religion</label>
                                     </div>
                                     <div class="col-md-4 space"> 
                                         <input type="text" name="crelign" value="<?php echo $row['Religion']; ?>" class="form-control" id="cust" >
                                     </div> -->
                                    <div class="col-md-2 space"> 
                                        <label>Residential Address</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="text" name="cresadd" value="<?php echo $row['ResAddress']; ?>" class="form-control" id="cust" >
                                    </div>

                                    <!-- <div class="col-md-2 space"> 
                                        <label>Category</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="text" name="ccaste" value="<?php echo $row['Caste']; ?>" class="form-control" id="custname" >
                                    </div> -->
                                    <div class="col-md-2 space"> 
                                        <label>Official Address</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="text" name="coffadd" value="<?php echo $row['OffAddress']; ?>" class="form-control" id="cust" >
                                    </div>

                                    <div class="col-md-2 space"> 
                                        <label>Marital Status</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="text" name="mstatus" value="<?php echo $row['MartialStatus']; ?>" class="form-control" id="cust" >
                                    </div>
                                    <div class="col-md-2 space"> 
                                        <label>Pincode</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="text" name="pin" value="<?php echo $row['pincode']; ?>" class="form-control" id="cust" >
                                    </div>

                                    <div class="col-md-2 space"> 
                                        <label>Spouse Name</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="text" name="spname" value="<?php echo $row['SpouseName']; ?>" class="form-control" id="custname" >
                                    </div>
                                    <div class="col-md-2 space"> 
                                        <label>City</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <select class="form-control" name="ccity" style="width: 100%;">
    <?php
    echo "<option value='" . $row['CityId'] . "'>" . $row['CityName'];
    $result = mysql_query("SELECT CityId, CityName FROM city ");

    while ($city = mysql_fetch_array($result)) {
        if ($city['CityName'] == $row['CityName']) {
            "<option style='display: none;' value='' >";
        } else {
            echo "<option value='" . $city['CityId'] . "'>" . $city['CityName'];
        }
    }
    ?>
                                        </select>
                                    </div>

                                    <div class="col-md-2 space"> 
                                        <label>Spouse DOB</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="text" name="spdob" value="<?php echo date('d-m-Y', strtotime($row['SpouseDOB'])); ?>" class="form-control" id="cust" >
                                    </div>
                                    <div class="col-md-2 space"> 
                                        <label>State</label>
                                    </div>
                                    <div class="col-md-4 space">
                                        <select class="form-control" name="cstate" style="width: 100%;">
    <?php
    echo "<option value='" . $row['StateId'] . "'>" . $row['StateName'];
    $result1 = mysql_query("SELECT StateId, StateName FROM state ");
    while ($st = mysql_fetch_array($result1)) {
        if ($st['StateName'] == $row['StateName']) {
            "<option style='display: none;' value='' >";
        } else {
            echo "<option value='" . $st['StateId'] . "'>" . $st['StateName'];
        }
    }
    ?>
                                        </select>
                                    </div>

                                    <div class="col-md-2 space"> 
                                        <label>Family Details</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="text"  name="familydetail" value="<?php echo $row['FamilyDetails']; ?>" class="form-control" id="cust" >
                                    </div>
                                    <div class="col-md-2 space"> 
                                        <label>Country</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <select class="form-control" name="ccountry" style="width: 100%;">
    <?php
    echo "<option value='" . $row['CountryId'] . "'>" . $row['CountryName'];
    $result2 = mysql_query("SELECT CountryId, CountryName FROM country ");
    while ($c = mysql_fetch_array($result2)) {
        if ($c['CountryName'] == $row['CountryName']) {
            "<option style='display: none;' value='' >";
        } else {
            echo "<option value='" . $c['CountryId'] . "'>" . $c['CountryName'];
        }
    }
    ?>
                                        </select>
                                    </div>

                                    <div class="col-md-2 space"> 
                                        <label>Nominee Name</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="text"  name="nname" value="<?php echo $row['NomineeName']; ?>"  class="form-control" id="cust" >
                                    </div>
                                    <div class="col-md-2 space"> 
                                        <label>Nominee Age</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="text" name="nage" value="<?php echo $row['NomineeAge']; ?>" class="form-control" id="cust" >
                                    </div>

                                    <div class="col-md-2 space"> 
                                        <label>Nominee Relation</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="text" name="nrelatn" value="<?php echo $row['NomineeRelation']; ?>" class="form-control" id="cust" >
                                    </div>
                                    <div class="col-md-2 space"> 
                                        <label>Family Relation</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="text" name="familyrelatn" value="<?php echo $row['FamilyRelation']; ?>" class="form-control" id="cust" >
                                    </div>

                                    <div class="col-md-2 space"> 
                                        <label>UID/Adhaar No</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="text" name="uid" value="<?php echo $row['Uidno']; ?>" class="form-control" id="cust" >
                                    </div>
                                    <div class="col-md-2 space"> 
                                        <label>Attach Aadhar Card</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="file" name="adharimage" value="<?php //echo $row[''];  ?>" id="" class="form-control" >
                                    </div>

                                    <div class="col-md-2 space"> 
                                        <label>Pancard No</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="text" name="panno" value="<?php echo $row['PanCardNo']; ?>" class="form-control" id="cust" maxlength="12" >
                                    </div>
                                    <div class="col-md-2 space"> 
                                        <label>Attach Pancard</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="file" name="panimage" value="<?php //echo $row[''];  ?>" id="" class="form-control" >
                                    </div>

                                    <div class="col-md-2 space"> 
                                        <label>PhotoIdentity No</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="text" name="photoid" value="<?php echo $row['PhotoIdentityNumber']; ?>" class="form-control" id="cust" >
                                    </div>
                                    <div class="col-md-2 space"> 
                                        <label>Attach PhotoID</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="file" name="idimage" value="<?php //echo $row[''];  ?>" id="" class="form-control" >
                                    </div>

                                    <div class="col-md-2 space"> 
                                        <label>Id type</label>
                                    </div>
                                    <div class="col-md-4 space"> 
                                        <input type="text" name="idtype" value="<?php echo $row['idtype'] ?>" class="form-control" id="cust" >
                                    </div>

                                </div>

                            </div>

                            <div id="" class="box box-warning">
                                <div class="box-body">

                                    <div class="col-md-2">
                                        <h4>Address Proof</h4>
                                        <img id="" src="../upload/<?php echo $row['IDProof1']; ?>" style="height:100px;width:100px;" />
                                    </div>
                                    <div class="col-md-2 text-left">
                                        <br><br>
                                        <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal">View</button>
                                        <br /><br />
                                        <a class="links" href="download.php?file=<?php echo $row['IDProof1']; ?>"><i class="fa fa-download"></i> Download</a>
                                    </div>
                                    <!-- Address Proof modal -->  
                                    <div class="modal fade bs-example-modal-sm" id="myModal" role="dialog">
                                        <div class="modal-dialog">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <img id="" src="../upload/<?php echo $row['IDProof1'] ?>" style="height:400px;width:500px;"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Address Proof modal end -->   


                                    <div class="col-md-2">
                                        <h4>Identity card</h4>
                                        <img id="" src="../upload/<?php echo $row['photoid'] ?>" style="height:100px;width:100px;" />
                                    </div>
                                    <div class="col-md-2 pull-left">
                                        <br ><br>
                                        <button type="button"  class="btn btn-sm btn-default" data-toggle="modal" data-target="#myModal1">View</button>
                                        <br /><br>
                                        <a id="" class="links"  href="download.php?file=<?php echo $row['photoid'] ?>"><i class="fa fa-download"></i> Download</a>
                                    </div>

                                    <!-- Identity card modal -->  
                                    <div class="modal fade bs-example-modal-sm" id="myModal1" role="dialog">
                                        <div class="modal-dialog">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <img id="" src="../upload/<?php echo $row['photoid'] ?>" style="height:400px;width:500px;"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Identity card modal end -->    

                                    <div class="col-md-2">
                                        <h4>Pancard</h4>
                                        <img id="" src="../upload/<?php echo $row['IDProof2'] ?>" style="height:100px;width:100px;" />
                                    </div>
                                    <div class="col-md-2 text-left">
                                        <br><br>
                                        <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#myModal2">View</button>
                                        <br><br>
                                        <a class="links" href="download.php?file=<?php echo $row['IDProof2'] ?>"><i class="fa fa-download"></i> Download</a>
                                    </div>
                                    <div class="modal fade bs-example-modal-sm" id="myModal2" role="dialog">
                                        <div class="modal-dialog">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <img id="" src="../upload/<?php echo $row['IDProof2']; ?>" style="height:400px;width:500px;"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="box-footer text-center">
                                    <input type="submit" name="submit" class="btn btn-primary" value="Update">
                                </div>
                            </div> 
<?php }
?>
                    </form>
                </section>           

                <!-- /.box-body -->


                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
<?php include 'include/mang_script.php'; ?>
            <!-- Control Sidebar -->

            <div class="control-sidebar-bg"></div>
        </div>


        <!-- webcam link -->



    </body>
</html>
