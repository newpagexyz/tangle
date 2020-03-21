<?php
	include_once('../tech/fun.php');
	$page='create_map';
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
		<link rel='stylesheet' type='text/css' href='../style/auth.css'>
	</head>
	<body>
		<?php
			create_way_by_post();
			?>
	</body>
</html>

