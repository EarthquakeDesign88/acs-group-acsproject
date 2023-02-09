<?php
    session_start();

    if($_SERVER["SERVER_NAME"] == 'localhost' || $_SERVER["SERVER_NAME"] == '127.0.0.1'){
        require $_SERVER['DOCUMENT_ROOT'] . "/acs-groups/backoffice/acs-project/config/app.php";
    }else{
        require $_SERVER['DOCUMENT_ROOT'] . "/backoffice/acs-project/config/app.php";
    }
    
    include_once('./Controllers/Auth/LoginController.php');

    $auth = new LoginController();

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
    <title>Create Template</title>
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
                            <h3 class="card-title text-primary"><?= $lang['templates']['create_template_header'] ?> <span id="load-data"></span></h3>
                        </div>
                        <div class="col-6">
                            <a href="./templates.php"><button type="button" class="btn btn-primary float-end"><?= $lang['templates']['btn']['back'] ?></button></a>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <form id="createTemplateForm">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="TemplateName" class="form-label"><?= $lang['templates']['template_name'] ?></label>
                                        <input type="text" class="form-control" id="template_name" name="template_name" placeholder="<?= $lang['templates']['placeholder']['template_name'] ?>" autocomplete="off"/>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="TemplateLanguage" class="form-label"><?= $lang['templates']['template_language'] ?></label>
                                        <select id="template_language" name="template_language" class="select2 form-select">
                                            <option value=""><?= $lang['templates']['placeholder']['template_language'] ?></option>
                                            <option value="TH"><?= $lang['lang_th'] ?></option>
                                            <option value="EN"><?= $lang['lang_en'] ?></option>                  
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="Project" class="form-label"><?= $lang['templates']['add_project'] ?>
                                            <button type="button" class="btn btn-icon btn-info" onclick="addInput()">
                                                <span class="tf-icons bx bxs-plus-circle"></span>
                                            </button>
                                        </label>
                                    </div>

                                    <input type="hidden" name="user_created" id="user_created" value="<?=$_SESSION['username'];?>">

                                    <div id="show_list"></div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2"><?= $lang['templates']['btn']['save'] ?></button>
                                    <button type="reset" class="btn btn-outline-secondary"><?= $lang['templates']['btn']['reset'] ?></button>
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
        $(document).on("keyup", '.search_project', function() {
            var searchText = $(this).val();
            var parent_list = $(this).parent().parent();
            var show_list = $(parent_list).find(".show_list");
            
            if(searchText != '') {
                $.ajax({
                    type: "POST",
                    url: "./Controllers/backEnd/TemplateController/TemplateController-search.php",
                    data: {
                        keywords: searchText
                    },
                    dataType: "json",
                    success: function(response) {
                        $(show_list).fadeIn();
                        $(show_list).html(response.outputSearch);
                    }
                });
            }
            else {
                $(show_list).fadeOut();
            }
        });


        $(document).on("click", 'li.project_row', function() {
            let parent_ul = $(this).parent().parent().parent();
            let text_input = $(parent_ul).find(".search_project");
            $(text_input).val($(this).text());

            let id = $(this).attr("id");
            let project_id = $(parent_ul).find("#project_id");
            $(project_id).val(id);

            $('.show_list').html("");
            $('.show_list').fadeOut();
        });


        $(document).ready(function() {
            $('#createTemplateForm').on("submit", function(e) {
                e.preventDefault();

                //Validate Form
                if($('#template_name').val() == '') {
                    Swal.fire({
                        icon: 'warning',
                        title: '<?= $lang['alert']['validate_title']['template']['name']; ?>',
                        text: '<?= $lang['alert']['confirm_action']; ?>',
                        confirmButtonColor: 'rgb(0 67 255)',
                        confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                        allowOutsideClick: false
                    });
                } 
                else if($('#template_language').val() == '') {
                    Swal.fire({
                        icon: 'warning',
                        title: '<?= $lang['alert']['validate_title']['template']['language']; ?>',
                        text: '<?= $lang['alert']['confirm_action']; ?>',
                        confirmButtonColor: 'rgb(0 67 255)',
                        confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                        allowOutsideClick: false
                    });
                } 
                else if($('.tdetail').length == 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: '<?= $lang['alert']['validate_title']['template']['count_project']; ?>',
                        text: '<?= $lang['alert']['confirm_action']; ?>',
                        confirmButtonColor: 'rgb(0 67 255)',
                        confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                        allowOutsideClick: false
                    });
                } 
                else {
                    let project_id = $('.project_id');
                    let data_id = {};
                    let all_projectId = [];
                    let templateName = $('#template_name').val();
                    let templateLanguage = $('#template_language').val();
                    let userCreated = $('#user_created').val();


                    for(let i = 0; i < project_id.length; i++){
                        let _attr = $(project_id[i]).attr("name")
                        let _val = $(project_id[i]).val()

                        if(_val == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: '<?= $lang['alert']['validate_title']['template']['project']; ?>',
                                text: '<?= $lang['alert']['confirm_action']; ?>',
                                confirmButtonColor: 'rgb(0 67 255)',
                                confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                                allowOutsideClick: false
                            });

                            return;
                        }
                        else {
                            data_id[_attr] = _val;
                            all_projectId.push(data_id);
                            data_id = {};      
                        }              
                    }

                    $.ajax({
                        type: "POST",
                        url: "./Controllers/backEnd/TemplateController/TemplateController-insert.php",
                        data: {
                            all_projectId: all_projectId,
                            template_name: templateName,
                            template_language: templateLanguage,
                            user_created: userCreated
                        },
                        dataType: "json",
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
                                        window.location = "templates.php";
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
                                        window.location = "create-template.php";
                                    }
                                })
                            }
                        }
                    });
                }
            });
        });
    </script>
    
    <script type="text/javascript">
        var i = 1;

        function addInput(){
            let count_add = $(".tdetail");
            let i = 1 + count_add.length;

            html = ''
            html += `
                <div class="mb-3 col-md-6 tdetail" id="tdetail${i}">
                    <div class="input-group">
                        <span class="input-group-text number_text">${i}</span>
                        <input type="text" class="form-control search_project" id="search_project" placeholder="<?= $lang['templates']['placeholder']['select_project']?>" autocomplete="off">
                        <button type="button" class="btn btn-icon btn-danger" onclick="deleteInput(${i})">
                            <span class="tf-icons bx bxs-trash"></span>
                        </button>
                        <input type="hidden" class="project_id" name="project_id" id="project_id" value=""/>
                    </div>
                    <div class="show_list" id="list${i}"></div>  
                </div>
            `
            i++
           
            $("#show_list").append(html);			
        }

        function deleteInput(id){
            let tdetail = document.querySelector("#tdetail" + id);
            tdetail.remove();

            let count_tdetail = $(".tdetail");
            for(let i = 0; i < count_tdetail.length; i++){
                $(count_tdetail[i]).find('.number_text').text(i+1);
            }
        }
       
    </script>
</body>

</html>

<?php }?>