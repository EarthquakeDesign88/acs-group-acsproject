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
        $pcategory_id = $_POST["pcategory_id"];
        $pcategory_name_th = $_POST["pcategory_name_th"];
        $pcategory_name_en = $_POST["pcategory_name_en"];
        $updated_at = date('Y-m-d H:i:s');

        $categoryObj = new Category;
        $categoryObj->updateCategory($pcategory_id, $pcategory_name_th, $pcategory_name_en, $updated_at);

        $response = [
            'status' => 'success',
            'message' => $_SESSION['lang'] == "en" ? 'Update Project Category Successfully' : 'อัพเดทหมวดหมู่โครงการเสร็จเรียบร้อยแล้ว'
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