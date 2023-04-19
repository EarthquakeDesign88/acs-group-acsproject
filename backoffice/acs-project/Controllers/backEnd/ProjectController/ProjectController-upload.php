<?php
    if($_SERVER["SERVER_NAME"] == 'localhost' || $_SERVER["SERVER_NAME"] == '127.0.0.1'){
        require $_SERVER['DOCUMENT_ROOT'] . "/acs-groups/backoffice/acs-project/config/app.php";
    }else{
        require $_SERVER['DOCUMENT_ROOT'] . "/backoffice/acs-project/config/app.php";
    }
    
    session_start();

    date_default_timezone_set('Asia/Bangkok');

    use App\Models\Project;


    if(isset($_POST['project_id'])) {
        if(!empty(array_filter($_FILES['files']['name']))){
            $project_id = $_POST["project_id"];
            $user_updated = $_POST["user_updated"];
            $user_role = $_POST["user_role"];
            $updated_at = date('Y-m-d H:i:s');


            if($user_role == 'admin') {
                $project_active = '1';
                $project_reviewstatus = "authorized";
            }
            else {
                $project_active = '0';
                $project_reviewstatus = "waiting for review";
            }
    
            $totalFiles = count($_FILES['files']['name']);
            $filesArray = array();

            //Get Project Name
            $projectObj = new Project;
            $result = $projectObj->getProjectById($project_id);
            foreach ($result as $row) { 
                $projectName = strtolower($row['project_name_en']);
                $projectImage = $row['project_image'];
            }

            //Check action 
            if($projectImage == '') {
                $project_action = "upload image";
            }
            else {
                $project_action = "upload new image";
            }
            
            for($i = 0; $i < $totalFiles; $i++){
                $imageName = $_FILES["files"]["name"][$i];
                $tmpName = $_FILES["files"]["tmp_name"][$i];
                $imageSize = $_FILES["files"]["size"][$i];

                $allowTypes  = array('jpg', 'jpeg', 'png');
                $fileExtension = pathinfo($imageName, PATHINFO_EXTENSION);


                if($imageSize > 4000000) { // Image size not exceeds 4 MB
                    $response = [
                        'status' => 'exceedsLimit',
                        'message' => $_SESSION['lang'] == "en" ? 'Do not use image larger than 4 MB, please use another image' : 'ห้ามใช้รูปภาพขนาดเกิน 4 MB โปรดใช้รูปภาพอื่น'
                    ];
                
                    echo json_encode($response);
                    exit();
                }
                else if(!in_array($fileExtension, $allowTypes)) { // Validate image type
                    $response = [
                        'status' => 'wrongExtension',
                        'message' => $_SESSION['lang'] == "en" ? 'Please use only JPG, JPEG, PNG files extensions' : 'โปรดใช้ไฟล์นามสกุล JPG, JPEG, PNG เท่านั้น'
                    ];
                
                    echo json_encode($response);
                    exit();
                }
                else {
                    $imageType = explode('.', $imageName);
                    $name = $imageType[0];
                    $imageType = strtolower(end($imageType));
    
                    
                    $newImageName = $projectName . "-" . uniqid(); // Generate new image name
                    $newImageName .= '.' . $imageType;
    
                    $filePath = '../../../uploads/project-images/' . $newImageName;
        
                    move_uploaded_file($tmpName, $filePath);
                    $filesArray[] = $newImageName;
                }
  
            }

            //Delete originalFile
            $projectObj->deleteOriginalFile($projectImage);


            //Upload Image
            $files = json_encode($filesArray);
            $data = [
                'project_id' => $project_id,
                'project_active' => $project_active,
                'project_action' => $project_action,
                'project_reviewstatus' => $project_reviewstatus,
                'updated_at' => $updated_at,
                'user_updated' => $user_updated
            ];


            $projectObj->uploadImages($data, $files);

            $response = [
                'status' => 'success',
                'message' => $_SESSION['lang'] == "en" ? 'Upload Project Image Successfully' : 'อัพโหลดรูปภาพโครงการเสร็จเรียบร้อยแล้ว'
            ];
        
            echo json_encode($response);
        }
    }
    else{
        $response = [
            'status' => 'error',
            'message' => $_SESSION['lang'] == "en" ? 'Something went wrong! Please try again' : 'พบข้อผิดพลาด โปรดลองใหม่อีกครั้ง'
        ];
    
        echo json_encode($response);
    }



?>