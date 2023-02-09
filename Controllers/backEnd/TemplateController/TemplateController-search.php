<?php
    if($_SERVER["SERVER_NAME"] == 'localhost' || $_SERVER["SERVER_NAME"] == '127.0.0.1'){
        require $_SERVER['DOCUMENT_ROOT'] . "/acs-groups/backoffice/acs-project/config/app.php";
    }else{
        require $_SERVER['DOCUMENT_ROOT'] . "/backoffice/acs-project/config/app.php";
    }

    date_default_timezone_set('Asia/Bangkok');

    use App\Models\Template;

    if(isset($_POST)) {
        $keywords = $_POST['keywords'];
        $output_search = '';
        
        $templateObj = new Template;
        $seachQuery = $templateObj->searchProject($keywords);

        $outputSearch = $seachQuery;
        $response = [
            'status' => 'success',
            'message' => 'Search success',
            'outputSearch' => $outputSearch
        ];
    
        echo json_encode($response);   
      
    }

?>