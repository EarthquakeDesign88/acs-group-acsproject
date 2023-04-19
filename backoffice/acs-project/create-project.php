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
    use App\Models\Owner;
    use App\Models\ScopeOfService;
    use App\Models\Type;
    use App\Models\Department;
    use App\Models\Status;

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
    <title>Create Project</title>
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
                            <h3 class="card-title text-primary"><?= $lang['projects']['view_projects']['create_project_header'] ?> <span id="load-data"></span></h3>
                        </div>
                        <div class="col-6">
                            <a href="./projects.php" class="btn btn-primary float-end"><?= $lang['projects']['view_projects']['btn']['back'] ?></a>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <form id="createProjectForm">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="ProjectNameTH" class="form-label"><?= $lang['projects']['view_projects']['project_name_th'] ?></label>
                                        <input type="text" class="form-control" id="project_name_th" name="project_name_th" placeholder="<?= $lang['projects']['view_projects']['placeholder']['project_name_th'] ?>" autocomplete="off"/>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="ProjectNameEN" class="form-label"><?= $lang['projects']['view_projects']['project_name_en'] ?></label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" class="form-control" id="project_name_en" name="project_name_en" placeholder="<?= $lang['projects']['view_projects']['placeholder']['project_name_en'] ?>" autocomplete="off"/>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="ProjectCategory" class="form-label"><?= $lang['projects']['view_projects']['project_category'] ?></label>
                                        <select id="project_category" name="project_category" class="select2 form-select">
                                            <?php                                             
                                                $categoryObj = new Category();
                                                $categories = $categoryObj->getAllCategories();
                                            ?>
                                                <option value=""><?= $lang['projects']['view_projects']['placeholder']['select_project_category'] ?></option>
                                            <?php   
                                                if($_SESSION['lang'] == "th") { ?>
                                                    <?php
                                                        foreach ($categories as $category) { ?>
                                                            <option value="<?= $category['pcategory_id'] ?>"><?= $category['pcategory_name_th'] ?></option>
                                                    <?php } ?>
                                              <?php  }
                                                else { ?>
                                                    <?php
                                                        foreach ($categories as $category) { ?>
                                                            <option value="<?= $category['pcategory_id'] ?>"><?= $category['pcategory_name_en'] ?></option>
                                                        <?php } ?>

                                             <?php } ?>                                
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="ProjectOwner" class="form-label"><?= $lang['projects']['view_projects']['project_owner'] ?></label>
                                        <input type="text" class="form-control search_owner_name " placeholder="<?= $lang['projects']['view_projects']['placeholder']['select_project_owner'] ?>" autocomplete="off" id="project_owner">
                                        <input type="hidden" class="form-control search_owner_id" name="project_owner">
                                        <div class="search_owner_show"></div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="ProjectScope" class="form-label"><?= $lang['projects']['view_projects']['project_scope'] ?></label>
                                        <select id="project_scope" name="project_scope" class="select2 form-select">
                                            <?php
                                                $scopeObj = new ScopeOfService();
                                                $scopes = $scopeObj->getAllScopeOfServices();
                                            ?>
                                                <option value=""><?= $lang['projects']['view_projects']['placeholder']['select_project_scope'] ?></option>
                                            <?php   
                                                if($_SESSION['lang'] == "th") { ?>
                                                    <?php
                                                        foreach ($scopes as $scope) { ?>
                                                            <option value="<?= $scope['scope_id'] ?>"><?= $scope['scope_name_th'] ?></option>
                                                        <?php }?>

                                              <?php  }
                                                else { ?>
                                                    <?php
                                                        foreach ($scopes as $scope) { ?>
                                                            <option value="<?= $scope['scope_id'] ?>"><?= $scope['scope_name_en'] ?></option>
                                                        <?php } ?>

                                             <?php } ?>
                 
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="ProjectType" class="form-label"><?= $lang['projects']['view_projects']['project_type'] ?></label>
                                        <select id="project_type" name="project_type" class="select2 form-select">                                       
                                            <?php
                                                $typeObj = new Type();
                                                $types = $typeObj->getAllTypes();
                                            ?>
                                                <option value=""><?= $lang['projects']['view_projects']['placeholder']['select_project_type'] ?></option>
                                            <?php   
                                                if($_SESSION['lang'] == "th") { ?>
                                                    <?php
                                                        foreach ($types as $type) { ?>
                                                            <option value="<?= $type['type_id'] ?>"><?= $type['type_name_th'] ?></option>
                                                        <?php }?>

                                              <?php  }
                                                else { ?>
                                                    <?php
                                                        foreach ($types as $type) { ?>
                                                               <option value="<?= $type['type_id'] ?>"><?= $type['type_name_en'] ?></option>
                                                        <?php } ?>

                                             <?php } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="ProjectDepartment" class="form-label"><?= $lang['projects']['view_projects']['project_department'] ?></label>
                                        <select id="project_department" name="project_department" class="select2 form-select">
                                            <?php
                                                $departmentObj = new Department();
                                                $departments = $departmentObj->getAllDepartments();
                                            ?>
                                                <option value=""><?= $lang['projects']['view_projects']['placeholder']['select_project_department'] ?></option>
                                            <?php   
                                                if($_SESSION['lang'] == "th") { ?>
                                                    <?php
                                                        foreach ($departments as $department) { ?>
                                                            <option value="<?= $department['department_id'] ?>"><?= $department['department_name'] ?></option>
                                                        <?php }?>

                                              <?php  }
                                                else { ?>
                                                    <?php
                                                        foreach ($departments as $department) { ?>
                                                            <option value="<?= $department['department_id'] ?>"><?= $department['department_name'] ?></option>
                                                        <?php } ?>

                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="ProjectStatus" class="form-label"><?= $lang['projects']['view_projects']['project_status'] ?></label>
                                        <select id="project_status" name="project_status" class="select2 form-select">
                                            <?php
                                                $statusObj = new Status();
                                                $statuss = $statusObj->getAllStatus();
                                            ?>
                                                <option value=""><?= $lang['projects']['view_projects']['placeholder']['select_project_status'] ?></option>
                                            <?php   
                                                if($_SESSION['lang'] == "th") { ?>
                                                    <?php
                                                        foreach ($statuss as $status) { ?>
                                                            <option value="<?= $status['status_id'] ?>"><?= $status['status_name_th'] ?></option>
                                                        <?php }?>

                                              <?php  }
                                                else { ?>
                                                    <?php
                                                        foreach ($statuss as $status) { ?>
                                                            <option value="<?= $status['status_id'] ?>"><?= $status['status_name_en'] ?></option>
                                                        <?php } ?>

                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="ProjectValue" class="form-label"><?= $lang['projects']['view_projects']['project_value'] ?></label>
                                        <input type="text" class="form-control" id="project_value" name="project_value" placeholder="<?= $lang['projects']['view_projects']['placeholder']['project_value'] ?>" autocomplete="off"/>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="ProjectArea" class="form-label"><?= $lang['projects']['view_projects']['project_area'] ?></label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" class="form-control" id="project_area" name="project_area" placeholder="<?= $lang['projects']['view_projects']['placeholder']['project_area'] ?>" autocomplete="off"/>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="ProjectLocationTH" class="form-label"><?= $lang['projects']['view_projects']['project_location_th'] ?></label>
                                        <div class="input-group input-group-merge">
                                            <textarea class="form-control" aria-label="With textarea" id="project_location_th" name="project_location_th" placeholder="<?= $lang['projects']['view_projects']['placeholder']['project_location_th'] ?>" autocomplete="off"></textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="ProjectLocationEN" class="form-label"><?= $lang['projects']['view_projects']['project_location_en'] ?></label>
                                        <div class="input-group input-group-merge">
                                            <textarea class="form-control" aria-label="With textarea" id="project_location_en" name="project_location_en" placeholder="<?= $lang['projects']['view_projects']['placeholder']['project_location_en'] ?>" autocomplete="off"></textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="ProjectDescriptionTH" class="form-label"><?= $lang['projects']['view_projects']['project_description_th'] ?></label>
                                        <div class="input-group input-group-merge">
                                            <textarea class="form-control" aria-label="With textarea" id="project_description_th" name="project_description_th" placeholder="<?= $lang['projects']['view_projects']['placeholder']['project_description_th'] ?>" autocomplete="off"></textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="ProjectDescriptionEN" class="form-label"><?= $lang['projects']['view_projects']['project_description_en'] ?></label>
                                        <div class="input-group input-group-merge">
                                            <textarea class="form-control" aria-label="With textarea" id="project_description_en" name="project_description_en" placeholder="<?= $lang['projects']['view_projects']['placeholder']['project_description_en'] ?>" autocomplete="off"></textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="ProjectYearOfCommencement" class="form-label"><?= $lang['projects']['view_projects']['project_year_of_commencement'] ?></label>
                                        <input type="text" class="form-control" id="project_year_of_commencement" name="project_year_of_commencement" placeholder="<?= $lang['projects']['view_projects']['placeholder']['project_year_of_commencement'] ?>" autocomplete="off"/>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="ProjectYearOfCompletion" class="form-label"><?= $lang['projects']['view_projects']['project_year_of_completion'] ?></label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" class="form-control" id="project_year_of_completion" name="project_year_of_completion" placeholder="<?= $lang['projects']['view_projects']['placeholder']['project_year_of_completion'] ?>" autocomplete="off"/>
                                        </div>
                                    </div>

                                    <input type="hidden" name="user_action" id="user_action" value="<?=$_SESSION['username'];?>">
                                    <input type="hidden" name="user_role" id="user_role" value="<?=$_SESSION['user_role'];?>">
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2"><?= $lang['projects']['view_projects']['btn']['save'] ?></button>
                                    <button type="reset" class="btn btn-outline-secondary"><?= $lang['projects']['view_projects']['btn']['reset'] ?></button>
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


    <script type="text/javascript">
        $(document).on('keyup', '.search_owner_name', function(e) {
            var lang = '<?= $_SESSION['lang']; ?>';
            var searchQuery = $(this).val();
            if(searchQuery != '') {
                $.ajax({
                    url: "./Controllers/backEnd/OwnerController/OwnerController-search.php",
                    type: "POST",
                    data: {
                        keywords: searchQuery
                    },
                    dataType: "json",
                    success: function(response) {
                        let data = response.data;
                        html = '';
                        html += '<ul class="list-unstyled list_owner scroll-auto" id="show_owner">'
                        if(data.length > 0){
                            for(let i = 0; i < data.length; i++){
                                html += `<li class="list-group-item border-1 owner_row" id="${data[i].owner_id}">${data[i].owner_name}</li>`
                            }
                        }else{
                            let text = lang === "en" ? 'No search results found' : 'ไม่พบข้อมูลที่ค้นหา';
                            html += `<li class="list-group-item border-1 text-center">
							    ${text}
						    </li>`
                        }

                        html += '</ul>'
                        $(".search_owner_show").fadeIn();
                        $(".search_owner_show").html(html);
                    }
                });
            }
            else {
                $(".search_owner_show").fadeOut();
                $('.search_owner_id').val("")
            }
        });

        $(document).on("click", 'li.owner_row', function() {
            let text = $(this).text();
            let id = $(this).attr('id')
            $('.search_owner_name').val(text)
            $('.search_owner_id').val(id)

            $('.search_owner_show').html("");
            $('.search_owner_show').fadeOut();
        });


        $('#createProjectForm').on("submit", function(e) {
            e.preventDefault();
            var regex = new RegExp(/^\+?[0-9(),.-]+$/);

            //Validate Form
            if ($('#project_name_th').val() == '') {
                Swal.fire({
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['project']['name_th']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                });
            } 
            else if ($('#project_name_en').val() == '') {
                Swal.fire({
                    
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['project']['name_en']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                });
            } 
            else if ($('#project_category').val() == '') {
                Swal.fire({
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['project']['category']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                });
            } 
            else if ($('#project_owner').val() == '') {
                Swal.fire({
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['project']['owner']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                });
            } 
            else if ($('#project_scope').val() == '') {
                Swal.fire({
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['project']['scope']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                });
            } 
            else if ($('#project_type').val() == '') {
                Swal.fire({          
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['project']['type']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                });
            } 
            else if ($('#project_department').val() == '') {
                Swal.fire({              
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['project']['department']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                });
            } 
            else if ($('#project_status').val() == '') {
                Swal.fire({
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['project']['status']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                });
            } 
            else if ($('#project_value').val() == '') {
                Swal.fire({       
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['project']['value']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                });
            } 
            else if(!($('#project_value').val().match(regex))) {
                Swal.fire({       
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['project']['value_number']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                });
            }
            else if ($('#project_area').val() == '') {
                Swal.fire({       
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['project']['area']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                });
            } 
            else if(!($('#project_area').val().match(regex))) {
                Swal.fire({       
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['project']['area_number']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                });
            }
            else if ($('#project_location_th').val() == '') {
                Swal.fire({       
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['project']['location_th']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                });
            } 
            else if ($('#project_location_en').val() == '') {
                Swal.fire({       
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['project']['location_en']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                });
            } 
            else if ($('#project_description_th').val() == '') {
                Swal.fire({       
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['project']['description_th']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                });
            } 
            else if ($('#project_description_en').val() == '') {
                Swal.fire({       
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['project']['description_en']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                });
            } 
            else if ($('#project_year_of_commencement').val() == '') {
                Swal.fire({       
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['project']['year_of_commencement']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                });
            }
            else if(!($('#project_year_of_commencement').val().match(regex))) {
                Swal.fire({       
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['project']['year_of_commencement_number']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                });
            } 
            else if ($('#project_year_of_completion').val() == '') {
                Swal.fire({       
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['project']['year_of_completion']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                });
            } 
            else if(!($('#project_year_of_completion').val().match(regex))) {
                Swal.fire({       
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['project']['year_of_completion_number']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                });
            }
            else {
                var createProjectForm = $(this).serialize();
                var userRole = '<?=$_SESSION['user_role']?>';

                $.ajax({
                    type: "POST",
                    url: "./Controllers/backEnd/ProjectController/ProjectController-insert.php",
                    data: createProjectForm,
                    dataType: "JSON",
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
                                        window.location = "projects.php";
                                    }
                                    else {
                                        window.location = "awaiting-review-project.php";
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
                                    window.location = "create-project.php";
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