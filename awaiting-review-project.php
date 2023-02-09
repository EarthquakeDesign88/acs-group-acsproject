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

if (!($_SESSION['authenticated'])) {
    $auth->redirect('./login.php');
} else {
    $projectObj = new Project();
    $username = $_SESSION['username'];

    $totalWaitingForReview = $projectObj->totalRequestByUser($username, $condition1 = 'waiting for review');
    $totalAuthorized = $projectObj->totalRequestByUser($username, $condition1 = 'authorized');
    $totalUnauthorized = $projectObj->totalRequestByUser($username, $condition1 = 'unauthorized', $condition2 = 'resend request');
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
                            <?= $lang['awaiting_review']['title_header'] ?>
                        </h3>
                    </div>
                </div>

                <div class="nav-align-top mb-4">
                    <ul class="nav nav-tabs nav-fill" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-waiting_review" aria-controls="navs-justified-waiting_review" aria-selected="true">
                                <i class='tf-icons bx bxs-x-circle text-warning'></i> <?= $lang['awaiting_review']['tab']['waiting_review'] ?> <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-warning"><?= $totalWaitingForReview ?></span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-authorized" aria-controls="navs-justified-authorized" aria-selected="false">
                                <i class='tf-icons bx bxs-check-circle text-success'></i> <?= $lang['awaiting_review']['tab']['authorized'] ?> <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-success"><?= $totalAuthorized ?></span>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-unauthorized" aria-controls="navs-justified-unauthorized" aria-selected="true">
                                <i class='tf-icons bx bxs-x-circle text-danger'></i> <?= $lang['awaiting_review']['tab']['unauthorized'] ?> <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger"><?= $totalUnauthorized ?></span>
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="navs-justified-waiting_review" role="tabpanel">
                            <?php
                            if ($totalWaitingForReview > 0) { ?>
                                <div class="table-responsive text-nowrap">
                                    <table class="table" id="projectTable">
                                        <thead class="th-resp">
                                            <tr>
                                                <th><?= $lang['awaiting_review']['table']['no_col'] ?></th>
                                                <th><?= $lang['awaiting_review']['table']['project_name_col'] ?></th>
                                                <th><?= $lang['awaiting_review']['table']['operation_col'] ?></th>
                                                <th><?= $lang['awaiting_review']['table']['action_col'] ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $condition1 = 'waiting for review';
                                            $waitingForReviewProjects = $projectObj->requestListsByUser($username, $condition1);
                                            $num = 0;

                                            foreach ($waitingForReviewProjects as $project) {
                                                $num++;
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
                                            ?>
                                                <tr>
                                                    <td data-label="<?= $lang['awaiting_review']['table']['no_col'] ?>"><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= $num ?></strong></td>
                                                    <td data-label="<?= $lang['awaiting_review']['table']['project_name_col'] ?>"> <?= $_SESSION['lang'] == "en" ? $project['project_name_en'] : $project['project_name_th']  ?></td>
                                                    <td data-label="<?= $lang['awaiting_review']['table']['operation_col'] ?>" class="text-warning"> <?= $project_action ?></td>
                                                    <td data-label="<?= $lang['awaiting_review']['table']['action_col'] ?>">
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

                        <div class="tab-pane fade" id="navs-justified-authorized" role="tabpanel">
                            <?php
                            if ($totalAuthorized > 0) { ?>
                                <div class="table-responsive text-nowrap">
                                    <table class="table" id="projectTable2">
                                        <thead class="th-resp">
                                            <tr>
                                                <th><?= $lang['awaiting_review']['table']['no_col'] ?></th>
                                                <th><?= $lang['awaiting_review']['table']['project_name_col'] ?></th>
                                                <th><?= $lang['awaiting_review']['table']['operation_col'] ?></th>
                                                <th><?= $lang['awaiting_review']['table']['action_col'] ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $condition1 = 'authorized';
                                            $authorizedProjects = $projectObj->requestListsByUser($username, $condition1);
                                            $num = 0;

                                            foreach ($authorizedProjects as $project) {
                                                $num++;
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
                                            ?>
                                                <tr>
                                                    <td data-label="<?= $lang['awaiting_review']['table']['no_col'] ?>"><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= $num ?></strong></td>
                                                    <td data-label="<?= $lang['awaiting_review']['table']['project_name_col'] ?>"> <?= $_SESSION['lang'] == "en" ? $project['project_name_en'] : $project['project_name_th']  ?></td>
                                                    <td data-label="<?= $lang['awaiting_review']['table']['operation_col'] ?>" class="text-warning"> <?= $project_action ?></td>
                                                    <td data-label="<?= $lang['awaiting_review']['table']['action_col'] ?>">
                                                        <div class="btn-toolbar demo-inline-spacing" role="toolbar" aria-label="Toolbar with button groups">
                                                            <div class="btn-group" role="group" aria-label="First group">
                                                                <?php
                                                                if ($project['project_action'] == 'create project' || $project['project_action'] == 'update project') { ?>
                                                                    <button type="button" class="btn btn-info" onclick="viewAuthorizedProjectDetails(<?= $project_id ?>, '<?= $condition1 ?>')">
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

                        <div class="tab-pane fade" id="navs-justified-unauthorized" role="tabpanel">
                            <?php
                            if ($totalUnauthorized > 0) { ?>
                                <div class="table-responsive text-nowrap">
                                    <table class="table" id="projectTable3">
                                        <thead class="th-resp">
                                            <tr>
                                                <th><?= $lang['awaiting_review']['table']['no_col'] ?></th>
                                                <th><?= $lang['awaiting_review']['table']['project_name_col'] ?></th>
                                                <th><?= $lang['awaiting_review']['table']['operation_col'] ?></th>
                                                <th><?= $lang['awaiting_review']['table']['remark_col'] ?></th>
                                                <th><?= $lang['awaiting_review']['table']['action_col'] ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $condition1 = 'unauthorized';
                                            $condition2 = 'resend request';
                                            $unauthorizedProjects = $projectObj->requestListsByUser($username, $condition1, $condition2);
                                            $num = 0;

                                            foreach ($unauthorizedProjects as $project) {
                                                $num++;
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
                                            ?>
                                                <tr>
                                                    <td data-label="<?= $lang['awaiting_review']['table']['no_col'] ?>"><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= $num ?></strong></td>
                                                    <td data-label="<?= $lang['awaiting_review']['table']['project_name_col'] ?>"> <?= $_SESSION['lang'] == "en" ? $project['project_name_en'] : $project['project_name_th']  ?></td>
                                                    <td data-label="<?= $lang['awaiting_review']['table']['operation_col'] ?>" class="text-warning"> <?= $project_action ?></td>
                                                    <td data-label="<?= $lang['awaiting_review']['table']['remark_col'] ?>">
                                                        <?php
                                                        if ($project['project_reviewstatus'] == 'resend request') { ?>
                                                            <span class="text-warning"><?= $lang['awaiting_review']['text']['allow_edit'] ?></span>
                                                        <?php   } else { ?>
                                                            <span><?= $lang['awaiting_review']['text']['notallow_edit'] ?></span>
                                                        <?php  }

                                                        ?>
                                                    </td>
                                                    <td data-label="<?= $lang['awaiting_review']['table']['action_col'] ?>">
                                                        <div class="btn-toolbar demo-inline-spacing" role="toolbar" aria-label="Toolbar with button groups">
                                                            <div class="btn-group" role="group" aria-label="First group">
                                                                <button type="button" class="btn btn-info" onclick="viewUnauthorizedProjectDetails(<?= $project_id ?>, '<?= $condition1 ?>', '<?= $condition2 ?>')">
                                                                    <i class='bx bx-show' title="<?= $lang['awaiting_review']['title']['details'] ?>"></i>
                                                                </button>
           
                                                                <?php
                                                                if ($project['project_reviewstatus'] == 'resend request') { 
                                                                    if($project['project_action'] == 'create project' || $project['project_action'] == 'update project') { ?>
                                                                        <a href="./edit-project.php?project_id=<?= $project['project_id'] ?>" class="btn btn-warning" title="<?= $lang['projects']['view_projects']['title']['edit'] ?>"><i class='bx bx-edit-alt'></i></a>                         
                                                                <?php } else { ?>
                                                                        <a href="./edit-projectimg.php?project_id=<?= $project['project_id'] ?>" class="btn btn-warning" title="<?= $lang['projects']['view_projects']['title']['edit_image'] ?>"><i class='bx bx-edit-alt'></i></a>                                      
                                                                <?php }  } ?>
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


            <!-- GET Modal projects for waiting for review status -->
            <div class="modal fade" id="modalViewWaitingForReviewProject" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="Details" style="color: #13da9a;">
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


            <!-- GET Modal projects for authorized status -->
            <div class="modal fade" id="modalViewAuthorizedProject" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="Details" style="color: #13da9a;">
                                <?= $lang['awaiting_review']['project_details']['details'] ?>
                            </h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="background-color: #f4f4f4;" id="contentViewAuthorizedProject"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                <?= $lang['awaiting_review']['project_details']['btn']['close'] ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- GET Modal projects for unauthorized status -->
            <div class="modal fade" id="modalViewUnauthorizedProject" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="Details" style="color: #13da9a;">
                                <?= $lang['awaiting_review']['project_details']['details'] ?>
                            </h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="background-color: #f1f1f1;" id="contentViewUnauthorizedProject"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                <?= $lang['awaiting_review']['project_details']['btn']['close'] ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- GET Modal projects image -->
            <div class="modal fade" id="modalProjectImage" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document" >
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="Details" style="color: #13da9a;">
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
        <script type="text/javascript" src="../../node_modules/DataTables/Buttons-2.2.3/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="../../node_modules/DataTables/Buttons-2.2.3/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="../../node_modules/DataTables/Buttons-2.2.3/js/buttons.print.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#projectTable').DataTable({
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

                $('#projectTable3').DataTable({
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


            function viewAuthorizedProjectDetails(project_id, condition) {
                var modalViewAuthorizedProject = $("#modalViewAuthorizedProject");
                var show = $("#contentViewAuthorizedProject");

                modalViewAuthorizedProject.modal('show');

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


            function viewUnauthorizedProjectDetails(project_id, condition, condition2) {
                var modalViewUnauthorizedProject = $("#modalViewUnauthorizedProject");
                var show = $("#contentViewUnauthorizedProject");

                modalViewUnauthorizedProject.modal('show');

                $.ajax({
                    type: "POST",
                    url: "modals/view-project-lists.php",
                    data: {
                        project_id: project_id,
                        condition: condition,
                        condition2: condition2
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
                    data: {project_id: project_id},
                    dataType: "json",
                    success: function(response) {
                        show.html(response.content);
                    }
                });
            }
        </script>


    </body>

    </html>

<?php } ?>