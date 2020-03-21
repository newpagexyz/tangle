<?php
	include_once('../tech/fun.php');
	if(isset($_POST['session']) AND isset($_POST['token'])){
		if($res=check_api_auth($_POST['session'],$_POST['token'])){
			echo 'true';
		}
		else{
			echo 'false';
		}
	}
	else{
		echo"invalid data";
	}
?>
