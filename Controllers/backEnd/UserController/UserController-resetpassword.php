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
        $user_id = $_POST["user_id"];
        $password = $_POST["password"];
        $updated_at = date('Y-m-d H:i:s');

        $page = $_POST['page'];

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $userObj = new User;
        $userObj->resetPassword($user_id, $passwordHash, $updated_at);

         //Check page for response
         if($page == 'profile') {
            $response = [
                'status' => 'success',
                'checkPage' => $page,
                'message' => $_SESSION['lang'] == "en" ? 'Reset Password Successfully' : 'รีเซ็ตรหัสผ่านเสร็จเรียบร้อยแล้ว'
            ];
        }
        else {
            $response = [
                'status' => 'success',
                'checkPage' => $page,
                'message' => $_SESSION['lang'] == "en" ? 'Reset Password Successfully' : 'รีเซ็ตรหัสผ่านเสร็จเรียบร้อยแล้ว'
            ];
        }

        echo json_encode($response);
        
    }
    else {
        $response = [
            'status' => 'error',
            'message' => $_SESSION['lang'] == "en" ? 'Something went wrong! Please try again' : 'พบข้อผิดพลาด โปรดลองใหม่อีกครั้ง'
        ];
    
        echo json_encode($response);
    }


?>