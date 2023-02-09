<?php
    if($_SERVER["SERVER_NAME"] == 'localhost' || $_SERVER["SERVER_NAME"] == '127.0.0.1'){
        require $_SERVER['DOCUMENT_ROOT'] . "/acs-groups/backoffice/acs-project/config/app.php";
    }else{
        require $_SERVER['DOCUMENT_ROOT'] . "/backoffice/acs-project/config/app.php";
    }
    
    session_start();
    date_default_timezone_set('Asia/Bangkok');

    use App\Models\Status;
   
    if(isset($_POST)) {
        $status_id = $_POST["status_id"];
        $status_name_th = $_POST["status_name_th"];
        $status_name_en = $_POST["status_name_en"];
        $updated_at = date('Y-m-d H:i:s');

        $statusObj = new Status;
        $statusObj->updateStatus($status_id, $status_name_th, $status_name_en, $updated_at);

        $response = [
            'status' => 'success',
            'message' => $_SESSION['lang'] == "en" ? 'Update Project Status Successfully' : 'อัพเดทสถานะโครงการเสร็จเรียบร้อยแล้ว'
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