<?php

	if(!defined('BEZ_KEY')){
			header('Location:/');
			exit;
		}
	if (!isset($_SESSION['name']) && $_SESSION['name']) {
		include_once './includes/admin/login.php';
		exit;
	}

	if (isset($arr_uri[3])) {

		switch ($arr_uri[3]) {
			case 'change':
				include_once './includes/admin/change.php';
				exit;
			break;
			
			case 'upload':
				include_once './includes/admin/upload.php';
				exit;
			break;

			case 'delete':
				include_once './includes/admin/delete.php';
				exit;
			break;
		}
	}

	require_once './includes/conf.php';

	$mysqli = mysqli_connect($db_host, $db_username, $db_password, $db_name);

	$sql = "SELECT * FROM `slider`";

	if (!$response = mysqli_query($mysqli, $sql)){
		echo 'Что то пошло не так!'. mysqli_error($mysqli);
		exit;
	} 

	$pic_item = array();
	while ($result = mysqli_fetch_array($response)) {
		array_push($pic_item, ltrim($result['path'], '.'));
	}

	$sql = "SELECT * FROM `settings`";
	if (!$response = mysqli_query($mysqli, $sql)){
		echo 'Что то пошло не так!'. mysqli_error($mysqli);
		exit;
	} 
	while ($result = mysqli_fetch_array($response)) {
		switch ($result['props']) {
			case 'tel':
				$tel = $result['value'];
				break;
			
			case 'vis_email':
				$vis_email = $result['value'];
				break;

			case 'adress':
				$adress = $result['value'];
				break;

			case 'email':
				$email = $result['value'];
				break;
		}
	}

	$sql = "SELECT * FROM `prices`";
	if (!$response = mysqli_query($mysqli, $sql)){
		echo 'Что то пошло не так!'. mysqli_error($mysqli);
		exit;
	} 

	$result = mysqli_fetch_array($response);

	$price1 = $result['price1'];
	$price2 = $result['price2'];
	$price3 = $result['price3'];


?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">

	<title>Пластиковые окна ПВХ в Перми по низкой цене</title>
	
	<link rel="stylesheet" href="/css/settings.css">
</head>
<body>
	<a href="/vhod" class="logout button">Назад</a>
	<div class="flexbox">
		<div class="box">
			<form action="/vhod/settings/change" method="POST" class="settings">
				<p><label for='email'>изменить email(уведомлений) </label></p>
				<input type="text" value=<?=$email?> name='new_value' id='email' class="input" required>
				<input type="submit" value="Изменить" class="button">
				<input type="hidden" name="type" value="email">		
			</form>

			<form action="/vhod/settings/change" method="POST" class="settings">
				<p><label for='phone'>изменить номер телефона </label></p>
				<input type="text" value=<?=$tel?> name='new_value' id='phone' class="input" required>
				<input type="submit" value="Изменить" class="button">
				<input type="hidden" name="type" value="phone">	
			</form>

			<form action="/vhod/settings/change" method="POST" class="settings">
				<p><label for='vis_email'>изменить email(отображаемый)</label></p>
				<input type="text" value=<?=$vis_email?> name='new_value' id="vis_email" class="input" required>
				<input type="submit" value="Изменить" class="button">
				<input type="hidden" name="type" value="vis_email">
			</form>

			<form action="/vhod/settings/change" method="POST" class="settings">
				<p><label for='adress'>изменить адрес</label></p>
				<input type="text" value='<?php echo $adress?>' name='new_value' id="adress" class="input" required>
				<input type="submit" value="Изменить" class="button">
				<input type="hidden" name="type" value="adress">
			</form>
		</div>
		<div class="box">
			<form action="/vhod/settings/change" method="POST" class="settings">
				<h2>ЦЕНЫ</h2>
				<p><label for='price1'>Двустворчатое окно</label></p>
				<input type="text" value=<?=$price1?> name='price1' id="price1" class="input" required>
				<p><label for='price2'>Трехстворчатое окно</label></p>
				<input type="text" value=<?=$price2?> name='price2' id="price2" class="input" required>
				<p><label for='price2'>Балконный блок</label></p>
				<input type="text" value=<?=$price3?> name='price3' id="price3" class="input" required>
				<br>
				<input type="submit" value="Изменить" class="button">
				<input type="hidden" name="type" value="price">
			</form>
		</div>
	</div>
	

	<form enctype="multipart/form-data" action="/vhod/settings/upload" method="POST" class="file">
		<label for="main-pic"> Заменить основное изображение</label>
		<input name="file" type="file" id='main-pic' accept="image/jpeg" required>
		<input type="submit" value="Заменить картинку" class="button">
		<input type="hidden" name="type" value="main_pic">
	</form>
	
	<form enctype="multipart/form-data" action="/vhod/settings/upload" method="POST" class="file">
		<label for="main-pic"> Добавить изображение в карусель</label>
		<input name="file" type="file" id='main-pic' accept="image/jpeg" required>
		<input type="submit" value="Добавить картинку" class="button">
		<input type="hidden" name="type" value="slider_pic">
	</form>
	<div class="container">
		<h2>УДАЛИТЬ ИЗОБРАЖЕНИЯ ИЗ КУРУСЕЛИ</h2>
		<h3>Внимание! Выбранные изображения будут удалены без возможности восстановления!</h3>
		<div class="row">
			<form action="/vhod/settings/delete" method="POST">
				<input type="hidden" name="type" value="delete">
				<?php
					$i = 0;
					foreach ($pic_item as $key => $value) {
						echo "<div class='delete-element'>";
						echo "<img src=". $value . " class='pic'>";
						echo "<input type='checkbox' name='pic_elem[]' value=".$value.">";
						echo "</div>";
					}
				?>
			<input type="submit" value="Удалить выбранные изображения!" class="button" id='delete'>

			</form>
		</div>
	</div>

	<script src="/js/admin.form.js"></script>

</body>
</html>