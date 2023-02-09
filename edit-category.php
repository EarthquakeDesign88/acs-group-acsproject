<?php
    session_start();

    if($_SERVER["SERVER_NAME"] == 'localhost' || $_SERVER["SERVER_NAME"] == '127.0.0.1'){
        require $_SERVER['DOCUMENT_ROOT'] . "/acs-groups/backoffice/acs-project/config/app.php";
    }else{
        require $_SERVER['DOCUMENT_ROOT'] . "/backoffice/acs-project/config/app.php";
    }
    
    include_once('./Controllers/Auth/LoginController.php');

    $auth = new LoginController();
    use App\Models\Category;

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
    <title>Edit Category</title>
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
                            <h3 class="card-title text-primary"><?= $lang['categories']['edit_category_header'] ?> <span id="load-data"></span></h3>
                        </div>
                        <div class="col-5">
                            <a href="./categories.php"class="btn btn-primary float-end"><?= $lang['categories']['btn']['back'] ?></a>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <form id="updateCategoryForm">
                                <div class="row">
                                    <?php
                                        $pcategory_id = $_GET['pcategory_id'];
                                        $categoryObj = new Category();
                                        $categories =  $categoryObj->getCategoryById($pcategory_id);

                                        foreach ($categories as $category) { ?>
                                            <div class="mb-3 col-md-6">
                                                <label for="CategoryNameTH" class="form-label"><?= $lang['categories']['category_name_th'] ?></label>
                                                <input type="text" class="form-control" id="pcategory_name_th" name="pcategory_name_th" placeholder="<?= $lang['categories']['placeholder']['category_name_th'] ?>" value="<?= $category['pcategory_name_th'] ?>" autocomplete="off"/>
                                            </div>
                                            <div class="mb-3 col-md-6"></div>
                                            <div class="mb-3 col-md-6">
                                                <label for="CategoryNameEN" class="form-label"><?= $lang['categories']['category_name_en'] ?></label>
                                                <div class="input-group input-group-merge">
                                                    <input type="text" class="form-control" id="pcategory_name_en" name="pcategory_name_en" placeholder="<?= $lang['categories']['placeholder']['category_name_en'] ?>" value="<?= $category['pcategory_name_en'] ?>" autocomplete="off"/>
                                                </div>
                                            </div>

                                            <input type="hidden" name="pcategory_id" value="<?=$pcategory_id?>">

                                    <?php }

                                    ?>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2"><?= $lang['categories']['btn']['save'] ?></button>
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
        $('#updateCategoryForm').on("submit", function(e) {
            e.preventDefault();

            //Validate Form
            if ($('#pcategory_name_th').val() == '') {
                Swal.fire({
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['category']['name_th']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                });
            } 
            else if ($('#pcategory_name_en').val() == '') {
                Swal.fire({
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['category']['name_en']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                });
            } 
            else {
                var updateCategoryForm = $(this).serialize();

                $.ajax({
                    type: "POST",
                    url: "./Controllers/backEnd/CategoryController/CategoryController-update.php",
                    data: updateCategoryForm,
                    dataType: "json",
                    beforeSend:function() {
                        $('#load-data').html("<div class='spinner-border text-secondary' role='status'><span class='visually-hidden'>Loading...</span></div>");
                    },  
                    success: function(response) {
                        if (response['status'] == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                text: '<?= $lang['alert']['confirm_action']; ?>',
                                confirmButtonColor: 'rgb(0 67 255)',
                                confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                                allowOutsideClick: false
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location = "categories.php";
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
                                    window.location = "edit-category.php";
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

<?php }?>