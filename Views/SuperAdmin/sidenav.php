<header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><i class="fa fa-bank"></i></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Co-operative</b>Bank</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="../upload/<?php echo $_SESSION['uimage']; ?>" class="user-image" >
                        <span class="hidden-xs"><?php echo $login_session; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="../upload/<?php echo $_SESSION['uimage']; ?>" class="img-circle" >

                            <p>
			    		<?php echo "hereeeeeeeeeeeeeeeeeeeeeee" ?>
                                User - <?php echo $login_session; ?>
                                <small></small>
                            </p>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="superadmin_profile.php" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="../../logout.php" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->

            </ul>
        </div>
    </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
                <a href="superadmin_dashboard.php">
                    <i class="fa fa-dashboard"></i><span>Dashboard</span>    
                </a>       
            </li>
            <li class="treeview">
                <a href="superadmin_user_list.php">
                    <i class="fa fa-user-plus"></i>
                    <span>View User List</span>
                </a>
            </li>
            <li class="treeview">
                <a href="superadmin_customer_list.php">
                    <i class="fa fa-user-plus"></i>
                    <span>View Customer List</span>
                </a>
            </li> 
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-clone"></i>
                    <span>Loan Outstanding</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="superadmin_loan_outstanding.php"><i class="fa fa-circle-o"></i>Loan Outstanding List</a></li>
                </ul>
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
                    <li><a href="gold_loantype_list.php"><i class="fa fa-inr"></i>Gold Loan Type</a></li>
                    <li><a href="loantype_list.php"><i class="fa fa-inr"></i>Loan Type</a></li>
                    <li><a href="fdtype_list.php"><i class="fa fa-gear"></i>FD Type</a></li>
                    <li>
                        <?php
                        $sql = mysql_query("SELECT * FROM `emailsetup`");
                        $count = mysql_num_rows($sql);
                        if ($count == 0) {
                            ?>
                            <a href="emailsetup.php"><i class="fa fa-gear"></i>Email Setup</a>
                        <?php } else {
                            ?>
                            <a href="update_emailsetup.php"><i class="fa fa-gear"></i>Email Setup</a>
                        <?php } ?>

                    </li>
                    <li>
                        <?php
                        $sql = mysql_query("SELECT * FROM `companysetup`");
                        $count = mysql_num_rows($sql);
                        if ($count == 0) {
                            ?>
                            <a href="companysetup.php"><i class="fa fa-gear"></i>Company Setup</a>
                        <?php } else {
                            ?>
                            <a href="update_companysetup.php"><i class="fa fa-gear"></i>Company Setup</a>
                        <?php } ?>

                    </li>
                    <li>
                        <?php
                        $sql = mysql_query("SELECT * FROM `loansetting`");
                        $count = mysql_num_rows($sql);
                        if ($count == 0) {
                            ?>
                            <a href="loan_setting.php"><i class="fa fa-gear"></i>Loan Setting</a>
                        <?php } else {
                            ?>
                            <a href="update_loan_setting.php"><i class="fa fa-gear"></i>Loan Setting</a>
                        <?php } ?>

                    </li>
                    <li>
                        <?php
                        $sql = mysql_query("SELECT * FROM `sms`");
                        $count = mysql_num_rows($sql);
                        if ($count == 0) {
                            ?>
                            <a href="sms.php"><i class="fa fa-gear"></i>SMS Setup</a>
                        <?php } else {
                            ?>
                            <a href="update_sms.php"><i class="fa fa-gear"></i>SMS Setup</a>
                        <?php } ?>
                    </li>
                    <li><a href="superadmin_sharedetail_list.php"><i class="fa fa-plus"></i>Sharedetail List</a></li>
                    <li><a href="superadmin_branch_list.php"><i class="fa fa-university"></i>Branch List</a></li>
                    <li><a href="superadmin_membership_list.php"><i class="fa fa-users"></i>Membership Fees List</a></li>
                    <li><a href="initialize_acc_no.php"><i class="fa fa-plus"></i>Initialize Account No</a></li>
                    <li><a href="account_typelist.php"><i class="fa fa-plus"></i>Account Type List</a></li>
                    <li><a href="superadmin_country_list.php"><i class="fa fa-plus"></i>Country List</a></li>
                    <li><a href="superadmin_state_list.php"><i class="fa fa-plus"></i>State List</a></li>
                    <li><a href="superadmin_city_list.php"><i class="fa fa-plus"></i>City List</a></li>
                    <li><a href="superadmin_region_list.php"><i class="fa fa-plus"></i>Region List</a></li>
                </ul>
            </li>
        </ul> 
    </section>
    <!-- /.sidebar -->
</aside>

