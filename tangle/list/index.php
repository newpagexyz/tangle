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
		<?php
			$key='pop';
			if(isset($_GET['key'])){
				$key=$_GET['key'];
			}
			map_list($key);
		?>
	</body>
</html>
