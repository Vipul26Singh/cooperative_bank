<?php
include '../superadmin-session.php';
error_reporting(0);
$cid = $_GET['id'];
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


                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="superadmin_edit_customer.php?id=<?php echo $cid ?>">

                        <?php
                        if (isset($_GET['id'])) {
                            //echo $_GET['id'];
                            $id = $_GET['id'];
                            $sql = mysql_query("SELECT customer.*, state.StateName, city.CityName, country.CountryName FROM customer INNER JOIN state ON customer.StateId=state.StateId INNER JOIN city ON city.CityId = customer.CityId INNER JOIN country ON customer.CountryId=country.CountryId WHERE CustomerID ='" . $cid . "' ");
                            while ($row = mysql_fetch_array($sql)) {
                                ?>


                                <div class="box box-warning">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Approve Customer Details</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <!-- form start -->
                                    <div class="box-body">
                                        <div class="form-group">  

                                            <div class="col-md-2 space">
                                                <label>Applicant Name</label>
                                            </div>
                                            <div class="col-md-4 space">
                                                <input type="text" name="cname" value="<?php echo $row['CustomerName']; ?>" class="form-control" id="custname" readonly>
                                            </div>
                                            <div class="col-md-2 space">
                                                <label>Mobile No</label>
                                            </div>
                                            <div class="col-md-4 space">
                                                <input type="text" name="cmno" value="<?php echo $row['MobileNo']; ?>" class="form-control" id="mno" readonly >
                                            </div>

                                            <div class="col-md-2 space" style="margin-top: 20px;">
                                                <label>Applicant Photo/Signature</label><br>
                                            </div>
                                            <div class="col-md-4 space" style="margin-top: 20px;">
                                                <div  id="image" class="form-group" style="border:1px solid lightgrey;float:left;height:100px; width:100px;" >
                                                    <img id="image" src="../upload/<?php echo $row['mphoto'] ?>"  style="border:1px solid lightgrey;float:left;height:100px; width:100px;"/>
                                                </div> 
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <img id="output_image1" src="../upload/<?php echo $row['CSign'] ?>" alt=""  height="100px" width="170px" style="border:1px solid lightgrey;height:100px; width:170px;" />
                                            </div>

                                            <div class="col-md-2 space"> 
                                                <label>Applicant DOB</label>
                                            </div>
                                            <div class="col-md-4 space"> 
                                                <input type="text" name="cdob" value="<?php echo date('d-m-Y', strtotime($row['BirthDate'])); ?>" class="form-control" placeholder="dd-mm-yyyy" readonly>
                                            </div>
                                            <div class="col-md-2 space"> 
                                                <label>Applicant Age</label>
                                            </div>
                                            <div class="col-md-4 space"> 
                                                <input type="text" name="cage" value="<?php echo $row['Age']; ?>" class="form-control" id="age" readonly>
                                            </div>

                                            <div class="col-md-2 space"> 
                                                <label>Applicant Father</label>
                                            </div>
                                            <div class="col-md-4 space"> 
                                                <input type="text" name="cfathername" value="<?php echo $row['ApplicantFather']; ?>" class="form-control" id="custname" readonly>
                                            </div>
                                            <div class="col-md-2 space"> 
                                                <label>Gender</label>
                                            </div>
                                            <div class="col-md-4 space"> 
                                                <input type="text" name="cgen" value="<?php echo $row['Gender']; ?>" class="form-control" id="custname" readonly>
                                            </div>

                                            <div class="col-md-2 space"> 
                                                <label>Email ID</label>
                                            </div>
                                            <div class="col-md-4 space"> 
                                                <input type="email" name="cemail" value="<?php echo $row['EmailID']; ?>" class="form-control" id="cust" readonly>
                                            </div>
                                            <div class="col-md-2 space"> 
                                                <label>Telephone No</label>
                                            </div>
                                            <div class="col-md-4 space"> 
                                                <input type="text" name="cteleno" value="<?php echo $row['TelPhoneNo']; ?>" class="form-control" id="cust" readonly>
                                            </div>

                                            <div class="col-md-2 space"> 
                                                <label>Religion</label>
                                            </div>
                                            <div class="col-md-4 space"> 
                                                <input type="text" name="creligion" value="<?php echo $row['Religion']; ?>" class="form-control" id="cust" readonly>
                                            </div>
                                            <div class="col-md-2 space"> 
                                                <label>Residential Address</label>
                                            </div>
                                            <div class="col-md-4 space"> 
                                                <input type="text" name="radds" value="<?php echo $row['ResAddress']; ?>" class="form-control" id="cust" readonly>
                                            </div>

                                            <div class="col-md-2 space"> 
                                                <label>Category</label>
                                            </div>
                                            <div class="col-md-4 space"> 
                                                <input type="text" name="ccaste" value="<?php echo $row['Caste']; ?>" class="form-control" id="custname" readonly="">
                                            </div>
                                            <div class="col-md-2 space"> 
                                                <label>Official Address</label>
                                            </div>
                                            <div class="col-md-4 space"> 
                                                <input type="text" name="oadds" value="<?php echo $row['OffAddress']; ?>" class="form-control" id="cust" readonly>
                                            </div>

                                            <div class="col-md-2 space"> 
                                                <label>Marital Status</label>
                                            </div>
                                            <div class="col-md-4 space"> 
                                                <input type="text" name="maritalstatus" value="<?php echo $row['MartialStatus']; ?>" class="form-control" id="cust" readonly>
                                            </div>
                                            <div class="col-md-2 space"> 
                                                <label>Pincode</label>
                                            </div>
                                            <div class="col-md-4 space"> 
                                                <input type="text" name="pincode" value="<?php echo $row['pincode']; ?>" class="form-control" id="cust" readonly>
                                            </div>

                                            <div class="col-md-2 space"> 
                                                <label>Spouse Name</label>
                                            </div>
                                            <div class="col-md-4 space"> 
                                                <input type="text" name="cspousename" value="<?php echo $row['SpouseName']; ?>" class="form-control" id="custname" readonly>
                                            </div>
                                            <div class="col-md-2 space"> 
                                                <label>City</label>
                                            </div>
                                            <div class="col-md-4 space"> 
                                                <input type="text" name="ccity" value="<?php echo $row['CityName']; ?>" class="form-control" id="custname" readonly>
                                            </div>

                                            <div class="col-md-2 space"> 
                                                <label>Spouse DOB</label>
                                            </div>
                                            <div class="col-md-4 space"> 
                                                <input type="text" name="spousedob" value="<?php echo date('d-m-Y', strtotime($row['SpouseDOB'])); ?>" class="form-control" id="cust" readonly>
                                            </div>
                                            <div class="col-md-2 space"> 
                                                <label>State</label>
                                            </div>
                                            <div class="col-md-4 space">
                                                <input type="text" name="cstate" value="<?php echo $row['StateName']; ?>" class="form-control" id="cust" readonly>
                                            </div>

                                            <div class="col-md-2 space"> 
                                                <label>Family Details</label>
                                            </div>
                                            <div class="col-md-4 space"> 
                                                <input type="text"  name="familydetail" value="<?php echo $row['FamilyDetails']; ?>" class="form-control" id="cust" readonly>
                                            </div>
                                            <div class="col-md-2 space"> 
                                                <label>Country</label>
                                            </div>
                                            <div class="col-md-4 space"> 
                                                <input type="text"  name="ccountry" value="<?php echo $row['CountryName']; ?>" class="form-control" id="cust" readonly>
                                            </div>

                                            <div class="col-md-2 space"> 
                                                <label>Nominee Name</label>
                                            </div>
                                            <div class="col-md-4 space"> 
                                                <input type="text"  name="cnomiee_name" value="<?php echo $row['NomineeName']; ?>"  class="form-control" id="cust" readonly>
                                            </div>
                                            <div class="col-md-2 space"> 
                                                <label>Nominee Age</label>
                                            </div>
                                            <div class="col-md-4 space"> 
                                                <input type="text" name="cnomiee_age" value="<?php echo $row['NomineeAge']; ?>" class="form-control" id="cust" readonly>
                                            </div>

                                            <div class="col-md-2 space"> 
                                                <label>Nominee Relation</label>
                                            </div>
                                            <div class="col-md-4 space"> 
                                                <input type="text" name="nomiee_relation" value="<?php echo $row['NomineeRelation']; ?>" class="form-control" id="cust" readonly>
                                            </div>
                                            <div class="col-md-2 space"> 
                                                <label>Family Relation</label>
                                            </div>
                                            <div class="col-md-4 space"> 
                                                <input type="text" name="family_reln" value="<?php echo $row['FamilyRelation']; ?>" class="form-control" id="cust" readonly>
                                            </div>

                                            <div class="col-md-2 space"> 
                                                <label>UID/Adhaar No</label>
                                            </div>
                                            <div class="col-md-4 space"> 
                                                <input type="text" name="cuidno" value="<?php echo $row['Uidno']; ?>" class="form-control" id="cust" readonly>
                                            </div>
                                            <div class="col-md-2 space"> 
                                                <label>Attach Aadhar Card</label>
                                            </div>
                                            <div class="col-md-4 space"> 
                                                <input type="text" name="adhar_image" value="<?php echo $row['IDProof1']; ?>" id="" class="form-control" readonly>
                                            </div>

                                            <div class="col-md-2 space"> 
                                                <label>Pancard No</label>
                                            </div>
                                            <div class="col-md-4 space"> 
                                                <input type="text" name="cpan_no" value="<?php echo $row['PanCardNo']; ?>" class="form-control" id="cust" maxlength="12" readonly>
                                            </div>
                                            <div class="col-md-2 space"> 
                                                <label>Attach Pancard</label>
                                            </div>
                                            <div class="col-md-4 space"> 
                                                <input type="text" name="pan_image" value="<?php echo $row['IDProof2']; ?>" id="" class="form-control" readonly>
                                            </div>

                                            <div class="col-md-2 space"> 
                                                <label>PhotoIdentity No</label>
                                            </div>
                                            <div class="col-md-4 space"> 
                                                <input type="text" name="idno" value="<?php echo $row['PhotoIdentityNumber']; ?>" class="form-control" id="cust" readonly>
                                            </div>
                                            <div class="col-md-2 space"> 
                                                <label>Attach PhotoID</label>
                                            </div>
                                            <div class="col-md-4 space"> 
                                                <input type="text" name="id_image" value="<?php echo $row['photoid']; ?>" id="" class="form-control" readonly>
                                            </div>

                                            <div class="col-md-2 space"> 
                                                <label>MemberShip Fees</label>
                                            </div>
                                            <div class="col-md-4 space"> 
        <?php
        $sql = mysql_query("SELECT * FROM `membershipfees` ORDER BY MemberShipFeesId DESC LIMIT 1");
        $row1 = mysql_fetch_array($sql);
        ?>
                                                <input type="text" value="<?php echo $row1['MemberShipFees'] ?>" class="form-control" name="membership" id="cust" readonly>
                                            </div>
                                            <div class="col-md-2 space"> 
                                                <label>Id type</label>
                                            </div>
                                            <div class="col-md-4 space"> 
                                                <input type="text" name="idtype" value="<?php echo $row['idtype'] ?>" class="form-control" id="cust" readonly>
                                            </div>


                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                    <br><br>

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
                                        <input type="submit" name="submit1" class="btn btn-primary" value="Edit">
                                    </div>
                                </div> 
    <?php
    }
}
?>

                    </form>
                </section>
            </div>

            <!-- /.box-body -->


            <!-- /.content -->

            <!-- /.content-wrapper -->
            <?php include 'include/script.php'; ?>

            <!-- Control Sidebar -->

            <div class="control-sidebar-bg"></div>
        </div>

    </body>
</html>
