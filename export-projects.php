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
    use App\Models\Department;
    use App\Models\Type;
    use App\Models\Status;
    use App\Models\ScopeOfService;
    use App\Models\Project;

    if(!($_SESSION['authenticated'])){  
        $auth->redirect('./login.php');
    }
    else {
        $projectObj = new Project();
        $categoryObj = new Category();
        $departmentObj = new Department();
        $typeObj = new Type();
        $statusObj = new Status();
        $scopeObj = new ScopeOfService();

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


    <link rel="stylesheet" href="./assets/css/preloader.css">

    <link rel="stylesheet" href="./assets/vendor/libs/jquery-year-picker/css/yearpicker.css" />
</head>

<style>
    .container {
        padding: 10px 15%;
    }

    .gallery {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        grid-gap: 30px;
    }

    .gallery img{
        width: 100%;
        height: 250px;
    }
    .button-right{
        display: flex;
        justify-content: flex-end;
    }
</style>

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
                        <?= $lang['projects']['export_projects']['title_header'] ?>
                    </h3>
                </div>
                <div class="col-4 button-right" id="button_ex"></div>
            </div>

            <div class="card">
                <div class="row px-3">
                    <div class="col-md-3 p-3">
                        <label class="form-label" for="basic-url"> <?= $lang['projects']['export_projects']['project_department'] ?></label>
                        <select class="form-select search_filter" name="search_dep" aria-label="Default select example">
                            <?php 
                                $menu_th = $lang['projects']['view_projects']['placeholder']['select_project_department'];
                                $menu_en = $lang['projects']['view_projects']['placeholder']['select_project_department'];
                                $menu =  $_SESSION['lang'] == "th" ? $menu_th : $menu_en; 
                            ?>

                            <option value=""><?= $menu ?></option>

                            <?php

                            $departmentObj = new Department();
                            $departments = $departmentObj->getAllDepartments(); 
                            
                            foreach ($departments as $department) { 
                                if($_SESSION['lang'] == "th") { ?>
                                    <option value="<?= $department['department_id'] ?>"><?= $department['department_desc'] ?></option>
                                <?php } 
                                else { ?>
                                    <option value="<?= $department['department_id'] ?>"><?= $department['department_name'] ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-3 p-3">
                        <label class="form-label" for="basic-url"><?= $lang['projects']['export_projects']['project_category'] ?></label>
                        <select class="form-select search_filter" name="search_cate" aria-label="Default select example">

                            <?php 
                                $menu_th = $lang['projects']['view_projects']['placeholder']['select_project_category'];
                                $menu_en = $lang['projects']['view_projects']['placeholder']['select_project_category'];
                                $menu =  $_SESSION['lang'] == "th" ? $menu_th : $menu_en; 
                            ?>

                            <option value=""><?= $menu ?></option>

                            <?php

                            $categoryObj = new Category();
                            $categories = $categoryObj->getAllCategories();

                            foreach ($categories as $category) { if($_SESSION['lang'] == "th") { ?>
                                    <option value="<?= $category['pcategory_id'] ?>"><?= $category['pcategory_name_th'] ?></option>
                                <?php } else { ?>
                                    <option value="<?= $category['pcategory_id'] ?>"><?= $category['pcategory_name_en'] ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-3 p-3">
                        <label class="form-label" for="basic-url"><?= $lang['projects']['export_projects']['project_type'] ?></label>
                        <select class="form-select search_filter" name="search_type" aria-label="Default select example">
                            
                            <?php 
                                $menu_th = $lang['projects']['view_projects']['placeholder']['select_project_type'];
                                $menu_en = $lang['projects']['view_projects']['placeholder']['select_project_type'];
                                $menu =  $_SESSION['lang'] == "th" ? $menu_th : $menu_en; 
                            ?>

                            <option value=""><?= $menu ?></option>

                            <?php

                            $typeObj = new Type();
                            $types = $typeObj->getAllTypes();

                            foreach ($types as $type) { if($_SESSION['lang'] == "th") { ?>
                                    <option value="<?= $type['type_id'] ?>"><?= $type['type_name_th'] ?></option>
                                <?php } else { ?>
                                    <option value="<?= $type['type_id'] ?>"><?= $type['type_name_en'] ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-3 p-3">
                        <label class="form-label" for="basic-url"><?= $lang['projects']['export_projects']['project_status'] ?></label>
                        <select class="form-select search_filter" name="search_status" aria-label="Default select example">
                            
                            <?php 
                                $menu_th = $lang['projects']['view_projects']['placeholder']['select_project_status'];
                                $menu_en = $lang['projects']['view_projects']['placeholder']['select_project_status'];
                                $menu =  $_SESSION['lang'] == "th" ? $menu_th : $menu_en; 
                            ?>

                            <option value=""><?= $menu ?></option>

                            <?php

                            $statusObj = new Status();
                            $statuss = $statusObj->getAllStatus();

                            foreach ($statuss as $status) { if($_SESSION['lang'] == "th") { ?>
                                    <option value="<?= $status['status_id'] ?>"><?= $status['status_name_th'] ?></option>
                                <?php } else { ?>
                                    <option value="<?= $status['status_id'] ?>"><?= $status['status_name_en'] ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row px-3">
                    <div class="col-md-4 p-3">
                        <label class="form-label" for="basic-url"><?= $lang['projects']['export_projects']['project_scope'] ?></label>
                        <select class="form-select search_filter" name="search_scope" aria-label="Default select example">
                            
                            <?php 
                                $menu_th = $lang['projects']['view_projects']['placeholder']['select_project_status'];
                                $menu_en = $lang['projects']['view_projects']['placeholder']['select_project_status'];
                                $menu =  $_SESSION['lang'] == "th" ? $menu_th : $menu_en; 
                            ?>

                            <option value=""><?= $menu ?></option>

                            <?php

                            $scopeObj = new ScopeOfService();
                            $scopes = $scopeObj->getAllScopeOfServices();

                            foreach ($scopes as $scope) { if($_SESSION['lang'] == "th") { ?>
                                    <option value="<?= $scope['scope_id'] ?>"><?= $scope['scope_name_th'] ?></option>
                                <?php } else { ?>
                                    <option value="<?= $scope['scope_id'] ?>"><?= $scope['scope_name_en'] ?></option>
                                <?php } ?>
                            <?php } ?>
                            ?>
                        </select>
                    </div>
                    <div class="col-md-8 p-3 search_owner">
                        <label class="form-label" for="basic-url"><?= $lang['projects']['export_projects']['project_owner'] ?></label>
                        <input type="text" class="form-control search_owner_name " placeholder="<?= $lang['projects']['view_projects']['placeholder']['select_project_owner'] ?>" name="search_owner" autocomplete="off">
                        <input type="hidden" class="form-control search_owner_id search_filter" name="search_owner">
                        <div class="search_owner_show"></div>
                    </div>
                </div>
                <div class="row px-3 mt-3">
                    <div class="col-md-6 p-3">
                        <div class="fieldset form-group border p-3 form-control">
                            <label class="form-label" for="basic-url"><?= $lang['projects']['export_projects']['project_year_of_commencement'] ?></label>
                            <div class="input-group input-daterange">
                                <input type="text" class="yearpicker form-control search_filter" name="commencement_dt" placeholder="<?= $lang['projects']['export_projects']['year']['choose_start_year'] ?>" id="check_commencement_dt" autocomplete="off">
                                <div class="align-self-center">&nbsp;&nbsp;-&nbsp;&nbsp;</div>
                                <input type="text" class="yearpicker form-control search_filter" name="commencement_df" placeholder="<?= $lang['projects']['export_projects']['year']['choose_end_year'] ?>" id="check_commencement_df" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 p-3">
                        <div class="fieldset form-group border p-3 form-control">
                            <label class="form-label" for="basic-url"><?= $lang['projects']['export_projects']['project_year_of_completion'] ?></label>
                            <div class="input-group input-daterange">
                                <input type="text" class="yearpicker form-control search_filter" name="completion_dt" placeholder="<?= $lang['projects']['export_projects']['year']['choose_start_year'] ?>" id="check_completion_dt" autocomplete="off">
                                <div class="align-self-center">&nbsp;&nbsp;-&nbsp;&nbsp;</div>
                                <input type="text" class="yearpicker form-control search_filter" name="completion_df" placeholder="<?= $lang['projects']['export_projects']['year']['choose_end_year'] ?>" id="check_completion_df" autocomplete="off">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row px-3">
                    <div class="col-md-6 p-3">
                        <button class="btn btn-primary" id="btnSearch"><?= $lang['projects']['export_projects']['btn']['search'] ?></button>
                    </div>
                </div>

                <hr>

                <div class="card visually-hidden" id="header-table">
                    <div class="table-responsive text-nowrap">
                        <table class="table" id="search_Table">
                            <thead class="th-resp">
                                 <tr>
                                    <th><?= $lang['projects']['export_projects']['table']['no_col'] ?></th>
                                    <th><?= $lang['projects']['export_projects']['table']['project_name_col'] ?></th>
                                    <th><?= $lang['projects']['export_projects']['table']['project_category_col'] ?></th>
                                    <th><?= $lang['projects']['export_projects']['table']['project_type_col'] ?></th>
                                    <th><?= $lang['projects']['export_projects']['table']['project_owner_col'] ?></th>
                                    <th><?= $lang['projects']['export_projects']['table']['project_scope_col'] ?></th>
                                    <th><?= $lang['projects']['export_projects']['project_department'] ?></th>
                                    <th><?= $lang['projects']['export_projects']['table']['project_location_col'] ?></th>
                                    <th><?= $lang['projects']['export_projects']['table']['project_description_col'] ?></th>
                                    <th><?= $lang['projects']['export_projects']['table']['project_area_col'] ?></th>
                                    <th><?= $lang['projects']['export_projects']['table']['project_value_col'] ?></th>
                                    <th><?= $lang['projects']['export_projects']['table']['project_year_of_commencement_col'] ?></th>
                                    <th><?= $lang['projects']['export_projects']['table']['project_year_of_completion_col'] ?></th>
                                    <th><?= $lang['projects']['export_projects']['table']['project_status_col'] ?></th>
                                 </tr>
                            </thead>
                        </table>
                        
                    </div>

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

    <!-- Light Box  -->
    <script type="text/javascript" src="./assets/vendor/libs/lightbox2/js/lightbox.js"></script>

    <script type="text/javascript" src="./assets/vendor/libs/jquery-year-picker/js/yearpicker.js"></script>

    <!-- test -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#search_Table').DataTable({
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

        $(document).on('keyup', '.search_owner_name', function(e) {
            var searchQuery = $(this).val();
            var lang = '<?= $_SESSION['lang']; ?>';
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
                        html += '<ul class="list-unstyled list_owner scroll-auto" id="show_data">'
                        if(data.length > 0){
                            for(let i = 0; i < data.length; i++){
                                html += `<li class="list-group-item list-group-item-action border-1 owner_row" id="${data[i].owner_id}">${data[i].owner_name}</li>`
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

        $(document).on('click', '#btnSearch', function() {

            var data = $('.search_filter');
            var lang = '<?= $_SESSION['lang']; ?>';
            var no_col = '<?= $lang['projects']['export_projects']['table']['no_col'] ?>';
            var project_name_col = '<?= $lang['projects']['export_projects']['table']['project_name_col'] ?>';
            var project_category_col = '<?= $lang['projects']['export_projects']['table']['project_category_col'] ?>';
            var project_type_col = '<?= $lang['projects']['export_projects']['table']['project_type_col'] ?>';
            var project_owner_col = '<?= $lang['projects']['export_projects']['table']['project_owner_col'] ?>';
            var project_scope_col = '<?= $lang['projects']['export_projects']['table']['project_scope_col'] ?>';
            var project_department_col = '<?= $lang['projects']['export_projects']['project_department'] ?>';
            var project_location_col = '<?= $lang['projects']['export_projects']['table']['project_location_col'] ?>';
            var project_description_col = '<?= $lang['projects']['export_projects']['table']['project_description_col'] ?>';
            var project_area_col = '<?= $lang['projects']['export_projects']['table']['project_area_col'] ?>';
            var project_value_col = '<?= $lang['projects']['export_projects']['table']['project_value_col'] ?>';
            var project_year_of_commencement_col = '<?= $lang['projects']['export_projects']['table']['project_year_of_commencement_col'] ?>';
            var project_year_of_completion_col = '<?= $lang['projects']['export_projects']['table']['project_year_of_completion_col'] ?>';
            var project_status_col = '<?= $lang['projects']['export_projects']['table']['project_status_col'] ?>';

            var check_data = {};
            $("#header-table").removeClass("visually-hidden");

            for(let i = 0; i < data.length; i++){
                var _attr = $(data[i]).attr('name');
                var _val = $(data[i]).val();
                check_data[_attr] = _val;
            }


            $.ajax({
                type: "POST",
                url: "./Controllers/backEnd/ProjectController/ProjectController-search.php",
                data: {
                    check_data
                },
                dataType: 'json',
                success: function(response) {
                    data = response.data      
                    for(let i = 0; i < data.length; i++){
                        data[i]['number'] = i + 1;
                    }       
                    var table = $('#search_Table').DataTable({
                        "pageLength": "50",
                        destroy: true,
                        "searching": false,
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
                        },
                        buttons: [
                            {
                                text: '<?= $lang['projects']['export_projects']['btn']['export_excel'] ?>',
                                className: 'button_ex',
                                extend: 'excel',
                            },
                        ],
                        data: data,
                        columns: [
                            { data: 'number' },
                            { data: lang === "en" ? 'project_name_en' : 'project_name_th' },
                            { data: lang === "en" ? 'pcategory_name_en' : 'pcategory_name_th' },
                            { data: lang === "en" ? 'type_name_en' : 'type_name_th' },
                            { data: lang === "en" ? 'owner_name_en' : 'owner_name_th' },
                            { data: lang === "en" ? 'scope_name_en' : 'scope_name_th' },
                            { data: 'department_name' },
                            { data: lang === "en" ? 'project_location_en' : 'project_location_th' },
                            { data: lang === "en" ? 'project_description_en' : 'project_description_th' },
                            { data: 'project_area' },
                            { data: 'project_value' },
                            { data: 'project_year_of_commencement' },
                            { data: 'project_year_of_completion' },
                            { data: lang === "en" ? 'status_name_en' : 'status_name_th' }
                        ],
                        createdRow: function(row, data, dataIndex) {
                            $( row ).find('td:eq(0)').attr('data-label', no_col).addClass('ellipsis-ex-sup'),
                            $( row ).find('td:eq(1)').attr('data-label', project_name_col).addClass('ellipsis-ex'),
                            $( row ).find('td:eq(2)').attr('data-label', project_category_col).addClass('ellipsis-ex-sup'),
                            $( row ).find('td:eq(3)').attr('data-label', project_type_col).addClass('ellipsis-ex-sup'),
                            $( row ).find('td:eq(4)').attr('data-label', project_owner_col).addClass('ellipsis-ex-sup'),
                            $( row ).find('td:eq(5)').attr('data-label', project_scope_col).addClass('ellipsis-ex-sup'),
                            $( row ).find('td:eq(6)').attr('data-label', project_department_col).addClass('ellipsis-ex-sup'),
                            $( row ).find('td:eq(7)').attr('data-label', project_location_col).addClass('ellipsis-ex-sup'),
                            $( row ).find('td:eq(8)').attr('data-label', project_description_col).addClass('ellipsis-ex'),
                            $( row ).find('td:eq(9)').attr('data-label', project_area_col).addClass('ellipsis-ex-sup')
                            $( row ).find('td:eq(10)').attr('data-label', project_value_col).addClass('ellipsis-ex-sup')
                            $( row ).find('td:eq(11)').attr('data-label', project_year_of_commencement_col).addClass('ellipsis-ex-sup')
                            $( row ).find('td:eq(12)').attr('data-label', project_year_of_completion_col).addClass('ellipsis-ex-sup')
                            $( row ).find('td:eq(13)').attr('data-label', project_status_col).addClass('ellipsis-ex-sup')
                        },
                        columnDefs:
                        [
                            {
                                targets: 9,
                                render: $.fn.dataTable.render.number(',', '.', 2, '')
                            },
                            {
                                targets: 10,
                                render: $.fn.dataTable.render.number(',', '.', 2, '')
                            }
                        ]
                    });
                    table.buttons().container().appendTo($('#button_ex'));
                }
            })
        });

    </script>

    <?php
        // Set Year Format
        $year = $projectObj->setYearFormat();

        $oldestYear = $year[0];
        $currentYear = $year[1]

    ?>
    
    <script type="text/javascript">
        $(document).ready(function() {
            $(".yearpicker").yearpicker({
                year: '',
                startYear: <?= $oldestYear ?>,
                endYear: <?= $currentYear ?>,
            });
        });
    </script>

</body>

</html>

<?php }?>

