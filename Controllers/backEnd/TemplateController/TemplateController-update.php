<?php
    if($_SERVER["SERVER_NAME"] == 'localhost' || $_SERVER["SERVER_NAME"] == '127.0.0.1'){
        require $_SERVER['DOCUMENT_ROOT'] . "/acs-groups/backoffice/acs-project/config/app.php";
    }else{
        require $_SERVER['DOCUMENT_ROOT'] . "/backoffice/acs-project/config/app.php";
    }
    
    session_start();
    date_default_timezone_set('Asia/Bangkok');

    use App\Models\Template;


    if(isset($_POST)) {
        $template_name = $_POST["template_name"];
        $template_language = $_POST["template_language"];
        $template_id = $_POST["template_id"];
        $user_updated = $_POST["userUpdated"];
        $updated_at = date('Y-m-d H:i:s');
        $allProject_id = $_POST["all_projectId"];

        $data = [
            'template_name' => $template_name,
            'template_language' => $template_language,
            'template_id' => $template_id,
            'user_updated' => $user_updated,
            'updated_at' => $updated_at,
            'allProject_id' => $allProject_id
        ];

        $templateObj = new Template;
        $templateObj->updateTemplate($data);

        $response = [
            'status' => 'success',
            'message' => $_SESSION['lang'] == "en" ? 'Update Template Successfully' : 'อัพเดทแม่แบบเสร็จเรียบร้อยแล้ว'
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