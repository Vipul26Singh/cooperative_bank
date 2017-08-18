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
                                <a href="cash_profile.php" class="btn btn-default btn-flat">Profile</a>
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
                <a href="cashier_dashboard.php">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>    
                </a>       
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-list-alt"></i>
                    <span>Account List</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="cash_accountList.php"><i class="fa fa-link"></i>Current & Saving</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i>
                    <span>Add Transactions</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="add_share_transaction_account.php"><i class="fa fa-file-text-o"></i>Add Share Transaction</a></li>
                    <li><a href="loan_transaction.php"><i class="fa fa-file-text-o"></i>Add Loan Transaction</a></li>
                    <li><a href="add_bank_acc_transactions.php"><i class="fa fa-file-text-o"></i>Add Bank Transaction</a></li> 
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-list-alt"></i>
                    <span>Transactions List</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="share_transaction_list.php"><i class="fa fa-list"></i> Share Transaction List</a></li>
                    <li><a href="transaction_list.php"><i class="fa fa-list"></i>Bank Transaction List</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Reports</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="Share_account_printlist.php"><i class="fa fa-print"></i>Print Share Account Report</a></li>
                    <li><a href="loan_printlist.php"><i class="fa fa-print"></i>Print Loan Account Report</a></li>
                    <li><a href="cash_account_printlist.php"><i class="fa fa-print"></i>Print Bank Account Report</a></li> 
                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-files-o"></i>View Account Statements
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="cash_share_transaction_statement.php"><i class="fa fa-edit"></i>Share Transaction Statement</a></li>
                    <li><a href="loan_transaction_statement.php"><i class="fa fa-edit"></i>Loan Transaction Statement</a></li> 
                    <li><a href="bank_transaction_statment.php"><i class="fa fa-edit"></i>Bank Transaction Statement</a></li> 
                </ul>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>