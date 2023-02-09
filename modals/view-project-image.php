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
        $content = '<div class="container row">';
      
        foreach($decode_image as $image) { 
            if($countImages > 1) {    
                $content .= '<div class="col-lg-4 col-md-12">
                    <div class="card mb-2">
                        <img src="./uploads/project-images/' .$image. '" class="card-img-top img-set" width="350" height="350">
                    </div>
                </div>';
            } else { 
                $content .= ' <div class="col-12">
                    <div class="card mb-2">
                        <img src="./uploads/project-images/' .$image. '" class="card-img-top img-set" width="350" height="450">
                    </div>
                </div>';
            }
        
        }

        $response = [
            'status' => 'success',
            'message' => 'Get image modal',
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