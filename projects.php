<?php 
    session_start();

    if($_SERVER["SERVER_NAME"] == 'localhost' || $_SERVER["SERVER_NAME"] == '127.0.0.1'){
        require $_SERVER['DOCUMENT_ROOT'] . "/acs-groups/backoffice/acs-project/config/app.php";
    }else{
        require $_SERVER['DOCUMENT_ROOT'] . "/backoffice/acs-project/config/app.php";
    }
    
    include_once('./Controllers/Auth/LoginController.php');

    $auth = new LoginController();
    use App\Models\Project;

    if(!($_SESSION['authenticated'])){  
        $auth->redirect('./login.php');
    }
    else {
        $projectObj = new Project();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects</title>
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

    <!-- LightBox2 -->
    <link href="./assets/vendor/libs/lightbox2/css/lightbox.css" rel="stylesheet" />

    <link rel="stylesheet" href="./assets/css/projects.css">
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
                        <?= $lang['projects']['view_projects']['title_header'] ?>
                        <?php $totalProject = $projectObj->totalRowCount(); ?>
                        <span class="badge bg-label-info"><?= $totalProject ?></span>
                    </h3>
                </div>
                <div class="col-6">
                    <a href="./create-project.php" class="btn btn-primary float-end">  <?= $lang['projects']['view_projects']['btn']['new_project'] ?></a>
                </div>
            </div>

            <div class="card">
                <div class="table-responsive">
                    <table class="table" id="projectTable">
                        <thead>
                            <tr>
                                <th><?= $lang['projects']['view_projects']['table']['no_col'] ?></th>
                                <th><?= $lang['projects']['view_projects']['table']['project_image_col'] ?></th>
                                <th><?= $lang['projects']['view_projects']['table']['project_name_col'] ?></th>
                                <th><?= $lang['projects']['view_projects']['table']['category_name_col'] ?></th>
                                <th><?= $lang['projects']['view_projects']['table']['action_col'] ?></th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php
                            
                            $projects = $projectObj->getAllProjects();
                            $num = 0;

                            for($i=0; $i< count($projects); $i++) {
                                $decode_image = json_decode($projects[$i]['project_image']);
                                $projects[$i]['project_image'] = $decode_image;
                            }

        
                            foreach ($projects as $project) {
                                $num++; ?>
                                <tr>
                                    <td data-label="<?= $lang['projects']['view_projects']['table']['no_col'] ?>"><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= $num ?></strong></td>
                                    <?php
                                        if($project['project_image'] != NULL) {?>
                                            <td data-label="<?= $lang['projects']['view_projects']['table']['project_image_col'] ?>">
                                                <img class="card-img-top project-image" src="./uploads/project-images/<?= $project['project_image'][0] ?>" alt="Card image cap" onclick="viewProjectImages(<?= $project['project_id'] ?>)">                                    
                                            </td>
                                            
                                    <?php }
                                        else { ?>
                                            <td data-label="<?= $lang['projects']['view_projects']['table']['project_image_col'] ?>">
                                                <img class="card-img-top" src="./assets/img/layouts/noimage.png" alt="Card image cap" width="100" height="180">
                                            </td>
                                        <?php }?>
                                    <td data-label="<?= $lang['projects']['view_projects']['table']['project_name_col'] ?>"> 
                                        <?php
                                            if($_SESSION['lang'] == "th") { ?>
                                                <span class="ellipsis"><?= $project['project_name_th'] ?></span>
                                        <?php   } else { ?>
                                                <span class="ellipsis"><?= $project['project_name_en'] ?></span>
                                        <?php    }                    
                                        ?>
                                    </td>
                                    <td data-label="<?= $lang['projects']['view_projects']['table']['category_name_col'] ?>">
                                        <?php
                                            if($_SESSION['lang'] == "th") { ?>
                                                <span class="ellipsis"><?= $project['pcategory_name_th'] ?></span>
                                        <?php   } else { ?>
                                                <span class="ellipsis"><?= $project['pcategory_name_en'] ?></span>
                                        <?php    }                    
                                        ?>
                                    </td>
                                    <td data-label="<?= $lang['projects']['view_projects']['table']['action_col'] ?>">
                                        <div class="btn-toolbar demo-inline-spacing" role="toolbar" aria-label="Toolbar with button groups">
                                            <div class="btn-group" role="group" aria-label="First group">
                                                <button type="button" class="btn btn-info" onclick="viewProjectDetails(<?= $project['project_id'] ?>)"><i class='bx bx-show' title="<?= $lang['projects']['view_projects']['title']['details'] ?>"></i></button>
                                                <a href="./edit-project.php?project_id=<?= $project['project_id'] ?>" class="btn btn-warning" title="<?= $lang['projects']['view_projects']['title']['edit'] ?>"><i class='bx bx-edit-alt'></i></a>                         
                                                <?php if($project['project_image'] == NULL) {?>
                                                    <div class="btn-group" role="group">
                                                        <button id="imageAction" type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class='bx bx-images'></i>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="imageAction">
                                                            <li>
                                                                <a class="dropdown-item" href="./upload-projectimg.php?project_id=<?= $project['project_id'] ?>">
                                                                    <?= $lang['projects']['view_projects']['title']['upload_image'] ?>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="btn-group" role="group">
                                                        <button id="imageAction" type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class='bx bx-images'></i>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="imageAction">
                                                            <li>
                                                                <a class="dropdown-item" onclick="viewProjectImages(<?= $project['project_id'] ?>)">
                                                                    <?= $lang['projects']['view_projects']['title']['image_gallery'] ?>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="./edit-projectimg.php?project_id=<?= $project['project_id'] ?>""><?= $lang['projects']['view_projects']['title']['edit_image'] ?></a>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                <?php }?>
                                                
                                                <?php
                                                    if($_SESSION['user_role'] == 'admin') { ?>
                                                        <button type="button" name="deleteData" id="<?= $project['project_id'] ?>" class="btn btn-danger deleteData" title="<?= $lang['projects']['view_projects']['title']['delete'] ?>"><i class='bx bxs-trash'></i></button>
                                                 <?php }
                                                ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            <?php  }

                            ?>

                        </tbody>
                    </table>

                </div>

            </div>
        </div>
        <!-- / Content -->


        <!-- View Details Modal -->
        <div class="modal fade" id="modalViewProjectDetails" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="Details" style="color: #13da9a;">
                            <?= $lang['projects']['view_projects']['project_details'] ?>
                        </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="background-color: #f4f4f4;" id="contentProjectDetails"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <?= $lang['projects']['view_projects']['btn']['close'] ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <!-- View Images Modal -->
        <div class="modal fade" id="modalViewProjectImages" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="imageGallery"><?= $lang['projects']['view_projects']['project_image_gallery'] ?></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="background-color: #e9e9e9;">
                        <div class="container" id="contentProjectImages"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <?= $lang['projects']['view_projects']['btn']['close'] ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>


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



    <!-- Light Box  -->
    <script type="text/javascript" src="./assets/vendor/libs/lightbox2/js/lightbox.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#projectTable').DataTable({
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

        $(document).on('click', '.deleteData', function(e) {
            e.preventDefault();
            var project_id = $(this).attr("id");

            Swal.fire({
                icon: 'warning',
                title: '<?= $lang['alert']['cancel_title']['project']; ?>',
                text: '<?= $lang['alert']['cancel_text']['project']; ?>',
                showCancelButton: true,
                confirmButtonColor: 'rgb(0 67 255)',
                confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                cancelButtonColor: '#ff3e1d',
                cancelButtonText: "<?= $lang['alert']['cancel']; ?>",
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "./Controllers/backEnd/ProjectController/ProjectController-delete.php",
                        data: {
                            project_id: project_id
                        },
                        dataType: "json",
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
                                        window.location = "projects.php";
                                    }
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: response.message,
                                    text: '<?= $lang['alert']['confirm_action']; ?>',
                                    confirmButtonColor: 'rgb(0 67 255)',
                                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                                    allowOutsideClick: false
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location = "projects.php";
                                    }
                                })
                            }
                        }
                    });
                }
            });

        });


        function viewProjectDetails(project_id) {
            var modalViewProjectDetails = $("#modalViewProjectDetails");
            var show = $("#contentProjectDetails");

            modalViewProjectDetails.modal('show');

            $.ajax({
                type: "POST",
                url: "modals/view-project-details.php",
                data: {
                    project_id: project_id,
                },
                dataType: "json",
                success: function(response) {
                    show.html(response.content);
                }
            });
        }

        function viewProjectImages(project_id) {
            var modalViewProjectImages = $("#modalViewProjectImages");
            var show = $("#contentProjectImages");

            modalViewProjectImages.modal('show');

            $.ajax({
                type: "POST",
                url: "modals/view-image-gallery.php",
                data: {
                    project_id: project_id,
                },
                dataType: "json",
                success: function(response) {
                    show.html(response.content);
                }
            });
        }

  
    </script>

    <script>
        lightbox.option({
            maxWidth: 800,
            maxHeight: 800,
        });
    </script>

</body>

</html>

<?php }?>