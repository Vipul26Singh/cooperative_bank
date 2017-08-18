<?php

include('config.php');

class Login {

    public function datalogin($u_name, $u_pass) {
        $res = mysql_query("SELECT userinfo.*, role.RoleName FROM userinfo 
                INNER JOIN role ON userinfo.RoleId=role.RoleId 
                WHERE userinfo.Active=1 AND Username='" . $u_name . "'
                AND Apassword='" . $u_pass . "' AND RoleName!='Admin' ");

        $user_data = mysql_fetch_array($res);
        //print_r($user_data);  
        $no_rows = mysql_num_rows($res);

        if ($no_rows == 1) {
            $_SESSION['login_user'] = $u_name;
            $_SESSION['branch_id'] = $user_data['BranchId'];
            $_SESSION['role_name'] = $user_data['RoleName'];
            $_SESSION['role_id'] = $user_data['RoleId'];
            $_SESSION['userid'] = $user_data['UserId'];

            if ($user_data['RoleName'] == 'SuperAdmin') {
                header("location: Views/SuperAdmin/superadmin_dashboard.php");
            } elseif ($user_data['RoleName'] == 'Manager') {
                BranchStatus();
                header("location:Views/Manager/manager_dashboard.php");
            } elseif ($user_data['RoleName'] == 'Clerk') {
                BranchStatus();
                header("location: Views/Clerk/clerk_dashboard.php");
            } elseif ($user_data['RoleName'] == 'Accountant') {
                BranchStatus();
                header("location: Views/Accountant/accountant_dashboard.php");
            } elseif ($user_data['RoleName'] == 'Cashier') {
                BranchStatus();
                header("location: Views/Cashier/cashier_dashboard.php");
            }
        } else {
            $_SESSION['error'] = "Invalid Username And Password";
            return FALSE;
        }
    }

    public function getToken() {
        if (!isset($_SESSION['user_token'])) {
            $_SESSION['user_token'] = md5(uniqid());
        }
    }

    public function checkToken($token) {
        if ($token != $_SESSION['user_token']) {
            header("location : 404.php");
            exit;
        }
    }

    public function getTokenField() {
        return '<input type="hidden" name="token" value="' . $_SESSION['user_token'] . '" />';
    }

    public function destroyToken() {
        unset($_SESSION['user_token']);
    }

}
