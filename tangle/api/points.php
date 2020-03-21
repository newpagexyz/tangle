<?php
	include_once('../tech/fun.php');
	$page='map';
	if(isset($_POST['id'])){
		echo get_map_json($_POST['id']);
	}
	else{
		echo"Invalid data";
	}
?>
