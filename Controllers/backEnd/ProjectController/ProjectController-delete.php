<?php
    if($_SERVER["SERVER_NAME"] == 'localhost' || $_SERVER["SERVER_NAME"] == '127.0.0.1'){
        require $_SERVER['DOCUMENT_ROOT'] . "/acs-groups/backoffice/acs-project/config/app.php";
    }else{
        require $_SERVER['DOCUMENT_ROOT'] . "/backoffice/acs-project/config/app.php";
    }
    
    session_start();
    use App\Models\Project;
  
    if(isset($_POST)) {
        $project_id = $_POST['project_id'];
        $projectObj = new Project;
        
        $check = $projectObj->deleteProjectImage($project_id);

        if($check){
            $projectObj->deleteProject($project_id);
            $response = [
                'status' => 'success',
                'message' => $_SESSION['lang'] == "en" ? 'Delete Project Successfully' : 'ลบโครงการนี้เสร็จเรียบร้อยแล้ว'
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