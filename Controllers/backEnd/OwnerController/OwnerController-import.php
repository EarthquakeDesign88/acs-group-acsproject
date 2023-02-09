<?php
    if($_SERVER["SERVER_NAME"] == 'localhost' || $_SERVER["SERVER_NAME"] == '127.0.0.1'){
        require $_SERVER['DOCUMENT_ROOT'] . "/acs-groups/backoffice/acs-project/config/app.php";
    }else{
        require $_SERVER['DOCUMENT_ROOT'] . "/backoffice/acs-project/config/app.php";
    }
    
    session_start();
    date_default_timezone_set('Asia/Bangkok');

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use App\Models\Owner;

    if(isset($_POST)) {
        $fileName = $_FILES['import-file']['name'];
        $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);
        $allowed_ext = ['xls', 'csv', 'xlsx'];

        if(in_array($file_ext, $allowed_ext)) {
            $inputFileNamePath = $_FILES['import-file']['tmp_name'];
            $spreadsheet = IOFactory::load($inputFileNamePath);
            $data = $spreadsheet->getActiveSheet()->toArray();
            $countData = 0;
    
            $count = "0";
            foreach($data as $col)
            {
                if($count)
                {
                    $owner_name_th = $col['0'];
                    $owner_name_en = $col['1'];
                    $user_created = $_POST['user_created'];
                    $created_at = date('Y-m-d H:i:s');

                    $ownerObj = new Owner;
                    $checkInsert = $ownerObj->createOwner($owner_name_th, $owner_name_en, $user_created, $created_at);
                    $countData++;
                }
                else
                {
                    $count = "1";
                }
            }
    
            if(isset($checkInsert))
            {
                $response = [
                    'status' => 'success',
                    'message' => $_SESSION['lang'] == "en" ? 'Upload and Save data '.$countData.' List Successfully' : 'อัพโหลดไฟล์และบันทึกข้อมูล'.$countData.'รายการสำเร็จ',
                ];
            
                echo json_encode($response);
            }
            else
            {
                $response = [
                    'status' => 'warning',
                    'message' => $_SESSION['lang'] == "en" ? 'Failed to save data! Please try again ' : 'บันทึกข้อมูลไม่สำเร็จ โปรดลองใหม่อีกครั้ง'
                ];
            
                echo json_encode($response);
            }
        }
        else
        {
            $response = [
                'status' => 'warning',
                'message' => $_SESSION['lang'] == "en" ? 'Please use only xls, csv, xlsx file extensions.' : 'โปรดใช้ไฟล์นามสกุล xls, csv, xlsx เท่านั้น'
            ];
        
            echo json_encode($response);
        }

    }
    else
    {
        $response = [
            'status' => 'error',
            'message' => $_SESSION['lang'] == "en" ? 'Something went wrong! Please try again' : 'พบข้อผิดพลาด โปรดลองใหม่อีกครั้ง'
        ];
    
        echo json_encode($response);
    }

?>