<?php 
    if($_SERVER["SERVER_NAME"] == 'localhost' || $_SERVER["SERVER_NAME"] == '127.0.0.1'){
        require $_SERVER['DOCUMENT_ROOT'] . "/acs-groups/backoffice/acs-project/config/app.php";
    }else{
        require $_SERVER['DOCUMENT_ROOT'] . "/backoffice/acs-project/config/app.php";
    }
        
    session_start();

    use App\Models\Project;


    if(isset($_POST['project_id'])) {
        $project_id = $_POST['project_id'];
        $condition = isset($_POST['condition']) ? $_POST['condition'] : "";
        $condition2 = isset($_POST['condition2']) ? $_POST['condition2'] : "";

        //Custom Style
        if($condition == 'waiting for review') {
            $case = '1';
            $fontcolor = 'color: #ffab00';
        }
        else if($condition == 'authorized') {
            $case = '2';
            $fontcolor = 'color: #71dd37';
        }
        else if($condition == 'unauthorized' && $condition2 == 'resend request'){
            $case = '3';
            $fontcolor = 'color: #f44336';
        }
        else {
            //For view History 
            $case = '0';
        }
        
        
        $projectObj = new Project;
        $projectDetails = $projectObj->getProjectById($project_id);

        foreach($projectDetails as $project) {
        }

        //Set Language
        if($_SESSION['lang'] == "en") {
            $disapprove_reason = "Disapprove Reason";
            $project_name_th = "Project Name TH";
            $project_name_en = "Project Name EN";
            $project_category = "Project Category";
            $project_type = "Project Type";
            $project_department = "Project Department";
            $project_owner = "Project Owner";
            $project_location_th = "Project Location TH";
            $project_location_en = "Project Location EN";
            $project_area = "Project Area (Sq.m.)";
            $project_value = "Project Value (M.Bath)";
            $project_status = "Project Status";
            $project_scope = "Project Scope Of Service";
            $project_description_th = "Project Description TH";
            $project_description_en = "Project Description EN";
            $project_year_of_commencement = "Project Year Of Commencement";
            $project_year_of_completion = "Project Year Of Completion";
        }
        else {
            $disapprove_reason = "เหตุผลที่ไม่อนุมัติ";
            $project_name_th = "ชื่อโครงการภาษาไทย";
            $project_name_en = "ชื่อโครงการภาษาอังกฤษ";
            $project_category = "หมวดหมู่โครงการ";
            $project_type = "ประเภทโครงการ";
            $project_department= "แผนกที่ทำโครงการ";
            $project_owner = "เจ้าของโครงการ";
            $project_location_th = "ที่อยู่โครงการภาษาไทย";
            $project_location_en = "ที่อยู่โครงการภาษาอังกฤษ";
            $project_area = "พื้นที่โครงการ (ตารางเมตร)";
            $project_value = "มูลค่าโครงการ (ล้านบาท)";
            $project_status = "สถานะโครงการ";
            $project_scope = "ขอบเขตโครงการ";
            $project_description_th = "รายละเอียดโครงการภาษาไทย";
            $project_description_en = "รายละเอียดโครงการภาษาอังกฤษ";
            $project_year_of_commencement = "ปีที่เริ่มดำเนินการโครงการ";
            $project_year_of_completion = "ปีที่เสร็จสิ้นโครงการ";
        }

        $content = '<div class="row">';
                        if($case == '3') {
                            $content .='
                            <div class="col-12 mb-2">
                                <strong class="text-danger">' .$disapprove_reason. '</strong>
                                <div class="alert alert-danger" role="alert">
                                    ' .$project['project_remarkstatus']. '
                                </div>
                            </div>
                            ';
                        }
            $content .='<div class="col-12">
                            <p class="text-title">
                                ' .$project_name_th. ' : <span><small class="text-main">' .$project['project_name_th'].'</small></span>
                            </p>
                        </div>
                        <div class="col-12">
                            <p class="text-title">
                                ' .$project_name_en. ' : <span><small class="text-main">' .$project['project_name_en']. ' </small></span>
                            </p>
                        </div>
                        <div class="col-12">
                            <p class="text-title">
                                ' .$project_category. ' : ';             
                                if ($_SESSION['lang'] == "th") { 
                                    $content .= '<span><small class="text-main">' .$project['pcategory_name_th']. '</small></span>';
                                }
                                else {
                                    $content .= '<span><small class="text-main">' .$project['pcategory_name_en']. '</small></span>';
                                }
                    $content .= '           
                            </p>
                        </div>
                        <div class="col-12">
                            <p class="text-title">
                                ' .$project_type. ' : ';   
                                if ($_SESSION['lang'] == "th") { 
                                    $content .= '<span><small class="text-main">' .$project['type_name_th']. '</small></span>';
                                }
                                else {
                                    $content .= '<span><small class="text-main">' .$project['type_name_en']. '</small></span>';
                                }
                    $content .= '  
                            </p>
                        </div>
                        <div class="col-12">
                            <p class="text-title">
                                ' .$project_department. ' : ';   
                                if ($_SESSION['lang'] == "th") { 
                                    $content .= '<span><small class="text-main">' .$project['department_desc']. '</small></span>';
                                }
                                else {
                                    $content .= '<span><small class="text-main">' .$project['department_name']. '</small></span>';
                                }
                    $content .= '  
                            </p>
                        </div>
                        <div class="col-12">
                            <p class="text-title">
                            ' .$project_owner. ' : ';   
                                if ($_SESSION['lang'] == "th") { 
                                    $content .= '<span><small class="text-main">' .$project['owner_name_th']. '</small></span>';
                                }
                                else {
                                    $content .= '<span><small class="text-main">' .$project['owner_name_en']. '</small></span>';
                                }
                    $content .= '  
                            </p>
                        </div>
                        <div class="col-12">
                            <p class="text-title">
                                ' .$project_location_th. ' : <span><small class="text-main">' .$project['project_location_th']. '</small></span>
                            </p>
                        </div>
                        <div class="col-12">
                            <p class="text-title">
                                ' .$project_location_en. ' : <span><small class="text-main">' .$project['project_location_en']. '</small></span>
                            </p>
                        </div>
                        <div class="col-12">
                            <p class="text-title">
                                ' .$project_area. ' : <span><small class="text-main">' .number_format($project['project_area'], 0). '</small></span>
                            </p>
                        </div>
                        <div class="col-12">
                            <p class="text-title">
                                ' .$project_value. ' : <span><small class="text-main">' .number_format($project['project_value'], 0). '</small></span>
                            </p>
                        </div>
                        <div class="col-12">
                            <p class="text-title">
                                ' .$project_status. ' : ';   
                                if ($_SESSION['lang'] == "th") { 
                                    $content .= '<span><small class="text-main">' .$project['status_name_th']. '</small></span>';
                                }
                                else {
                                    $content .= '<span><small class="text-main">' .$project['status_name_en']. '</small></span>';
                                }
                $content .= '  
                            </p>
                        </div>
                        <div class="col-12">
                            <p class="text-title">
                                ' .$project_scope. ' : ';   
                                if ($_SESSION['lang'] == "th") { 
                                    $content .= '<span><small class="text-main">' .$project['scope_name_th']. '</small></span>';
                                }
                                else {
                                    $content .= '<span><small class="text-main">' .$project['scope_name_en']. '</small></span>';
                                }
                $content .= '  
                            </p>
                        </div>
                        <div class="col-12">
                            <p class="text-title">
                                ' .$project_description_th. ' : <span><small class="text-main">' .$project['project_description_th']. '</small></span>
                            </p>
                        </div>
                        <div class="col-12">
                            <p class="text-title">
                                ' .$project_description_en. ' : <span><small class="text-main">' .$project['project_description_en']. '</small></span>
                            </p>
                        </div>
                        <div class="col-12">
                            <p class="text-title">
                                ' .$project_year_of_commencement. ' : <span><small class="text-main">' .$project['project_year_of_commencement']. '</small></span>
                            </p>
                        </div>
                        <div class="col-12">
                            <p class="text-title">
                                ' .$project_year_of_completion. ' : <span><small class="text-main">' .$project['project_year_of_completion']. '</small></span>
                            </p>
                        </div>
                    </div>';

        $space = (!empty($condition2)) ? '&' : '';
        $response = [
            'status' => 'success',
            'message' => 'Get content modal',
            'condition' =>  $condition . $space . $condition2,
            'content' => $content
        ];
    
        echo json_encode($response);
      
    }
    else {
        $response = [
            'status' => 'error',
            'message' => 'Unable to retrieve content'
        ];
    
        echo json_encode($response);
    }

?>