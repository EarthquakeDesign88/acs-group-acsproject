<?php 
    if($_SERVER["SERVER_NAME"] == 'localhost' || $_SERVER["SERVER_NAME"] == '127.0.0.1'){
        require $_SERVER['DOCUMENT_ROOT'] . "/acs-groups/backoffice/acs-project/config/app.php";
    }else{
        require $_SERVER['DOCUMENT_ROOT'] . "/backoffice/acs-project/config/app.php";
    }
        
    session_start();

    use App\Models\Project;

    if(isset($_POST['project_id'])) {
        $project_id = $_POST['project_id'];
        $projectObj = new Project;
        $projects = $projectObj->viewImageGallery($project_id);
  
        $decode_image = json_decode($projects[0]['project_image']);
  
        $countImages = count($decode_image);
  
        $content = '';
        
        $content .= '<div class="gallery">';
                        //Config css styles for image 1 picture or geather than 1 pictures
                        if($countImages == 1) {
                            foreach($decode_image as $image) {
                                $content .= '<div class="box"><a href="./uploads/project-images/'. $image .'" data-lightbox="models"';
                                    foreach($projects as $project) {
                                        if($_SESSION['lang'] == "th") { 
                                            $projectName = $project['project_name_th'];
                                            $title_button = "ดาวโหลดรูปภาพ";
                                        }
                                        else {
                                            $projectName = $project['project_name_en'];
                                            $title_button = "Download Image";
                                        }    
                                        
                                  
                                        $content .= 'data-title="' .$projectName. '">
                                                        <img src="./uploads/project-images/'. $image .'">
                                                        <a href="./uploads/project-images/'. $image .'" download><i class="download-btn bx bx-download" title="'. $title_button .'"></i></a>
                                                    </a>
                                             </div>';
                                        }
                            }
                        }
                        else {
                            foreach($decode_image as $image) {
                                $content .= '<div class="box"><a href="./uploads/project-images/'. $image .'" data-lightbox="models"';
                                    foreach($projects as $project) {
                                        if($_SESSION['lang'] == "th") { 
                                            $projectName = $project['project_name_th'];
                                            $title_button = "ดาวโหลดรูปภาพ";
                                        }
                                        else {
                                            $projectName = $project['project_name_en'];
                                            $title_button = "Download Image";
                                        }  
                                  
                                        $content .= 'data-title="' .$projectName. '">
                                                        <img src="./uploads/project-images/'. $image .'">
                                                        <a href="./uploads/project-images/'. $image .'" download><i class="download-btn bx bx-download" title="'. $title_button .'"></i></a>
                                                    </a>
                                             </div>';
                                        }
                            }
                        }
        $content .= '</div>';
                
        $response = [
            'status' => 'success',
            'message' => 'Get images modal',
            'content' => $content
        ];
    
        echo json_encode($response);
      
    }
    else {
        $response = [
            'status' => 'error',
            'message' => 'Unable to retrieve image',
        ];
    
        echo json_encode($response);
    }

?>