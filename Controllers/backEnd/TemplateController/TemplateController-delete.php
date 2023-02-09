<?php
    if($_SERVER["SERVER_NAME"] == 'localhost' || $_SERVER["SERVER_NAME"] == '127.0.0.1'){
        require $_SERVER['DOCUMENT_ROOT'] . "/acs-groups/backoffice/acs-project/config/app.php";
    }else{
        require $_SERVER['DOCUMENT_ROOT'] . "/backoffice/acs-project/config/app.php";
    }
    
    session_start();
    use App\Models\Template;

    if(isset($_POST)) {
        if($_POST['action'] === "del_project"){
            $tdetail_id = $_POST['tdetail_id'];
            $tDetailObj = new Template;
            $tDetailObj->deleteProject($tdetail_id);
    
            $response = [
                'status' => 'success',
                'message' => $_SESSION['lang'] == "en" ? 'Delete Project Successfully' : 'ลบโครงการนี้เสร็จเรียบร้อยแล้ว'
            ];
    
            echo json_encode($response);

        }
        else if($_POST['action'] === "del_template"){
            $template_id = $_POST['template_id'];
            $templateObj = new Template;
            $templateObj->deleteTemplate($template_id);
    
            $response = [
                'status' => 'success',
                'message' => $_SESSION['lang'] == "en" ? 'Delete Template Successfully' : 'ลบแม่แบบนี้เสร็จเรียบร้อยแล้ว'
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
    }
    else {
        $response = [
            'status' => 'error',
            'message' => $_SESSION['lang'] == "en" ? 'Something went wrong! Please try again' : 'พบข้อผิดพลาด โปรดลองใหม่อีกครั้ง'
        ];

        echo json_encode($response);
    }


?>