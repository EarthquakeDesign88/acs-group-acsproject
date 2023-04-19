<?php
    session_start();
    
    include_once('./LoginController.php');
    include_once('./ResetPasswordController.php');

    if(isset($_POST)) {
        if(isset($_POST['action'])){
            $action = $_POST['action'];
            if($action === "send_reset"){
                $username = $_POST['username'];
    
                $userObj = new ResetPasswordController;
        
                $sendEmail = $userObj->resetPasswordSendEmail($username);
        
                if($sendEmail['check']){
                    $response = [
                        'status' => 'success',
                        'message' => 'ส่งลิงค์รีเซ็ตรหัสผ่านไปยังอีเมลเรียบร้อยแล้ว',
                        'email'=> $sendEmail['email']
                    ];
                }else{
                    $response = [
                        'status' => 'error',
                        'message' => 'พบข้อผิดพลาด โปรดลองใหม่อีกครั้ง'
                    ];
                }
                echo json_encode($response);
    
            }else if($action === "reset_password"){
                $username = $_POST['username'];
                $updated_at = date('Y-m-d H:i:s');
                $password = $_POST['password'];
    
                $userObj = new ResetPasswordController;
    
                $check_update = $userObj->resetPassword($username,$password,$updated_at);
    
                if($check_update){
                    $response = [
                        'status' => 'success',
                        'message' => 'เปลี่ยนรหัสผ่านสำเร็จ'
                    ];
                }else{
                    $response = [
                        'status' => 'error',
                        'message' => 'พบข้อผิดพลาด โปรดลองใหม่อีกครั้ง'
                    ];
                }
                echo json_encode($response);
            }
        }else{
            $username = $_POST["username"];
            $password = $_POST["password"];
    
            $auth = new LoginController;
            $checkLogin = $auth->userAuthentication($username, $password);
    
            if($checkLogin) {
                $response = [
                    'status' => 'success',
                    'message' => 'เข้าสู่ระบบสำเร็จ'
                ];
            
                echo json_encode($response);
            }
            else {
                $response = [
                    'status' => 'warning',
                    'message' => 'ชื่อบัญชีหรือรหัสผ่านไม่ถูกต้อง โปรดลองใหม่อีกครั้ง'
                ];
            
                echo json_encode($response);
            } 
        }

    }
    else {
        $response = [
            'status' => 'error',
            'message' => 'พบข้อผิดพลาด โปรดลองใหม่อีกครั้ง'
        ];
    
        echo json_encode($response);
    }
?>