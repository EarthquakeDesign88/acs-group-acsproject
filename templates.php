<?php 
    session_start();

    if($_SERVER["SERVER_NAME"] == 'localhost' || $_SERVER["SERVER_NAME"] == '127.0.0.1'){
        require $_SERVER['DOCUMENT_ROOT'] . "/acs-groups/backoffice/acs-project/config/app.php";
    }else{
        require $_SERVER['DOCUMENT_ROOT'] . "/backoffice/acs-project/config/app.php";
    }
    
    include_once('./Controllers/Auth/LoginController.php');

    $auth = new LoginController(); 
    use App\Models\Template;

    if(!($_SESSION['authenticated'])){  
        $auth->redirect('./../login.php');
    }
    else {
        $templateObj = new Template();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Templates</title>
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
                <div class="col-6">
                    <h3 class="card-title text-primary">
                        <?= $lang['templates']['title_header'] ?>
                        <?php $totalTemplate = $templateObj->totalRowCount(); ?>
                        <span class="badge bg-label-info"><?= $totalTemplate ?></span>
                    </h3>
                </div>
                <div class="col-6">
                    <a href="./create-template.php"><button type="button" class="btn btn-primary float-end"><?= $lang['templates']['btn']['new_template'] ?></button></a>
                </div>
            </div>

            <div class="card">
                <div class="table-responsive text-nowrap">
                    <table class="table" id="templateTable">
                        <thead>
                            <tr>
                                <th><?= $lang['templates']['table']['no_col'] ?></th>
                                <th><?= $lang['templates']['table']['template_name_col'] ?></th>
                                <th><?= $lang['templates']['table']['template_language_col'] ?></th>
                                <th><?= $lang['templates']['table']['action_col'] ?></th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php
                            $templates = $templateObj->getAllTemplates();
                            $num = 0;

                            foreach ($templates as $template) {
                                $num++; ?>
                                <tr>
                                    <td data-label="<?= $lang['templates']['table']['no_col'] ?>"><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= $num ?></strong></td>
                                    <td data-label="<?= $lang['templates']['table']['template_name_col'] ?>"><?= $template['template_name'] ?></td>
                                    <td data-label="<?= $lang['templates']['table']['template_language_col'] ?>"><?= $template['template_language'] ?></td>
                                    <td data-label="<?= $lang['templates']['table']['action_col'] ?>">
                                        <div class="btn-toolbar demo-inline-spacing" role="toolbar" aria-label="Toolbar with button groups">
                                            <div class="btn-group" role="group" aria-label="First group">
                                            <div class="btn-group" role="group" aria-label="First group">
                                                <a href="./view-template.php?template_id=<?= $template['template_id'] ?>" target="_blank" class="btn btn-outline-info" title="<?= $lang['templates']['title']['present'] ?>"><i class='bx bx-show'></i></a>
                                                <a href="./edit-template.php?template_id=<?= $template['template_id'] ?>" class="btn btn-outline-warning" title="<?= $lang['templates']['title']['edit'] ?>"><i class='bx bx-edit-alt'></i></a>
                                                <button type="button" name="deleteData" id="<?= $template['template_id'] ?>" class="btn btn-outline-danger deleteData" title="<?= $lang['templates']['title']['delete'] ?>"><i class='bx bxs-trash'></i></button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php }

                            ?>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
        <!-- / Content -->


        <div class="content-backdrop fade"></div>
    </div>


    <?php include_once('./includes/totop.html') ?>

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

    <!-- DataTable -->
    <script type="text/javascript" src="../../node_modules/DataTables/datatables.min.js"></script>
    <script type="text/javascript" src="../../node_modules/DataTables/Buttons-2.2.3/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="../../node_modules/DataTables/Buttons-2.2.3/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="../../node_modules/DataTables/Buttons-2.2.3/js/buttons.print.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#templateTable').DataTable({
                "pageLength": 50,
                "language":{
                    "lengthMenu":"<?= $lang['datatable']['language']['lengthMenu']; ?>",
                    "info": "<?= $lang['datatable']['language']['info']; ?>",
                    "search":"<?= $lang['datatable']['language']['search']; ?>",
                    "zeroRecords": "<?= $lang['datatable']['language']['zeroRecords']; ?>",
                    "infoEmpty": "<?= $lang['datatable']['language']['infoEmpty']; ?>",
                    "infoFiltered": "<?= $lang['datatable']['language']['infoFiltered']; ?>",
                    "paginate":{
                        "previous":"<?= $lang['datatable']['language']['paginate']['previous']; ?>",
                        "next":"<?= $lang['datatable']['language']['paginate']['next']; ?>"
                    }
                }
            });
        });


        $(document).on('click', '.deleteData', function(e){
            e.preventDefault();
            var template_id = $(this).attr("id");

            Swal.fire({
                icon: 'warning',
                title: '<?= $lang['alert']['cancel_title']['template']; ?>',
                text: '<?= $lang['alert']['cancel_text']['template']; ?>',
                showCancelButton: true,
                confirmButtonColor: 'rgb(0 67 255)',
                confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                cancelButtonColor: '#ff3e1d',
                cancelButtonText: "<?= $lang['alert']['cancel']; ?>",
                allowOutsideClick: false
            }).then((result) => {
                if(result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "./Controllers/backEnd/TemplateController/TemplateController-delete.php",
                        data: {
                            action: "del_template",
                            template_id: template_id
                        },
                        dataType: "json",
                        success: function(response){
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
                                        window.location = "templates.php";
                                    }
                                })
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
                                        window.location = "templates.php";
                                    }
                                })
                            }
                        }
                    });
                }
            });

        });
    </script>



</body>

</html>

<?php }?>