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
		<div class='first-block'>
			<div class='blackback'>
			<video width="100%" poster="media/index/video_preview.png" id='main_video' muted="muted">
				<source src="media/index/video.mp4">
			</video>
			</div>
			<script src='scripts/js/index/video_controls.js'></script>
		</div>
		<?php
			include_once('modules/header.php');
		?>
		<div class='second-block'>
		
		<h1>Придумывайте маршруты<br>и изучайте местность с <b>Tangle<b></h1>
		<h2>Вам больше не придется искать, чем заняться!<h2>
		<p><g>Выбирайте из более 10000 маршрутов<g><p>
		</div>
		<div class='third-block'>
		<ul>
			<li>	<div class='button'><a1 href='#'>Создать маршрут</a1></div></li>
			<li>	<div class='button'><a1 href='#'>Попробовать</a1></div></li>
		</ul>
		</div>
		<div class='fourth-block'>
		<h1>Наши возможности<h1>
		
		</div>
	</body>
</html>
