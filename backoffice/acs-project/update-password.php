<?php

  if($_SERVER["SERVER_NAME"] == 'localhost' || $_SERVER["SERVER_NAME"] == '127.0.0.1'){
    require $_SERVER['DOCUMENT_ROOT'] . "/acs-groups/backoffice/acs-project/config/app.php";
  }else{
    require $_SERVER['DOCUMENT_ROOT'] . "/backoffice/acs-project/config/app.php";
  }
  
  include_once('./Controllers/Auth/ResetPasswordController.php');

  if($_GET['key'] && $_GET['reset']){
    
    $username=$_GET['key'];
    $pass=$_GET['reset'];

    $username_decode = base64_decode($username);
    $password_decode = base64_decode($pass);

    $userObj = new ResetPasswordController();

    $check_user = $userObj->checkExistsEmailAndPassword($username_decode,$password_decode);

    if($check_user == 1){
      
?>
<!DOCTYPE html>

<html lang="en" class="light-style  customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

  <head>
    <meta charset="utf-8" />
    <title>Update Password</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="./assets/vendor/fonts/boxicons.css" />
    
    

    <!-- Core CSS -->
    <link rel="stylesheet" href="./assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="./assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="./assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="./assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    
    

  <!-- Page CSS -->
  <!-- Page -->
  <link rel="stylesheet" href="./assets/vendor/css/pages/page-auth.css">
  <!-- Helpers -->
  <script src="./assets/vendor/js/helpers.js"></script>
  <script src="./assets/js/config.js"></script>
    

</head>

<body>

  <!-- Content -->

<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-4">

      <!-- Forgot Password -->
      <div class="card">
        <div class="card-body">
          <!-- /Logo -->
          <div>
            <img src="./assets/img/acs/acs-logo.png" alt="LogoImage" class="logo-img" style="width: 80px">
          </div>
          <h4 class="mb-2 mt-3">Reset Password</h4>
          <p class="mb-4">Enter your new password and we'll send username and password for reset your password</p>
            <div class="mb-3">
              <input type="hidden" class="form-control" id="username" name="username" value="<?= $username_decode ?>" readonly>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">New Password</label>
              <input type="text" class="form-control" id="password" name="password" placeholder="Enter your new password" autofocus>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Confirm New Password</label>
              <input type="password" class="form-control" id="c_password" name="c_password" placeholder="Enter your confirm new email" autofocus>
            </div>
            <button class="btn btn-primary d-grid w-100" id="save_password">Save</button>
          <div class="text-center mt-4">
            <a href="./login.php" class="d-flex align-items-center justify-content-center">
              <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
              Back to login
            </a>
          </div>
        </div>
      </div>
      <!-- /Forgot Password -->
    </div>
  </div>
</div>

<!-- / Content -->

  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="./assets/vendor/libs/jquery/jquery.js"></script>
  <script src="./assets/vendor/libs/popper/popper.js"></script>
  <script src="./assets/vendor/js/bootstrap.js"></script>
  <script src="./assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="../../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>

  <script src="./assets/vendor/js/menu.js"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->
  
  <script>

    $('#save_password').on("click", function(e) {
        let username = $("#username").val();
        let password = $("#password").val();
        let c_password = $("#c_password").val();

        var pattern = /^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%&]).*$/;

        if(password === "" || c_password === ""){
          Swal.fire({
                icon: 'warning',
                title: 'โปรดกรอกรหัสผ่าน',
                text: 'กรุณากด ตกลง เพื่อดำเนินการต่อ',
                confirmButtonColor: '#697a8d',
                confirmButtonText: 'ตกลง',
                allowOutsideClick: false
            });

            return 
        }

        if(!password.match(pattern)){
            Swal.fire({
                icon: 'warning',
                title: 'รหัสผ่านไม่ปลอดภัย',
                text: 'กรุณากด ตกลง เพื่อดำเนินการต่อ',
                confirmButtonColor: '#697a8d',
                confirmButtonText: 'ตกลง',
                allowOutsideClick: false
            });

            return 
        }

        if(password !== c_password) {
            Swal.fire({
                icon: 'warning',
                title: 'โปรดกรอกรหัสผ่านให้ตรงกัน',
                text: 'กรุณากด ตกลง เพื่อดำเนินการต่อ',
                confirmButtonColor: '#697a8d',
                confirmButtonText: 'ตกลง',
                allowOutsideClick: false
            });

            return
        }

        $.ajax({
            type: "POST",
            url: "./Controllers/Auth/AuthController.php",
            data: {
                action: "reset_password",
                username,
                password
            },
            dataType: "json",
            success: function(response) {
              Swal.fire({
                  icon: 'success',
                  title: response.message,
                  text: 'กรุณากด ตกลง เพื่อดำเนินการต่อ',
                  confirmButtonColor: '#697a8d',
                  confirmButtonText: 'ตกลง',
                  allowOutsideClick: false
              }).then((result) => {
                  if (result.isConfirmed) {
                    window.location = './login.php'
                  }
              })
              
            }
        });
    });
  </script>

  <!-- Main JS -->
  <script src="./assets/js/main.js"></script>

  <!-- Page JS -->
  
  
  
  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  
</body>

</html>

<?php }

} ?>