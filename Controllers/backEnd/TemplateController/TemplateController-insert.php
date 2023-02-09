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
        $user_created = $_POST["user_created"];
        $created_at = date('Y-m-d H:i:s');
        $allProject_id = $_POST["all_projectId"];

        $data = [
            'template_name' => $template_name,
            'template_language' => $template_language,
            'created_at' => $created_at,
            'user_created' => $user_created,
            'allProject_id' => $allProject_id
        ];


        $templateObj = new Template;
        $checkExists = $templateObj->checkExistsTemplate($template_name);

        if($checkExists > 0) {
            $response = [
                'status' => 'warning',
                'message' => $_SESSION['lang'] == "en" ? 'Template is already exists' : 'แม่แบบนี้ถูกใช้แล้ว โปรดใช้ชื่ออื่น'
            ];
        
            echo json_encode($response);   
        }
        else {
            $templateObj->createTemplate($data);

            $response = [
                'status' => 'success',
                'message' => $_SESSION['lang'] == "en" ? 'Create Template Successfully' : 'สร้างแม่แบบเสร็จเรียบร้อยแล้ว'
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