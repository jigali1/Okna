<?php
	
	if(!defined('BEZ_KEY')){
		header('Location:/');
		exit;
	}


	if (isset($arr_uri[2])) {


		switch ($arr_uri[2]){

			case 'login':
				if ($_POST['user'] != '' && $_POST['pass'] != '') {
					$login = $_POST['user'];
					$password = $_POST['pass'];
					include_once './includes/admin/auth.php';
					exit;
				}
			break;

			case 'logout':
				$_SESSION['name'] = '';
				header('Location:/');
				exit;
			break;

			case 'settings':

				if (isset($_SESSION['name']) && $_SESSION['name'] == '1' ) {
					include_once './includes/admin/settings.php';
					exit;
				}
			break;					
		}
	}

	if (isset($_SESSION['name']) && $_SESSION['name'] == '1' ) {
		include_once './includes/admin/main_admin.php';
		exit;
	}

	include_once './includes/admin/login.php';



?>