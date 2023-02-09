<?php
    if($_SERVER["SERVER_NAME"] == 'localhost' || $_SERVER["SERVER_NAME"] == '127.0.0.1'){
        require $_SERVER['DOCUMENT_ROOT'] . "/acs-groups/backoffice/acs-project/config/app.php";
    }else{
        require $_SERVER['DOCUMENT_ROOT'] . "/backoffice/acs-project/config/app.php";
    }
    
    session_start();
    date_default_timezone_set('Asia/Bangkok');

    use App\Models\Category;
    
    if(isset($_POST)) {
        $pcategory_name_th = $_POST["pcategory_name_th"];
        $pcategory_name_en = $_POST["pcategory_name_en"];
        $created_at = date('Y-m-d H:i:s');
        
        $categoryObj = new Category;

        $checkExists = $categoryObj->checkExistsCategory($pcategory_name_th, $pcategory_name_en);

        if($checkExists > 0) {
            $response = [
                'status' => 'warning',
                'message' => $_SESSION['lang'] == "en" ? 'Project Category is already exists' : 'หมวดหมู่โครงการนี้ถูกใช้แล้ว โปรดใช้ชื่ออื่น'
            ];
        
            echo json_encode($response);
        }
        else {
            $categoryObj->createCategory($pcategory_name_th, $pcategory_name_en, $created_at);

            $response = [
                'status' => 'success',
                'message' => $_SESSION['lang'] == "en" ? 'Create Project Category Successfully' : 'สร้างหมวดหมู่โครงการเสร็จเรียบร้อยแล้ว'
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