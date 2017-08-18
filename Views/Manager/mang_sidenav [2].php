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
                                <a href="mang_profile.php" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="../logout.php" class="btn btn-default btn-flat">Sign out</a>
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
                <a href="manager_dashboard.php">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>    
                </a>       
            </li>


            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Manage Customer</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pendingcustomer_list.php"><i class="fa fa-user-plus"></i>Pending Customers</a></li>
                    <li><a href="approvedcustomer_list.php"><i class="fa fa-check-circle-o"></i>Approve Customers</a></li>
                </ul>
            </li>




            <li class="treeview">
                <a href="#">
                    <i class="fa fa-bank"></i>
                    <span>Bank Account Open</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="BankAccountList.php"><i class="fa fa-circle-o"></i>Current & Saving</a></li>
                    <li><a href="ShareAccountList.php"><i class="fa fa-circle-o"></i>Share Account</a></li>
                    <li><a href="Share_account_printlist.php"><i class="fa fa-circle-o"></i>Print Share Account List</a></li>
                    <li><a href="share_transaction_list.php"><i class="fa fa-circle-o"></i>Share Transaction Account</a></li>
                    <li><a href="share_transaction_statement.php"><i class="fa fa-circle-o"></i>Share Transaction Statment</a></li>
                    <li><a href="fd_acc_list.php"><i class="fa fa-circle-o"></i>FD Account List</a></li>
                    <li><a href="fd_acc_printlist.php"><i class="fa fa-circle-o"></i>Print FD Account List</a></li>
                    <li><a href="fd_transaction.php"><i class="fa fa-circle-o"></i>FD Transaction</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-clone"></i> <span>Manage Loan Application</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li>
                        <a href="#"><i class="fa fa-circle-o"></i>Gold Loan Application
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="pending_loan_customer.php"><i class="fa fa-plus-circle"></i>Pending Loan</a></li>
                            <li>
                                <a href="approve_goldloan_list.php"><i class="fa fa-circle-o"></i> Approval Loan
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>

                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-circle-o"></i>Regular Loan Application
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="pending_regulerloan_applicationList.php"><i class="fa fa-plus-circle"></i>Pending Loan</a></li>
                            <li>
                                <a href="approve_regulerloan_list.php"><i class="fa fa-circle-o"></i> Approval Loan
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>

                            </li>
                        </ul>
                    </li>

                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-clone"></i>
                    <span>Manage Approval Loan</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left "></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    <li><a href="loan_list.php"><i class="fa fa-plus-circle"></i>Approve Loan</a></li>
                    <li><a href="loan_transaction_statement.php"><i class="fa fa-check-circle-o"></i>Loan Transaction Statment</a></li> 
                    <li><a href="loan_printlist.php"><i class="fa fa-clone"></i>Print Loan List</a></li> 
                </ul>

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
                    <li><a href="loan_outstanding.php"><i class="fa fa-circle-o"></i>Loan Outstanding List</a></li>
                    <li><a href="loan_over_due_interest.php"><i class="fa fa-circle-o"></i>Loan OverDue Interest List</a></li>
                    <li><a href="loan_demand_report_statement.php"><i class="fa fa-circle-o"></i>Demand Report</a></li>
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
                    <li><a href="#"><i class="fa fa-circle-o"></i>Add Clerk</a></li>
                </ul>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>