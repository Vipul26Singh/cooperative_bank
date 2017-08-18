<?php
include '../superadmin-session.php';
error_reporting(0);
$cid = $_GET['id'];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Manager</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="../CSS/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../CSS/dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="../CSS/dist/css/skins/_all-skins.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="../CSS/plugins/iCheck/flat/blue.css">
        <!-- Morris chart -->
        <link rel="stylesheet" href="../CSS/plugins/morris/morris.css">
        <!-- jvectormap -->
        <link rel="stylesheet" href="../CSS/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
        <!-- Date Picker -->
        <link rel="stylesheet" href="../CSS/plugins/datepicker/datepicker3.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="../CSS/plugins/daterangepicker/daterangepicker.css">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="../CSS/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
        <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
        <style>
            .border {
                border: 1px solid #000;
                padding: 10px;
            }

            .side-border{
                border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000;  
                padding: 10px;
            }

            .right-border{
                border-right: 1px solid #000; border-bottom: 1px solid #000;  
                padding: 10px;
            }


            .bottom-border{
                border-bottom: 1px solid #000;  
                padding: 10px;
            }
        </style>
    </head>

    <body >

        <!-- Content Wrapper. Contains page content -->

        <section class="content">

            <div class="box box-body text-center">

                <?php
                $sql2 = mysql_query("SELECT * FROM companysetup") or die(mysql_error());
                while ($row = mysql_fetch_array($sql2)) {
                    ?>
                    <br>
                    <div class="row">
                        <div class="col-xs-1 col-xs-offset-2">
                            <?php echo '<img src="../upload/' . $row['companylogo'] . '" class="text-center" style="width:100px; height:120px; margin-left:20px;" />'; ?></div>
                        <div class="col-xs-9">
                            <div class="col-xs-9"><h3 class="text-center" ><b><?php echo $row['CompanyName']; ?>&emsp;&emsp;</b></h3></div>
                            <div class="col-xs-9 text-center"><i><b> <?php echo $row['CompanyAddress']; ?>&emsp;&emsp;</b></i></div>
                            <div class="col-xs-9 text-center"><i><b> Registration No:  <?php echo $row['registrationno']; ?>&emsp;&emsp;</b></i></div>
                            <div class="col-xs-9 text-center"><i><b> Contact No: <?php echo $row['phoneno']; ?>&emsp;&emsp;</b></i></div><br><br>
                        </div>
                    </div>
                    <div class="box-header text-center">
                        <?php
                    }
                    $sqlbranch = mysql_fetch_array(mysql_query("SELECT * FROM `branch` WHERE BranchId='" . $_SESSION['branch_id'] . "' ")) or die(mysql_error());
                    ?>  <div class="row">
                        <div class="col-xs-2" ></div>
                        <div class="col-xs-1 text-right"><b><?php echo $sqlbranch['BranchName']; ?></b><br></div>
                        <div class="col-xs-6"></div>
                        <div class="col-xs-3 text-left"><p><b> Date: </b><?php echo date("d-m-Y"); ?>&emsp;</p></div>
                    </div>
                </div>   

                <h4 class="box-title"><b>Customer Information</b></h4> 

<?php
if (isset($_GET['id'])) {
    //echo $_GET['id'];
    $id = $_GET['id'];
    $sql = mysql_query("SELECT customer.*,state.StateName,city.CityName,country.CountryName FROM customer INNER JOIN state ON customer.StateId=state.StateId INNER JOIN city ON city.CityId = customer.CityId INNER JOIN country ON customer.CountryId=country.CountryId WHERE CustomerID ='" . $id . "' ");
    while ($row = mysql_fetch_array($sql)) {
        ?>
                        <div class="container">
                            <div class="col-xs-12">
                                <p class="text-justify text-left">
                                    For the Purpose of providing good service, protection and promotion of your interest, it is important for you to provide us with
                                    the neccessary information data regarding yourself please take all steps in order to complete this questionnaire fully and
                                    precisely.
                                </p>
                            </div><br>
                            <section class="col-xs-12 border">
                                <div class="col-xs-9 text-left"><strong>1. CUSTOMER DATA</strong></div>
                                <div class="col-xs-3 text-left"><strong>Date: </strong><?php echo date('d-m-Y', strtotime($row['AccountDate'])); ?></div><br><br> 
                                <div class="col-xs-12 text-left" style="background-color: #0073b7; color: #ffffff; padding: 5px;">A. Personal Details</div>
                            </section>
                            <section class="col-xs-10 ">
                                <div class="row text-left">
                                    <div class="side-border">&emsp;<b>Name: &nbsp;</b> <?php echo $row['CustomerName']; ?></div>
                                    <div class="side-border" ><b>&emsp;Father's Name: &nbsp;</b><?php echo $row['ApplicantFather']; ?></div>
                                    <div class="side-border" style="height: 40px;">
                                        <div class="col-xs-4"><b>Date of birth : &nbsp;</b><?php echo date('d-m-Y', strtotime($row['BirthDate'])); ?></div> 
                                        <div class="col-xs-4"><b>Nationality : &nbsp;</b> Indian</div>
                                        <div class="col-xs-4"><b>Gender :&nbsp; </b><?php echo $row['Gender']; ?></div>
                                    </div>
                                    <div class="side-border" style="height: 40px;">
                                        <div class="col-xs-4"><b>ID card/Passport No. : &nbsp;</b><?php //echo $row['PhotoIdentityNumber'];  ?></div> 
                                        <div class="col-xs-4"><b>Country of Issue : &nbsp;</b><?php //echo $row['CountryName'];  ?></div>
                                    </div>
                                    <div class="side-border"><b>&emsp;Home Address : &nbsp;</b><?php echo $row['ResAddress']; ?></div>

                                </div>
                            </section>
                            <section class="col-md-2 right-border responsive">
                                <div class="row">
                                    <div class="col-md-2 text-center " >
                                        <!--  <div style="width: 160px; height: 130px;">
                                          <img src="../upload/<?php //echo $row['mphoto'];  ?>" class="img-fluid" alt="Responsive image" ></div>
                                          <img src="../upload/<?php //echo $row['CSign'];  ?>" class="img-fluid" alt="Responsive image"> -->

                                        <img src="../upload/<?php echo $row['mphoto'] ?>" class="responsive-img" height="100px" width="150px"/>
                                        <img src="../upload/<?php echo $row['CSign'] ?>" class="responsive-img" height="82px" width="150px" />

                                    </div>
                                </div>
                            </section>
                            <section class="col-xs-12">
                                <div class="row">
                                    <div class="side-border text-left"><b>&emsp;Work Address : &nbsp;</b><?php echo $row['OffAddress']; ?></div>
                                    <div class="side-border text-left height-control" style="height: 40px;">
                                        <div class="col-xs-3"><b>Home Tel. : &nbsp;</b><?php echo $row['TelPhoneNo']; ?></div> 
                                        <div class="col-xs-3"><b>Work Tel. : &nbsp;</b></div>
                                        <div class="col-xs-3"><b>Mobile : &nbsp;</b><?php echo $row['MobileNo']; ?></div>
                                    </div>
                                    <div class="side-border text-left height-control" style="height: 40px;">
                                        <div class="col-xs-3"><b>Email : &nbsp;</b><?php echo $row['EmailID']; ?></div> 
                                        <div class="col-xs-3"><b>Fax : &nbsp;</b><?php //echo $row[''];  ?></div>
                                        <div class="col-xs-3"><b>Martial Status:&nbsp;</b><?php echo $row['MartialStatus']; ?></div>
                                    </div>
                                    <div class="side-border text-left" >&emsp; <b>Preferred Communication Method :</b> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                                        By Post : <input type="checkbox" name="" value="ON" > &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                                        By Fax :   <input type="checkbox" name="" value="ON" > &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                                        By Email :  <input type="checkbox" name="" value="ON" >
                                    </div>
                                </div>
                            </section>
                            <section class="col-xs-12"><br>
                                <p class="text-justify text-left">
                                    In the case where the services shall be provided to a second natural person jointly with the first natural person, the following 
                                    information should also be completed. All communication will be forwarded to the first natural person as provided above. 
                                </p>
                            </section><br>
                            <section class="col-xs-12">
                                <div class="row">
                                    <div class="col-xs-12 border text-left" style="background-color: #0073b7; color: #ffffff; padding: 5px;">B. Document Submitted</div>
                                    <div class="col-xs-12 side-border text-left height-control" style="height: 40px;">
                                        <div class="col-xs-6"><b>Document Type: &nbsp;</b><?php echo $row['idtype']; ?></div> 
                                        <div class="col-xs-6"><b>Document No: &nbsp;</b><?php echo $row['PhotoIdentityNumber']; ?></div>
                                    </div>
                                    <div class="col-xs-12 side-border text-left height-control" style="height: 40px;">
                                        <div class="col-xs-6"><b>UID/Aadhaar No: &nbsp;</b><?php echo $row['Uidno']; ?></div> 
                                        <div class="col-xs-6"><b>Pan Card No: &nbsp;</b><?php echo $row['PanCardNo']; ?></div>
                                    </div>
                                    <div class="col-xs-12 side-border text-left height-control" style="height: 40px;">
                                        <div class="col-xs-6"><b>Other Document 1 Type: &nbsp;</b></div> 
                                        <div class="col-xs-6"><b>Other Document 1 No: &nbsp;</b></div>
                                    </div>
                                    <div class="col-xs-12 side-border text-left height-control" style="height: 40px;">
                                        <div class="col-xs-6"><b>Other Document 2 Type: &nbsp;</b></div> 
                                        <div class="col-xs-6"><b>Other Document 2 No: &nbsp;</b></div>
                                    </div>
                                    <div class="side-border col-xs-12 text-left">&emsp;<b>Remarks If Any:</b></div>
                                </div>
                            </section><br><br>
                            <section class="col-xs-12">
                                <div class="row"><br>
                                    <div class="col-xs-12 border text-left" style="background-color: #0073b7; color: #ffffff; padding: 5px;">C. Nominee Details</div>
                                    <div class="side-border col-xs-12 text-left form-control">&emsp;<b>Nominee Name: &nbsp;</b><?php echo $row['NomineeName']; ?></div>
                                    <div class="side-border col-xs-12 text-left form-control" >
                                        <div class="col-xs-6"><b>Nominee Age: &nbsp;</b><?php echo $row['NomineeAge']; ?></div> 
                                        <div class="col-xs-6"><b>Nominee Date of Birth: &nbsp;</b><?php //echo $row[''];  ?></div>
                                    </div>
                                    <div class="side-border col-xs-12  text-left form-control" >
                                        <div class="col-xs-6"><b>Relation with Nominee: &nbsp;</b><?php echo $row['NomineeRelation']; ?> </div> 
                                        <div class="col-xs-6"><b>Nominee Contact No: &nbsp;</b><?php //echo $row[''];  ?></div>
                                    </div>
                                    <div class="side-border col-xs-12 text-left">&emsp;<b>Nominee Present Address: &nbsp;</b><?php //echo $row[''];  ?></div>
                                    <div class="side-border col-xs-12 text-left">&emsp;<b>Nominee Permanent Address: &nbsp;</b><?php //echo $row[''];  ?></div>
                                </div>
                            </section>
                            <section class="col-xs-12">
                                <div class="row"><br>
                                    <div class="col-xs-12 border text-left" style="background-color: #0073b7; color: #ffffff; padding: 5px;"> D. Other Details</div>
                                    <div class="side-border col-xs-12 text-left form-control">&emsp;<b>Gross Annual Income:</b> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                                        <input type="checkbox" name="" value="ON" />Below 1 Lac &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                                        <input type="checkbox" name="" value="ON" />1-5 Lac &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                                        <input type="checkbox" name="" value="ON" />5-10 Lac &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                                        <input type="checkbox" name="" value="ON" />10-25 Lac &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                                        <input type="checkbox" name="" value="ON" />> 25 Lac &emsp;&emsp;&emsp;
                                    </div>
                                    <div class="side-border col-xs-12  text-left form-control" >
                                        <div class="col-xs-6"><b>Religion: &nbsp;</b> <?php echo $row['Religion']; ?> </div> 
                                        <div class="col-xs-6"><b>Category: &nbsp;</b><?php echo $row['Caste']; ?></div>
                                    </div>
                                    <div class="side-border col-xs-12 text-left">&emsp;<b>Any Other Information:</b></div>
                                </div>
                            </section>
                            <section class="col-xs-12">
                                <div class="row"><br>
                                    <div class="col-xs-12" style="background-color: #0073b7; color: #ffffff; padding: 5px;">  FOR OFFICE USE ONLY </div><br><br>
                                    <div class="border col-xs-12">
                                        <div class="col-xs-8 text-left" >
                                            <b>Branch Name/Code</b> <br>
                                            ________________________<br><br> 

                                            <input type="checkbox" name="" value="ON" />  (Original Verified) Self Certified Document Copeis Received<br><br>
                                            <input type="checkbox" name="" value="ON" />  Self Attested Copies of Document Received<br><br>
                                        </div><br>

                                        <div class="col-xs-2 border center" style="height:150px; width:150px;">

                                        </div>
                                        <div class="col-xs-2 border" style="height:150px; width:150px; margin-left: 20px;">

                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="col-xs-12">
                                <div class="row"><br>
                                    <div class="col-xs-12" style="background-color: #0073b7; color: #ffffff; padding: 5px;">   CUSTOMER'S DECLARATION </div><br><br>
                                    <div class="col-xs-12 text-left">
                                        <p>
                                            I/We Confirm that I/We have Read CareFully the Content of this Application and that I/We have provided all the required
                                            information which concerns me/us and i/we hereby declare and confirm that this is true and correct and that I/We have not
                                            withheld any relevant or substancial information. Furthur,I/We undertake to inform immediately the Bank in writing of any
                                            changes of this information.
                                        </p> <br>
                                        <p>
                                            I/we confirm that I/We have delivered all that is required in accordance with above section and that these are genuine and
                                            authentic and their content is true and correct.
                                        </p> 
                                        <p>
                                            <b>Full name :</b>  &emsp;&emsp; <u><?php echo $row['CustomerName']; ?></u> 
                                        </p> 
                                        <p>
                                            <b>Signature :</b> &emsp;&emsp;  ___________________________________ &emsp;&emsp; <b>Date :</b> &emsp;&emsp; ___________________________________
                                        </p> 
                                    </div>
                                    <div class="col-xs-12">

                                    </div>
                                </div>
                            </section>   
                        </div>
    <?php }
}
?>
            </div>
        </section>

        <!-- /.box-body -->


        <!-- /.content -->

        <!-- /.content-wrapper -->


        <!-- Control Sidebar -->

        <!-- webcam link -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
        <!-- image upload -->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <!-- jQuery 2.2.3 -->
        <script src="../CSS/plugins/jQuery/jquery-2.2.3.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- DataTables -->
        <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="../CSS/bootstrap/js/bootstrap.min.js"></script>
        <!-- Morris.js charts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="../CSS/plugins/morris/morris.min.js"></script>
        <!-- Sparkline -->
        <script src="../CSS/plugins/sparkline/jquery.sparkline.min.js"></script>
        <!-- jvectormap -->
        <script src="../CSS/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="../CSS/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="../CSS/plugins/knob/jquery.knob.js"></script>
        <!-- daterangepicker -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
        <script src="../CSS/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- datepicker -->
        <script src="../CSS/plugins/datepicker/bootstrap-datepicker.js"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="../CSS/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
        <!-- Slimscroll -->
        <script src="../CSS/plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="../CSS/plugins/fastclick/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="../CSS/dist/js/app.min.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="../CSS/dist/js/pages/dashboard.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../CSS/dist/js/demo.js"></script>

        <script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="../../bootstrap/js/bootstrap.min.js"></script>

        <!-- SlimScroll -->
        <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="../../plugins/fastclick/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="../../dist/js/app.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../../dist/js/demo.js"></script>

    </body>
</html>
