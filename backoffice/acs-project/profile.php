<?php 
    session_start();

    if($_SERVER["SERVER_NAME"] == 'localhost' || $_SERVER["SERVER_NAME"] == '127.0.0.1'){
        require $_SERVER['DOCUMENT_ROOT'] . "/acs-groups/backoffice/acs-project/config/app.php";
    }else{
        require $_SERVER['DOCUMENT_ROOT'] . "/backoffice/acs-project/config/app.php";
    }
    
    include_once('./Controllers/Auth/LoginController.php');

    $auth = new LoginController();
    use App\Models\User;

    if(!($_SESSION['authenticated'])){  
        $auth->redirect('./login.php');
    }
    else {
        $userObj = new User();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
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
    <!-- DataTable -->
    <link rel="stylesheet" type="text/css" href="../../node_modules/DataTables/datatables.min.css" />
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css"> -->



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
            <div class="row mb-2">
                <div class="col-12">
                    <h3 class="card-title text-primary">
                        <?= $lang['users']['profile'] ?>
                    </h3>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body form-register">
                    <form id="resetPasswordForm">
                        <div class="row">
                            <?php
                                $user_id = $_SESSION['user_id'];
                                $userObj = new User();
                                $users =  $userObj->getUserById($user_id);
                            
                                foreach($users as $user) { ?>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="username" class="form-label"><?= $lang['users']['username'] ?></label>
                                            <input type="text" class="form-control" id="username" name="username" value="<?= $user['user_firstname'] ?>" readonly/>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="email" class="form-label"><?= $lang['users']['email'] ?></label>
                                            <input type="text" class="form-control" id="user_email" name="user_email" value="<?= $user['user_email'] ?>" readonly/>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="mobilePhone" class="form-label"><?= $lang['users']['mobilenumber'] ?></label>
                                            <input type="text" class="form-control" id="user_mobilenumber" name="user_mobilenumber" value="<?= $user['user_mobilenumber'] ?>" readonly/>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="firstName" class="form-label"><?= $lang['users']['firstname'] ?></label>
                                            <input type="text" class="form-control" id="user_firstname" name="user_firstname" value="<?= $user['user_firstname'] ?>" readonly/>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="lastName" class="form-label"><?= $lang['users']['lastname'] ?></label>
                                            <input type="text" class="form-control" id="user_lastname" name="user_lastname" value="<?= $user['user_lastname'] ?>" readonly/>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="department" class="form-label"><?= $lang['users']['department'] ?></label>
                                            <input type="text" class="form-control" id="department" name="department" value="<?= $user['department_name'] ?>" readonly/>
                                        </div>
                                    </div>
                                   
                            <?php   }
                            ?>
                            

                        </div>
                        <div class="btn-group mt-2">
                            <a href="./edit-profile.php?user_id=<?=$user_id?>&page=profile" class="btn btn-outline-warning"><i class='bx bx-edit-alt'></i><?= $lang['users']['btn']['edit_profile'] ?></a>
                            <a href="./reset-password.php?user_id=<?=$user_id?>&page=profile" class="btn btn-outline-primary"><i class='bx bx-lock-open-alt'></i><?= $lang['users']['btn']['reset_password'] ?></a>
                        </div>
                    </form>
                </div>
                <!-- /Account -->
            </div>

        </div>
        <!-- / Content -->


        <div class="content-backdrop fade"></div>
    </div>




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

</body>

</html>

<?php }?>