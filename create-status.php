<?php
    session_start();

    if($_SERVER["SERVER_NAME"] == 'localhost' || $_SERVER["SERVER_NAME"] == '127.0.0.1'){
        require $_SERVER['DOCUMENT_ROOT'] . "/acs-groups/backoffice/acs-project/config/app.php";
    }else{
        require $_SERVER['DOCUMENT_ROOT'] . "/backoffice/acs-project/config/app.php";
    }
    
    include_once('./Controllers/Auth/LoginController.php');

    $auth = new LoginController();

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
    <title>Create Status</title>
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
                            <h3 class="card-title text-primary"><?= $lang['status']['create_status_header']?> <span id="load-data"></span></h3>
                        </div>
                        <div class="col-6">
                            <a href="./status.php"><button type="button" class="btn btn-primary float-end"><?= $lang['status']['btn']['back']?></button></a>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <form id="createStatusForm">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="StatusNameTH" class="form-label"><?= $lang['status']['status_name_th'] ?></label>
                                        <input type="text" class="form-control" id="status_name_th" name="status_name_th" placeholder="<?= $lang['status']['placeholder']['status_name_th']?>" autocomplete="off"/>
                                    </div>
                                    <div class="mb-3 col-md-6"></div>
                                    <div class="mb-3 col-md-6">
                                        <label for="StatusNameEN" class="form-label"><?= $lang['status']['status_name_en'] ?></label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" class="form-control" id="status_name_en" name="status_name_en" placeholder="<?= $lang['status']['placeholder']['status_name_en']?>" autocomplete="off"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2"><?= $lang['status']['btn']['save']?></button>
                                    <button type="reset" class="btn btn-outline-secondary"><?= $lang['status']['btn']['reset']?></button>
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
        $('#createStatusForm').on("submit", function(e) {
            e.preventDefault();

            //Validate Form
            if ($('#status_name_th').val() == '') {
                Swal.fire({
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['status']['name_th']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                });
            } 
            else if ($('#status_name_en').val() == '') {
                Swal.fire({
                    
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['status']['name_en']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                });
            } 
            else {
                var createStatusForm = $(this).serialize();

                $.ajax({
                    type: "POST",
                    url: "./Controllers/backEnd/StatusController/StatusController-insert.php",
                    data: createStatusForm,
                    dataType: "json",
                    beforeSend:function() {
                        $('#load-data').html("<div class='spinner-border text-secondary' role='status'><span class='visually-hidden'>Loading...</span></div>");
                    },  
                    success: function(response) {
                        if (response.status == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                text: '<?= $lang['alert']['confirm_action']; ?>',
                                confirmButtonColor: 'rgb(0 67 255)',
                                confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                                allowOutsideClick: false
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location = "status.php";
                                }
                            })
                        }
                        else if (response.status == 'warning') {
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
                                    window.location = "create-status.php";
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