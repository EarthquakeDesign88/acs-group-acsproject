<?php
    if($_SERVER["SERVER_NAME"] == 'localhost' || $_SERVER["SERVER_NAME"] == '127.0.0.1'){
        require $_SERVER['DOCUMENT_ROOT'] . "/acs-groups/backoffice/acs-project/config/app.php";
    }else{
        require $_SERVER['DOCUMENT_ROOT'] . "/backoffice/acs-project/config/app.php";
    }

    
    $currentPage = basename($_SERVER['PHP_SELF'], ".php");

    use App\Models\User;
    use App\Models\Project;
    use App\Models\Owner;

    $user_id = $_SESSION['user_id'];
    $userObj = new User();
    $users =  $userObj->getUserById($user_id);

    foreach ($users as $user) { 
        $username = $user['username'];
        $user_firstname = $user['user_firstname'];
        $user_lastname = $user['user_lastname'];
        $user_department = $user['department_name'];
        $user_role = $user['user_role'];
    }

    $projectObj = new Project();
    $ownerObj = new Owner();

    //For Admin 
    $totalAwaitingReviewProjects = $projectObj->totalAwaitingReviewCount($condition = 'waiting for review');
    $totalAwaitingReviewOwners = $ownerObj->totalAwaitingReviewCount($condition = 'waiting for review');
    $totalAwaitingReviewAll =  $totalAwaitingReviewProjects + $totalAwaitingReviewOwners;

    //For User
    $totalWaitingForReviewProjects = $projectObj->totalRequestByUser($username, $condition1 = 'waiting for review');
    $totalWaitingForReviewOwners = $ownerObj->totalRequestByUser($username, $condition1 = 'waiting for review');
?>

<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
                <a href="#" class="app-brand-link">
                    <span class="app-brand-logo demo">
                        <img src="./assets/img/acs/acs-logo.png" alt="Logo" width="30" height="30">
                    </span>
                    <span class="app-brand-text demo menu-text fw-bolder ms-2">ACS Project</span>
                </a>

                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                    <i class="bx bx-chevron-left bx-sm align-middle"></i>
                </a>
            </div>

            <div class="menu-inner-shadow"></div>

            <ul class="menu-inner py-1">
                <!-- Dashboard -->
                <li class="menu-item <?php echo $currentPage == 'dashboard' ? 'active': '' ?>">
                    <a href="./dashboard.php" class="menu-link">
                        <i class="menu-icon tf-icons bx bxs-dashboard"></i>
                        <div data-i18n="Analytics"><?= $lang['menu']['dashboard_menu'] ?></div>
                    </a>
                </li>

                <!-- Presentation -->
                <li class="menu-item <?php echo $currentPage == 'templates' 
                            || $currentPage == 'create-template' 
                            || $currentPage == 'edit-template'
                            ? 'active': '' ?>">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-bar-chart-square"></i>
                        <div data-i18n="Presentation"><?= $lang['menu']['presentation_menu'] ?></div>
                    </a>

                    <ul class="menu-sub">
                        <li class="menu-item <?php echo $currentPage == 'templates' ? 'active': '' ?>">
                            <a href="templates.php" class="menu-link">
                                <div data-i18n="View templates"><?= $lang['sub_menu']['view_templates'] ?></div>
                            </a>
                        </li>
                    </ul> 
                </li>
                

                <!-- Projects -->
                <li class="menu-item <?php echo $currentPage == 'projects' 
                                            || $currentPage == 'create-project' 
                                            || $currentPage == 'edit-project' 
                                            || $currentPage == 'upload-projectimg' 
                                            || $currentPage == 'edit-projectimg' 
                                            || $currentPage == 'image-gallery'
                                            || $currentPage == 'export-projects'
                                            || $currentPage == 'awaiting-review-project'
                                            ? 'active': '' ?>">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bxs-school"></i>
                        <div data-i18n="Projects"><?= $lang['menu']['projects_menu'] ?></div>
                    </a>

                    <ul class="menu-sub">
                        <li class="menu-item <?php echo $currentPage == 'projects' ? 'active': '' ?>">
                            <a href="projects.php" class="menu-link">
                                <div data-i18n="View project"><?= $lang['sub_menu']['view_projects'] ?></div>
                            </a>
                        </li>
                    </ul> 
                    <ul class="menu-sub">
                        <li class="menu-item <?php echo $currentPage == 'export-projects' ? 'active': '' ?>">
                            <a href="export-projects.php" class="menu-link">
                                <div data-i18n="Export project"><?= $lang['sub_menu']['export_projects'] ?></div>
                            </a>
                        </li>
                    </ul> 

                    <?php
                        if($user_role != 'admin') { ?>
                            <ul class="menu-sub">
                                <li class="menu-item <?php echo $currentPage == '' ? 'active': '' ?>">
                                    <a href="awaiting-review-project.php" class="menu-link">
                                        <div data-i18n="Awaiting Review">
                                            <?= $lang['menu']['awating_review_menu'] ?>
                                            <?php
                                                    if($totalWaitingForReviewProjects > 0) { ?>
                                                        <span class="badge bg-warning"><?= $totalWaitingForReviewProjects ?></span>
                                            <?php   }
                                                ?>
                                        </div>
                                    </a>
                                </li>
                            </ul> 
                    <?php   }
                    ?>
                </li>

                <!-- Owner -->
                <li class="menu-item <?php echo $currentPage == 'owners' 
                                            || $currentPage == 'create-owner' 
                                            || $currentPage == 'edit-owner' 
                                            || $currentPage == 'awaiting-review-owner'
                                            ? 'active': '' ?>">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bxs-user"></i>
                        <div data-i18n="Owner"><?= $lang['menu']['owners_menu'] ?></div>
                    </a>

                    <ul class="menu-sub">
                        <li class="menu-item <?php echo $currentPage == 'owners' ? 'active': '' ?>">
                            <a href="./owners.php" class="menu-link">
                                <div data-i18n="View Owner"><?= $lang['sub_menu']['view_owners'] ?></div>
                            </a>
                        </li>
                    </ul>

                    <?php
                        if($user_role != 'admin') { ?>
                            <ul class="menu-sub">
                                <li class="menu-item <?php echo $currentPage == '' ? 'active': '' ?>">
                                    <a href="awaiting-review-owner.php" class="menu-link">
                                        <div data-i18n="Awaiting Review">
                                            <?= $lang['menu']['awating_review_menu'] ?>
                                            <?php
                                                    if($totalWaitingForReviewOwners > 0) { ?>
                                                        <span class="badge bg-warning"><?= $totalWaitingForReviewOwners ?></span>
                                            <?php   }
                                                ?>
                                        </div>
                                    </a>
                                </li>
                            </ul> 
                    <?php   }
                    ?>
                </li>

    
                <?php
                    if($user_role == 'admin') { ?> 
                        <li class="menu-header small text-uppercase">
                            <span class="menu-header-text"><b><?= $lang['menu']['admin_management'] ?></b></span>
                        </li>
                        <li class="menu-item <?php echo $currentPage == 'awaiting-review'
                                                     || $currentPage == 'history-review' 
                                                     ? 'active': '' ?>"> 
                            <a href="./awaiting-review.php" class="menu-link">
                                <i class='menu-icon tf-icons bx bx-file-find'></i>
                                <div data-i18n="AwaitingReview">
                                    <?= $lang['menu']['awating_review_menu'] ?>
                                    <?php
                                        if($totalAwaitingReviewAll > 0) { ?>
                                            <span class="badge bg-warning"><?= $totalAwaitingReviewAll ?></span>
                                <?php   }
                                    ?>
                                </div>
                            </a>
                        </li>
                        <li class="menu-item <?php echo $currentPage == 'users'
                                                        || $currentPage == 'create-user' 
                                                        || $currentPage == 'edit-profile' && $page == 'users'
                                                        || $currentPage == 'reset-password' && $page == 'users'
                                                        || $currentPage == 'status' 
                                                        || $currentPage == 'create-status' 
                                                        || $currentPage == 'edit-status' 
                                                        || $currentPage == 'scope-services'
                                                        || $currentPage == 'create-scope-service' 
                                                        || $currentPage == 'edit-scope-service'   
                                                        || $currentPage == 'types'  
                                                        || $currentPage == 'create-type' 
                                                        || $currentPage == 'edit-type' 
                                                        ? 'active': '' ?>">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons bx bx-cog"></i>
                                <div data-i18n="Settings"><?= $lang['menu']['settings_menu'] ?></div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item <?php echo $currentPage == 'users' 
                                                                || $currentPage == 'create-user' 
                                                                || $currentPage == 'edit-profile' && $page == 'users'
                                                                || $currentPage == 'reset-password' && $page == 'users' 
                                                                ? 'active': '' ?>">
                                    <a href="./users.php" class="menu-link">
                                        <div data-i18n="Users"><?= $lang['sub_menu']['users'] ?></div>
                                    </a>
                                </li>
                            </ul>

                            <ul class="menu-sub">
                                <li class="menu-item  <?php echo $currentPage == 'departments' 
                                                                || $currentPage == 'create-department' 
                                                                || $currentPage == 'edit-department' 
                                                                ? 'active': '' ?>">
                                    <a href="./departments.php" class="menu-link">
                                        <div data-i18n="Departments"><?= $lang['sub_menu']['departments'] ?></div>
                                    </a>
                                </li>
                            </ul>

                            <ul class="menu-sub">
                                <li class="menu-item  <?php echo $currentPage == 'categories' 
                                                                || $currentPage == 'create-category' 
                                                                || $currentPage == 'edit-category' 
                                                                ? 'active': '' ?>">
                                    <a href="./categories.php" class="menu-link">
                                        <div data-i18n="Categories"><?= $lang['sub_menu']['categories'] ?></div>
                                    </a>
                                </li>
                            </ul>

                            <ul class="menu-sub">
                                <li class="menu-item <?php echo $currentPage == 'status' 
                                                                || $currentPage == 'create-status' 
                                                                || $currentPage == 'edit-status' 
                                                                ? 'active': '' ?>">
                                    <a href="./status.php" class="menu-link">
                                        <div data-i18n="Status"><?= $lang['sub_menu']['status'] ?></div>
                                    </a>
                                </li>
                            </ul>

                            <ul class="menu-sub">
                                <li class="menu-item <?php echo $currentPage == 'types' 
                                                                || $currentPage == 'create-type' 
                                                                || $currentPage == 'edit-type' 
                                                                ? 'active': '' ?>"> 
                                    <a href="./types.php" class="menu-link">
                                        <div data-i18n="Types"><?= $lang['sub_menu']['types'] ?></div>
                                    </a>
                                </li>
                            </ul>

                            <ul class="menu-sub">
                                <li class="menu-item <?php echo $currentPage == 'scope-services'
                                                                || $currentPage == 'create-scope-service' 
                                                                || $currentPage == 'edit-scope-service' 
                                                                ? 'active': '' ?>"> 
                                    <a href="./scope-services.php" class="menu-link">
                                        <div data-i18n="Scope of Service"><?= $lang['sub_menu']['scope_of_services'] ?></div>
                                    </a>
                                </li>
                            </ul>
                        
                            <!-- <ul class="menu-sub">
                                <li class="menu-item">
                                    <a href="#" class="menu-link">
                                        <div data-i18n="Page Settings">Page Settings</div>
                                    </a>
                                </li>
                            </ul> -->
                        </li>
                 <?php  }
                
                
                ?>

            </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
        
        <!-- Navbar -->
        <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                    <i class="bx bx-menu bx-sm"></i>
                </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                <!-- Search -->
                <div class="navbar-nav align-items-center">
                    <div class="nav-item d-flex align-items-center">
                    </div>
                </div>
                <!-- /Search -->

                <ul class="navbar-nav flex-row align-items-center ms-auto">
                    <!-- Place this tag where you want the button to render. -->
                    <li class="nav-item lh-1 me-3">
                    <?php
                        $recheck = strtok($_SERVER['QUERY_STRING'], '&');

                        if($_SERVER['QUERY_STRING'] != ""){
                            if($recheck != "") {
                                if($recheck == "lang=th" || $recheck == "lang=en") {
                                    $url_new_en = $currentPage . ".php?" . "lang=en";
                                    $url_new_th = $currentPage . ".php?" . "lang=th";
                                }
                                else {
									$queryParams = $_GET;
									unset($queryParams['lang']);
                                    $url_new_en = $currentPage . ".php?" . http_build_query($queryParams) . "&lang=en";
                                    $url_new_th = $currentPage . ".php?" . http_build_query($queryParams) . "&lang=th";
                                }
                            }
                        }
                        else {
                            $url_new_en = $currentPage . ".php" . "?lang=en";
                            $url_new_th = $currentPage . ".php" . "?lang=th";
                        }

                    ?>
                        <span>
                            <a href="<?= $url_new_en ?>" class="lang <?= $_SESSION['lang'] == "en" ? 'active' : '' ?>"><?= $lang['lang_en_short'] ?></a>|
                            <a href="<?= $url_new_th ?>" class="lang <?= $_SESSION['lang'] == "th" ? 'active' : '' ?>"><?= $lang['lang_th_short'] ?></a>
                        </span>
                    </li>
                    <li class="nav-item lh-1 me-3">
                        <a class="github-button" href="#" data-icon="octicon-star" data-size="large" data-show-count="true">
                            <b><?= strtoupper($user_firstname) ?> <?= strtoupper($user_lastname) ?></b>
                        </a>
                    </li>

                    <!-- User -->
                    <li class="nav-item navbar-dropdown dropdown-user dropdown">
                        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                            <div class="avatar avatar-online">
                                <img src="./assets/img/acs/icon-e3.png" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar avatar-online">
                                                <img src="./assets/img/acs/icon-e3.png" alt class="w-px-40 h-auto rounded-circle" />
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <span class="fw-semibold d-block mt-2"><?= strtoupper($username) ?></span>
                                        </div>
                                    </div> 
                                </a>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                            </li>
                            <li>
                                <a class="dropdown-item" href="../acs-project/profile.php">
                                    <i class="bx bx-user me-2"></i>
                                    <span class="align-middle"><?= $lang['menu']['my_profile'] ?></span>
                                </a>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                            </li>
                            <li>
                                <a class="dropdown-item" href="./logout.php">
                                    <i class="bx bx-power-off me-2"></i>
                                    <span class="align-middle"><?= $lang['menu']['logout'] ?></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!--/ User -->
                </ul>
            </div>
        </nav>
        <!-- / Navbar -->

