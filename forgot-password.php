<!DOCTYPE html>
<html lang="en" class="light-style  customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>Forgot Password</title>
  <!-- Favicons -->
  <?php include_once('./includes/favicons.php') ?>
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
  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="./assets/js/config.js"></script>
  <style>
    .load {
      position: fixed;
      width: 100%;
      height: 100vh;
      background-color: rgba(180, 180, 180, 0.5);
      z-index: 2;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .loader {
      border: 16px solid #f3f3f3;
      border-radius: 50%;
      border-top: 16px solid #3498db;
      width: 120px;
      height: 120px;
      -webkit-animation: spin 2s linear infinite;
      /* Safari */
      animation: spin 2s linear infinite;
    }

    /* Safari */
    @-webkit-keyframes spin {
      0% {
        -webkit-transform: rotate(0deg);
      }
      100% {
        -webkit-transform: rotate(360deg);
      }
    }

    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }
      100% {
        transform: rotate(360deg);
      }
    }
  </style>
</head>

<body>
  <!-- Content -->
  <div id="load">
    <div></div>
  </div>

  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner py-4">
        <!-- Forgot Password -->
        <div class="card send_reset_email">
          <div class="card-body">
            <!-- /Logo -->
            <div>
              <img src="./assets/img/acs/acs-logo.png" alt="LogoImage" class="logo-img" style="width: 80px">
            </div>
            <h4 class="mb-2 mt-3">Forgot Password? 🔒</h4>
            <p class="mb-4">Enter your username and we'll send you instructions to reset your password</p>
            <div class="mb-3">
              <label for="Username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="กรุณากรอกชื่อบัญชีผู้ใช้ของคุณ" autofocus>
            </div>

            <button class="btn btn-primary d-grid w-100" id="send_reset">Send Reset Link</button>

            <div class="text-center mt-4">
              <a href="./login.php" class="d-flex align-items-center justify-content-center">
                <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                Back to login
              </a>
            </div>
          </div>
        </div>
        <!-- /Forgot Password -->

        <div class="card send_email">
          <div class="card-body">
            <!-- /Logo -->
            <div>
              <img src="./assets/img/acs/acs-logo.png" alt="LogoImage" class="logo-img" style="width: 80px">
            </div>

            <h4 class="mb-2 mt-3">Your password reset email has been sent!</h4>
            <p class="mb-4">We have sent a password reset email to your email address : <b id="email_send"></b></p>
            <p class="mb-4">Please check your inbox to continue.</p>
          </div>
        </div>
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


  <script>
    $(document).ready(function() {
      $(".send_email").hide()
    });

    $('#send_reset').on("click", function(e) {
      let username = $("#username").val();
      if (username == '') {
        Swal.fire({
          icon: 'warning',
          title: 'โปรดกรอกชื่อบัญชีผู้ใช้',
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
          action: "send_reset",
          username
        },
        beforeSend: function() {
          $('#load').addClass("load")
          $('#load div').addClass("loader")
        },
        dataType: "json",
        success: function(response) {
          if (response.status === 'success') {
            Swal.fire({
              icon: 'success',
              title: response.message,
              text: 'กรุณากด ตกลง เพื่อดำเนินการต่อ',
              confirmButtonColor: '#697a8d',
              confirmButtonText: 'ตกลง',
              allowOutsideClick: false
            });

            $("#email_send").text(response.email)
            $(".send_email").show();
            $(".send_reset_email").hide()
          } else {
            Swal.fire({
              icon: 'error',
              title: 'โปรดกรอกอีเมลล์ให้ถูกต้อง',
              text: 'กรุณากด ตกลง เพื่อดำเนินการต่อ',
              confirmButtonColor: '#697a8d',
              confirmButtonText: 'ตกลง',
              allowOutsideClick: false
            });
          }
        },
        complete: function() {
          $('#load').removeClass("load")
          $('#load div').removeClass("loader")
        }

      });

    });
  </script>



  <!-- Main JS -->

  <script src="./assets/js/main.js"></script>
</body>
</html>