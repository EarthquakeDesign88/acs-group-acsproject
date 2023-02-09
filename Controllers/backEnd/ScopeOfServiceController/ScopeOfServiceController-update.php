<?php
    if($_SERVER["SERVER_NAME"] == 'localhost' || $_SERVER["SERVER_NAME"] == '127.0.0.1'){
        require $_SERVER['DOCUMENT_ROOT'] . "/acs-groups/backoffice/acs-project/config/app.php";
    }else{
        require $_SERVER['DOCUMENT_ROOT'] . "/backoffice/acs-project/config/app.php";
    }
    
    session_start();
    date_default_timezone_set('Asia/Bangkok');

    $updated_at = date('Y-m-d H:i:s');

    use App\Models\ScopeOfService;

    if(isset($_POST)) {
        $scope_id = $_POST["scope_id"];
        $scope_name_th = $_POST["scope_name_th"];
        $scope_name_en = $_POST["scope_name_en"];
        $updated_at = date('Y-m-d H:i:s');

        $scopeObj = new ScopeOfService;
        $scopeObj->updateScopeOfService($scope_id, $scope_name_th, $scope_name_en, $updated_at);

        $response = [
            'status' => 'success',
            'message' => $_SESSION['lang'] == "en" ? 'Update Scope Of Service Successfully' : 'อัพเดทขอบเขตโครงการเสร็จเรียบร้อยแล้ว'
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