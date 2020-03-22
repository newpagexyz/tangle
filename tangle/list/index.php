<?php
	include_once('../tech/fun.php');
	$page='list';
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
		<link rel="shortcut icon" href="../media/logo/favico.png" type="image/x-icon">
		<link rel='stylesheet' type='text/css' href='../style/list.css'>
	</head>
	<body>
		<header>
			<div>
				Тематические маршруты
			</div>
		</header>
		<main>
			<h1>
				Выберите категорию:
			</h1>
			<div class='show_images'>
					<ul>
						<li>
							<img src='../media/lk/cats/marshruty-01.png'>
						</li>
						<li>
							<img src='../media/lk/cats/mesta-01.png'>
						</li>
						<li>
							<img src='../media/lk/cats/priroda-01.png'>
						</li>
						<li>
							<img src='../media/lk/cats/top100-01.png'>
						</li>
					</ul>				
				</div>
				<div class='filter'>Фильтр</div>
				<h1>Топ 500:</h1>
		</main>
		<aside>
			<?php
				$key='pop';
				if(isset($_GET['key'])){
					$key=$_GET['key'];
				}
				map_list($key);
			?>
		</aside>
	</body>
</html>
