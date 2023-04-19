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
        $username = $_POST["username"];
        $user_email = $_POST["user_email"];
        $user_firstname = $_POST["user_firstname"];
        $user_lastname = $_POST["user_lastname"];
        $user_mobilenumber = $_POST["user_mobilenumber"];
        $user_role = $_POST["user_role"];
        $user_depid = $_POST["user_depid"];
        $updated_at = date('Y-m-d H:i:s');

        $page = $_POST['page'];

        $userObj = new User;
        $userObj->updateUser($user_id, $username, $user_email, $user_firstname, $user_lastname, $user_mobilenumber, $user_role, $user_depid, $updated_at);

        //Check page for response
        if($page == 'profile') {
            $response = [
                'status' => 'success',
                'checkPage' => $page,
                'message' => $_SESSION['lang'] == "en" ? 'Update Profile Successfully' : 'อัพเดทข้อมูลส่วนตัวเสร็จเรียบร้อยแล้ว'
            ];
        }
        else {
            $response = [
                'status' => 'success',
                'checkPage' => $page,
                'message' => $_SESSION['lang'] == "en" ? 'Update User Successfully' : 'อัพเดทบัญชีผู้ใช้เสร็จเรียบร้อยแล้ว'
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