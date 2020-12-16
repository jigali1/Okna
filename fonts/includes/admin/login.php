<?php
	
	if(!defined('BEZ_KEY')){
		header('Location:/');
		exit;
	}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Пластиковые окна ПВХ в Перми по низкой цене</title>
	<link rel="stylesheet" href="/css/login.css">
</head>
<body>
	<?php
		if (isset($message) && $message !='') {
			echo "<p style='text-align: center; color:red;'>" . $message . '</p>';
		}
	?>
	<h1>Вход</h1>
	<div id="wrapper">
	<form id="signin" method="POST" action="/vhod/login" autocomplete="off">
		<input type="text" id="user" name="user" placeholder="Логин" />
		<input type="password" id="pass" name="pass" placeholder="Пароль" />
		<button type="submit">	&#9658;</button>
	</form>
</div>
	

</body>
</html>