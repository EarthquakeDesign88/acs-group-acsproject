<?php

if($_SERVER["SERVER_NAME"] == 'localhost' || $_SERVER["SERVER_NAME"] == '127.0.0.1'){
    require $_SERVER['DOCUMENT_ROOT'] . "/acs-groups/backoffice/acs-project/config/app.php";
}else{
    require $_SERVER['DOCUMENT_ROOT'] . "/backoffice/acs-project/config/app.php";
}


use App\Database\Db;
use App\Models\User;

class LoginController extends Db {
    protected $tableName = 'user';

    public function userAuthentication($username, $password) {
        $sql_checkLogin = "SELECT u.*, d.department_name FROM {$this->tableName} as u INNER JOIN department as d ON u.user_depid = d.department_id 
                                                              WHERE username = '$username' ";
        $result = $this->conn->query($sql_checkLogin);
        $row = $result->fetch();

        if($row > 0) {
            $passwordVerify = password_verify($password, $row['password']);
        
            if(!empty($row) && $passwordVerify) {
                $_SESSION['authenticated'] = true;  
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['user_firstname'] = $row['user_firstname'];
                $_SESSION['user_lastname'] = $row['user_lastname'];
                $_SESSION['user_role'] = $row['user_role'];
                $_SESSION['user_department'] = $row['department_name'];
    
                return true;
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }

    public function redirect($url) {
        header("Location: $url");
    }

    public function logout() {
        session_start();
        session_destroy();
        unset($_SESSION['authenticated']);
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['user_firstname']);
        unset($_SESSION['user_lastname']);
        unset($_SESSION['user_role']);
        unset($_SESSION['user_department']);
        
        header('location: ../index.php');
    }

    public function VerifyAdmin() {
        $user_id = $_SESSION['user_id'];
        $userObj = new User();
        $users =  $userObj->getUserById($user_id);
    
        foreach ($users as $user) { 
            $user_role = $user['user_role'];
        }
    
        if($user_role != 'admin') {
            return false;
        }
        else {
            return true;
        }
    }

}

?>