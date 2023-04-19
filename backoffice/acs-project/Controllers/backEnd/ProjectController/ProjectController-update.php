<?php
    if($_SERVER["SERVER_NAME"] == 'localhost' || $_SERVER["SERVER_NAME"] == '127.0.0.1'){
        require $_SERVER['DOCUMENT_ROOT'] . "/acs-groups/backoffice/acs-project/config/app.php";
    }else{
        require $_SERVER['DOCUMENT_ROOT'] . "/backoffice/acs-project/config/app.php";
    }
    
    session_start();    
    date_default_timezone_set('Asia/Bangkok');
    
    use App\Models\Project;

    // var_dump($_POST);
    
    if(isset($_POST)) {
        $project_id = $_POST["project_id"];
        $project_name_th = $_POST["project_name_th"];
        $project_name_en = $_POST["project_name_en"];
        $project_category = $_POST["project_category"];
        $project_owner = $_POST["project_owner"];
        $project_scope = $_POST["project_scope"];
        $project_type = $_POST["project_type"];
        $project_department = $_POST["project_department"];
        $project_status = $_POST["project_status"];
        $project_value = $_POST["project_value"];
        $project_area = $_POST["project_area"];
        $project_location_th = $_POST["project_location_th"];
        $project_location_en = $_POST["project_location_en"];
        $project_description_th = $_POST["project_description_th"];
        $project_description_en = $_POST["project_description_en"];
        $project_year_of_commencement = $_POST["project_year_of_commencement"];
        $project_year_of_completion = $_POST["project_year_of_completion"];
        $user_action = $_POST["user_action"];
        $user_role = $_POST["user_role"];
        $datetime = date('Y-m-d H:i:s');

        $project_action = "update project";
        
        if($user_role == 'admin') {
            $project_active = '1';
            $project_reviewstatus = "authorized";
        }
        else {
            $project_active = '0';
            $project_reviewstatus = "waiting for review";
        }

        $data = [
            'project_name_th' => $project_name_th,
            'project_name_en' => $project_name_en,
            'project_category' => $project_category,
            'project_owner' => $project_owner,
            'project_scope' => $project_scope,
            'project_type' => $project_type,
            'project_department' => $project_department,
            'project_status' => $project_status,
            'project_value' => $project_value,
            'project_area' => $project_area,
            'project_location_th' => $project_location_th,
            'project_location_en' => $project_location_en,
            'project_description_th' => $project_description_th,
            'project_description_en' => $project_description_en,
            'project_year_of_commencement' => $project_year_of_commencement,
            'project_year_of_completion' => $project_year_of_completion,
            'project_active' => $project_active,
            'project_action' => $project_action,
            'project_reviewstatus' => $project_reviewstatus,
            'updated_at' => $datetime,
            'user_updated' => $user_action,
            'project_id' => $project_id
        ];

        $projectObj = new Project;
        $projectObj->updateProject($data);

        $response = [
            'status' => 'success',
            'message' => $_SESSION['lang'] == "en" ? 'Update Project Successfully' : 'อัพเดทโครงการเสร็จเรียบร้อยแล้ว'
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