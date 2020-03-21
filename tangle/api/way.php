<?php
	include_once('../tech/fun.php');
	if(isset($_POST['key'])){
		switch($_POST['key']){
			case "pop":
				echo json_encode(array(
					1=>array(
						'id'=>'1',
						'title'=>'Единственный хоть как-то работающий маршрут, выбирайте его!',
						'img_src'=>'https://newpage.ddns.net/tangle/media/preview/img1.jpg',
						'rate'=>'1000000'
					),
					2=>array(
						'id'=>'2',
						'title'=>'RIP',
						'img_src'=>'https://newpage.ddns.net/tangle/media/preview/rip.png',
						'rate'=>'0'
					),
					3=>array(
						'id'=>'2',
						'title'=>'RIP',
						'img_src'=>'https://newpage.ddns.net/tangle/media/preview/rip.png',
						'rate'=>'0'
					)
				));
			break;
			case "new":
				echo json_encode(array(
					1=>array(
						'id'=>'1',
						'title'=>'Единственный хоть как-то работающий маршрут, выбирайте его!',
						'img_src'=>'https://newpage.ddns.net/tangle/media/preview/img1.jpg',
						'rate'=>'1000000'
					),
					2=>array(
						'id'=>'2',
						'title'=>'RIP',
						'img_src'=>'https://newpage.ddns.net/tangle/media/preview/rip.png',
						'rate'=>'0'
					),
					3=>array(
						'id'=>'2',
						'title'=>'RIP',
						'img_src'=>'https://newpage.ddns.net/tangle/media/preview/rip.png',
						'rate'=>'0'
					)
				));
			break;
			default:
				echo 'Invalid data';
			break;
		}
	}
?>
