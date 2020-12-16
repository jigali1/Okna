<?php

if(!defined('BEZ_KEY')){
			header('Location:/');
			exit;
		}
	if (!isset($_SESSION['name']) && $_SESSION['name']) {
		include_once './includes/admin/login.php';
		exit;
	}

	if (!isset($_POST['pic_elem'])) {
		exit;
	}
	
	require_once './includes/conf.php';

	$mysqli = mysqli_connect($db_host, $db_username, $db_password, $db_name);

	foreach ($_POST['pic_elem'] as $key => $value) {
		$elem = '.'. $value;
		$sql = "DELETE FROM `slider` WHERE `path`='$elem'";
		if (!mysqli_query($mysqli, $sql)){
			echo 'Что то пошло не так!'. mysqli_error($mysqli);
		exit;
		} 
		unlink($elem);
	}
	header('Location: /vhod/settings');
?>