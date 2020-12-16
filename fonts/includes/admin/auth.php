<?php
	
	if(!defined('BEZ_KEY')){
		header('Location:/');
		exit;
	}

	require './includes/conf.php';

	$mysqli = new mysqli($db_host, $db_username, $db_password, $db_name);

	if ($mysqli->connect_errno) {
		 echo "Извините, возникла проблема на сайте";
		 echo "Ошибка номер: " . $mysqli->connect_errno . "\n";
		 exit;
	}

	$sql = "SELECT * FROM admin";

	$result = $mysqli->query($sql);
	
	if ($result->num_rows === 0) {
		echo "Извините, возникла проблема на сайте";
	}

	$message = '';
	while ($users = $result->fetch_assoc()) {
		if ($users['pass'] == $password && $users['login'] == $login) {
			$_SESSION['name'] = '1';
			header('Location: /vhod');
		} else {

			$message = "Неверный логин или пароль";
			require_once "login.php";
		}
	}
