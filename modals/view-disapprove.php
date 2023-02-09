<?php 
    if($_SERVER["SERVER_NAME"] == 'localhost' || $_SERVER["SERVER_NAME"] == '127.0.0.1'){
        require $_SERVER['DOCUMENT_ROOT'] . "/acs-groups/backoffice/acs-project/config/app.php";
    }else{
        require $_SERVER['DOCUMENT_ROOT'] . "/backoffice/acs-project/config/app.php";
    }
           
    session_start();

    use App\Models\Project;
    use App\Models\Owner;


    if(isset($_POST)) {
        if($_POST['action'] == 'disapprove project') {
            $case = 1;
            $project_id = $_POST['project_id'];
            $projectObj = new Project();
            $details = $projectObj->getProjectById($project_id);
        }
        else {
            $case = 2;
            $owner_id = $_POST['owner_id'];
            $ownerObj = new Owner();
            $details = $ownerObj->getOwnerById($owner_id);
        }


        foreach($details as $detail) {
        }

        
        //Set Language
        if($_SESSION['lang'] == "en") {
            $text_btn = "Confirm";
            $project_name = (!empty($detail['project_name_en'])) ? $detail['project_name_en'] : "";
            $owner_name = (!empty($detail['owner_name_en'])) ? $detail['owner_name_en'] : "";
            $disapprove_check = "Do you want to edit new information?";
            $yes = "Yes";
            $no = "No";
            $disapprove_reason = "Disapprove Reason";
        }
        else {
            $text_btn = "ยืนยัน";
            $project_name = (!empty($detail['project_name_th'])) ? $detail['project_name_th'] : "";
            $owner_name = (!empty($detail['owner_name_th'])) ? $detail['owner_name_th'] : "";
            $disapprove_check = "ต้องการให้แก้ไขข้อมูลใหม่ใช่หรือไม่?";
            $yes = "ใช่";
            $no = "ไม่";
            $disapprove_reason = "เหตุผลที่ไม่อนุมัติ";
        }


        if($case == 1) {
            $content = '<span class="badge bg-danger mb-2">' .$project_name. '</span></br>'; 
            $button = '
                <button type="button" class="btn btn-outline-primary" onclick="confirmDisapproveProject('. $project_id .')">
                    ' .$text_btn. '
                </button>
            ';       
        }
        else {
            $content = '<span class="badge bg-danger mb-2">' .$owner_name. '</span></br>';  
            $button = '
                <button type="button" class="btn btn-outline-primary" onclick="confirmDisapproveOwner('. $owner_id .')">
                    ' .$text_btn. '
                </button>
            ';           
        }


        $content .= '
            <label for="disapproveReason" class="form-label" style="font-size: 0.9rem;">' .$disapprove_check. '
                <span id="validate_check"></span>
            </label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="resend_request" id="resend_request" value="yes">
                <label class="form-check-label" for="resend_request">' .$yes. '</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="resend_request" id="resend_request" value="no">
                <label class="form-check-label" for="resend_request">' .$no. ' </label>
            </div>

            <div class="my-3">
                <label for="disapproveReason" class="form-label" style="font-size: 0.9rem;">' .$disapprove_reason. '</label>
                <textarea class="form-control" id="disapprove_reason" name="disapprove_reason" rows="3"></textarea>
                <span id="validate_reason"></span>
            </div>
            '.$button.'
        ';

        $response = [
            'status' => 'success',
            'message' => 'Get content modal',
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
                                   
                                   
                                   
                                   
                   
                  