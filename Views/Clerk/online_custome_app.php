<?php
include '../superadmin-session.php';
error_reporting(0);
?>

<?php include 'include/clerk_nav.php'; ?>

<body class="hold-transition skin-yellow sidebar-mini">
    <div class="wrapper">
        <?php include 'include/clerk_sidenav.php'; ?>

        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">

                <ul class="sidebar-menu">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span>    
                        </a>       
                    </li>
                    <li class="treeview">
                        <a href="Branch.html">
                            <i class="fa fa-bank"></i> <span>Branch Master</span>    
                        </a>       
                    </li>
                    <li class="treeview">
                        <a href="UserMaster.html">
                            <i class="fa fa-user-plus"></i>
                            <span>User Master</span>
                           <!--  <span class="pull-right-container">
                             <i class="fa fa-angle-left pull-right"></i>
                            </span> -->
                        </a>

                    </li>
                    <li class="treeview">
                        <a href="Customer.html">
                            <i class="fa fa-users"></i>
                            <span>Customer Master</span>
                           <!--  <span class="pull-right-container">
                             <i class="fa fa-angle-left pull-right"></i>
                            </span> -->
                        </a>

                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-gears"></i>
                            <span>Settings</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="InitializeAccountNo.html"><i class="fa fa-list"></i> Initialize Account No</a></li>
                            <li><a href="SmsSetup.html"><i class="fa fa-inr"></i>Sms Setup</a></li>
                            <li><a href="FdSetup.html"><i class="fa fa-copy"></i> FD Setup</a></li>
                            <li><a href="GoldLoanType.html"><i class="fa fa-diamond"></i> Gold Loan Type</a></li>
                            <li><a href="LoanType.html"><i class="fa fa-inr"></i>Loan Type</a></li>
                            <li><a href="Country.html"><i class="fa fa-circle-o"></i>Add Country</a></li>
                            <li><a href="State.html"><i class="fa fa-plus"></i>Add State</a></li>
                            <li><a href="City.html"><i class="fa fa-circle-o"></i>Add City</a></li>
                            <li><a href="Region.html"><i class="fa fa-inr"></i>Add Region</a></li>
                        </ul>
                    </li>

                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <section class="content">

                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Apply for Internet/Mobile Banking </h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form">
                        <div class="box-body">

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Customer ID</label>
                                </div></div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="custname">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Mobile No</label>
                                </div></div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="cust">
                            </div>
                        </div>
                </div>
                <div class="col-md-6">             
                    <div class="form-group">
                        <label>Photo/Signature</label><br>
                        <image width="100px" height="100px">
                        <image width="200px" height="80px">
                    </div>

                </div>
                <div class="row">  
                    <div class="col-md-12">  
                        <div class="col-md-6">             
                            <div class="form-group">
                                <label>Email ID</label>
                                <input type="text" class="form-control" id="cust">
                            </div>
                            <div class="form-group">
                                <label>Mobile Banking</label>
                                <select class="form-control" style="width: 100%;">
                                    <option selected="selected">--Select--</option>
                                    <option>Yes</option>
                                    <option>No</option>                 

                                </select>              </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Account No</label>
                                <select class="form-control" style="width: 100%;">
                                    <option selected="selected">--Select--</option>


                                </select>   
                            </div>
                            <div class="form-group">
                                <label>Internet Banking</label>
                                <select class="form-control" style="width: 100%;">
                                    <option selected="selected">--Select--</option>
                                    <option>Yes</option>
                                    <option>No</option>                    

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Account Balance</label>
                        <input type="text" class="form-control" id="cust">
                    </div>
                    <div class="form-group">
                        <label>Customer Type</label>
                        <select class="form-control" style="width: 100%;">
                            <option selected="selected">--Select--</option>


                        </select>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <label>User ID 1</label>
                        <input type="text" class="form-control" id="cust">

                    </div>
                    <div class="form-group">
                        <label>User ID 2</label>
                        <input type="text" class="form-control" id="cust">
                    </div>
                </div>
                <div class="col-md-6">             
                    <div class="form-group">
                        <label>Residential Address</label>
                        <input type="text" class="form-control" id="cust">
                    </div>
                    <div class="form-group">
                        <label>Official Address</label>
                        <input type="text" class="form-control" id="cust">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>User ID 3</label>
                        <input type="text" class="form-control" id="cust">

                    </div>
                    <div class="form-group">
                        <label>Application Date</label>
                        <input type="date" class="form-control" id="cust">

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Branch Name</label>
                                <input type="text" class="form-control" id="cust">

                            </div>
                        </div>
                    </div>

                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-warning">Submit</button>
                </div>
                </form>
        </div>

    </section>
    <!-- /.content -->
</div>
<?php include 'include/clerk_script.php'; ?>
<!-- /.content-wrapper -->
<!--  <footer class="main-footer">
  
   <strong>Copyright &copy; 2017-2018 <a href="#">CodeFever</a>.</strong> All rights
   reserved.
 </footer>
-->
<!-- Control Sidebar -->

<div class="control-sidebar-bg"></div>
</div>

</body>
</html>
