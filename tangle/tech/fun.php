<?php
	include_once('config.php');
	include_once('texts.php');
	function my_query($q, $for_safe=array()){//Функция для SQL запросов, первый аргумент - текст запроса в бд, второй - массив из экранируемых строк
		global $mysql;
		$link = mysqli_connect($mysql['host'], $mysql['user'], $mysql['password'], $mysql['dbname']);
		if(!empty($for_safe)){
			foreach($for_safe as $text){
				mysqli_real_escape_string($link,$text);
			}
		}
		$res=false;
		if($link){
			$res=mysqli_query($link,$q);
			mysqli_close($link);
		}
		return $res;
	}
	function reg_user($name,$surname,$email,$password){//Функция регистрации пользователя
		if(check_mail($email)){
			my_query('INSERT INTO `users` set `name`="'.$name.'", `surname`="'.$surname.'", `email`="'.$email.'",`password`="'.md5($password).'";',array(0=>$email,1=>$password,2=>$name,3=>$surname));
			return true;
		}
		else{
			return false;
		}
	}
	function check_mail($email){//Проверяет свободность имейла
		$res=my_query('SELECT * FROM `users` WHERE email="'.$email.'";',array(0=>$email));
		if(mysqli_fetch_assoc($res)){
			return false;
		}
		else{
			return true;
		}
	}
	function gen_token() {//Генератор токенов
		$token = md5(microtime() . 'salt' . time());
		return $token;
	}
	function auth($email,$password){
		$ret=false;
		$res=my_query('SELECT * FROM `users` WHERE email="'.$email.'" AND `password`="'.md5($password).'";',array(0=>$email,1=>$password));
			if($result=mysqli_fetch_assoc($res)){
				$session=gen_token();
				$token=gen_token();
				create_web_session($session,$token,$result['id']);
				$ret=true;
			}
		return $ret;
	}
	function create_web_session($session,$token,$id){//Создаём куки и пишем в бд
		$res=my_query('INSERT INTO `session` SET session="'.$session.'", token="'.$token.'",user_id="'.$id.'";',array(0=>$session,1=>$token));
		create_st_cookie($session,$token);
		}
	function check_cookie(){//Проверка валидности сессии в браузере
		$ret=false;
		if(isset($_COOKIE['session']) AND isset($_COOKIE['token'])){
			$session=$_COOKIE['session'];
			$token=$_COOKIE['token'];
			$res=my_query('SELECT * FROM `session` WHERE session="'.$session.'" AND token="'.$token.'";',array(0=>$session,1=>$token));
			if($res=mysqli_fetch_assoc($res)){
				$ret=true;
				change_cookie($_COOKIE['session'],$_COOKIE['token']);
			}
		}
		return $ret;
	}
	function change_cookie($session,$token){//Изменение токена
		$token=gen_token();
		$res=my_query('UPDATE `session` SET token="'.$token.'"  WHERE session="'.$session.'";',array(0=>$session,1=>$token));
		create_st_cookie($session,$token);
	}
	function create_st_cookie($session,$token){
		setcookie("session", $session, time()+3600000, "/");
		setcookie("token", $token, time()+3600000, "/");
	}
	function api_auth($email,$password){//Авторизация через api
		$res=my_query('SELECT * FROM `users` WHERE email="'.$email.'" AND password="'.md5($password).'";',array(0=>$email,1=>$password));
		if($result=mysqli_fetch_assoc($res)){
			$session=gen_token();
			$token=gen_token();
			create_api_session($session,$token,$result['id']);
			$array =array(
				'session'=>$session,
				'token'=>$token,
			);
			return json_encode($array);
		}else{
			return false;
		}
	}
	function check_api_auth($session,$token){//Валидатор сессии из api
		$res=my_query('SELECT * FROM `api_session` WHERE session="'.$session.'" AND token="'.$token.'";',array(0=>$session,1=>$token));
		if(mysqli_fetch_assoc($res)){
			return true;
		}
		else{
			return false;
		}
	}
	function create_api_session($session,$token,$id){//Записать в бд api сессию
			$res=my_query('INSERT INTO `api_session` SET session="'.$session.'", token="'.$token.'",user_id="'.$id.'";',array(0=>$session,1=>$token));
	}
	function create_way($name, $title,$long_text,$time,$type,$uid){//Создаёт маршрут без точек и возвращает его id
		echo 'INSERT INTO `way` SET name="'.$name.'", short_text="'.$title.'",user_id="'.$uid.'", long_text="'.$long_text.'", time="'.intval($time).'", type="'.intval($type).'";';
		$res=my_query('INSERT INTO `way` SET name="'.$name.'", short_text="'.$title.'",user_id="'.$uid.'", long_text="'.$long_text.'", time="'.intval($time).'", type="'.intval($type).'";',array(0=>$name,1=>$title,2=>$long_text,3=>$time,4=>$type));
		$res=my_query('SELECT `id` FROM `way` WHERE name="'.$name.'" AND short_text="'.$title.'" AND user_id="'.$uid.'" AND long_text="'.$long_text.'" AND time="'.intval($time).'" AND type="'.intval($type).'";',array(0=>$name,1=>$title,2=>$long_text,3=>$time,4=>$type));
		$r=mysqli_fetch_assoc($res);
		return $r['id'];
	}
	function add_points($points,$id){
		foreach($points as $value){
			$res=my_query('INSERT INTO `points` SET way_id="'.$id.'", title="'.$value['title'].'",alt="'.$value['alt'].'", lat="'.$value['lat'].'";',array(0=>$value['title'],1=>$value['alt'],2=>$value['lat']));
		}
	}
	function get_id_by_session($session,$token){//Получить id по сессии
		$res=my_query('SELECT * FROM `session` WHERE session="'.$session.'";',array(0=>$session,1=>$token));
		if($r=mysqli_fetch_assoc($res)){
			return $r['user_id'];
		}
	}
	function create_way_by_post(){//Проверяет post-запрос с формы создания маршрута
		if(isset($_COOKIE['session']) AND isset($_COOKIE['token'])){
			$uid=get_id_by_session($_COOKIE['session'],$_COOKIE['token']);
			if(isset($_POST['name']) AND isset($_POST['title']) AND isset($_POST['long_text']) AND isset($_POST['time']) AND isset($_POST['type'])){
				$id=create_way($_POST['name'],$_POST['title'],$_POST['long_text'],$_POST['time'],$_POST['type'],$uid);
				$points=array();
				foreach($_POST as $key => $value){
					if($key!='name' AND $key!='title' AND $key!='long_text' AND $key!='time' AND $key!='type'){
						if(strpos($key, 'tit')===0){
							$points[substr($key, 3)]['title']=$value;
						}
						if(strpos($key, 'alt')===0){
							$points[substr($key, 3)]['alt']=$value;
						}
						if(strpos($key, 'lat')===0){
							$points[substr($key, 3)]['lat']=$value;
						}   
					}
				}
				add_points($points,$id);
			}
		}
	}
	function get_map_json($id){//Получить json для карты по id
		$res=my_query('SELECT * FROM `points` WHERE way_id="'.$id.'";',array(0=>$id));
		$i=0;
		$arr=array();
		while($r=mysqli_fetch_assoc($res)){
			$arr[$i]['lat']=$r['lat'];
			$arr[$i]['alt']=$r['alt'];
			$arr[$i]['title']=$r['title'];
			$i++;
		}
		if($i==0){
			return "not found";	
		}else{
			$ret= json_encode($arr);
			$ret =substr($ret, 1,-1); 
			return $ret;
		}
	}
	function get_ways($key='new'){
		/*if($key=='pop'){
				$res=my_query('SELECT * FROM `way` ORDER BY `rate` DESC;');
		}
		else($key=='new'){
				$res=my_query('SELECT * FROM `way` ORDER BY `id` DESC;');
		}*/
		$res=my_query('SELECT * FROM `way` ORDER BY `rate` DESC;');
		$i=0;
		$arr=array();
		while($r=mysqli_fetch_assoc($res)){
			$i++;
			$arr[$i]['id']=$r['id'];
			$arr[$i]['title']=$r['short_text'];
			$arr[$i]['img_src']=$r['preview_src'];
			$arr[$i]['rate']=$r['rate'];
		}
		if($i==0){
			return "not found";	
		}else{
			$ret= json_encode($arr);
			return $ret;
		}
	}
	function map_list($key){
		$ret=get_ways($key);
		$arr= json_decode($ret,1);
		foreach($arr as $value){
			echo "<div>";
				echo"<a href='../map/?id=".$value['id']."'>".$value['title']."
					</a>";
					echo"<img src='".$value['img_src']."'>";
			echo"</div>";
		}
	}
	function create_refer_cookie($link){
		setcookie("refer", $link, time()+3600000, "/");
	}
	function goto_refer_cookie(){
		$ref='Location: http://newpage.ddns.net/tangle/';
		if(isset($_COOKIE["refer"])){
			$ref='Location: '.$_COOKIE["refer"];
			unset($_COOKIE['refer']);
			setcookie('refer', null, -1, '/');
		}
		header($ref);
		exit();
	}
	function deauth(){
		if(isset($_COOKIE['sesion'])){
			unset($_COOKIE['session']);
			setcookie('session', null, -1, '/');
		}
		if(isset($_COOKIE['token'])){
			unset($_COOKIE['token']);
			setcookie('token', null, -1, '/');
		}
		header('Location: https://newpage.ddns.net/tangle/');
	}
	function ret_name_by_cookie(){
		$ret=false;
		if(isset($_COOKIE['session']) AND isset($_COOKIE['token'])){
			$session=$_COOKIE['session'];
			$token=$_COOKIE['token'];
			$res=my_query('SELECT * FROM `session` WHERE session="'.$session.'";',array(0=>$session,1=>$token));
			if($res=mysqli_fetch_assoc($res)){
				$res=my_query('SELECT * FROM `users` WHERE id="'.$res['user_id'].'";');
				if($res=mysqli_fetch_assoc($res)){
					$ret=$res['name'];
				}
			}
		}
		return $ret;
	}
	function find_way($keywords){
		if($res=my_query('SELECT * FROM `way` WHERE `text` like "%'.$text.'%";',array(0=>$text))){
			while($r=mysqli_fetch_assoc($res)){
				
			}
		}
	}
?>
