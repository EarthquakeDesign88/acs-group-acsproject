<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../../node_modules/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/css/login.css">
    <link rel="stylesheet" href="./assets/css/preloader.css">

    <!-- Favicons -->
    <?php include_once('./includes/favicons.php') ?>
</head>
<body>
    <!-- Pre loader -->
    <?php include_once('./includes/preloader.php') ?>

    <section>
        <div class="form-container">
        <img src="./assets/img/acs/acs-logo.png" alt="LogoImage" class="logo-img">
            <h1>Login </h1>
            <form id="loginForm">
                <div class="control">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" placeholder="โปรดกรอกชื่อบัญชีผู้ใช้">
                </div>
                <div class="control">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" placeholder="โปรดกรอกรหัสผ่าน"> 
                    <span class="preview-password" onclick="previewPassword()">
                        <i id="showPassword" class="fa fa-eye"></i> 
                        <i id="hidePassword" class="fa fa-eye-slash"></i>     
                    </span>
                </div>
                <div class="control">
                    <input type="submit" value="Login" name="loginBtn" id="loginBtn">
                </div>
                <div class="link">
                    <a href="./forgot-password.php">Forgot password</a>
                </div>
            </form>
        </div>
    </section>


    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./assets/js/preloader.js"></script> 
    <script src="../../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>


    <script type="text/javascript">     
        //Preview password
        function previewPassword() {
            var password = document.getElementById("password");
            var showPassword = document.getElementById("showPassword");
            var hidePassword = document.getElementById("hidePassword");

            if(password.type === 'password') {
                password.type = "text";
                showPassword.style.display = "block";
                hidePassword.style.display = "none";
            } else {
                password.type = "password"
                showPassword.style.display = "none";
                hidePassword.style.display = "block";
            }
        }


        $('#loginForm').on("submit", function(e) {
            e.preventDefault()

            if($('#username').val() == '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'โปรดกรอกชื่อบัญชีผู้ใช้',
                    text: 'กรุณากด ตกลง เพื่อดำเนินการต่อ',
                    confirmButtonColor: '#697a8d',
                    confirmButtonText: 'ตกลง',
                    allowOutsideClick: false
                });
            }
            else if($('#password').val() == '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'โปรดกรอกรหัสผ่าน',
                    text: 'กรุณากด ตกลง เพื่อดำเนินการต่อ',
                    confirmButtonColor: '#697a8d',
                    confirmButtonText: 'ตกลง',
                    allowOutsideClick: false
                });
            }
            else {
                var loginForm = $(this).serialize();

                $.ajax({
                    type: "POST",
                    url: "./Controllers/Auth/AuthController.php",
                    data: loginForm,
                    dataType: "json",
                    beforeSend:function() {
                        $('#loginBtn').val("Logging in...");
                    },  
                    success: function(response) {
                        if(response.status == 'success') {
                            window.location = "./dashboard.php";
                        }
                        else {
                            Swal.fire({
                                icon: 'warning',
                                title: response.message,
                                text: 'กรุณากด ตกลง เพื่อดำเนินการต่อ',
                                confirmButtonColor: '#697a8d',
                                confirmButtonText: 'ตกลง',
                                allowOutsideClick: false
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $('#loginBtn').val("Login");
                                    swal.close()
                                }
                            })
                        }
                    }
                });
            }
        });
    </script>

</body>
</html>