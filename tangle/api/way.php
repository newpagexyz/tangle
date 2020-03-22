<?php
	include_once('../tech/fun.php');
	if(isset($_POST['key'])){
		echo get_ways($_POST['key']);
	}
?>
