<?php
$method = $_SERVER['REQUEST_METHOD'];

$link = mysql_connect("sitpe-db.my.phpcloud.com", "sitpe", "castrolle") or die("Could not connect");
mysql_select_db("sitpe") or die("Could not select database");
 
//Test    http://127.0.0.1:81/gpsjson/add_position.php?bus=123&longitude=111&latitude=2222
 
$log = 'bus:'.$_GET[bus].' longitude:'.$_GET[longitude].' tatitude:'.$_GET[latitude];
$sql = "INSERT INTO `log` (`id` ,`description`)VALUES (NULL ,  '$log')";
	mysql_query($sql);

switch ($method) {
	case 'GET':
	date_default_timezone_set('America/Bogota');
       $date_string = date('d-m-Y');
	$hour_string = date('H:i:s');
	$stamp_string = date('Y-m-d H:i:s');

	if(isset($_GET['bus']) && isset($_GET['longitude']) && isset($_GET['latitude'])){
	
	 	$latitude = $_GET['latitude'];
 	       $longitude = $_GET['longitude'];


	 	$sql = "SELECT id FROM `bus` WHERE `number` = '$_GET[bus]'";
	 	$resulset = mysql_query($sql);		
		$id_bus = 0;
		
	 	while ($obj = mysql_fetch_object($resulset)) {			
				$id_bus = $obj->id;
		}	 	
	
		if($id_bus != 0){

			$sql = "select  `cp`.id from `bus` `b` join `bus_driver` `bd` on(`b`.`id` = `bd`.`id_bus`) join `driver` `d` on(`d`.`id` = `bd`.`id_driver`) join `check_point` `cp` on(`cp`.`id_route` = `b`.`id_route`) where ('$latitude' between (`cp`.`latitude` - (select `parameter`.`value` from `parameter` where (`parameter`.`name` = 'CHECK_POINT_RANGE')))  	   and (`cp`.`latitude` + (select `parameter`.`value` from `parameter` where (`parameter`.`name` = 'CHECK_POINT_RANGE'))))  AND ('$longitude' between (`cp`.`longitude` - (select `parameter`.`value` from `parameter` where (`parameter`.`name` = 'CHECK_POINT_RANGE')))  	   and (`cp`.`longitude` + (select `parameter`.`value` from `parameter` where (`parameter`.`name` = 'CHECK_POINT_RANGE'))))";			$resulset = mysql_query($sql);		
			$id_check_point = 0;
			
			while ($obj = mysql_fetch_object($resulset)) {
				$id_check_point = $obj->id;
			}	

			$sql = "INSERT INTO position (id_bus,longitude,latitude,date,hour,stamp) VALUES ('$id_bus','$_GET[longitude]','$_GET[latitude]',STR_TO_DATE('$date_string','%d-%m-%Y'),'$hour_string','$stamp_string')";
			mysql_query($sql);

			
			if($id_check_point != 0){
			
			 $sql = "INSERT INTO `check_point_register` ( `id` ,`id_check_point` ,`id_bus` ,`stamp`)VALUES (NULL ,  '$id_check_point',  '$id_bus', '$stamp_string')";
			 mysql_query($sql);
			}

		}
	}	
	break;
}

mysql_close($link);
?>		