<?php
	include_once('../tech/fun.php');
	$page='auth';
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
			if(isset($_POST['email']) AND isset($_POST['psw'])){
				if(auth($_POST['email'],$_POST['psw'])){
					echo "Пользователь авторизован!";
				}
				else{
					echo"Ошибка, повторите попытку позднее";
				}
			}
			else{	
				echo'
					<form action="" method="post">
					  <div class="container">
						<h1>Вход</h1>
						<hr>

						<label for="email"><b>Email</b></label><br>
						<input type="text" placeholder="Enter Email" name="email" required><br>

						<label for="psw"><b>Пароль</b></label><br>
						<input type="password" placeholder="Enter Password" name="psw" required><br>

						<hr>
						<button type="submit" class="registerbtn">Войти</button> 
					  </div>
					  
					  <div class="container signin">
						<p><d>Все еще нет аккаунта?<d> <a href="../reg/">Создать</a>.</p>
					  </div>
					</form>';
			}
			?>
	</body>
</html>
