<?php 
    if($_SERVER["SERVER_NAME"] == 'localhost' || $_SERVER["SERVER_NAME"] == '127.0.0.1'){
        require $_SERVER['DOCUMENT_ROOT'] . "/acs-groups/backoffice/acs-project/config/app.php";
    }else{
        require $_SERVER['DOCUMENT_ROOT'] . "/backoffice/acs-project/config/app.php";
    }
           
    session_start();

    use App\Models\User;


    if(isset($_POST['user_id'])) {
        $user_id = $_POST['user_id'];

        
        $userObj = new User;
        $userDetails = $userObj->getUserById($user_id);


        foreach($userDetails as $user) {
        }

        //Set Language
        if($_SESSION['lang'] == "en") {
            $username_label = "Username";
            $email_label = "Email";
            $fullname_label = "Fullname";
            $mobilenumber_label = "Mobilenumber";
            $role_label = "Role";
            $department_label = "Department";
            $created_label = "Created Date";
            $updated_label = "Updated Date";
        }
        else {
            $username_label = "ชื่อบัญชีผู้ใช้";
            $email_label = "อีเมล";
            $fullname_label = "ชื่อ-นามสกุล";
            $mobilenumber_label = "เบอร์โทรศัพท์มือถือ";
            $role_label = "บทบาท";
            $department_label = "แผนก";
            $created_label = "เวลาที่สร้างผู้ใช้";
            $updated_label = "เวลาที่แก้ไขข้อมูลผู้ใช้";
        }


        $content = '<div class="row">
                        <div class="col-md-6 col-12 mb-3">
                            <label for="Username" class="form-label">'.$username_label.'</label>
                            <input type="text" class="form-control" value="'.$user['username'].'" readonly/>
                        </div>
                            <div class="col-md-6 col-12 mb-3">
                            <label for="Email" class="form-label">'.$email_label.'</label>
                            <input type="text" class="form-control" value="'.$user['user_email'].'" readonly/>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label for="Fullname" class="form-label">'.$fullname_label.'</label>
                            <input type="text" class="form-control" value="'.$user['user_firstname'].' '.$user['user_lastname'].'" readonly/>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label for="MobileNumber" class="form-label">'.$mobilenumber_label.'</label>
                            <input type="text" class="form-control" value="'.$user['user_mobilenumber'].'" readonly/>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label for="Department" class="form-label">'.$department_label.'</label>
                            <input type="text" class="form-control" value="'.$user['department_name'].'" readonly/>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label for="Role" class="form-label">'.$role_label.'</label>
                            <input type="text" class="form-control" value="'.$user['user_role'].'" readonly/>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label for="CreatedDate" class="form-label">'.$created_label.'</label>
                            <input type="text" class="form-control" value="'.$user['created_at'].'" readonly/>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label for="UpdatedDate" class="form-label">'.$updated_label.'</label>
                            <input type="text" class="form-control" value="'.$user['updated_at'].'" readonly/>
                        </div>
                    </div>
        
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