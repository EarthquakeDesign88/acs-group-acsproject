<?php
    if($_SERVER["SERVER_NAME"] == 'localhost' || $_SERVER["SERVER_NAME"] == '127.0.0.1'){
        require $_SERVER['DOCUMENT_ROOT'] . "/acs-groups/backoffice/acs-project/config/app.php";
    }else{
        require $_SERVER['DOCUMENT_ROOT'] . "/backoffice/acs-project/config/app.php";
    }
    
    session_start();
    date_default_timezone_set('Asia/Bangkok');

    use App\Models\User;
    
    if(isset($_POST)) {
        $username = $_POST["username"];
        $user_email = $_POST["user_email"];
        $password = $_POST["password"];
        $user_firstname = $_POST["user_firstname"];
        $user_lastname = $_POST["user_lastname"];
        $user_mobilenumber = $_POST["user_mobilenumber"];
        $user_role = $_POST["user_role"];
        $user_depid = $_POST["user_depid"];
        $created_at = date('Y-m-d H:i:s');

        $userObj = new User;
        
        $checkExists = $userObj->checkExistsUser($username);

        if($checkExists > 0) {
            $response = [
                'status' => 'warning',
                'message' => $_SESSION['lang'] == "en" ? 'User is already exists' : 'บัญชีนี้ถูกใช้แล้ว โปรดใช้ชื่ออื่น'
            ];
        
            echo json_encode($response);   
        }
        else {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $userObj->createUser($username, $passwordHash, $user_email, $user_firstname, $user_lastname, $user_mobilenumber, $user_role, $user_depid, $created_at);

            $response = [
                'status' => 'success',
                'message' => $_SESSION['lang'] == "en" ? 'Create User Successfully' : 'สร้างบัญชีผู้ใช้เสร็จเรียบร้อยแล้ว'
            ];
        
            echo json_encode($response);
        }
    }
    else {
        $response = [
            'status' => 'error',
            'message' => $_SESSION['lang'] == "en" ? 'Something went wrong! Please try again' : 'พบข้อผิดพลาด โปรดลองใหม่อีกครั้ง'
        ];
    
        echo json_encode($response);
    }

?>