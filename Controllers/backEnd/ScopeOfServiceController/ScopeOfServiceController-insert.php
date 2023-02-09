<?php
    if($_SERVER["SERVER_NAME"] == 'localhost' || $_SERVER["SERVER_NAME"] == '127.0.0.1'){
        require $_SERVER['DOCUMENT_ROOT'] . "/acs-groups/backoffice/acs-project/config/app.php";
    }else{
        require $_SERVER['DOCUMENT_ROOT'] . "/backoffice/acs-project/config/app.php";
    }
    
    session_start();
    date_default_timezone_set('Asia/Bangkok');

    use App\Models\ScopeOfService;
    
    if(isset($_POST)) {
        $scope_name_th = $_POST["scope_name_th"];
        $scope_name_en = $_POST["scope_name_en"];
        $created_at = date('Y-m-d H:i:s');

        $scopeObj = new ScopeOfService;
        $checkExists = $scopeObj->checkExistsScopeOfService($scope_name_th, $scope_name_en);

        if($checkExists > 0) {
            $response = [
                'status' => 'warning',
                'message' => $_SESSION['lang'] == "en" ? 'Scope Of Service is already exists' : 'ขอบเขตโครงการนี้ถูกใช้แล้ว โปรดใช้ชื่ออื่น'
            ];
        
            echo json_encode($response);   
        }
        else {
            $scopeObj->createScopeOfService($scope_name_th, $scope_name_en, $created_at);

            $response = [
                'status' => 'success',
                'message' => $_SESSION['lang'] == "en" ? 'Create Scope Of Service Successfully' : 'สร้างขอบเขตโครงการเสร็จเรียบร้อยแล้ว'
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