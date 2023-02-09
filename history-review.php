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

        $totalAuthorizedProjects = $projectObj->totalAwaitingReviewCount($condition1 = 'authorized');
        $totalUnauthorizedProjects = $projectObj->totalAwaitingReviewCount($condition1 = 'unauthorized', $condition2 = 'resend request');

        $totalAuthorizedOwners = $ownerObj->totalAwaitingReviewCount($condition1 = 'authorized');
        $totalUnauthorizedOwners = $ownerObj->totalAwaitingReviewCount($condition1 = 'unauthorized', $condition2 = 'resend request');

?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>History Review</title>
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
                        <div class="col-7">
                            <h3 class="card-title text-primary">
                                <?= $lang['awaiting_review']['title_history'] ?> <span id="showCount" class="text-warning" style="font-size: 18px;"></span>
                          
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-outline-primary active" id="project_selected" onclick="showProjectHistory()"><?= $lang['awaiting_review']['btn']['projects'] ?></button>
                                    <button type="button" class="btn btn-outline-primary" id="owner_selected" onclick="showOwnerHistory()"><?= $lang['awaiting_review']['btn']['owners'] ?></button>
                                </div>
                            </h3>
                        </div>
                        <div class="col-5">
                            <button type="button" class="btn rounded-pill btn-icon btn-info float-end" onclick="history.back()" title="<?= $lang['awaiting_review']['title']['go_back'] ?>"><i class='bx bx-arrow-back'></i></button>
                        </div>
                    </div>

                    <div class="nav-align-top mb-4">
                        <ul class="nav nav-tabs nav-fill" role="tablist" id="project-tabs">
                            <li class="nav-item">
                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-authorized-projects" aria-controls="navs-justified-authorized-projects" aria-selected="true" id="tab_authorized_projects">
                                    <i class='tf-icons bx bxs-check-circle text-success'></i> <?= $lang['awaiting_review']['tab']['authorized'] ?> <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-success"><?= $totalAuthorizedProjects ?></span>
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-unauthorized-projects" aria-controls="navs-justified-unauthorized-projects" aria-selected="false" id="tab_unauthorized_projects">
                                    <i class='tf-icons bx bxs-x-circle text-danger'></i> <?= $lang['awaiting_review']['tab']['unauthorized'] ?> <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger"><?= $totalUnauthorizedProjects ?></span>
                                </button>
                            </li>
                        </ul>

                        <ul class="nav nav-tabs nav-fill d-none" role="tablist" id="owner-tabs">
                            <li class="nav-item">
                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-authorized-owners" aria-controls="navs-justified-authorized-owners" aria-selected="true" id="tab_authorized_owners">
                                    <i class='tf-icons bx bxs-check-circle text-success'></i> <?= $lang['awaiting_review']['tab']['authorized'] ?> <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-success"><?= $totalAuthorizedOwners ?></span>
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-unauthorized-owners" aria-controls="navs-justified-unauthorized-owners" aria-selected="false" id="tab_unauthorized_owners">
                                    <i class='tf-icons bx bxs-x-circle text-danger'></i> <?= $lang['awaiting_review']['tab']['unauthorized'] ?> <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger"><?= $totalUnauthorizedOwners ?></span>
                                </button>
                            </li>
                        </ul>

                        <!-- Project History -->
                        <div class="tab-content" id="project-history">
                            <div class="tab-pane fade show active" id="navs-justified-authorized-projects" role="tabpanel">
                                <?php
                                if ($totalAuthorizedProjects > 0) { ?>
                                    <div class="table-responsive text-nowrap">
                                        <table class="table" id="projectTable1">
                                            <thead>
                                                <tr>
                                                    <th><?= $lang['awaiting_review']['table']['no_col'] ?></th>
                                                    <th><?= $lang['awaiting_review']['table']['project_name_col'] ?></th>
                                                    <th><?= $lang['awaiting_review']['table']['operation_col'] ?></th>
                                                    <th><?= $lang['awaiting_review']['table']['user_request_col'] ?></th>
                                                    <th><?= $lang['awaiting_review']['table']['action_col'] ?></th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                <?php
                                                $condition1 = 'authorized';
                                                $authorizedProjects = $projectObj->historyReviews($condition1);
                                                $num = 0;

                                                foreach ($authorizedProjects as $project) {
                                                    $project_id = $project['project_id'];

                                                    if($project['project_action'] == 'create project') {
                                                        $project_action = $_SESSION['lang'] == 'th' ? 'สร้างโครงการ' : 'create project';
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

                                                    $num++;
                                                ?>
                                                    <tr>
                                                        <td data-label="<?= $lang['awaiting_review']['table']['no_col'] ?>"><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= $num ?></strong></td>
                                                        <td data-label="<?= $lang['awaiting_review']['table']['project_name_col'] ?>"> <span class="ellipsis-tb"><?= $_SESSION['lang'] == "en" ? $project['project_name_en'] : $project['project_name_th']  ?></span></td>
                                                        <td data-label="<?= $lang['awaiting_review']['table']['operation_col'] ?>" class="text-warning"> <?= $project_action ?></td>
                                                        <td data-label="<?= $lang['awaiting_review']['table']['user_request_col'] ?>"><?= $project['user_updated'] ?></td>
                                                        <td data-label="<?= $lang['awaiting_review']['table']['action_col'] ?>">
                                                            <div class="btn-toolbar demo-inline-spacing" role="toolbar" aria-label="Toolbar with button groups">
                                                                <div class="btn-group" role="group" aria-label="First group">
                                                                    <?php
                                                                    if ($project['project_action'] == 'create project' || $project['project_action'] == 'update project') { ?>
                                                                        <button type="button" class="btn btn-info" onclick="viewHistoryProjectDetails(<?= $project_id ?>)">
                                                                            <i class='bx bx-show' title="<?= $lang['awaiting_review']['title']['details'] ?>"></i>
                                                                        </button>
                                                                    <?php } else { ?>
                                                                        <button type="button" class="btn btn-dark" onclick="viewProjectImage(<?= $project_id ?>)">
                                                                            <i class='bx bx-images' title="<?= $lang['awaiting_review']['title']['view_image'] ?>"></i>
                                                                        </button>
                                                                    <?php }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>


                                                <?php }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php } else { ?>
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <td><?= $lang['awaiting_review']['text']['no_data'] ?></td>
                                        </div>
                                    </div>
                                <?php  }
                                ?>
                            </div>

                            <div class="tab-pane fade" id="navs-justified-unauthorized-projects" role="tabpanel">
                                <?php
                                if ($totalUnauthorizedProjects > 0) { ?>
                                    <div class="table-responsive text-nowrap">
                                        <table class="table" id="projectTable2">
                                            <thead>
                                                <tr>
                                                    <th><?= $lang['awaiting_review']['table']['no_col'] ?></th>
                                                    <th><?= $lang['awaiting_review']['table']['project_name_col'] ?></th>
                                                    <th><?= $lang['awaiting_review']['table']['operation_col'] ?></th>
                                                    <th><?= $lang['awaiting_review']['table']['user_request_col'] ?></th>
                                                    <th><?= $lang['awaiting_review']['table']['remark_col'] ?></th>
                                                    <th><?= $lang['awaiting_review']['table']['action_col'] ?></th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                <?php
                                                $condition1 = 'unauthorized';
                                                $condition2 = 'resend request';
                                                $UnauthorizedProjects = $projectObj->historyReviews($condition1, $condition2);
                                                $num = 0;

                                                foreach ($UnauthorizedProjects as $project) {
                                                    $project_id = $project['project_id'];

                                                    
                                                    if($project['project_action'] == 'create project') {
                                                        $project_action = $_SESSION['lang'] == 'th' ? 'สร้างโครงการ' : 'create project';
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

                                                    $num++;
                                                    ?>
                                                    <tr>
                                                        <td data-label="<?= $lang['awaiting_review']['table']['no_col'] ?>"><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= $num ?></strong></td>
                                                        <td data-label="<?= $lang['awaiting_review']['table']['project_name_col'] ?>"> <span class="ellipsis-tb"><?= $_SESSION['lang'] == "en" ? $project['project_name_en'] : $project['project_name_th']  ?></span></td>
                                                        <td data-label="<?= $lang['awaiting_review']['table']['operation_col'] ?>" class="text-warning"> <?= $project_action ?></td>
                                                        <td data-label="<?= $lang['awaiting_review']['table']['user_request_col'] ?>"><?= $project['user_updated'] ?></td>
                                                        <td data-label="<?= $lang['awaiting_review']['table']['remark_col'] ?>">
                                                            <?php
                                                            if ($project['project_reviewstatus'] == 'resend request') { ?>
                                                                <span class="text-warning"><?= $lang['awaiting_review']['text']['allow_edit'] ?></span>
                                                            <?php   } else { ?>
                                                                <span><?= $lang['awaiting_review']['text']['notallow_edit'] ?></span>
                                                            <?php  }

                                                            ?>
                                                        </td>
                                                        <td <?= $lang['awaiting_review']['table']['action_col'] ?>">
                                                            <div class="btn-toolbar demo-inline-spacing" role="toolbar" aria-label="Toolbar with button groups">
                                                                <div class="btn-group" role="group" aria-label="First group">
                                                                    <?php
                                                                    if ($project['project_action'] == 'create project' || $project['project_action'] == 'update project') { ?>
                                                                        <button type="button" class="btn btn-info" onclick="viewHistoryProjectDetails(<?= $project_id ?>)">
                                                                            <i class='bx bx-show' title="<?= $lang['awaiting_review']['title']['details'] ?>"></i>
                                                                        </button>
                                                                    <?php } else { ?>
                                                                        <button type="button" class="btn btn-dark" onclick="viewProjectImage(<?= $project_id ?>)">
                                                                            <i class='bx bx-images' title="<?= $lang['awaiting_review']['title']['view_image'] ?>"></i>
                                                                        </button>
                                                                    <?php }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                <?php }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
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

                        <!-- Owner History -->
                        <div class="tab-content d-none" id="owner-history">
                            <div class="tab-pane fade show active" id="navs-justified-authorized-owners" role="tabpanel">
                                <?php
                                if ($totalAuthorizedOwners > 0) { ?>
                                    <div class="table-responsive text-nowrap">
                                        <table class="table" id="ownerTable1">
                                            <thead>
                                                <tr>
                                                    <th><?= $lang['awaiting_review']['table']['no_col'] ?></th>
                                                    <th><?= $lang['awaiting_review']['table']['owner_name_col'] ?></th>
                                                    <th><?= $lang['awaiting_review']['table']['operation_col'] ?></th>
                                                    <th><?= $lang['awaiting_review']['table']['action_col'] ?></th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                <?php
                                                $condition1 = 'authorized';
                                                $authorizedOwners = $ownerObj->historyReviews($condition1);
                                                $num = 0;

                                                foreach ($authorizedOwners as $owner) {
                                                    $num++;
                                                    $owner_id = $owner['owner_id'];

                                                    if($owner['owner_action'] == 'create project owner') {
                                                        $owner_action = $_SESSION['lang'] == 'th' ? 'สร้างเจ้าของโครงการ' : 'create project owner';
                                                    }
                                                    else if($owner['owner_action'] == 'update project owner') {
                                                        $owner_action = $_SESSION['lang'] == 'th' ? 'แก้ไขเจ้าของโครงการ' : 'update project owner';
                                                    }
                                                ?>
                                                    <tr>
                                                        <td data-label="<?= $lang['awaiting_review']['table']['no_col'] ?>"><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= $num ?></strong></td>
                                                        <td data-label="<?= $lang['awaiting_review']['table']['owner_name_col'] ?>"> <span class="ellipsis-tb"><?= $_SESSION['lang'] == "en" ? $owner['owner_name_en'] : $owner['owner_name_th']  ?></span></td>
                                                        <td data-label="<?= $lang['awaiting_review']['table']['operation_col'] ?>" class="text-warning"><?= $owner_action ?></td>
                                                        <td data-label="<?= $lang['awaiting_review']['table']['action_col'] ?>">
                                                            <div class="btn-toolbar demo-inline-spacing" role="toolbar" aria-label="Toolbar with button groups">
                                                                <div class="btn-group" role="group" aria-label="First group">
                                                                    <button type="button" class="btn btn-info"  onclick="viewHistoryOwnerDetails(<?= $owner_id ?>, '<?= $condition1 ?>')">
                                                                        <i class='bx bx-show' title="<?= $lang['awaiting_review']['title']['details'] ?>"></i>
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
                                <?php } else { ?>
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <td><?= $lang['awaiting_review']['text']['no_data'] ?></td>
                                        </div>
                                    </div>
                                <?php  }
                                ?>
                            </div>

                            <div class="tab-pane fade" id="navs-justified-unauthorized-owners" role="tabpanel">
                                <?php
                                if ($totalUnauthorizedOwners > 0) { ?>
                                    <div class="table-responsive text-nowrap">
                                        <table class="table" id="ownerTable2">
                                            <thead>
                                                <tr>
                                                    <th><?= $lang['awaiting_review']['table']['no_col'] ?></th>
                                                    <th><?= $lang['awaiting_review']['table']['owner_name_col'] ?></th>
                                                    <th><?= $lang['awaiting_review']['table']['operation_col'] ?></th>
                                                    <th><?= $lang['awaiting_review']['table']['remark_col'] ?></th>
                                                    <th><?= $lang['awaiting_review']['table']['action_col'] ?></th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                <?php
                                                $condition1 = 'unauthorized';
                                                $condition2 = 'resend request';
                                                $unauthorizedOwners = $ownerObj->historyReviews($condition1, $condition2);
                                                $num = 0;

                                                foreach ($unauthorizedOwners as $owner) {
                                                    $num++;
                                                    $owner_id = $owner['owner_id'];

                                                    if($owner['owner_action'] == 'create project owner') {
                                                        $owner_action = $_SESSION['lang'] == 'th' ? 'สร้างเจ้าของโครงการ' : 'create project owner';
                                                    }
                                                    else if($owner['owner_action'] == 'update project owner') {
                                                        $owner_action = $_SESSION['lang'] == 'th' ? 'แก้ไขเจ้าของโครงการ' : 'update project owner';
                                                    }
                                                ?>
                                                    <tr>
                                                        <td data-label="<?= $lang['awaiting_review']['table']['no_col'] ?>"><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= $num ?></strong></td>
                                                        <td data-label="<?= $lang['awaiting_review']['table']['owner_name_col'] ?>"> <span class="el"></span></td>
                                                        <td data-label="<?= $lang['awaiting_review']['table']['operation_col'] ?>" class="text-warning"><?= $owner_action ?></td>
                                                        <td data-label="<?= $lang['awaiting_review']['table']['remark_col'] ?>">
                                                            <?php
                                                            if ($owner['owner_reviewstatus'] == 'resend request') { ?>
                                                                <span class="text-warning"><?= $lang['awaiting_review']['text']['allow_edit'] ?></span>
                                                            <?php   } else { ?>
                                                                <span><?= $lang['awaiting_review']['text']['notallow_edit'] ?></span>
                                                            <?php  }

                                                            ?>
                                                        </td>
                                                        <td data-label="<?= $lang['awaiting_review']['table']['action_col'] ?>">
                                                            <div class="btn-toolbar demo-inline-spacing" role="toolbar" aria-label="Toolbar with button groups">
                                                                <div class="btn-group" role="group" aria-label="First group">
                                                                    <button type="button" class="btn btn-info" onclick="viewHistoryOwnerDetails(<?= $owner_id ?>, '<?= $condition1 ?>', '<?= $condition2 ?>')">
                                                                        <i class='bx bx-show' title="<?= $lang['awaiting_review']['title']['details'] ?>"></i>
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


                <!-- GET Modal History Projects -->
                <div class="modal fade" id="modalHistoryProject" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" style="color: #13da9a;">
                                    <?= $lang['awaiting_review']['project_details']['details'] ?>
                                </h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="background-color: #f4f4f4;" id="contentHistoryProject"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    <?= $lang['awaiting_review']['project_details']['btn']['close'] ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- GET Modal History Owners -->
                <div class="modal fade" id="modalHistoryOwner" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" style="color: #13da9a;">
                                    <?= $lang['awaiting_review']['owner_details']['details'] ?>
                                </h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="background-color: #f4f4f4;" id="contentHistoryOwner"></div>
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
                $(document).ready(function() {
                    $('#projectTable1').DataTable({
                        "pageLength": 50,
                        "language": {
                            "lengthMenu": "<?= $lang['datatable']['language']['lengthMenu']; ?>",
                            "info": "<?= $lang['datatable']['language']['info']; ?>",
                            "search": "<?= $lang['datatable']['language']['search']; ?>",
                            "zeroRecords": "<?= $lang['datatable']['language']['zeroRecords']; ?>",
                            "infoEmpty": "<?= $lang['datatable']['language']['infoEmpty']; ?>",
                            "infoFiltered": "<?= $lang['datatable']['language']['infoFiltered']; ?>",
                            "paginate": {
                                "previous": "<?= $lang['datatable']['language']['paginate']['previous']; ?>",
                                "next": "<?= $lang['datatable']['language']['paginate']['next']; ?>"
                            }
                        }
                    });

                    $('#projectTable2').DataTable({
                        "pageLength": 50,
                        "language": {
                            "lengthMenu": "<?= $lang['datatable']['language']['lengthMenu']; ?>",
                            "info": "<?= $lang['datatable']['language']['info']; ?>",
                            "search": "<?= $lang['datatable']['language']['search']; ?>",
                            "zeroRecords": "<?= $lang['datatable']['language']['zeroRecords']; ?>",
                            "infoEmpty": "<?= $lang['datatable']['language']['infoEmpty']; ?>",
                            "infoFiltered": "<?= $lang['datatable']['language']['infoFiltered']; ?>",
                            "paginate": {
                                "previous": "<?= $lang['datatable']['language']['paginate']['previous']; ?>",
                                "next": "<?= $lang['datatable']['language']['paginate']['next']; ?>"
                            }
                        }
                    });

                    $('#ownerTable1').DataTable({
                        "pageLength": 50,
                        "language": {
                            "lengthMenu": "<?= $lang['datatable']['language']['lengthMenu']; ?>",
                            "info": "<?= $lang['datatable']['language']['info']; ?>",
                            "search": "<?= $lang['datatable']['language']['search']; ?>",
                            "zeroRecords": "<?= $lang['datatable']['language']['zeroRecords']; ?>",
                            "infoEmpty": "<?= $lang['datatable']['language']['infoEmpty']; ?>",
                            "infoFiltered": "<?= $lang['datatable']['language']['infoFiltered']; ?>",
                            "paginate": {
                                "previous": "<?= $lang['datatable']['language']['paginate']['previous']; ?>",
                                "next": "<?= $lang['datatable']['language']['paginate']['next']; ?>"
                            }
                        }
                    });

                    $('#ownerTable2').DataTable({
                        "pageLength": 50,
                        "language": {
                            "lengthMenu": "<?= $lang['datatable']['language']['lengthMenu']; ?>",
                            "info": "<?= $lang['datatable']['language']['info']; ?>",
                            "search": "<?= $lang['datatable']['language']['search']; ?>",
                            "zeroRecords": "<?= $lang['datatable']['language']['zeroRecords']; ?>",
                            "infoEmpty": "<?= $lang['datatable']['language']['infoEmpty']; ?>",
                            "infoFiltered": "<?= $lang['datatable']['language']['infoFiltered']; ?>",
                            "paginate": {
                                "previous": "<?= $lang['datatable']['language']['paginate']['previous']; ?>",
                                "next": "<?= $lang['datatable']['language']['paginate']['next']; ?>"
                            }
                        }
                    });
                });


                function viewHistoryProjectDetails(project_id) {
                    var modalHistoryProject = $("#modalHistoryProject");
                    var show = $("#contentHistoryProject");

                    modalHistoryProject.modal('show');

                    $.ajax({
                        type: "POST",
                        url: "modals/view-project-lists.php",
                        data: {
                            project_id: project_id
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

                function viewHistoryOwnerDetails(owner_id, condition) {
                    var modalHistoryOwner = $("#modalHistoryOwner");
                    var show = $("#contentHistoryOwner");

                    modalHistoryOwner.modal('show');

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

                function showOwnerHistory() {
                    var projectSelected = document.getElementById('project_selected');
                    var ownerSelected = document.getElementById('owner_selected');
                    
                    var projectTabs = document.getElementById('project-tabs');
                    var ownerTabs = document.getElementById('owner-tabs');
                    var projectHistory = document.getElementById('project-history');
                    var ownerHistory = document.getElementById('owner-history');

                    //Switch active button
                    projectSelected.classList.remove("active");
                    ownerSelected.classList.add("active");

                    //Hide project tabs
                    projectTabs.classList.add("d-none");
                    ownerTabs.classList.remove("d-none");

                    //Hide project history
                    projectHistory.classList.add("d-none");
                    ownerHistory.classList.remove("d-none");
                }

                function showProjectHistory() {
                    var projectSelected = document.getElementById('project_selected');
                    var ownerSelected = document.getElementById('owner_selected');
                    
                    var projectTabs = document.getElementById('project-tabs');
                    var ownerTabs = document.getElementById('owner-tabs');
                    var projectHistory = document.getElementById('project-history');
                    var ownerHistory = document.getElementById('owner-history');

                    //Switch active button
                    projectSelected.classList.add("active");
                    ownerSelected.classList.remove("active");

                    //Hide owner tabs
                    projectTabs.classList.remove("d-none");
                    ownerTabs.classList.add("d-none");

                    //Hide owner history
                    projectHistory.classList.remove("d-none");
                    ownerHistory.classList.add("d-none");
                }

            </script>

        </body>

        </html>

<?php }
} ?>