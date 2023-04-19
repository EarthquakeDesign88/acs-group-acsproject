<?php
    if($_SERVER["SERVER_NAME"] == 'localhost' || $_SERVER["SERVER_NAME"] == '127.0.0.1'){
        require $_SERVER['DOCUMENT_ROOT'] . "/acs-groups/backoffice/acs-project/config/app.php";
    }else{
        require $_SERVER['DOCUMENT_ROOT'] . "/backoffice/acs-project/config/app.php";
    }
    
    session_start();
    use App\Models\Status;
  
    if(isset($_POST)) {
        $status_id = $_POST['status_id'];
        $statusObj = new Status;
        $statusObj->deleteStatus($status_id);

        $response = [
            'status' => 'success',
            'message' => $_SESSION['lang'] == "en" ? 'Delete Project Status Successfully' : 'ลบสถานะโครงการนี้เสร็จเรียบร้อยแล้ว'
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