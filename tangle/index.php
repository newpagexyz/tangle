<?php
	include_once('tech/fun.php');
	$page='index';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'>
		<title>
			<?php
				echo $texts[$page]['title'];
			?>
		</title>
		<link rel="shortcut icon" href="media/logo/favico.png" type="image/x-icon">
		<link rel='stylesheet' type='text/css' href='style/index.css'>
		<link rel='stylesheet' type='text/css' href='style/header.css'>
	</head>
	<body>
		<?php
			include_once('modules/header.php');
		?>
		<div class='first-block'>
			<div class='blackback'>
			<video width="100%" poster="media/index/video_preview.png" id='main_video' muted="muted">
				<source src="media/index/video.mp4">
			</video>
			</div>
			<script src='scripts/js/index/video_controls.js'></script>
		</div>
		<div class='second-block'>
		
		<h1>Придумывайте маршруты<br>и изучайте местность с <b>Tangle<b></h1>
		<h2>Вам больше не придется искать, чем заняться!<h2>
		<p><g>Выбирайте из более 10000 маршрутов<g><p>
		</div>
		<div class='third-block'>
			<div class='helper'>
				<div class='button'><a class='a1' href='create_way/'>Создать маршрут</a></div>
				<div class='button'><a class='a1' href='apk/'>Попробовать</a></div>
			</div>
		</ul>
		</div>
		<div class='fourth-block'>
		<hr style='visibility:hidden'>
		</div>
		<div class='five-block'>
			 <h1><i class='blue'>Наше</i> приложение<br> для <i class='green'>вашего</i> удобства</h1>
			 <!--<nav>
				<h2>Удобно<br>Всегда под рукой<br>Есть оффлайн-режим<br>Ещё больше баллов<br></h2>
			 </nav>-->
			 <img src="media/index/qr.png" alt="logo" width="500px">
			 <a href='apk/'>Скачать</a>
		</div>
		<footer>
			<hr>
			<p>Developed by &#171;NewPage1	&#187; &copy;2020</p>
		</footer>
	</body>
</html>
