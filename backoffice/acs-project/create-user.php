<?php
    session_start();

    if($_SERVER["SERVER_NAME"] == 'localhost' || $_SERVER["SERVER_NAME"] == '127.0.0.1'){
        require $_SERVER['DOCUMENT_ROOT'] . "/acs-groups/backoffice/acs-project/config/app.php";
    }else{
        require $_SERVER['DOCUMENT_ROOT'] . "/backoffice/acs-project/config/app.php";
    }
    
    include_once('./Controllers/Auth/LoginController.php');

    $auth = new LoginController();
    use App\Models\Department;

    if(!($_SESSION['authenticated'])){  
        $auth->redirect('./login.php');
    }
    else {
        $verifyAdmin = $auth->VerifyAdmin();

        if($verifyAdmin != 1) {
            header('location: errors/unauthorized.php');
        }
        else {
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="./assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/img/favicons/favicon-16x16.png">
    <link rel="manifest" href="./assets/img/favicons/site.webmanifest">
    <link rel="mask-icon" href="./assets/img/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#b8ebfa">
    <meta name="theme-color" content="#b8ebfa">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="./assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="./assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="./assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="./assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="./assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="./assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="./assets/vendor/js/helpers.js"></script>
    <script src="./assets/js/config.js"></script>

    <link rel="stylesheet" href="./assets/css/preloader.css">
</head>

<body>
    <!-- Pre loader -->
    <?php include_once('./includes/preloader.php') ?>

    <!-- Sidebar -->
    <?php include_once('./includes/sidebar.php') ?>

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                    <div class="row mb-2">
                        <div class="col-6">
                            <h3 class="card-title text-primary"><?= $lang['users']['create_user_header'] ?> <span id="load-data"></span></h3>
                        </div>
                        <div class="col-6">
                            <a href="./users.php"class="btn btn-primary float-end"><?= $lang['users']['btn']['back'] ?></a>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body form-register">
                            <form id="createUserForm">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="username" class="form-label"><?= $lang['users']['username'] ?></label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="<?= $lang['users']['placeholder']['username'] ?>" autocomplete="off"/>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="userEmail" class="form-label"><?= $lang['users']['email'] ?></label>
                                        <input class="form-control" type="text" id="user_email" name="user_email" placeholder="<?= $lang['users']['placeholder']['email'] ?>" autocomplete="off"/>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="password" class="form-label" for="password"><?= $lang['users']['password'] ?></label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" id="password" name="password" class="form-control" placeholder="<?= $lang['users']['placeholder']['password'] ?>" onkeyup="return validate()" autocomplete="off"/>
                                        </div>

                                        <div class="errors mt-3 d-none" id="errors">
                                            <ul style="list-style: none;">
                                                <li id="upper"><?= $lang['users']['validate']['upper'] ?></li>
                                                <li id="lower"><?= $lang['users']['validate']['lower'] ?></li>
                                                <li id="special_char"><?= $lang['users']['validate']['special_char'] ?></li>
                                                <li id="number"><?= $lang['users']['validate']['number'] ?></li>
                                                <li id="length"><?= $lang['users']['validate']['length'] ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="confirmPassword" class="form-label" for="cpassword"><?= $lang['users']['confirm_password'] ?></label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="cpassword" name="cpassword" class="form-control" placeholder="<?= $lang['users']['placeholder']['confirm_password'] ?>" autocomplete="off"/>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="firstName" class="form-label"><?= $lang['users']['firstname'] ?></label>
                                        <input class="form-control" type="text" id="user_firstname" name="user_firstname" placeholder="<?= $lang['users']['placeholder']['firstname'] ?>" autocomplete="off"/>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="lastName" class="form-label"><?= $lang['users']['lastname'] ?></label>
                                        <input class="form-control" type="text" name="user_lastname" id="user_lastname" placeholder="<?= $lang['users']['placeholder']['lastname'] ?>" autocomplete="off"/>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="mobilePhone" class="form-label"><?= $lang['users']['mobilenumber'] ?></label>
                                        <input type="text" class="form-control" id="user_mobilenumber" name="user_mobilenumber" placeholder="<?= $lang['users']['placeholder']['mobilenumber'] ?>" autocomplete="off"/>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="department" class="form-label"><?= $lang['users']['department'] ?></label>
                                        <select id="user_depid" name="user_depid" class="select2 form-select">
                                            <option value=""><?= $lang['users']['placeholder']['select_department'] ?></option>
                                            <?php

                                            $departmentObj = new Department();
                                            $departments = $departmentObj->getAllDepartments();

                                            foreach ($departments as $department) { ?>
                                                <option value="<?= $department['department_id'] ?>"><?= $department['department_name'] ?></option>
                                            <?php }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="role" class="form-label"><?= $lang['users']['role'] ?></label>
                                        <select id="user_role" name="user_role" class="select2 form-select">
                                            <option value=""><?= $lang['users']['placeholder']['select_role'] ?></option>
                                            <option value="user"><?= $lang['users']['option']['user'] ?></option>
                                            <option value="manager"><?= $lang['users']['option']['manager'] ?></option>
                                            <option value="admin"><?= $lang['users']['option']['admin'] ?></option>
                                        </select>
                                    </div>

                                    <div class="mb-3 col-md-6">

                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2"><?= $lang['users']['btn']['save'] ?></button>
                                    <button type="reset" class="btn btn-outline-secondary"><?= $lang['users']['btn']['reset'] ?></button>
                                </div>
                            </form>
                        </div>
                        <!-- /Account -->
                    </div>

                </div>
            </div>
        </div>
        <!-- / Content -->

        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
    </div>
    <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="./assets/vendor/libs/jquery/jquery.js"></script>
    <script src="./assets/vendor/libs/popper/popper.js"></script>
    <script src="./assets/vendor/js/bootstrap.js"></script>
    <script src="./assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="./assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="./assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="./assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="./assets/js/dashboards-analytics.js"></script>

    <script src="./assets/js/preloader.js"></script>
    <script src="../../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>


    <script type="text/javascript">
        function validate() {
            var password = document.getElementById('password');
            var upper = document.getElementById('upper');
            var lower = document.getElementById('lower');
            var number = document.getElementById('number');
            var length = document.getElementById('length');
            var specialChar = document.getElementById('special_char');
            var errors = document.getElementById('errors');

            if(password.value.length > 0) {
                errors.classList.remove("d-none");
            }
            else {
                errors.classList.add("d-none");
            }
            if(password.value.match(/[A-Z]/)) {
                upper.style.color = 'green';
            }
            else {
                upper.style.color = 'red';
            }
            if(password.value.match(/[a-z]/)) {
                lower.style.color = 'green';
            }
            else {
                lower.style.color = 'red';
            }  
            if(password.value.match(/[0-9]/)) {
                number.style.color = 'green';
            }
            else {
                number.style.color = 'red';
            }
            if(password.value.length < 8) {
                length.style.color = 'red';
            }
            else {
                length.style.color = 'green';
            }
            if(password.value.match(/[!\@\#\$\%\^\&\*\(\)\_\-\+\=\?\>\<\.\,]/)) {
                specialChar.style.color = 'green';
            }
            else {
                specialChar.style.color = 'red';
            }
        }

        $('#createUserForm').on("submit", function(e) {
            e.preventDefault();

            var pattern = /^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\@\#\$\%\^\&\*\(\)\_\-\+\=\?\>\<\.\,]).*$/;
            var regex = new RegExp(/^\+?[0-9(),.-]+$/);
            var mailformat = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;

            //Validate Form
            if($('#username').val() == '') {
                Swal.fire({
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['user']['name']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                });  
            }
            else if($('#user_email').val() == '') {
                Swal.fire({
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['user']['email']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                });
            }
            else if(!$('#user_email').val().match(mailformat)) {
                Swal.fire({
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['user']['format_email']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                });
            }
            else if($('#password').val() == '') {
                Swal.fire({
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['user']['password']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                });
            }
            else if($('#cpassword').val() == '') {
                Swal.fire({
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['user']['confirm_password']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                });
            }
            else if(!$('#password').val().match(pattern)) {
                Swal.fire({
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['user']['password_security']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                });
            }
            else if($('#user_firstname').val() == '') {
                Swal.fire({
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['user']['first_name']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                });
            }
            else if($('#user_lastname').val() == '') {
                Swal.fire({
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['user']['last_name']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                });
            }
            else if($('#user_mobilenumber').val() == '') {
                Swal.fire({
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['user']['mobilenumber']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                });
            }
            else if(!$('#user_mobilenumber').val().match(regex)) {
                Swal.fire({
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['user']['mobilenumber_number']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                });
            }
            else if($('#user_depid').val() == '') {
                Swal.fire({
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['user']['department']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                });
            }
            else if($('#user_role').val() == '') {
                Swal.fire({
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['user']['role']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                });
            }

            //Verify password
            else if($('#password').val() != $('#cpassword').val()) {
                Swal.fire({
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['user']['check_password']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                });
            }

            else {
                var createUserForm = $(this).serialize();

                $.ajax({
                    type: "POST",
                    url: "./Controllers/backEnd/UserController/UserController-insert.php",
                    data: createUserForm,
                    dataType: "json",
                    beforeSend:function() {
                        $('#load-data').html("<div class='spinner-border text-secondary' role='status'><span class='visually-hidden'>Loading...</span></div>");
                    },  
                    success: function(response) {
                        if(response.status == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                text: '<?= $lang['alert']['confirm_action']; ?>',
                                confirmButtonColor: 'rgb(0 67 255)',
                                confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                                allowOutsideClick: false
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location = "users.php";
                                }
                            })
                        }                  
                        else if(response.status == 'warning') {
                            Swal.fire({
                                icon: 'warning',
                                title: response.message,
                                text: '<?= $lang['alert']['confirm_action']; ?>',
                                confirmButtonColor: 'rgb(0 67 255)',
                                confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                                allowOutsideClick: false
                            });
                            
                            $('#load-data').html("");
                        }
                        else {
                            Swal.fire({ 
                                icon: 'error',
                                title: response.message,
                                text: '<?= $lang['alert']['confirm_action']; ?>',
                                confirmButtonColor: 'rgb(0 67 255)',
                                confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                                allowOutsideClick: false
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location = "create-user.php";
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

<?php } }?>