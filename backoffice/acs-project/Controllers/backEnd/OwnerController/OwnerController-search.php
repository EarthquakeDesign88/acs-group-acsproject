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
        $search_query = isset($_POST['keywords']) ? $_POST['keywords'] : '';

        $ownerObj = new Owner;
        $data = $ownerObj->searchOwner($search_query);

        $response = [
            'status' => 'success',
            'data' => $data
        ];
    
        echo json_encode($response);
    }else {
        $response = [
            'status' => 'error',
            'message' => $_SESSION['lang'] == "en" ? 'Something went wrong! Please try again' : 'พบข้อผิดพลาด โปรดลองใหม่อีกครั้ง'
        ];
    
        echo json_encode($response);
    }

?>