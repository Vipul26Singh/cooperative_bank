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
                                User - <?php echo $login_session; ?>
                                <?php $sql = mysql_fetch_array(mysql_query("select BranchName from branch where BranchId='" . $_SESSION['branch_id'] . "' ")) ?>
                                <small><?php echo $sql['BranchName']; ?></small>
                            </p>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="clerk_profile.php" class="btn btn-default btn-flat">Profile</a>
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
                <a href="clerk_dashboard.php">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>    
                </a>       


            <li class="treeview">
                <a href="#">
                    <i  class="fa fa-users"></i>
                    <span>Customer</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="add_customer.php"><i class="fa fa-inr"></i>Add Customer</a></li>
                    <li><a href="approvedcustomer_list.php"><i class="fa fa-inr"></i>Approved Customer list</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="">
                    <i class="fa fa-inr"></i>
                    <span>Loan Application</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="add_gold_loan.php"><i class="fa fa-diamond"></i>Apply Gold Loan</a></li>
                    <li><a href="add_reguler_loan.php"><i class="fa fa-copy"></i>Apply Regular Loan</a></li>
                    <li><a href="approve_goldloan_list.php"><i class="fa fa-list"></i> Gold Loan list</a></li>
                    <li><a href="approve_regulerloan_list.php"><i class="fa fa-list-alt"></i>Regular Loan List</a></li>
                </ul>
            </li>



            <li class="treeview">
                <a href="#">
                    <i class="fa fa-clone"></i> <span>Pending Application List</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li>
                        <a href="pendingcustomer_list.php"><i class="fa fa-balance-scale"></i>KYC Application
                            <span class="pull-right-container">
                                <i class=" "></i>
                            </span>
                        </a>

                    </li>

                    <li>
                        <a href="#"><i class="fa fa-copy"></i>Loan Applications
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="pending_loan_customer.php"><i class="fa fa-diamond"></i>Gold Loan</a></li>
                            <li><a href="pending_regulerloan_applicationList.php"><i class="fa fa-rupee"></i>Regular Loan</a></li>

                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-list"></i>Bank Account Applications
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="BankAccountList.php"><i  class="fa fa-bank"></i>Current and saving Account</a></li>


                        </ul>
                    </li>


                </ul>

            <li><a href="ShareAccountList.php"><i class="fa fa-plus-circle"></i>Share Account</a></li>


            <li>
                <a href="#"><i class="fa fa-list"></i>Bank Accounts 
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="BankAccountList_clerk.php"><i  class="fa fa-bank"></i>Current and saving Account</a></li>
                    <li><a href="approve_customerbankaccount_list.php"><i class="fa fa-plus-circle"></i>Approve Application</a></li> 

                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-circle-o"></i>View Account Statement
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="share_transaction_statement.php"><i class="fa fa-plus-circle"></i>Share Transaction Statement</a></li>
                    <li><a href="loan_transaction_statement.php"><i class="fa fa-plus-circle"></i>Loan Transaction Statement</a></li> 
                    <li><a href="bank_transaction_statement.php"><i class="fa fa-plus-circle"></i>Bank Transaction Statement</a></li> 
                </ul>
            </li>
    </section>
    <!-- /.sidebar -->
</aside>