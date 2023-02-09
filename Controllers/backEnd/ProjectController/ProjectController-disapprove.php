<?php
    if($_SERVER["SERVER_NAME"] == 'localhost' || $_SERVER["SERVER_NAME"] == '127.0.0.1'){
        require $_SERVER['DOCUMENT_ROOT'] . "/acs-groups/backoffice/acs-project/config/app.php";
    }else{
        require $_SERVER['DOCUMENT_ROOT'] . "/backoffice/acs-project/config/app.php";
    }
    
    session_start();    
    date_default_timezone_set('Asia/Bangkok');
    
    use App\Models\Project;

    if(isset($_POST)) {
        $project_id = $_POST['project_id'];
        $resend_request = $_POST['resend_request'];
        $disapprove_reason = $_POST['disapprove_reason'];


        $projectObj = new Project;
        $result = $projectObj->getProjectById($project_id);
        foreach ($result as $row) { 
            $project_action = $row['project_action'];
        }

        $data = [
            'project_id' => $project_id,
            'resend_request' => $resend_request,
            'disapprove_reason' => $disapprove_reason,
            'project_action' => $project_action
        ];


        $projectObj->disapproveRequest($data);

        $response = [
            'status' => 'success',
            'message' => $_SESSION['lang'] == "en" ? 'Request was not approved' : 'คำร้องขอไม่ได้รับการอนุมัติ'
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