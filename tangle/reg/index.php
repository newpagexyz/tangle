<?php
	include_once('../tech/fun.php');
	$page='reg';
?>
<!DOCTYPE html>
<html>
	<head>
	<title>
		<?php
				echo $texts[$page]['title'];
		?>
	</title>
		<link rel="shortcut icon" href="../media/logo/favico.png" type="image/x-icon">
		<link rel='stylesheet' type='text/css' href='../style/reg.css'>
	<meta charset='utf-8'>
	</head>
	<body>
	<?php
		if(isset($_POST['name'])AND isset($_POST['surname']) AND isset($_POST['email']) AND isset($_POST['psw'])){
			if(reg_user($_POST['name'],$_POST['surname'],$_POST['email'],$_POST['psw'])){
				echo "Пользователь успешно зарегистрирован!";
			}
			else{
				echo"Ошибка, повторите попытку позднее";
			}
		}
		else{	
			echo'
			<form method=post action="">
			  <div class="container">
				<h1>Регистрация</h1>
				<p>Заполните форму чтобы создать аккаунт.</p>
				<hr>
				
				<label for="name"><b>Имя</b></label><br>
				<input required type="text" placeholder="Enter Name" name="name" required><br>
				
				<label for="surename"><b>Фамилия</b></label><br>
				<input required type="text" placeholder="Enter Surename" name="surname" required><br>
				
				<label for="email"><b>Email</b></label><br>
				<input required type="email" placeholder="Enter Email" name="email" required><br>

				<label for="psw"><b>Пароль</b></label><br>
				<input required type="password" placeholder="Enter Password" name="psw" required><br>

				<label for="psw-repeat"><b>Повторите пароль</b></label><br>
				<input required type="password" placeholder="Repeat Password" name="psw-repeat" required>
				<hr>
				<button type="submit" class="registerbtn">зарегистрироваться</button>
				<p><c>При созданиии аккаунта вы соглашаетесь с <a href="../terms/">Terms & Privacy</a><c></p>

				
			  </div>
			  
			  <div class="container signin">
				<p><d>Уже есть аккаунт<d> <a href="../auth/">Войти</a>.</p>
			  </div>
			</form>
			';
		}
	?>
	</body>
</html>
