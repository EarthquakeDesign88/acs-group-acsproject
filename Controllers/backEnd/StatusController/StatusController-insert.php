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
        $status_name_th = $_POST["status_name_th"];
        $status_name_en = $_POST["status_name_en"];
        $created_at = date('Y-m-d H:i:s');

        $statusObj = new Status;

        $checkExists = $statusObj->checkExistsStatus($status_name_th, $status_name_en);

        if($checkExists > 0) {
            $response = [
                'status' => 'warning',
                'message' => $_SESSION['lang'] == "en" ? 'Project Status is already exists' : 'สถานะโครงการนี้ถูกใช้แล้ว โปรดใช้ชื่ออื่น'
            ];
        
            echo json_encode($response);   
        }
        else {
            $statusObj->createStatus($status_name_th, $status_name_en, $created_at);

            $response = [
                'status' => 'success',
                'message' => $_SESSION['lang'] == "en" ? 'Create Project Status Successfully' : 'สร้างสถานะโครงการเสร็จเรียบร้อยแล้ว'
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