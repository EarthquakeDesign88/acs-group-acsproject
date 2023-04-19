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
        $project_id = $_GET['project_id'];

        $projectObj = new Project();
        $projects = $projectObj->getProjectById($project_id);

        foreach($projects as $project) {
            $projectNameTH = $project['project_name_th'];
            $projectNameEN = $project['project_name_en'];
            $images = $project['project_image'];
        }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project Image</title>
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
                        <div class="col-10">
                            <h3 class="card-title text-primary"><?= $lang['projects']['view_projects']['edit_project_image'] ?> 
                            <?php
                                if($_SESSION['lang'] == "th") { ?>
                                    <span class="badge bg-warning text-pname"><?= $projectNameTH ?></span> 
                            <?php   } else { ?>
                                    <span class="badge bg-warning text-pname"><?= $projectNameEN ?></span>
                            <?php    }
                            ?>                   
                            <span id="load-data"></span> 
                        </h3>
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-primary float-end" onclick="history.back()"><?= $lang['projects']['view_projects']['btn']['back'] ?></button>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <form id="imageUploadForm" enctype="multipart/form-data">
                                <div class="rox">
                                    <div class="mb-3 col-md-12">
                                        <label for="ProjectImage" class="form-label"><?= $lang['projects']['view_projects']['project_image'] ?></label>
                                        <input type="file" class="form-control" id="files" name="files[]" multiple>
                                    </div>
                                    <div class="img-thumbs" id="original-images">
                                        <?php      
                                            $projects = $projectObj->viewImageGallery($project_id);
                                            $decode_image = json_decode($projects[0]['project_image']);

                                            $countImages = count($decode_image);

                                            if($countImages > 0) {?>
                                                <span class="badge bg-danger float-end"><?= $lang['projects']['view_projects']['span']['original_image'] ?></span>
                                        <?php   
                                                    foreach($decode_image as $image) {  ?>
                                                        <div class="wrapper-thumb">
                                                            <img src="./uploads/project-images/<?= $image ?>" class="img-preview-thumb">
                                                        </div>
                                             <?php  
                                                    }
                                            }
                                            else {
                                                $show = $_SESSION['lang'] == "en" ? 'Image file was not found in directory' : 'ไม่พบไฟล์รูปภาพในระบบ';
                                                echo $show;
                                            } ?>
                                    
                                    </div>
                                    <div class="img-thumbs img-thumbs-hidden" id="img-preview"><span class="badge bg-success float-end"><?= $lang['projects']['view_projects']['span']['new_image'] ?></span></div>
                                </div>

                                <input type="hidden" name="project_id" value="<?=$project_id?>">
                                <input type="hidden" name="user_updated" id="user_updated" value="<?=$_SESSION['username'];?>">
                                <input type="hidden" name="user_role" id="user_role" value="<?=$_SESSION['user_role'];?>">
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary btn-hidden me-2" id="upload"><?= $lang['projects']['view_projects']['btn']['upload'] ?></button>
                                    <button type="reset" class="btn btn-danger btn-hidden me-2" id="reset" onclick="resetPreview();"><?= $lang['projects']['view_projects']['btn']['clear'] ?></button>
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

    <style>
        .img-thumbs {
            background: #eee;
            border: 1px solid #ccc;
            border-radius: 0.25rem;
            margin: 1.5rem 0;
            padding: 0.75rem;
        }
        
        .img-thumbs-hidden {
            display: none;
        }

        .btn-hidden {
            display: none;
        }

        .wrapper-thumb {
            position: relative;
            display:inline-block;
            margin: 1rem 0;
            justify-content: space-around;
        }

        .img-preview-thumb {
            background: #fff;
            border: 1px solid none;
            border-radius: 0.25rem;
            box-shadow: 0.125rem 0.125rem 0.0625rem rgba(0, 0, 0, 0.12);
            margin-right: 1rem;
            max-width: 140px;
            padding: 0.25rem;
        }

        .remove-btn{
            position:absolute;
            display:flex;
            justify-content:center;
            align-items:center;
            font-size:.7rem;
            top:-5px;
            right:10px;
            width:20px;
            height:20px;
            background:white;
            border-radius:10px;
            font-weight:bold;
            cursor:pointer;
        }

        .remove-btn:hover{
            box-shadow: 0px 0px 3px grey;
            transition:all .3s ease-in-out;
        }
    </style>


    <script type="text/javascript">
        var imgUpload = document.getElementById('files')
        , imgPreview = document.getElementById('img-preview')
        , imgUploadForm = document.getElementById('imageUploadForm')
        , totalFiles
        , previewTitle
        , previewTitleText
        , img
        , originalImages = document.getElementById('original-images');

        imgUpload.addEventListener('change', previewImgs, true);

        function previewImgs(e) {
            totalFiles = imgUpload.files.length;
            if(!!totalFiles) {
                imgPreview.classList.remove('img-thumbs-hidden');
                reset.classList.remove('btn-hidden');
                originalImages.classList.add('img-thumbs-hidden');
                upload.classList.remove('btn-hidden');
            }
        
            for(var i = 0; i < totalFiles; i++) {
                wrapper = document.createElement('div');
                wrapper.classList.add('wrapper-thumb');
                removeBtn = document.createElement("span");
                nodeRemove= document.createTextNode('x');
                removeBtn.classList.add('remove-btn');
                removeBtn.appendChild(nodeRemove);
                img = document.createElement('img');
                img.src = URL.createObjectURL(e.target.files[i]);
                img.classList.add('img-preview-thumb');
                wrapper.appendChild(img);
                // wrapper.appendChild(removeBtn);
                imgPreview.appendChild(wrapper);
            
                $('.remove-btn').click(function(e){
                    $(this).parent('.wrapper-thumb').remove();
                    imgUpload[i].value = '';
                    img.classList.add('img-thumbs-hidden');
                });    

            }
        }

        function resetPreview() {
            // imgUpload[].value = '';
            imgPreview.classList.add('img-thumbs-hidden');
            window.location.reload();
            // URL.revokeObjectURL(img.src);
        }

    
        $('#imageUploadForm').on("submit", function(e) {
            e.preventDefault();
            totalFiles = imgUpload.files.length;

            //Validate Form
            if ($('#files').val() == '') {
                Swal.fire({
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['project']['image_file']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                });
            } 
            else if (totalFiles > 12) {
                Swal.fire({
                    icon: 'warning',
                    title: '<?= $lang['alert']['validate_title']['project']['count_file']; ?>',
                    text: '<?= $lang['alert']['confirm_action']; ?>',
                    confirmButtonColor: 'rgb(0 67 255)',
                    confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
            } 
            else {
                var imageUploadForm = new FormData(this);
                var userRole = '<?=$_SESSION['user_role']?>';
                var totalFiles = document.getElementById('files').files.length;

                imageUploadForm.append("files[]", document.getElementById('files').files);
                upload.classList.add('btn-hidden');
                reset.classList.add('btn-hidden');
          
                $.ajax({
                    type: "POST",
                    url: "./Controllers/backEnd/ProjectController/ProjectController-upload.php",
                    data: imageUploadForm,
                    dataType: "JSON",
                    contentType: false,
                    processData: false,
                    beforeSend:function() {
                        $('#load-data').html("<div class='spinner-border text-secondary' role='status'><span class='visually-hidden'>Loading...</span></div>");
                    },  
                    success: function(response) {
                        if (response.status == 'exceedsLimit') {
                            Swal.fire({
                                icon: 'warning',
                                title: response.message,
                                text: '<?= $lang['alert']['confirm_action']; ?>',
                                confirmButtonColor: 'rgb(0 67 255)',
                                confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                                allowOutsideClick: false
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            });
                        }
                        else if (response.status == 'wrongExtension') {
                            Swal.fire({
                                icon: 'warning',
                                title: response.message,
                                text: '<?= $lang['alert']['confirm_action']; ?>',
                                confirmButtonColor: 'rgb(0 67 255)',
                                confirmButtonText: '<?= $lang['alert']['ok']; ?>',
                                allowOutsideClick: false
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            });
                        }
                        else if (response.status == 'success') {
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
                            });
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
                                    window.location.reload();
                                }
                            });
                        }
                    }
                });
            }
        });
    </script>

</body>

</html>

<?php }?>