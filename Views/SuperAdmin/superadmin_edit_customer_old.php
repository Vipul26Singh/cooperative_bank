<?php
include '../superadmin-session.php';
error_reporting(0);
$cid = $_GET['id'];

if (isset($_POST['submit'])) {
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

    //$result = file_put_contents( $folder.$cimage, file_get_contents('php://input') );


    if (move_uploaded_file($panimage_loc, $folder . $panimage)) {
        $sql5 = mysql_query("UPDATE `customer` SET `IDProof2`='" . $panimage . "' WHERE CustomerID ='" . $cid . "' ");
        //echo 'inserted';
        //echo 'inserted';
    }
    if (move_uploaded_file($adharimage_loc, $folder . $adharimage)) {
        $sql4 = mysql_query("UPDATE `customer` SET `IDProof1`='" . $adharimage . "' WHERE CustomerID ='" . $cid . "' ");
        //echo 'inserted';
    }
    if (move_uploaded_file($signimage_loc, $folder . $signimage)) {
        $sql6 = mysql_query("UPDATE `customer` SET `CSign`='" . $signimage . "' WHERE CustomerID ='" . $cid . "' ");
        //echo 'inserted'; 
    }
    if (move_uploaded_file($cimage_loc, $folder . $cimage)) {
        $sql2 = mysql_query("UPDATE `customer` SET `mphoto`='" . $cimage . "' WHERE CustomerID ='" . $cid . "' ") or die(mysql_error());

        //echo "Updated";
        //echo "UPDATE `customer` SET `mphoto`='".$cimage."' WHERE CustomerID ='".$cid."' ";
        //header("location: superadmin_customer_list.php");
    }


    if (move_uploaded_file($photoid_loc, $folder . $photoid)) {
        $sql3 = mysql_query("UPDATE `customer` SET `photoid`='" . $photoid . "' WHERE CustomerID ='" . $cid . "' ");
        //echo 'inserted';
    }


    $sql1 = mysql_query("UPDATE `customer` SET `CustomerName`='" . $c_name . "', `ResAddress`='" . $cradd . "',`OffAddress`='" . $coadd . "',`TelPhoneNo`='" . $ctele . "',`MobileNo`='" . $c_cno . "',`BirthDate`='" . $c_dob . "',`Age`='" . $cage . "',`CityId`='" . $ccity . "',`StateId`='" . $cstate . "',`CountryId`='" . $ccountry . "',`EmailID`='" . $cemail . "',`pincode`='" . $cpin . "',`MartialStatus`='" . $mstatus . "',`SpouseName`='" . $sname . "',`SpouseDOB`='" . $sdob . "',`NomineeName`='" . $nname . "',`NomineeAge`='" . $nage . "',`NomineeRelation`='" . $nrel . "',`Religion`='" . $crel . "',`Caste`='" . $ccaste . "',`Gender`='" . $cgen . "',`ApplicantFather`='" . $cfather . "',`FamilyDetails`='" . $fdetail . "',`FamilyRelation`='" . $frel . "',`PanCardNo`='" . $pan . "',`Uidno`='" . $uid . "',`idtype`='" . $id_type . "',`PhotoIdentityNumber`='" . $photoidno . "',`LastModifiedBy`='" . $login_session_id . "', `LastModifiedDate`=CURTIME() WHERE CustomerID ='" . $cid . "' ") or die(mysql_error());
    //$sql = mysql_query("UPDATE customer,city,state,country SET customer.CustomerName='".$c_name."', customer.ResAddress='".$cradd."', customer.OffAddress='".$coadd."', customer.TelPhoneNo='".$ctele."', customer.MobileNo='".$c_cno."', customer.BirthDate='".$c_dob."', customer.Age='".$cage."', city.CityName='".$ccity."', state.StateName='gujarat', country.CountryName='india', customer.EmailID='abcxyz@abc.com', customer.pincode=440030, customer.MartialStatus='Single', customer.SpouseName='', customer.SpouseDOB='', customer.NomineeName='asds', customer.NomineeAge=56, customer.NomineeRelation='ggffg', customer.Religion='hindu', customer.Caste='abc', customer.Gender='male', customer.ApplicantFather='xyz', customer.FamilyDetails='gfgffg', customer.FamilyRelation='hggu', customer.PanCardNo=14454878, customer.Uidno=656565,customer.idtype='voting card', customer.PhotoIdentityNumber=6846546 WHERE customer.CityId=city.CityId AND customer.StateId=state.StateId AND customer.CountryId = country.CountryId AND customer.CustomerID=10") or die(mysql_error());
    //echo "UPDATE `customer` SET `CustomerName`='".$c_name."', `ResAddress`='".$cradd."',`OffAddress`='".$coadd."',`TelPhoneNo`='".$ctele."',`MobileNo`='".$c_cno."',`BirthDate`='".$c_dob."',`Age`='".$cage."',`CityId`='".$ccity."',`StateId`='".$cstate."',`CountryId`='".$ccountry."',`EmailID`='".$cemail."',`pincode`='".$cpin."',`MartialStatus`='".$mstatus."',`SpouseName`='".$sname."',`SpouseDOB`='".$sdob."',`NomineeName`='".$nname."',`NomineeAge`='".$nage."',`NomineeRelation`='".$nrel."',`Religion`='".$crel."',`Caste`='".$ccaste."',`Gender`='".$cgen."',`ApplicantFather`='".$cfather."',`FamilyDetails`='".$fdetail."',`FamilyRelation`='".$frel."',`PanCardNo`='".$pan."',`Uidno`='".$uid."',`idtype`='".$id_type."',`PhotoIdentityNumber`='".$photoidno."',`LastModifiedBy`='".$login_session_id."', `LastModifiedDate`=CURTIME()  WHERE CustomerID ='".$cid."' "; 

    if ($sql1) {
        echo "Successfully Updated";
        header("location: superadmin_customer_list.php");
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
<?php include 'include/nav.php'; ?>
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
        <?php include 'include/sidenav.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                <section class="content">

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Customer Detail</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="" enctype="multipart/form-data">

<?php
//echo $cid;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = mysql_query("SELECT customer.*,state.StateName,city.CityName,country.CountryName,branch.BranchName FROM customer INNER JOIN state ON customer.StateId=state.StateId INNER JOIN city ON city.CityId = customer.CityId INNER JOIN country ON customer.CountryId=country.CountryId INNER JOIN branch ON customer.BranchId = branch.BranchId WHERE CustomerID ='" . $id . "' ") or die(mysql_error());

    while ($row = mysql_fetch_array($sql)) {
        ?>

                                    <div class="box-body">
                                        <div class="col-md-6"> 
                                            <label>Photo/Signature</label>
                                            <div class="form-group">
                                    <?php
                                    //echo $row['mphoto']; 
                                    echo '<img src="../upload/' . $row['mphoto'] . '" id="output_image" style="width:100px; height:100px" />'
                                    //echo '<img src="data:upload/jpeg;base64,'.base64_encode( $row['mphoto'] ).'" style="width:100px; height:100px" />';
                                    ?>
                                                &nbsp;&nbsp;&nbsp;&nbsp;
        <?php
        //echo $row['CSign']; 
        //echo '<img src="upload/11154-attendance.jpg" style="width:100px; height:100px" />'
        echo '<img src="../upload/' . $row['CSign'] . '" id="output_image1" style="width:100px; height:100px" />'
        ?>

                                            </div>
                                            <div class="btn btn-sm btn-default btn-file" id="divphoto" runat="server">
                                                <i class="fa fa-image"></i>&nbsp; User Photo
                                                <input type="file"  accept="upload/*" onchange="preview_image(event)" onchange="readURL(this);" name="cimage" id="imgInp" width="100px" >
                                            </div>
                                            <div class="btn btn-sm btn-default btn-file" id="div1" runat="server">
                                                <i class="fa fa-image"></i>&nbsp; Signature Photo
                                                <input type="file" accept="upload/*" onchange="preview_image1(event)" name="csignimage" id="cust" width="100px" >
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <!--   <div class="form-group">
                                               <label>Customer ID</label>
                                               <input name="cid" class="form-control" id="cust"  value="<?php //echo $row[0];  ?>" >
                                               </div> -->
                                            <div class="form-group">
                                                <label>Branch Name</label>
        <?php echo $row['BranchName']; ?>
                                            </div> 
                                            <div class="form-group">
                                                <label>Customer Name</label>
                                                <input type="text" value="<?php echo $row['CustomerName']; ?>" name="cust_name" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Mobile No</label>
                                                <input type="text" value="<?php echo $row['MobileNo']; ?>" class="form-control" name="cust_mno">
                                            </div>
                                        </div>

                                        <div class="col-md-6">             
                                            <div class="form-group">
                                                <label>Date of Birth</label>
                                                <input type="text" value="<?php echo date('d-m-Y', strtotime($row['BirthDate'])); ?>" class="form-control" name="cdob" >
                                            </div>
                                            <div class="form-group">
                                                <label>Age</label>
                                                <input type="text" value="<?php echo $row['Age']; ?>" class="form-control" name="cage">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Applicant Father Name</label>
                                                <input type="text" value="<?php echo $row['ApplicantFather']; ?>" class="form-control" name="cfather">
                                            </div>
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <input type="text" value="<?php echo $row['Gender']; ?>" class="form-control" name="cgen">                    
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email ID</label>
                                                <input type="text" value="<?php echo $row['EmailID']; ?>" class="form-control" name="cemailid">
                                            </div>
                                            <div class="form-group">
                                                <label>Telephone No</label>
                                                <input type="text" value="<?php echo $row['TelPhoneNo']; ?>" class="form-control" name="ctele">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Caste</label>
                                                <input type="text" value="<?php echo $row['Caste']; ?>" class="form-control" name="ccaste">
                                            </div>
                                            <div class="form-group">
                                                <label>Religion</label>
                                                <input type="text" value="<?php echo $row['Religion']; ?>" class="form-control" name="crelign">
                                            </div>
                                        </div>

                                        <div class="col-md-6">             
                                            <div class="form-group">
                                                <label>Residential Address</label>
                                                <input type="text" value="<?php echo $row['ResAddress']; ?>" class="form-control" name="cresadd">
                                            </div>
                                            <div class="form-group">
                                                <label>Official Address</label>
                                                <input type="text" value="<?php echo $row['OffAddress']; ?>" class="form-control" name="coffadd">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>City</label>
                                                <select class="form-control" name="ccity" style="width: 100%;">
        <?php
        echo "<option value='" . $row['CityId'] . "'>" . $row['CityName'];
        $result = mysql_query("SELECT CityId, CityName FROM city WHERE Active=1");

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
                                            <div class="form-group">
                                                <label>Pincode</label>
                                                <input type="text" value="<?php echo $row['pincode']; ?>" class="form-control" name="pin">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>State</label>
                                                <select class="form-control" name="cstate" style="width: 100%;">
        <?php
        echo "<option value='" . $row['StateId'] . "'>" . $row['StateName'];
        $result1 = mysql_query("SELECT StateId, StateName FROM state WHERE Active=1");
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
                                            <div class="form-group">
                                                <label>Country</label>
                                                <select class="form-control" name="ccountry" style="width: 100%;">
        <?php
        //include 'config.php';
        //$sql = mysql_query("SELECT CountryId, CountryName FROM country");
        //while ($row = mysql_fetch_array($sql)) {
        //echo "<option>--Select--</option>";
        echo "<option value='" . $row['CountryId'] . "'>" . $row['CountryName'];
        $result2 = mysql_query("SELECT CountryId, CountryName FROM country WHERE Active=1");
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
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Marital Status</label>
                                                <input type="text" value="<?php echo $row['MartialStatus']; ?>" class="form-control" name="mstatus">
                                            </div>
                                            <div class="form-group">
                                                <label>Spouse Name</label>
                                                <input type="text" value="<?php echo $row['SpouseName']; ?>" class="form-control" name="spname">
                                            </div>
                                        </div>

                                        <div class="col-md-6">             
                                            <div class="form-group">
                                                <label>Nominee Name</label>
                                                <input type="text" value="<?php echo $row['NomineeName']; ?>" class="form-control" name="nname"> 
                                            </div>
                                            <div class="form-group">
                                                <label>Nominee Age</label>
                                                <input type="text" value="<?php echo $row['NomineeAge']; ?>" class="form-control" name="nage">
                                            </div>
                                        </div>

                                        <div class="col-md-6">             
                                            <div class="form-group">
                                                <label>Spouse DOB</label>
                                                <input type="text" value="<?php echo date('d-m-Y', strtotime($row['SpouseDOB'])); ?>" class="form-control" name="spdob">
                                            </div>
                                            <div class="form-group">
                                                <label>Family Details</label>
                                                <input type="text" value="<?php echo $row['FamilyDetails']; ?>" class="form-control" name="familydetail">
                                            </div>
                                        </div>

                                        <div class="col-md-6">             
                                            <div class="form-group">
                                                <label>Nominee Relation</label>
                                                <input type="text" value="<?php echo $row['NomineeRelation']; ?>" class="form-control" name="nrelatn">
                                            </div>
                                        </div>

                                        <div class="col-md-6">   
                                            <div class="form-group">
                                                <label>Family Relation</label>
                                                <input type="text" value="<?php echo $row['FamilyRelation']; ?>" class="form-control" name="familyrelatn">
                                            </div>
                                        </div>

                                        <div class="col-md-6">             
                                            <div class="form-group">
                                                <label>UID Number</label>
                                                <input type="text" value="<?php echo $row['Uidno']; ?>" class="form-control" name="uid">
                                            </div>
                                            <label> Aadhar Card</label>
                                            <div class="form-group">
        <?php //echo $row['IDProof1']; 
        echo '<img src="../upload/' . $row['IDProof1'] . '" id="output_image2" style="width:100px; height:100px" />'
        ?>
                                            </div>
                                            <div class="btn btn-sm btn-default btn-file" id="div1" runat="server">
                                                <i class="fa fa-image"></i>&nbsp; Aadhar Photo
                                                <input type="file" accept="upload/*" onchange="preview_image2(event)" name="adharimage" id="cust" width="100px" >
                                            </div>
                                        </div>

                                        <div class="col-md-6">             
                                            <div class="form-group">
                                                <label>Pancard No</label>
                                                <input type="text" value="<?php echo $row['PanCardNo']; ?>" class="form-control" name="panno">
                                            </div>
                                            <label> Pancard</label>
                                            <div class="form-group">
        <?php //echo $row['IDProof2']; 
        echo '<img src="../upload/' . $row['IDProof2'] . '" id="output_image3" style="width:100px; height:100px" />'
        ?>
                                            </div>
                                            <div class="btn btn-sm btn-default btn-file" id="div1" runat="server">
                                                <i class="fa fa-image"></i>&nbsp; Pancard Photo
                                                <input type="file" accept="upload/*" onchange="preview_image3(event)" name="panimage" id="cust" width="100px" >
                                            </div>
                                        </div>

                                        <div class="col-md-6">             
                                            <div class="form-group">
                                                <label>PhotoId No</label>
                                                <input type="text" value="<?php echo $row['PhotoIdentityNumber']; ?>" class="form-control" name="photoid">
                                            </div>
                                            <label>PhotoID</label>
                                            <div class="form-group">
        <?php //echo $row['photoid']; 
        echo '<img src="../upload/' . $row['photoid'] . '" id="output_image4" style="width:100px; height:100px" />'
        ?>
                                            </div>
                                            <div class="btn btn-sm btn-default btn-file" id="div1" runat="server">
                                                <i class="fa fa-image"></i>&nbsp; ID Photo
                                                <input type="file" accept="upload/*" onchange="preview_image4(event)" name="idimage" id="cust" width="100px" >
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Id type</label>
                                                <input type="text" value="<?php echo $row['idtype']; ?>" class="form-control" name="idtype">
                                            </div>
                                            <!--     -->
                                        </div>
                                    </div>
                                    <div class="box-footer text-center">
                                        <input type="submit" name="submit" class="btn btn-primary" value="Update detail">
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

    </body>
</html>
