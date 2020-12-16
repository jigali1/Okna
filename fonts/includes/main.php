<?php 
	if(!defined('BEZ_KEY')){
		header('Location:/');
		exit;
	}
	require_once 'includes/conf.php';

	$mysqli = new mysqli($db_host, $db_username, $db_password, $db_name);

	$sql = "SELECT * FROM `settings`";

	$response = $mysqli->query($sql);
	
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
		}
	}

	$sql = "SELECT * FROM `prices`";
	$response = $mysqli->query($sql);

	$result = mysqli_fetch_array($response);

	$price1 = $result['price1'];
	$price2 = $result['price2'];
	$price3 = $result['price3'];

?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Пластиковые окна ПВХ в Перми по низкой цене</title>

	
	<link rel="stylesheet" href="css/slick.css">
	<link rel="stylesheet" href="/css/style.css">
	<link rel="stylesheet" href="/css/iconsfont.css">
	<link rel="shortcut icon" type="image/png" href="/img/Logo.png"/>

</head>
<body>
	<div class="bcg-main hide"></div>
	<div class="popover hide">
		<div class="popup hide" id="popup-form">
			<form action="/sendmail.php" method="post">
				<h3>Оставьте заявку</h3>
				<p>на бесплатную</p>
				<p>консультацию</p>
				<p>или замер окна!</p>	
				<div class="column-row">
					<input type="text" id="popup-name" class="input" name="name" required autocomplete="off" maxlength='20'>
					<label for="popup-name">Ваше имя</label>
				</div>
				<div class="column-row">
					<input type="text" id="popup-phone" class="input phone" name="phone" required autocomplete="off" minlength='16'>
					<label for="popup-phone">Ваш номер телефона</label>
				</div>
				<input type="submit" value="Оставить">
			</form>
		</div>	
	</div>	
	<div class="popover hide" id='popok'>
		<div class="message_block">
			<p class='message'></p>
			<div class="button-ok">ОК</div>
		</div>
	</div>
	<div class="popup-call call-popup">
		<svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="phone" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-phone fa-w-16 fa-9x"><path fill="gray" d="M476.5 22.9L382.3 1.2c-21.6-5-43.6 6.2-52.3 26.6l-43.5 101.5c-8 18.6-2.6 40.6 13.1 53.4l40 32.7C311 267.8 267.8 311 215.4 339.5l-32.7-40c-12.8-15.7-34.8-21.1-53.4-13.1L27.7 329.9c-20.4 8.7-31.5 30.7-26.6 52.3l21.7 94.2c4.8 20.9 23.2 35.5 44.6 35.5C312.3 512 512 313.7 512 67.5c0-21.4-14.6-39.8-35.5-44.6zM69.3 464l-20.9-90.7 98.2-42.1 55.7 68.1c98.8-46.4 150.6-98 197-197l-68.1-55.7 42.1-98.2L464 69.3C463 286.9 286.9 463 69.3 464z" class=""></path></svg>
	</div>	
	

	<header class="header">
		<div class="container flex-row">
		
			<div class="logo">
				<a href="/" class="flex-row"> 
					<img src="/img/Logo.png" alt="LOGO">
					<div class="company">
						<h1>Альбатрос</h1>
						<h5>Решим по окнам ваш вопрос</h5>
					</div> 
				</a>
			</div>
			<div class="tel flex-row">
				<a href=tel:<?php echo $tel?> class="icon-phone"><?php echo $tel?></a>
				<button class="button call-popup">Хочу бесплатный замер!</button>
			</div>
		</div>
	</header>

	<main>
		<section class="adv">
			<div class="container">
				<h2>Пластиковые окна Пермь</h2>
				<h4>А вы готовы заменить старые окна на новые? Мы к вашим услугам!</h4>
				<div class="flex-row adv-row">
					<div class="adv-elem icon-ok">
						Продажа
					</div>
					<div class="adv-elem icon-ok">
						Установка
					</div>
					<div class="adv-elem icon-ok">
						Замена
					</div>
					<div class="adv-elem icon-ok">
						Ремонт
					</div>
				</div>
			</div>	
		</section>
		
		<div class="request">
			<div class="container">
				<form action="/sendmail.php" method="post" class="column-form">
					<h3>Оставьте заявку</h3>
					<p>на бесплатную</p>
					<p>консультацию</p>
					<p>по телефону</p>
					<div class="column-row">
						<input type="text" id="column-name" class="input" name="name" required autocomplete="off" maxlength='20'>
						<label for="column-name">Ваше имя</label>
					</div>
					<div class="column-row">
						<input type="text" id="column-phone" class="input phone" name="phone" required autocomplete="off" minlength='16'>
						<label for="column-phone">Ваш номер телефона</label>
					</div>
					<input type="submit" value="Оставить">
				</form>
			</div>
		</div>
			
		<section class="num-info">
			<div class="container flex-row">
				<div class="num-info-item-main">
					<h4>О нас</h4> 
					<span>в цифрах</span>
				</div>
				<div class="num-info-item icon-check">
					12 лет
					<p>на рынке</p>
				</div>
				<div class="num-info-item icon-check">
					Более 800 довольных
					<p>клиентов</p>
				</div>
				<div class="num-info-item icon-check">
					6 лет
					<p>гарантии</p>
				</div>
			</div>
		</section>			
		<section class="advantage-info flex-row">
			<div class="container flex-row">
				<!-- <div class="problems">
					<h4>В большинстве фирм</h4>
					<hr>
					<ul>
						<li> 
							<div class="icon-thumbs-down"></div>
							<div class="advantage-item">Менеджеры не помогают выбрать наилучший вариант</div>
						</li>
						<li> 
							<div class="icon-thumbs-down"></div>
							<div class="advantage-item">Нет возможности выбрать более экономные комплектации</div>
						</li>
						<li> 
							<div class="icon-thumbs-down"></div>
							<div class="advantage-item">Как привило, подбор окон - утомительное занятие</div>
						</li>
					</ul>
				</div> -->
				<div class="solutions">
					<h4>у нас</h4>
					<hr style="color: green;background-color: #2c2">
					<ul>
						<li> 
							<div class="icon-thumbs-up"></div>
							<div class="advantage-item">Бесплатные замер и консультация</div>
						</li>
						<li> 
							<div class="icon-thumbs-up"></div>
							<div class="advantage-item">Индивидуальный подход к каждому клиенту</div>
						</li>
						<li> 
							<div class="icon-thumbs-up"></div>
							<div class="advantage-item">Помощь с выбором и установка в кратчайшие сроки</div>
						</li>
					</ul>
				</div>
			</div>	
		</section>


		<div class="windows">
			<div class="container">
				<div class="flexbox">
					<div class="wind-elem call-popup">
						<h3>Двухстворчатые окна</h3>
						<img src="/img/2stv.png" alt=""> 
						<div class="wind-info"><p>Цены от <?=$price1 ?> рублей</p> 
							<button class="button">узнать точнее</button>
						</div>
					</div>
					<div class="wind-elem call-popup">
						<h3>Трёхствторчатые окна</h3>
						<img src="/img/3stv.png" alt="">
						<p>Цены от <?=$price2 ?> рублей</p> 
						<button class="button">узнать точнее</button>
					</div>
					<div class="wind-elem call-popup">
						<h3>Балконные блоки</h3>
						<img src="/img/balkon2.png" alt="">
						<p>Цены от <?=$price3 ?> рублей</p> 
						<button class="button">узнать точнее</button>
					</div>
					<div class="wind-elem call-popup">
						<h3>Ремонт окон и аксессуары</h3>
						<img src="/img/remont.png" alt="">
						<p>Замена, настройка, ремонт</p> 
						<button class="button">узнать цены</button>
					</div>
				</div>
			</div>
			
		</div>

				
		<div class="consultation">
			<form action="/sendmail.php" method="post" class="row-form">
				<div class="container flex-row">
				<h3>закажите консультацию с нашим менеджером</h3>
				<div class="form-column ">
					<input type="text" id="row-name" class="input " name="name" required autocomplete="off" maxlength='20'>
					<label for="row-name" id="cons-name-label">Ваше имя</label>
				</div>
				<div class="form-column">
					<input type="text" id="row-phone" class="input phone" name="phone" required autocomplete="off" minlength='16'>
					<label for="row-phone" id="row-label">Ваш номер телефона</label>
				</div>
				<input type="submit" value="Заказать">
			</div>
			</form>
		</div>

		<!-- <section class="steps-wrap">
			<div class="container">
				<h3>Этапы работы</h3>
				<div class="steps_inner">
					<div class="step">
						<div class="number">1</div>
					</div>
					<div class="step"><div class="number"></div></div>
					<div class="step"><div class="number"></div></div>
					<div class="step"><div class="number"></div></div>
				</div>
			</div>
			
		</section> -->
		

		<div class="examples">
			<div class="container">
				<h2>Примеры наших работ</h2>				
				<div class="slider">
						<?php 
							$sql = "SELECT `path` FROM `slider`";

							$response = $mysqli->query($sql);
	
							while ($result = mysqli_fetch_array($response)) {

								$path = ltrim($result['path'], '.');
								echo "<div class='slider__item'><img src=".
										$path . "></div>";

							}
						?>
				</div>
				<p>Больше фото в нашем <a href="https://www.instagram.com/albatros.perm/" target="_blank"><img src="img/instagram.jpg" alt=""><span class = "insta">Instagramm</span></a></p>
			</div>
		</div>
	</main>	

	<footer class="footer">
		<div class="container">
			<h3><img src="img/Logo.png" alt="">альбатрос</h3>
			<div class="contact-row flex-row">
				<div class="row-elem address">
					<p>Наш адрес:</p>
					<p><?php echo $adress?></p>
				</div>
				<div class="row-elem">
					<p>Наши контакты</p>
					<p><a href=tel:<?php echo $tel?> class="icon-phone"><?php echo $tel?></a></p>
					<p><a href=mailto:<?php echo $vis_email?> class='icon-mail'><?php echo $vis_email?></a></p>
					<p><a href="https://www.instagram.com/albatros.perm/"><img src="../img/instagram.jpg" alt="" class="icon-instagram">albatros.perm</a></p>
				</div>						
			</div> 
		</div>
			
			<button class="button call-popup">Заказать звонок</button>
			
		<div class="copyright">
				<div class="container">
					&copy; 2020 - <?php echo date('Y'); ?> "<a href="/">АЛЬБАТРОС</a>"
				</div>					
			</div>	
		
		
	</footer>

	<script src="js/script.js"></script>
	<script src="https://unpkg.com/imask"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="js/slick.min.js"></script>
	<script src="js/form.js"></script>
	<script>
		$('.slider').slick({
			arrows:true,
			dots:false,
			adaptiveHeight:false,
			slidesToShow:1,
			slidesToScroll:1,
			speed:800,
			autoplay:true,
			autoplaySpeed: 7000,
			pauseOnHover:false,
			draggable:false,
			touchMove: true,
			waitForAnimate: true,

		});
	</script>
	
</html>
