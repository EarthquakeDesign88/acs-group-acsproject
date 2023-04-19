<?php
    if($_SERVER["SERVER_NAME"] == 'localhost' || $_SERVER["SERVER_NAME"] == '127.0.0.1'){
        require $_SERVER['DOCUMENT_ROOT'] . "/acs-groups/backoffice/acs-project/config/app.php";
    }else{
        require $_SERVER['DOCUMENT_ROOT'] . "/backoffice/acs-project/config/app.php";
    }
    
    session_start();
    date_default_timezone_set('Asia/Bangkok');

    use App\Models\Type;

    if(isset($_POST)) {
        $type_name_th = $_POST["type_name_th"];
        $type_name_en = $_POST["type_name_en"];
        $created_at = date('Y-m-d H:i:s');

        $typeObj = new Type;

        $checkExists = $typeObj->checkExistsType($type_name_th, $type_name_en);

        if($checkExists > 0) {
            $response = [
                'status' => 'warning',
                'message' => $_SESSION['lang'] == "en" ? 'Project Type is already exists' : 'ประเภทโครงการนี้ถูกใช้แล้ว โปรดใช้ชื่ออื่น'
            ];
        
            echo json_encode($response);   
        }
        else {
            $typeObj->createType($type_name_th, $type_name_en, $created_at);

            $response = [
                'status' => 'success',
                'message' => $_SESSION['lang'] == "en" ? 'Create Project Type Successfully' : 'สร้างประเภทโครงการเสร็จเรียบร้อยแล้ว'
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