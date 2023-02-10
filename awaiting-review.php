<?php
session_start();

if ($_SERVER["SERVER_NAME"] == 'localhost' || $_SERVER["SERVER_NAME"] == '127.0.0.1') {
    require $_SERVER['DOCUMENT_ROOT'] . "/acs-groups/backoffice/acs-project/config/app.php";
} else {
    require $_SERVER['DOCUMENT_ROOT'] . "/backoffice/acs-project/config/app.php";
}

include_once('./Controllers/Auth/LoginController.php');

$auth = new LoginController();

use App\Models\Project;
use App\Models\Owner;

if (!($_SESSION['authenticated'])) {
    $auth->redirect('./login.php');
} else {
    $verifyAdmin = $auth->VerifyAdmin();

    if ($verifyAdmin != 1) {
        header('location: errors/unauthorized.php');
    } else {
        $projectObj = new Project();
        $ownerObj = new Owner();

        $totalAwaitingReviewProjects = $projectObj->totalAwaitingReviewCount($condition = 'waiting for review');
        $totalAwaitingReviewOwners = $ownerObj->totalAwaitingReviewCount($condition = 'waiting for review');
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Awaiting Review</title>
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
                        <div class="col-8">
                            <h3 class="card-title text-primary">
                                <?= $lang['awaiting_review']['title_header'] ?> <span id="showCount" class="text-warning" style="font-size: 18px;"></span>
                            </h3>
                        </div>
                        <div class="col-4">
                            <a href="history-review.php" class="btn rounded-pill btn-icon btn-info float-end" title="<?= $lang['awaiting_review']['title']['history_review'] ?>"><i class='bx bx-history'></i></a>
                        </div>
                    </div>

                    <div class="nav-align-top mb-4">
                        <ul class="nav nav-tabs nav-fill" role="tablist">
                            <li class="nav-item">
                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-projects" aria-controls="navs-justified-projects" aria-selected="true" id="tab_projects">
                                    <i class="tf-icons bx bxs-school"></i> <?= $lang['awaiting_review']['tab']['projects'] ?> <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-warning"><?= $totalAwaitingReviewProjects ?></span>
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-owners" aria-controls="navs-justified-owners" aria-selected="false" id="tab_owners">
                                    <i class="tf-icons bx bxs-user"></i> <?= $lang['awaiting_review']['tab']['owners'] ?> <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-warning"><?= $totalAwaitingReviewOwners ?></span>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="navs-justified-projects" role="tabpanel">
                                <?php
                                if ($totalAwaitingReviewProjects > 0) { ?>
                                    <div class="table-responsive text-nowrap">
                                        <form id="approveActionProjectForm">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th><input type='checkbox' class="form-check-input" id="checkAllProjects"> <?= $lang['awaiting_review']['input']['check_all'] ?></th>
                                                        <th class="th-resp"><?= $lang['awaiting_review']['table']['project_name_col'] ?></th>
                                                        <th class="th-resp"><?= $lang['awaiting_review']['table']['operation_col'] ?></th>
                                                        <th class="th-resp"><?= $lang['awaiting_review']['table']['user_request_col'] ?></th>
                                                        <th class="th-resp"><?= $lang['awaiting_review']['table']['user_request_col'] ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $condition1 = 'waiting for review';
                                                    $awaitingReviewProjects = $projectObj->awaitingReviews();

                                                    foreach ($awaitingReviewProjects as $project) {
                                                        $project_id = $project['project_id'];

                                                        if($project['project_action'] == 'create project') {
                                                            $project_action = $_SESSION['lang'] == 'th' ? 'สร้างโครงการใหม่' : 'create project';
                                                        }
                                                        else if($project['project_action'] == 'update project') {
                                                            $project_action = $_SESSION['lang'] == 'th' ? 'แก้ไขโครงการ' : 'update project';
                                                        }
                                                        else if($project['project_action'] == 'upload image') {
                                                            $project_action = $_SESSION['lang'] == 'th' ? 'อัพโหลดรูปภาพโครงการ' : 'upload image';
                                                        }
                                                        else {
                                                            $project_action = $_SESSION['lang'] == 'th' ? 'อัพโหลดรูปภาพโครงการใหม่' : 'upload new image';
                                                        }
                                                    ?>
                                                        <tr>
                                                            <td data-label="" class="text-center"><input type='checkbox' class="form-check-input" name="project_ids[]" value="<?= $project['project_id'] ?>"></td>
                                                            <td data-label="<?= $lang['awaiting_review']['table']['project_name_col'] ?>"> <span class="ellipsis-tb"><?= $_SESSION['lang'] == "en" ? $project['project_name_en'] : $project['project_name_th']  ?></span></td>
                                                            <td data-label="<?= $lang['awaiting_review']['table']['operation_col'] ?>" class="text-warning"> <?= $project_action ?></td>
                                                            <td data-label="<?= $lang['awaiting_review']['table']['user_request_col'] ?>"><?= $project['user_updated'] ?></td>
                                                            <td data-label="<?= $lang['awaiting_review']['table']['user_request_col'] ?>">
                                                                <div class="btn-toolbar demo-inline-spacing" role="toolbar" aria-label="Toolbar with button groups">
                                                                    <div class="btn-group" role="group" aria-label="First group">
                                                                        <?php
                                                                        if ($project['project_action'] == 'create project' || $project['project_action'] == 'update project') { ?>
                                                                            <button type="button" class="btn btn-info" onclick="viewWaitingForReviewProjectDetails(<?= $project_id ?>, '<?= $condition1 ?>')">
                                                                                <i class='bx bx-show' title="<?= $lang['awaiting_review']['title']['details'] ?>"></i>
                                                                            </button>
                                                                        <?php } else { ?>
                                                                            <button type="button" class="btn btn-dark" onclick="viewProjectImage(<?= $project_id ?>)">
                                                                                <i class='bx bx-images' title="<?= $lang['awaiting_review']['title']['view_image'] ?>"></i>
                                                                            </button>
                                                                        <?php }
                                                                        ?>
                                                                        <button type="button" class="btn btn-danger" onclick="viewDisapproveProject(<?= $project_id ?>)">
                                                                            <i class='bx bx-x-circle' title="<?= $lang['awaiting_review']['title']['disapprove'] ?>"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                    <?php }
                                                    ?>
                                                </tbody>
                                            </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <button type="submit " class="btn btn-primary me-2" id="btn-approve-project"><?= $lang['awaiting_review']['btn']['approve'] ?></button>
                                        </div>
                                    </div>
                                    </form>
                                <?php } else { ?>
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <td><?= $lang['awaiting_review']['text']['no_data'] ?></td>
                                        </div>
                                    </div>
                                <?php  }
                                ?>
                            </div>



                            <div class="tab-pane fade" id="navs-justified-owners" role="tabpanel">
                                <?php
                                if ($totalAwaitingReviewOwners > 0) { ?>
                                    <div class="table-responsive text-nowrap">
                                        <form id="approveActionOwnerForm">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th><input type='checkbox' class="form-check-input" id="checkAllOwners"> <?= $lang['awaiting_review']['input']['check_all'] ?></th>
                                                        <th class="th-resp"><?= $lang['awaiting_review']['table']['owner_name_col'] ?></th>
                                                        <th class="th-resp"><?= $lang['awaiting_review']['table']['operation_col'] ?></th>
                                                        <th class="th-resp"><?= $lang['awaiting_review']['table']['user_request_col'] ?></th>
                                                        <th class="th-resp"><?= $lang['awaiting_review']['table']['action_col'] ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $condition1 = 'waiting for review';
                                                    $awaitingReviewOwners = $ownerObj->awaitingReviews();

                                                    foreach ($awaitingReviewOwners as $owner) {
                                                        $owner_id = $owner['owner_id'];

                                                        if($owner['owner_action'] == 'create project owner') {
                                                            $owner_action = $_SESSION['lang'] == 'th' ? 'สร้างเจ้าของโครงการ' : 'create project owner';
                                                        }
                                                        else if($owner['owner_action'] == 'update project owner') {
                                                            $owner_action = $_SESSION['lang'] == 'th' ? 'แก้ไขเจ้าของโครงการ' : 'update project owner';
                                                        }
                                                    ?>
                                                        <tr>
                                                            <td data-label="" class="text-center"><input type='checkbox' class="form-check-input" name="owner_ids[]" value="<?= $owner['owner_id'] ?>"></td>
                                                            <td data-label="<?= $lang['awaiting_review']['table']['owner_name_col'] ?>"> <span class="ellipsis-tb"><?= $_SESSION['lang'] == "en" ? $owner['owner_name_en'] : $owner['owner_name_th']  ?></span></td>
                                                            <td data-label="<?= $lang['awaiting_review']['table']['operation_col'] ?>" class="text-warning"> <?= $owner_action ?></td>
                                                            <td data-label="<?= $lang['awaiting_review']['table']['user_request_col'] ?>"><?= $owner['user_updated'] ?></td>
                                                            <td data-label="<?= $lang['awaiting_review']['table']['action_col'] ?>">
                                                                <div class="btn-toolbar demo-inline-spacing" role="toolbar" aria-label="Toolbar with button groups">
                                                                    <div class="btn-group" role="group" aria-label="First group">
                                                                        <button type="button" class="btn btn-info" onclick="viewWaitingForReviewOwnerDetails(<?= $owner_id ?>, '<?= $condition1 ?>')">
                                                                            <i class='bx bx-show' title="<?= $lang['awaiting_review']['title']['details'] ?>"></i>
                                                                        </button>
                                                                        <button type="button" class="btn btn-danger" onclick="viewDisapproveOwner(<?= $owner_id ?>)">
                                                                            <i class='bx bx-x-circle' title="<?= $lang['awaiting_review']['title']['disapprove'] ?>"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php }

                                                    ?>
                                                </tbody>
                                            </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <button type="submit " class="btn btn-primary me-2" id="btn-approve-owner"><?= $lang['awaiting_review']['btn']['approve'] ?></button>
                                        </div>
                                    </div>
                                    </form>
                                <?php } else { ?>
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <td><?= $lang['awaiting_review']['text']['no_data'] ?></td>
                                        </div>
                                    </div>
                                <?php  }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- / Content -->


                <!-- GET Modal projects for awaiting review -->
                <div class="modal fade" id="modalViewWaitingForReviewProject" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" style="color: #13da9a;">
                                    <?= $lang['awaiting_review']['project_details']['details'] ?>
                                </h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="background-color: #f4f4f4;" id="contentViewWaitingForReviewProject"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    <?= $lang['awaiting_review']['project_details']['btn']['close'] ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- GET Modal owners for waiting for review status -->
                <div class="modal fade" id="modalViewWaitingForReviewOwner" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" style="color: #13da9a;">
                                    <?= $lang['awaiting_review']['owner_details']['details'] ?>
                                </h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="background-color: #f4f4f4;" id="contentViewWaitingForReviewOwner"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    <?= $lang['awaiting_review']['owner_details']['btn']['close'] ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- GET Modal projects image -->
                <div class="modal fade" id="modalProjectImage" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" style="color: #13da9a;">
                                    <?= $lang['awaiting_review']['project_details']['project_image'] ?>
                                </h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="background-color: #f4f4f4;" id="contentProjectImage"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    <?= $lang['awaiting_review']['project_details']['btn']['close'] ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Get Modal Disapproval project -->
                <div class="modal fade" id="modalDisapproveProject" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" style="color: #13da9a;">
                                    <?= $lang['awaiting_review']['project_details']['disapprove'] ?>
                                </h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="background-color: #f4f4f4;" id="contentDisapproveProject"></div>
                        </div>
                    </div>
                </div>

                <!-- Get Modal Disapproval owner -->
                <div class="modal fade" id="modalDisapproveOwner" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" style="color: #13da9a;">
                                    <?= $lang['awaiting_review']['owner_details']['disapprove'] ?>
                                </h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="background-color: #f4f4f4;" id="contentDisapproveOwner"></div>
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

            <script type="text/javascript">
                //Approve Project
                $(document).ready(function() {
                    // Check/Uncheck ALl
                    $('#checkAllProjects').change(function() {
                        var total_checkboxes_checked = $('input[name="project_ids[]"]:checked').length;
                        var showCheckedCount = document.getElementById('showCount');

                        if ($(this).is(':checked')) {
                            $('input[name="project_ids[]"]').prop('checked', true);

                            showCheckedCount.innerText = '<?= $lang['awaiting_review']['text']['select_all'] ?> ' + <?= $totalAwaitingReviewProjects ?> + ' <?= $lang['awaiting_review']['text']['lists'] ?>';
                        } else {
                            $('input[name="project_ids[]"]').each(function() {
                                $(this).prop('checked', false);

                                showCheckedCount.innerText = '';
                            });
                        }
                    });

                    // Checkbox click
                    $('input[name="project_ids[]"]').click(function() {
                        var total_checkboxes = $('input[name="project_ids[]"]').length;
                        var total_checkboxes_checked = $('input[name="project_ids[]"]:checked').length;
                        var showCheckedCount = document.getElementById('showCount');

                        if (total_checkboxes_checked == total_checkboxes) {
                            $('#checkAllProjects').prop('checked', true);
                        } else {
                            $('#checkAllProjects').prop('checked', false);
                        }

                        if (total_checkboxes_checked === 1) {
                            showCheckedCount.innerText = '<?= $lang['awaiting_review']['text']['select'] ?> ' + total_checkboxes_checked + ' <?= $lang['awaiting_review']['text']['list'] ?>';
                        } else if (total_checkboxes_checked > 1) {
                            showCheckedCount.innerText = '<?= $lang['awaiting_review']['text']['select'] ?> ' + total_checkboxes_checked + ' <?= $lang['awaiting_review']['text']['lists'] ?>';
                        } else {
                            showCheckedCount.innerText = '';
                        }
                    });

                    $('#approveActionProjectForm').on("submit", function(e) {
                        e.preventDefault();

                        var approveActionProjectForm = $(this).serialize();
                        var total_checkboxes_checked = $('input[name="project_ids[]"]:checked').length;

                        if (total_checkboxes_checked === 0) {
                            Swal.fire({
                                icon: 'warning',
                                title: '<?= $lang['alert']['validate_title']['awaiting_review']['check_selected']; ?>',
                                text: '<?= $lang['alert']['confirm_action']; ?>',
                                confirmButtonColor: 'rgb(0 67 255)',
                                confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                                allowOutsideClick: false
                            });
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: '<?= $lang['alert']['approve_title']['awaiting_review']; ?>',
                                text: '<?= $lang['alert']['approve_text']['awaiting_review']; ?>',
                                showCancelButton: true,
                                confirmButtonColor: 'rgb(0 67 255)',
                                confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                                cancelButtonColor: '#ff3e1d',
                                cancelButtonText: '<?= $lang['alert']['cancel']; ?>',
                                allowOutsideClick: false
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $.ajax({
                                        type: "POST",
                                        url: "./Controllers/backEnd/ProjectController/ProjectController-approve.php",
                                        data: approveActionProjectForm,
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
                                                        window.location = "awaiting-review.php";
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
                                                        window.location = "awaiting-review.php";
                                                    }
                                                })
                                            }
                                        }
                                    });
                                }
                            });
                        }
                    });
                });

                //Disapprove Project
                function confirmDisapproveProject(project_id) {
                    var resend_request = $('input[type=radio][name=resend_request]:checked').val();
                    var disapprove_reason = $('#disapprove_reason').val();
                    var check_radio = $('input[type=radio][name=resend_request]:checked').length;
                    var modalDisapproveProject = $("#modalDisapproveProject");

                    if (check_radio == 0) {
                        modalDisapproveProject.modal('hide');
                        Swal.fire({
                            icon: 'warning',
                            title: '<?= $lang['alert']['validate_title']['awaiting_review']['check_resend']; ?>',
                            text: '<?= $lang['alert']['confirm_action']; ?>',
                            confirmButtonColor: 'rgb(0 67 255)',
                            confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                            allowOutsideClick: false
                        });
                    } 
                    else if (disapprove_reason == '') {
                        modalDisapproveProject.modal('hide');
                        Swal.fire({
                            icon: 'warning',
                            title: '<?= $lang['alert']['validate_title']['awaiting_review']['check_reason']; ?>',
                            text: '<?= $lang['alert']['confirm_action']; ?>',
                            confirmButtonColor: 'rgb(0 67 255)',
                            confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                            allowOutsideClick: false
                        });
                    } 
                    else {
                        $.ajax({
                            type: "POST",
                            url: "./Controllers/backEnd/ProjectController/ProjectController-disapprove.php",
                            data: {
                                project_id: project_id,
                                resend_request: resend_request,
                                disapprove_reason: disapprove_reason
                            },
                            dataType: "json",
                            success: function(response) {
                                modalDisapproveProject.modal('hide');

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
                                            window.location = "awaiting-review.php";
                                        }
                                    })
                                } else {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: response.message,
                                        text: '<?= $lang['alert']['confirm_action']; ?>',
                                        confirmButtonColor: 'rgb(0 67 255)',
                                        confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                                        allowOutsideClick: false
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location = "awaiting-review.php";
                                        }
                                    })
                                }
                            }

                        });    
                    }
                }


                //Approve Owners
                $(document).ready(function() {
                    // Check/Uncheck ALl
                    $('#checkAllOwners').change(function() {
                        var total_checkboxes_checked = $('input[name="owner_ids[]"]:checked').length;
                        var showCheckedCount = document.getElementById('showCount');

                        if ($(this).is(':checked')) {
                            $('input[name="owner_ids[]"]').prop('checked', true);

                            showCheckedCount.innerText = '<?= $lang['awaiting_review']['text']['select_all'] ?> ' + <?= $totalAwaitingReviewOwners ?> + ' <?= $lang['awaiting_review']['text']['lists'] ?>';
                        } else {
                            $('input[name="owner_ids[]"]').each(function() {
                                $(this).prop('checked', false);

                                showCheckedCount.innerText = '';
                            });
                        }
                    });

                    // Checkbox click
                    $('input[name="owner_ids[]"]').click(function() {
                        var total_checkboxes = $('input[name="owner_ids[]"]').length;
                        var total_checkboxes_checked = $('input[name="owner_ids[]"]:checked').length;
                        var showCheckedCount = document.getElementById('showCount');

                        if (total_checkboxes_checked == total_checkboxes) {
                            $('#checkAllOwners').prop('checked', true);
                        } else {
                            $('#checkAllOwners').prop('checked', false);
                        }

                        if (total_checkboxes_checked === 1) {
                            showCheckedCount.innerText = '<?= $lang['awaiting_review']['text']['select'] ?> ' + total_checkboxes_checked + ' <?= $lang['awaiting_review']['text']['list'] ?>';
                        } else if (total_checkboxes_checked > 1) {
                            showCheckedCount.innerText = '<?= $lang['awaiting_review']['text']['select'] ?> ' + total_checkboxes_checked + ' <?= $lang['awaiting_review']['text']['lists'] ?>';
                        } else {
                            showCheckedCount.innerText = '';
                        }
                    });

                    $('#approveActionOwnerForm').on("submit", function(e) {
                        e.preventDefault();

                        var approveActionOwnerForm = $(this).serialize();
                        var total_checkboxes_checked = $('input[name="owner_ids[]"]:checked').length;

                        if (total_checkboxes_checked === 0) {
                            Swal.fire({
                                icon: 'warning',
                                title: '<?= $lang['alert']['validate_title']['awaiting_review']['check_selected']; ?>',
                                text: '<?= $lang['alert']['confirm_action']; ?>',
                                confirmButtonColor: 'rgb(0 67 255)',
                                confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                                allowOutsideClick: false
                            });
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: '<?= $lang['alert']['approve_title']['awaiting_review']; ?>',
                                text: '<?= $lang['alert']['approve_text']['awaiting_review']; ?>',
                                showCancelButton: true,
                                confirmButtonColor: 'rgb(0 67 255)',
                                confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                                cancelButtonColor: '#ff3e1d',
                                cancelButtonText: '<?= $lang['alert']['cancel']; ?>',
                                allowOutsideClick: false
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $.ajax({
                                        type: "POST",
                                        url: "./Controllers/backEnd/OwnerController/OwnerController-approve.php",
                                        data: approveActionOwnerForm,
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
                                                        window.location = "awaiting-review.php";
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
                                                        window.location = "awaiting-review.php";
                                                    }
                                                })
                                            }
                                        }
                                    });
                                }
                            });
                        }

                    });
                });

                //Disapprove Owner
                function confirmDisapproveOwner(owner_id) {
                    var resend_request = $('input[type=radio][name=resend_request]:checked').val();
                    var disapprove_reason = $('#disapprove_reason').val();
                    var check_radio = $('input[type=radio][name=resend_request]:checked').length;
                    var modalDisapproveOwner = $("#modalDisapproveOwner");

                    if (check_radio == 0) {
                        modalDisapproveOwner.modal('hide');
                        Swal.fire({
                            icon: 'warning',
                            title: '<?= $lang['alert']['validate_title']['awaiting_review']['check_resend']; ?>',
                            text: '<?= $lang['alert']['confirm_action']; ?>',
                            confirmButtonColor: 'rgb(0 67 255)',
                            confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                            allowOutsideClick: false
                        });
                    } 
                    else if (disapprove_reason == '') {
                        modalDisapproveOwner.modal('hide');
                        Swal.fire({
                            icon: 'warning',
                            title: '<?= $lang['alert']['validate_title']['awaiting_review']['check_reason']; ?>',
                            text: '<?= $lang['alert']['confirm_action']; ?>',
                            confirmButtonColor: 'rgb(0 67 255)',
                            confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                            allowOutsideClick: false
                        });
                    } 
                    else {
                        $.ajax({
                            type: "POST",
                            url: "./Controllers/backEnd/OwnerController/OwnerController-disapprove.php",
                            data: {
                                owner_id: owner_id,
                                resend_request: resend_request,
                                disapprove_reason: disapprove_reason
                            },
                            dataType: "json",
                            success: function(response) {
                                modalDisapproveOwner.modal('hide');

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
                                            window.location = "awaiting-review.php";
                                        }
                                    })
                                } else {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: response.message,
                                        text: '<?= $lang['alert']['confirm_action']; ?>',
                                        confirmButtonColor: 'rgb(0 67 255)',
                                        confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                                        allowOutsideClick: false
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location = "awaiting-review.php";
                                        }
                                    })
                                }
                            }

                        });    
                    }
                }



                //Get Modals
                function viewWaitingForReviewProjectDetails(project_id, condition) {
                    var modalViewWaitingForReviewProject = $("#modalViewWaitingForReviewProject");
                    var show = $("#contentViewWaitingForReviewProject");

                    modalViewWaitingForReviewProject.modal('show');

                    $.ajax({
                        type: "POST",
                        url: "modals/view-project-lists.php",
                        data: {
                            project_id: project_id,
                            condition: condition
                        },
                        dataType: "json",
                        success: function(response) {
                            show.html(response.content);
                        }
                    });
                }

                function viewWaitingForReviewOwnerDetails(owner_id, condition) {
                    var modalViewWaitingForReviewOwner = $("#modalViewWaitingForReviewOwner");
                    var show = $("#contentViewWaitingForReviewOwner");

                    modalViewWaitingForReviewOwner.modal('show');

                    $.ajax({
                        type: "POST",
                        url: "modals/view-owner-lists.php",
                        data: {
                            owner_id: owner_id,
                            condition: condition
                        },
                        dataType: "json",
                        success: function(response) {
                            show.html(response.content);
                        }
                    });
                }

                function viewProjectImage(project_id) {
                    var modalProjectImage = $("#modalProjectImage");
                    var show = $("#contentProjectImage");

                    modalProjectImage.modal('show');

                    $.ajax({
                        type: "POST",
                        url: "modals/view-project-image.php",
                        data: {
                            project_id: project_id
                        },
                        dataType: "json",
                        success: function(response) {
                            show.html(response.content);
                        }
                    });
                }


                function viewDisapproveProject(project_id) {
                    var modalDisapproveProject = $("#modalDisapproveProject");
                    var show = $("#contentDisapproveProject");

                    modalDisapproveProject.modal('show');

                    $.ajax({
                        type: "POST",
                        url: "modals/view-disapprove.php",
                        data: {
                            project_id: project_id,
                            action: "disapprove project"
                        },
                        dataType: "json",
                        success: function(response) {
                            show.html(response.content);
                        }
                    });
                }

                
                function viewDisapproveOwner(owner_id) {
                    var modalDisapproveOwner = $("#modalDisapproveOwner");
                    var show = $("#contentDisapproveOwner");

                    modalDisapproveOwner.modal('show');

                    $.ajax({
                        type: "POST",
                        url: "modals/view-disapprove.php",
                        data: {
                            owner_id: owner_id,
                            action: "disapprove owner"
                        },
                        dataType: "json",
                        success: function(response) {
                            show.html(response.content);
                        }
                    });
                }

            </script>

        </body>

        </html>

<?php }
} ?>