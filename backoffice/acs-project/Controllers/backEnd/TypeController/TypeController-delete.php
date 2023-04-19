<?php
    if($_SERVER["SERVER_NAME"] == 'localhost' || $_SERVER["SERVER_NAME"] == '127.0.0.1'){
        require $_SERVER['DOCUMENT_ROOT'] . "/acs-groups/backoffice/acs-project/config/app.php";
    }else{
        require $_SERVER['DOCUMENT_ROOT'] . "/backoffice/acs-project/config/app.php";
    }
    
    session_start();
    use App\Models\Type;
  
    if(isset($_POST)) {
        $type_id = $_POST['type_id'];
        $typeObj = new Type;
        $typeObj->deleteType($type_id);

        $response = [
            'status' => 'success',
            'message' => $_SESSION['lang'] == "en" ? 'Delete Project Type Successfully' : 'ลบประเภทโครงการนี้เสร็จเรียบร้อยแล้ว'
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