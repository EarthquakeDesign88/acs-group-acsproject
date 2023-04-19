<?php
    include_once('./Controllers/Auth/LoginController.php');

	$userLogout = new LoginController;
	$userLogout->logout();

?>