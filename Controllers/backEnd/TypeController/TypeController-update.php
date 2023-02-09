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
        $type_id = $_POST["type_id"];
        $type_name_th = $_POST["type_name_th"];
        $type_name_en = $_POST["type_name_en"];
        $updated_at = date('Y-m-d H:i:s');

        $typeObj = new Type;
        $typeObj->updateType($type_id, $type_name_th, $type_name_en, $updated_at);

        $response = [
            'status' => 'success',
            'message' => $_SESSION['lang'] == "en" ? 'Update Project Type Successfully' : 'อัพเดทประเภทโครงการเสร็จเรียบร้อยแล้ว'
        ];
    
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