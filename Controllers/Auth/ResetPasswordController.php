<?php

if($_SERVER["SERVER_NAME"] == 'localhost' || $_SERVER["SERVER_NAME"] == '127.0.0.1'){
    require $_SERVER['DOCUMENT_ROOT'] . "/acs-groups/backoffice/acs-project/config/app.php";
}else{
    require $_SERVER['DOCUMENT_ROOT'] . "/backoffice/acs-project/config/app.php";
}

use App\Database\Db;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ResetPasswordController extends Db
{
    protected $tableName = 'user';


    public function checkExistsUser($username)
    {
        $username = strtolower($username);
        $sql_checkExists = "SELECT * FROM {$this->tableName} WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($sql_checkExists);
        $stmt->execute(['username' => $username]);
        $rows = $stmt->fetchAll();

        $existsUser = '';

        if (count($rows) > 0) {
            $existsUser = 1;
        } else {
            $existsUser = 0;
        }

        return array($existsUser, $rows);
    }

    public function checkExistsEmail($email)
    {
        $sql_checkExists = "SELECT * FROM {$this->tableName} WHERE user_email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql_checkExists);
        $stmt->execute(['email' => $email]);
        $rows = $stmt->fetchAll();

        $existsUser = '';

        if (count($rows) > 0) {
            $existsUser = 1;
        } else {
            $existsUser = 0;
        }

        return array($existsUser, $rows);
    }

    public function checkExistsEmailAndPassword($username, $password)
    {
        $sql_checkExists = "SELECT * FROM {$this->tableName} WHERE username = :username AND password = :password_hash LIMIT 1";
        $stmt = $this->conn->prepare($sql_checkExists);
        $stmt->execute([

            'username' => $username,

            'password_hash' => $password

        ]);

        $rows = $stmt->fetchAll();
        $existsEmailAndPassword = '';

        if (count($rows) > 0) {
            $existsEmailAndPassword = 1;
        } else {
            $existsEmailAndPassword = 0;
        }

        return $existsEmailAndPassword;
    }

    public function resetPassword($username, $password, $updated_at)
    {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE {$this->tableName} SET password = :password,
                                              updated_at = :updated_at
                                          WHERE username = :username";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'password' => $password_hash,
            'updated_at' => $updated_at,
            'username' => $username
        ]);

        return true;
    }

    public function resetPasswordSendEmail($username)
    {
        $checkUser = $this->checkExistsUser($username);

        if ($checkUser[0] == 0) {
            return false;
        } else {
            $password = $checkUser[1][0]['password'];
            $username_check = $checkUser[1][0]['username'];
            $email = $checkUser[1][0]['user_email'];
        }

        $mail = new PHPMailer(true);

        if ($checkUser[0] > 0) {
            try {
                //Server settings
                if($_SERVER["SERVER_NAME"] == 'localhost' || $_SERVER["SERVER_NAME"] == '127.0.0.1'){
                    $mail->SMTPDebug = 0; //Enable verbose debug output
                    $mail->isSMTP(); //Send using SMTP
                    // $mail->Host = gethostbyname('smtp.gmail.com');
                    $mail->Host = 'mail.acs-groups.com'; //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;           //Enable SMTP authentication
                    $mail->Username = 'arunchaiseri.dev@acs-groups.com'; //SMTP username
                    $mail->Password = 'x=kcDmufprc;';
                    $mail->SMTPSecure = 'ssl'; //SMTP password
                    $mail->Port = 465;
                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                    $mail->AddEmbeddedImage('../../assets/img/acs/acs-logo.png', 'acs-logo', 'acs-logo.png ');
                    $sql_username = base64_encode($username_check);
                    $sql_password = base64_encode($password);

                    $link = $_SERVER['SERVER_NAME'] . "/acs-groups/backoffice/acs-project/update-password.php?key=" . $sql_username . "&reset=" . $sql_password;
                }else{
                    $mail->SMTPDebug = 0; //Enable verbose debug output
                    $mail->isSMTP(); //Send using SMTP
                    // $mail->Host = gethostbyname('smtp.gmail.com');
                    $mail->Host = 'mail.acs-groups.com'; //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;           //Enable SMTP authentication
                    $mail->Username = 'arunchaiseri.dev@acs-groups.com'; //SMTP username
                    $mail->Password = 'x=kcDmufprc;';
                    $mail->SMTPSecure = 'ssl'; //SMTP password
                    $mail->Port = 465;
                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                    $mail->AddEmbeddedImage('../../assets/img/acs/acs-logo.png', 'acs-logo', 'acs-logo.png ');
                    $sql_username = base64_encode($username_check);
                    $sql_password = base64_encode($password);

                    $link = $_SERVER['SERVER_NAME'] . "/backoffice/acs-project/update-password.php?key=" . $sql_username . "&reset=" . $sql_password;
                }

                //Recipients
                $mail->setFrom('arunchaiseri.dev@acs-groups.com', 'Reset Password');
                $mail->addAddress($email);     //Add a recipient
                //Content

                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Arun Chaiseri Consulting Engineers(Password Reset)';
                $mail->Body  = "
                <html>
                    <head>
                        <body>
                            <div style=\"width: 400px;height: 400px;\">
                                <div style=\"display:flex; align-items: center; justify-contents: center; flex-direction: columne\">
                                    <div>
                                        <img src=\"cid:acs-logo\" width=\"50\" height=\"50\">
                                    </div>
                                </div>
                                <h3 style=\"font-size: 30px;font-family: 600;\">Password Reset</h3>
                                <p style=\"font-size: 18px;margin-bottom: 50px;\">If you've lost your password or wish to reset it, use the link below to get started.</p>
                                <a href=\"$link\" style=\"padding: 20px; background-color: rgb(65, 86, 207);color: white;font-size: 18px;font-weight: 600;text-decoration: none\">Reset Your Password</a>
                            </div>
                        </body>
                    </head>
                </html>   

                ";

                $mail->send();
                return array('check' => true, 'email' => $email);
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                return false;
            }
        } else {
            return false;
        }
    }
}
