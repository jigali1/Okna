<?php 
	if(!defined('BEZ_KEY')){
		header('Location:/');
		exit;
	}
	if (!isset($_SESSION['name']) && $_SESSION['name'] != '1' ) {
		exit;
	}

	if ($_POST['type'] == '' || !isset($_FILES['file'])) {
		exit;			
	}

	// Массив допустимых значений типа файла
	$types = array('image/gif', 'image/png', 'image/jpeg');
	// Максимальный размер файла
	$size = 1024000;

	if (!in_array($_FILES['file']['type'], $types)){
 		die('Запрещённый тип файла.');
	}
	if ($_FILES['file']['size'] > $size){
 		die('Слишком большой размер файла.');
	}

	switch ($_POST['type']) {

		case 'main_pic':
			if ($_FILES['file']['type'] != 'image/jpeg'){
 				die('На главную можно только jpg файлы!');
			}
			
			if(!move_uploaded_file($_FILES['file']['tmp_name'], './img/main-picture.jpg')){
				die('Ошибка сервера! Файл не загружен!');
			}
			echo ('Основное изображение успешно заменено!');
		break;

		case 'slider_pic':
			
			require_once './includes/conf.php';
			$mysqli = mysqli_connect($db_host, $db_username, $db_password, $db_name);

			$base = './img/slider/';
			$name = $_FILES['file']['name'];
			$name_exp = explode('.', $name);
			$ext = end($name_exp);
			$file_name = md5(time().$name).'.'.$ext;
			$file_path = $base.$file_name;
			if(!move_uploaded_file($_FILES['file']['tmp_name'], $file_path)) {
				die('Ошибка сервера! Файл не загружен!');
			}
			$sql = "INSERT INTO `slider`(`name`, `path`) VALUES ('$file_name', '$file_path')";

			if (!mysqli_query($mysqli, $sql)){
    			echo 'Что то пошло не так! Мы уже в курсе и скоро починим!'. mysqli_error($mysqli);
    			exit;
    		} 

    		echo'Изображение успешно добавлено в карусель!';
		break;
		
	}

?>