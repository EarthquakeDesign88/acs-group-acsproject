<?php 
    if($_SERVER["SERVER_NAME"] == 'localhost' || $_SERVER["SERVER_NAME"] == '127.0.0.1'){
        require $_SERVER['DOCUMENT_ROOT'] . "/acs-groups/backoffice/acs-project/config/app.php";
    }else{
        require $_SERVER['DOCUMENT_ROOT'] . "/backoffice/acs-project/config/app.php";
    }
           
    session_start();

    use App\Models\Owner;


    if(isset($_POST['owner_id'])) {
        $owner_id = $_POST['owner_id'];
        $condition = isset($_POST['condition']) ? $_POST['condition'] : "";
        $condition2 = isset($_POST['condition2']) ? $_POST['condition2'] : "";
        $role = isset($_POST['role']) ? $_POST['role'] : "";
        

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
        

        $ownerObj = new Owner;
        $ownerDetails = $ownerObj->getOwnerById($owner_id);


        foreach($ownerDetails as $owner) {
        }

        //Set Language
        if($_SESSION['lang'] == "en") {
            $disapprove_reason = "Disapprove Reason";
            $owner_name_th = "Owner Name TH";
            $owner_name_en = "Owner Name EN";
        }
        else {
            $disapprove_reason = "เหตุผลที่ไม่อนุมัติ";
            $owner_name_th = "ชื่อเจ้าของโครงการภาษาไทย";
            $owner_name_en = "ชื่อเจ้าของโครงการภาษาอังกฤษ";
        }

        $content = '<div class="row">';
                        if($case == '3') {
                            $content .='
                            <div class="col-12 mb-2">
                                <strong class="text-danger">' .$disapprove_reason. '</strong>
                                <div class="alert alert-danger" role="alert">
                                    ' .$owner['owner_remarkstatus']. '
                                </div>
                            </div>
                            ';
                        }
            $content .='<div class="col-12">
                            <p class="text-title">
                                ' .$owner_name_th. ' : <span><small class="text-main">' .$owner['owner_name_th'].'</small></span>
                            </p>
                        </div>
                        <div class="col-12">
                            <p class="text-title">
                                ' .$owner_name_en. ' : <span><small class="text-main">' .$owner['owner_name_en']. ' </small></span>
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