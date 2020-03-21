<?php
	include_once('../tech/fun.php');
	if(isset($_POST['email']) AND isset($_POST['password'])){
		if($res=api_auth($_POST['email'],$_POST['password'])){
			echo $res;
		}
		else{
			echo 'false';
		}
	}
	else{
		echo"invalid data";
	}
?>
