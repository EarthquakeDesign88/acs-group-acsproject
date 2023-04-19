<?php
    // Auto load
    if($_SERVER["SERVER_NAME"] == 'localhost' || $_SERVER["SERVER_NAME"] == '127.0.0.1'){
        $ENVIRONMENT_KEY = "PPE";

        require $_SERVER['DOCUMENT_ROOT'] . "/acs-groups/backoffice/acs-project/vendor/autoload.php";

    }else{
        $ENVIRONMENT_KEY = "PROD";

        require $_SERVER['DOCUMENT_ROOT'] . "/backoffice/acs-project/vendor/autoload.php";
    }


    //Multiple Languages
    if (!isset($_SESSION['lang'])) {
        $_SESSION['lang'] = "en";
    }
    else if (isset($_GET['lang']) && $_SESSION['lang'] != $_GET['lang'] && !empty($_GET['lang'])) {
        if ($_GET['lang'] == "en") {
            $_SESSION['lang'] = "en";
        }
        else if ($_GET['lang'] == "th") {
            $_SESSION['lang'] = "th";
        }
    }
    require_once "languages/" . $_SESSION['lang'] . ".php";

?>