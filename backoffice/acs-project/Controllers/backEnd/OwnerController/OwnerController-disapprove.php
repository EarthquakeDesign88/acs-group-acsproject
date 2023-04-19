<?php
    if($_SERVER["SERVER_NAME"] == 'localhost' || $_SERVER["SERVER_NAME"] == '127.0.0.1'){
        require $_SERVER['DOCUMENT_ROOT'] . "/acs-groups/backoffice/acs-project/config/app.php";
    }else{
        require $_SERVER['DOCUMENT_ROOT'] . "/backoffice/acs-project/config/app.php";
    }
    
    session_start();    
    date_default_timezone_set('Asia/Bangkok');
    
    use App\Models\Owner;

    if(isset($_POST)) {
        $owner_id = $_POST['owner_id'];
        $resend_request = $_POST['resend_request'];
        $disapprove_reason = $_POST['disapprove_reason'];

        $data = [
            'owner_id' => $owner_id,
            'resend_request' => $resend_request,
            'disapprove_reason' => $disapprove_reason
        ];

        $ownerObj = new Owner;
        $ownerObj->disapproveRequest($data);

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