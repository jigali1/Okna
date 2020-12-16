<?php
	
	if(!defined('BEZ_KEY')){
		header('Location:/');
		exit;
	}
	if (!isset($_SESSION['name']) && $_SESSION['name']) {
		include_once './includes/admin/login.php';
		exit;
	}


	require_once './includes/conf.php';

	$mysqli = mysqli_connect($db_host, $db_username, $db_password, $db_name);

	$sql = "SELECT * FROM `customers` ORDER BY `datetime` DESC";

	$response = mysqli_query($mysqli, $sql);

?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">

	<title>Пластиковые окна ПВХ в Перми по низкой цене</title>
	
	<link rel="stylesheet" href="/css/admin.css">
</head>
<body>
	<header class='header'>
		<a href="/vhod/settings" class='button'>Настройки</a>
		<a href="/vhod/logout" class="logout button">Выход</a>
	</header>
	

	<h2>список заявок</h2>

	<table>

		<tr style="font-weight: bold;">
			<td>Имя</td>
			<td>Телефон</td>
			<td>Дата</td>
		</tr>

	<?php 
		while ($result = mysqli_fetch_array($response)) {


			$res_tel = "<a href=tel:" . $result['tel'] . "class='icon-phone'>" . $result['tel'] . "</a>";
			echo "<tr>
			<td>".$result['name']."</td>
			<td>".$res_tel."</td>
			<td>".$result['datetime']."</td>
		</tr> ";
		}

	?>
	</table>
	

</body>
</html>