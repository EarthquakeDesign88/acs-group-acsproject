<?php
    if($_SERVER["SERVER_NAME"] == 'localhost' || $_SERVER["SERVER_NAME"] == '127.0.0.1'){
        require $_SERVER['DOCUMENT_ROOT'] . "/acs-groups/backoffice/acs-project/config/app.php";
    }else{
        require $_SERVER['DOCUMENT_ROOT'] . "/backoffice/acs-project/config/app.php";
    }
    
    session_start();
    date_default_timezone_set('Asia/Bangkok');

    use App\Models\Owner;
    
    if(isset($_POST)) {
        $owner_name_th = $_POST["owner_name_th"];
        $owner_name_en = $_POST["owner_name_en"];
        $user_action = $_POST["user_action"];
        $user_role = $_POST["user_role"];
        $datetime = date('Y-m-d H:i:s');

        $owner_action = "create project owner";

        if($user_role == 'admin') {
            $owner_active = '1';
            $owner_reviewstatus = "authorized";
        }
        else {
            $owner_active = '0';
            $owner_reviewstatus = "waiting for review";
        }

        $data = [
            'owner_name_th' => $owner_name_th,
            'owner_name_en' => $owner_name_en,
            'owner_active' => $owner_active,
            'owner_action' => $owner_action,
            'owner_reviewstatus' => $owner_reviewstatus,
            'created_at' => $datetime,
            'user_created' => $user_action,
            'updated_at' => $datetime,
            'user_updated' => $user_action
        ];


        $ownerObj = new Owner;
        $checkExists = $ownerObj->checkExistsOwner($owner_name_th, $owner_name_en);

        if($checkExists > 0) {
            $response = [
                'status' => 'warning',
                'message' => $_SESSION['lang'] == "en" ? 'Project Owner is already exists' : 'เจ้าของโครงการนี้ถูกใช้แล้ว โปรดใช้ชื่ออื่น'
            ];
        
            echo json_encode($response);   
        }
        else {
            $ownerObj->createOwner($data);

            $response = [
                'status' => 'success',
                'message' => $_SESSION['lang'] == "en" ? 'Create Project Owner Successfully' : 'สร้างเจ้าของโครงการเสร็จเรียบร้อยแล้ว'
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