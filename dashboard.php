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
    use App\Models\Category;
    use App\Models\Department;
    use App\Models\Owner;
    use App\Models\Template;

    if(!($_SESSION['authenticated'])){  
        $auth->redirect('./login.php');
    }
    else {
        $projectObj = new Project;
        $projectCount = $projectObj->totalRowCount();

        $categoryObj = new Category;
        $categoryCount = $categoryObj->totalRowCount();

        $departmentObj = new Department;
        $departmentCount = $departmentObj->totalRowCount();

        $ownerObj = new Owner;
        $ownerCount = $ownerObj->totalRowCount();

        $templateObj = new Template;
        $templateCount = $templateObj->totalRowCount();

        $username = $_SESSION['username'];
        $user_role = $_SESSION['user_role'];


        if($user_role == 'admin') {
            //For admin
            $totalAwaitingReviewProjects = $projectObj->totalAwaitingReviewCount($condition = 'waiting for review');
            $totalAwaitingReviewOwners = $ownerObj->totalAwaitingReviewCount($condition = 'waiting for review');
            $totalAwaitingReviewAll = $totalAwaitingReviewProjects + $totalAwaitingReviewOwners;
    
            $totalAuthorizedProjects = $projectObj->totalAwaitingReviewCount($condition1 = 'authorized');
            $totalAuthorizedOwners = $ownerObj->totalAwaitingReviewCount($condition1 = 'authorized');
            $totalAuthorizedAll = $totalAuthorizedProjects + $totalAuthorizedOwners;
    
            $totalUnauthorizedProjects = $projectObj->totalAwaitingReviewCount($condition1 = 'unauthorized', $condition2 = 'resend request');
            $totalUnauthorizedOwners = $ownerObj->totalAwaitingReviewCount($condition1 = 'unauthorized', $condition2 = 'resend request');
            $totalUnauthorizedAll = $totalUnauthorizedProjects + $totalUnauthorizedOwners;
        }
        else {         
            //For user
            $totalAwaitingReviewProjects = $projectObj->totalRequestByUser($username, $condition = 'waiting for review');
            $totalAwaitingReviewOwners = $ownerObj->totalRequestByUser($username, $condition = 'waiting for review');
            $totalAwaitingReviewAll = $totalAwaitingReviewProjects + $totalAwaitingReviewOwners;
    
            $totalAuthorizedProjects = $projectObj->totalRequestByUser($username, $condition1 = 'authorized');
            $totalAuthorizedOwners = $ownerObj->totalRequestByUser($username, $condition1 = 'authorized');
            $totalAuthorizedAll = $totalAuthorizedProjects + $totalAuthorizedOwners;
    
            $totalUnauthorizedProjects = $projectObj->totalRequestByUser($username, $condition1 = 'unauthorized', $condition2 = 'resend request');
            $totalUnauthorizedOwners = $ownerObj->totalRequestByUser($username, $condition1 = 'unauthorized', $condition2 = 'resend request');
            $totalUnauthorizedAll = $totalUnauthorizedProjects + $totalUnauthorizedOwners;
        }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
                            <div class="col-lg-8 mb-4 order-0">
                                <div class="card">
                                    <div class="d-flex align-items-end row">
                                        <div class="col-sm-7">
                                            <div class="card-body">
                                                <h5 class="card-title text-primary"><?= $lang['dashboard']['title'] ?> <?= $_SESSION['user_firstname']?> <?= $_SESSION['user_lastname']?></h5>
                                                <p class="mb-4">
                                                    <?= $lang['dashboard']['sub_title'] ?><br>
                                                    <?= $lang['dashboard']['sub_title2'] ?>
                                                </p>

                                            </div>
                                        </div>
                                        <div class="col-sm-5 text-center text-sm-left">
                                            <div class="card-body pb-0 px-0 px-md-4">
                                                <img src="./assets/img/acs/icon-dash.svg" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 order-1">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <img src="./assets/img/acs/icon-e8.png" alt="chart success" class="rounded" />
                                                    </div>
                                                    <div class="dropdown">
                                                        <?php
                                                            if($_SESSION['user_role'] == 'admin') { ?>
                                                                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                                                    <a class="dropdown-item" href="./projects.php"><?= $lang['dashboard']['view_more'] ?></a>
                                                                </div>
                                                        <?php }?>
                                                    </div>
                                                </div>
                                                <span class="fw-semibold d-block mb-1"><?= $lang['dashboard']['projects'] ?></span>
                                                <h3 class="card-title mb-2"><?=$projectCount?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <img src="./assets/img/acs/icon-e2.png" alt="Credit Card" class="rounded" />
                                                    </div>
                                                    <div class="dropdown">
                                                        <?php
                                                            if($_SESSION['user_role'] == 'admin') { ?>
                                                            <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                                                <a class="dropdown-item" href="./categories.php"><?= $lang['dashboard']['view_more'] ?></a>
                                                            </div>
                                                        <?php }?>
                                                    </div>
                                                </div>
                                                <span class="fw-semibold d-block mb-1"><?= $lang['dashboard']['categories'] ?></span>
                                                <h3 class="card-title text-nowrap mb-1"><?=$categoryCount?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          
                            <div class="col-md-2 col-6 order-2 order-md-3 order-lg-2 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between">
                                            <div class="avatar flex-shrink-0">
                                                <img src="./assets/img/acs/waiting.png" alt="Credit Card" class="rounded" />
                                            </div>
                                            <div class="dropdown">
                                                <?php
                                                    if($_SESSION['user_role'] == 'admin') { ?>
                                                    <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                                        <a class="dropdown-item" href="./awaiting-review.php"><?= $lang['dashboard']['view_more'] ?></a>
                                                    </div>      
                                                <?php }?>                                              
                                            </div>
                                        </div>
                                        <span class="fw-semibold d-block mb-1 text-warning"><?= $lang['dashboard']['waiting_review'] ?></span>
                                        <h3 class="card-title text-nowrap mb-2 text-warning"><?=$totalAwaitingReviewAll?></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-6 order-2 order-md-3 order-lg-2 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between">
                                            <div class="avatar flex-shrink-0">
                                                <img src="./assets/img/acs/authorized.png" alt="Credit Card" class="rounded" />
                                            </div>
                                            <div class="dropdown">
                                                <?php
                                                    if($_SESSION['user_role'] == 'admin') { ?>
                                                        <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                                        <a class="dropdown-item" href="./history-review.php"><?= $lang['dashboard']['view_more'] ?></a>
                                                    </div>
                                                <?php }?>                                                    
                                            </div>
                                        </div>
                                        <span class="fw-semibold d-block mb-1 text-success"><?= $lang['dashboard']['authorized'] ?></span>
                                        <h3 class="card-title text-nowrap mb-2 text-success"><?=$totalAuthorizedAll?></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-12 order-2 order-md-3 order-lg-2 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between">
                                            <div class="avatar flex-shrink-0">
                                                <img src="./assets/img/acs/unauthorized.png" alt="Credit Card" class="rounded" />
                                            </div>
                                            <div class="dropdown">
                                                <?php
                                                    if($_SESSION['user_role'] == 'admin') { ?>
                                                        <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                                        <a class="dropdown-item" href="./history-review.php"><?= $lang['dashboard']['view_more'] ?></a>
                                                    </div>
                                                <?php }?>                                                    
                                            </div>
                                        </div>
                                        <span class="fw-semibold d-block mb-1 text-danger"><?= $lang['dashboard']['unauthorized'] ?></span>
                                        <h3 class="card-title text-nowrap mb-2 text-danger"><?=$totalUnauthorizedAll?></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-0 order-2 order-md-3 order-lg-2 mb-4"></div>
                            
    
                            <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                                <div class="row">
                                    <div class="col-6 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <img src="./assets/img/acs/icon-e5.png" alt="Credit Card" class="rounded" />
                                                    </div>
                                                    <div class="dropdown">
                                                        <?php
                                                            if($_SESSION['user_role'] == 'admin') { ?>
                                                             <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                                                <a class="dropdown-item" href="./departments.php"><?= $lang['dashboard']['view_more'] ?></a>
                                                            </div>
                                                        <?php }?>                                                    
                                                    </div>
                                                </div>
                                                <span class="fw-semibold d-block mb-1"><?= $lang['dashboard']['departments'] ?></span>
                                                <h3 class="card-title text-nowrap mb-2"><?=$departmentCount?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <img src="./assets/img/acs/icon-e4.png" alt="Credit Card" class="rounded" />
                                                    </div>
                                                    <div class="dropdown">
                                                        <?php
                                                            if($_SESSION['user_role'] == 'admin') { ?>
                                                            <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                                <a class="dropdown-item" href="./owners.php"><?= $lang['dashboard']['view_more'] ?></a>
                                                            </div>
                                                        <?php }?>     
                                                    </div>
                                                </div>
                                                <span class="fw-semibold d-block mb-1"><?= $lang['dashboard']['owners'] ?></span>
                                                <h3 class="card-title mb-2"><?=$ownerCount?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <img src="./assets/img/acs/present.png" alt="Credit Card" class="rounded" />
                                                    </div>
                                                    <div class="dropdown">
                                                        <?php
                                                            if($_SESSION['user_role'] == 'admin') { ?>
                                                            <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                                <a class="dropdown-item" href="./templates.php"><?= $lang['dashboard']['view_more'] ?></a>
                                                            </div>
                                                        <?php }?>    
                                                    </div>
                                                </div>
                                                <span class="fw-semibold d-block mb-1"><?= $lang['dashboard']['templates'] ?></span>
                                                <h3 class="card-title mb-2"><?=$templateCount?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
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
    </head>

    <body>

    </body>

</html>

<?php }?>