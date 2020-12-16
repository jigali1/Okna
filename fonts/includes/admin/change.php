<?php
 
	if(!defined('BEZ_KEY')){
			header('Location:/');
			exit;
		}

	if (!isset($_SESSION['name']) && $_SESSION['name'] != '1' ) {
		exit;
	}
	if ($_POST['type'] == '') {
		exit;			
	}

	$type = $_POST['type'];
	

	require_once './includes/conf.php';

	$mysqli = mysqli_connect($db_host, $db_username, $db_password, $db_name);

	switch ($type) {
		case 'email':
			$value = $_POST['new_value'];
			$sql = "UPDATE `settings` SET `value` = '$value' WHERE `settings`.`props` = 'email'";
			break;

		case 'phone':
			$value = $_POST['new_value'];
			$sql = "UPDATE `settings` SET `value` = '$value' WHERE `settings`.`props` = 'tel'";
			break;

		case 'vis_email':
			$value = $_POST['new_value'];
			$sql = "UPDATE `settings` SET `value` = '$value' WHERE `settings`.`props` = 'vis_email'";
			break;

		case 'adress':
			$value = $_POST['new_value'];
			$sql = "UPDATE `settings` SET `value` = '$value' WHERE `settings`.`props` = 'adress'";
			break;

		case 'price':
			if ($_POST['price1'] && $_POST['price2'] && $_POST['price1']) {
				$price1 = $_POST['price1'];
				$price2 = $_POST['price2'];
				$price3 = $_POST['price3'];
				$sql = "UPDATE `prices` SET `price1`='$price1', `price2`='$price2', `price3` = '$price3' WHERE `prices`.`id` = '1'";

			}
			break;
	}

	if (isset($sql) && mysqli_query($mysqli, $sql)) {
		echo "Ваш запрос успешно выполнен!";
	} else {
		echo "Произошла ошибка на сервере. Сообщите администратору!";
	}

	


	exit;

?>