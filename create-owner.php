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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Owner</title>
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
                        <div class="col-7">
                            <h3 class="card-title text-primary"><?= $lang['owners']['create_owner_header'] ?>
                                <?php
                                    if($_SESSION['user_role'] == 'admin') { ?>
                                        <button type="button" class="btn button_ex" data-bs-toggle="modal" data-bs-target="#importOwnerModal"><?= $lang['owners']['btn']['import_excel']?></button> 
                                <?php }?>       
                                    <span id="load-data"></span>
                            </h3>
                        </div>
                        <div class="col-5">
                            <a href="./owners.php"><button type="button" class="btn btn-primary float-end"><?= $lang['owners']['btn']['back']?></button></a>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <form id="createOwnerForm">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="OwnerNameTH" class="form-label"><?= $lang['owners']['owner_name_th']?></label>
                                        <input type="text" class="form-control" id="owner_name_th" name="owner_name_th" placeholder="<?= $lang['owners']['placeholder']['owner_name_th']?>" autocomplete="off"/>
                                    </div>
                                    <div class="mb-3 col-md-6"></div>
                                    <div class="mb-3 col-md-6">
                                        <label for="OwnerNameEN" class="form-label"><?= $lang['owners']['owner_name_en']?></label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" class="form-control" id="owner_name_en" name="owner_name_en" placeholder="<?= $lang['owners']['placeholder']['owner_name_en']?>" autocomplete="off"/>
                                        </div>
                                    </div>

                                    <input type="hidden" name="user_action" id="user_action" value="<?=$_SESSION['username'];?>">
                                    <input type="hidden" name="user_role" id="user_role" value="<?=$_SESSION['user_role'];?>">
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2"><?= $lang['owners']['btn']['save']?></button>
                                    <button type="reset" class="btn btn-outline-secondary"><?= $lang['owners']['btn']['reset']?></button>
                                </div>
                            </form>
                        </div>
                        <!-- /Account -->
                    </div>

                </div>
            </div>
        </div>
        <!-- / Content -->

        <?php
            if($_SESSION['user_role'] == 'admin') { ?>
                  <!-- Modal Import Excel For Owner -->
                <div class="modal fade" id="importOwnerModal" tabindex="-1" aria-modal="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">
                            <?= $lang['owners']['btn']['import_excel']?>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="importExcelForm" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="ExcelFile" class="form-label"> <?= $lang['owners']['select_file_import']?> <span><a href="./excel_templates/OwnerImportTemplate.xlsx" class="btn btn-primary" style="padding: 0.15rem 0.5rem;" download><i class="bx bx-download" title="<?= $lang['owners']['title']['download_template']?>"></i></a></span></label>
                                        <input class="form-control" type="file" name="import-file" id="import-file">
                                    </div>
                                </div>
                                
                                <input type="hidden" name="user_created" id="user_created" value="<?=$_SESSION['username'];?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= $lang['owners']['btn']['close']?></button>
                            <button type="submit" class="btn button_ex" id="importOwner"><?= $lang['owners']['btn']['upload']?></button>
                        </div>
                            </form>
                    </div>
                    </div>
                </div>
        <?php }?>  
      

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
        $('#createOwnerForm').on("submit", function(e) {
            e.preventDefault();

            //Validate Form
            if ($('#owner_name_th').val() == '') {
                Swal.fire({
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['owner']['name_th']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                });
            } 
            else if ($('#owner_name_en').val() == '') {
                Swal.fire({
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['owner']['name_en']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                });
            } 
            else {
                var createOwnerForm = $(this).serialize();
                var userRole = '<?=$_SESSION['user_role']?>';

                $.ajax({
                    type: "POST",
                    url: "./Controllers/backEnd/OwnerController/OwnerController-insert.php",
                    data: createOwnerForm,
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
                                    if(userRole == 'admin') {
                                        window.location = "owners.php";
                                    }
                                    else {
                                        window.location = "awaiting-review-owner.php";
                                    }
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
                                    window.location = "create-owner.php";
                                }
                            })
                        }
                    }
                });
            }

        });

        $('#importExcelForm').on('submit', function(e) {
            e.preventDefault();

            if ($('#import-file').val() == '') {
                $('#importOwnerModal').removeClass('show');
                $('.modal-backdrop').remove();

                Swal.fire({
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['owner']['file_excel']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                })
            }
            else {
                var ImportExcelForm = new FormData(this);

                $.ajax({
                    type: "POST",
                    url: "./Controllers/backEnd/OwnerController/OwnerController-import.php",
                    data: ImportExcelForm,
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend:function() {
                        $('#load-data').html("<div class='spinner-border text-secondary' role='status'><span class='visually-hidden'>Loading...</span></div>");
                    },  
                    success: function(response) {
                        if (response.status == 'success') {
                            $('#importOwnerModal').removeClass('show');
                            $('.modal-backdrop').remove();

                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                text: '<?= $lang['alert']['confirm_action']; ?>',
                                confirmButtonColor: 'rgb(0 67 255)',
                                confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                                allowOutsideClick: false
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location = "owners.php";
                                }
                            })
                        }
                        else if (response.status == 'warning') {
                            $('#importOwnerModal').removeClass('show');
                            $('.modal-backdrop').remove();
                            $('#import-file').val(null);
                            $('#load-data').html("");

                            Swal.fire({
                                icon: 'warning',
                                title: response.message,
                                text: '<?= $lang['alert']['confirm_action']; ?>',
                                confirmButtonColor: 'rgb(0 67 255)',
                                confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                                allowOutsideClick: false
                            });
                        }
                        else {
                            $('#importOwnerModal').removeClass('show');
                            $('.modal-backdrop').remove();
                            $('#load-data').html("");

                            swal.fire({
                                icon: 'warning',
                                title: response.message,
                                text: '<?= $lang['alert']['confirm_action']; ?>',
                                confirmButtonColor: 'rgb(0 67 255)',
                                confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                                allowOutsideClick: false
                            });
                            
                        }
                    }
                })
            }
        })
    </script>

</body>

</html>

<?php }?>