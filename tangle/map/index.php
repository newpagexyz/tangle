<?php
	include_once('../tech/fun.php');
	$page='map';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'>
		<style>
			.My_window{
					visibility:hidden;
					width:0px;
					height:0px;
					position: fixed;
					top:10%;
				}
		</style>
		<style type="text/css">
      .directions li span.arrow {
        display:inline-block;
        min-width:28px;
        min-height:28px;
        background-position:0px;
        background-image: url("https://heremaps.github.io/maps-api-for-javascript-examples/map-with-with-route-from-a-to-b-using-public-transport/img/arrows.png");
        position:relative;
        top:8px;
      }
      .directions li span.depart  {
        background-position:-28px;
      }
      .directions li span.rightUTurn  {
        background-position:-56px;
      }
      .directions li span.leftUTurn  {
        background-position:-84px;
      }
      .directions li span.rightFork  {
        background-position:-112px;
      }
      .directions li span.leftFork  {
        background-position:-140px;
      }
      .directions li span.rightMerge  {
        background-position:-112px;
      }
      .directions li span.leftMerge  {
        background-position:-140px;
      }
      .directions li span.slightRightTurn  {
        background-position:-168px;
      }
      .directions li span.slightLeftTurn{
        background-position:-196px;
      }
      .directions li span.rightTurn  {
        background-position:-224px;
      }
      .directions li span.leftTurn{
        background-position:-252px;
      }
      .directions li span.sharpRightTurn  {
        background-position:-280px;
      }
      .directions li span.sharpLeftTurn{
        background-position:-308px;
      }
      .directions li span.rightRoundaboutExit1 {
        background-position:-616px;
      }
      .directions li span.rightRoundaboutExit2 {
        background-position:-644px;
      }
      
      .directions li span.rightRoundaboutExit3 {
        background-position:-672px;
      }
      
      .directions li span.rightRoundaboutExit4 {
        background-position:-700px;
      }
      
      .directions li span.rightRoundaboutPass {
        background-position:-700px;
      }
      
      .directions li span.rightRoundaboutExit5 {
        background-position:-728px;
      }
      .directions li span.rightRoundaboutExit6 {
        background-position:-756px;
      }
      .directions li span.rightRoundaboutExit7 {
        background-position:-784px;
      }
      .directions li span.rightRoundaboutExit8 {
        background-position:-812px;
      }
      .directions li span.rightRoundaboutExit9 {
        background-position:-840px;
      }
      .directions li span.rightRoundaboutExit10 {
        background-position:-868px;
      }
      .directions li span.rightRoundaboutExit11 {
        background-position:896px;
      }
      .directions li span.rightRoundaboutExit12 {
        background-position:924px;
      }
      .directions li span.leftRoundaboutExit1  {
        background-position:-952px;
      }
      .directions li span.leftRoundaboutExit2  {
        background-position:-980px;
      }
      .directions li span.leftRoundaboutExit3  {
        background-position:-1008px;
      }
      .directions li span.leftRoundaboutExit4  {
        background-position:-1036px;
      }
      .directions li span.leftRoundaboutPass {
        background-position:1036px;
      }
      .directions li span.leftRoundaboutExit5  {
        background-position:-1064px;
      }
      .directions li span.leftRoundaboutExit6  {
        background-position:-1092px;
      }
      .directions li span.leftRoundaboutExit7  {
        background-position:-1120px;
      }
      .directions li span.leftRoundaboutExit8  {
        background-position:-1148px;
      }
      .directions li span.leftRoundaboutExit9  {
        background-position:-1176px;
      }
      .directions li span.leftRoundaboutExit10  {
        background-position:-1204px;
      }
      .directions li span.leftRoundaboutExit11  {
        background-position:-1232px;
      }
      .directions li span.leftRoundaboutExit12  {
        background-position:-1260px;
      }
      .directions li span.arrive  {
        background-position:-1288px;
      }
      .directions li span.leftRamp  {
        background-position:-392px;
      }
      .directions li span.rightRamp  {
        background-position:-420px;
      }
      .directions li span.leftExit  {
        background-position:-448px;
      }
      .directions li span.rightExit  {
        background-position:-476px;
      }
      .directions li span.ferry  {
        background-position:-1316px;
      }
      </style>
	  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
    <title>Map with Route from A to B using Public Transport</title>
    <link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
   <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>
		<title>
			<?php
				echo $texts[$page]['title'];
			?>
		</title>
		<link rel="shortcut icon" href="../media/logo/favico.png" type="image/x-icon">
		<link rel='stylesheet' type='text/css' href='../style/map.css'>
	</head>
	<body id="map-with-route">
		<?php
			if(isset($_GET['id'])){
				map_to_js_object($_GET['id']);
			}
			else{
					header('Location: https://newpage.ddns.net/tangle/list');
			}
		?>

    <div class="page-header">
  <div style="width: 640px; height: 480px" id="mapContainer">
  </div>
  <div id="panel"></div>
  <div class='My_window' id='My_window'>

	</div>
  
	<button id='button2'>draw</button>
	<h3></h3>
	<script src='../scripts/js/map/prosmotr.js'></script>
	</body>
</html>      
