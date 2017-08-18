<?php
session_start();
$filename = 'config.php';
if (!file_exists($filename)) {
    header("location:install/index.php");
    exit;
}

include_once ('Login.php');
include('config.php');
//include('common.php');
//include('messages/messages.php');

/*$sqlregistorcount = mysql_fetch_array(mysql_query("SELECT count(*) "
                . "as countdata from  registation "));
if ($sqlregistorcount['countdata'] == '0') {
    header("location: registration.php");
} else {
    
}*/

function BranchStatus() {
    $sql = mysql_query("SELECT * from branch "
            . "WHERE BranchId='" . $_SESSION['branch_id'] . "' "
            . "AND Active=1 ") or die(mysql_error());

    if ($row = mysql_fetch_assoc($sql)) {
        return true;
    } else {
        return false;
    }
}

if (isset($_POST['submit'])) {
    if (empty($_POST['uname']) && empty($_POST['upass'])) {
        $_SESSION['error'] = "Empty Fields";
    } elseif (!empty($_POST['uname']) && empty($_POST['upass'])) {
        $_SESSION['error'] = "Password should not be empty.";
    } else {
        $Loginobj = new Login();
        $Loginobj->checkToken($_POST['token']);
        $u_name = $_POST['uname'];
        $u_pass = md5($_POST['upass']);
        $user = $Loginobj->datalogin($u_name, $u_pass);
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Log in</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, 
              user-scalable=no" name="viewport">
        <link rel="stylesheet" href="CSS/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="CSS/dist/css/AdminLTE.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="CSS/plugins/iCheck/square/blue.css">
        <style type="text/css">
            .bg {
                background-image: url("DefaultImage/bg.jpg");
                background-repeat: no-repeat;
                background-size: cover;
            }
        </style>
    </head>

    <body class="hold-transition login-page bg" >
        <div class="login-box">
            <div class="login-logo">
                <?php
                $sql2 = (mysql_query("SELECT * FROM companysetup"))or die(mysql_error());
                ?>
                <a href="#" style="color: #ffffff;">
                    <h2>
                        <strong><?php
                            if (mysql_num_rows($sql2) == 0) {
                                echo "Microfinance Ltd";
                            } else {
                                $sqldata = mysql_fetch_array($sql2);
                                echo $sqldata['CompanyName'];
                            }
                            ?></strong>
                    </h2>
                </a>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <div class="text-center" style="color: red;">    
                    <?php
                    if (empty($_SESSION['error'])) {
                        
                    } else {
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    }
                    ?>
                </div><br> 
                <?php
                $Loginobj = new Login();
                $Loginobj->getToken();
                ?>
                <form action="" method="post" name="myform">
                    <div class="form-group has-feedback">
                        <input type="text" name="uname" class="form-control" placeholder="Username" autocomplete="off">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" name="upass" class="form-control" placeholder="Password" autocomplete="off">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                        </div>

                        <div class="col-xs-4">
                            <input type="submit" name="submit" class="btn btn-primary btn-block btn-flat" value="Sign In">
                        </div>
                        <?php
                        $Loginobj = new Login();
                        echo $Loginobj->getTokenField();
                        ?>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-box-body -->

        </div>
        <!-- /.login-box -->
        <!-- jQuery 2.2.3 -->
        <script src="CSS/plugins/jQuery/jquery-2.2.3.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="CSS/bootstrap/js/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script src="CSS/plugins/iCheck/icheck.min.js"></script>
    </body>
</html>
