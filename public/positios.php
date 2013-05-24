<?php
$method = $_SERVER['REQUEST_METHOD'];


$link = mysql_connect("mysql10.000webhost.com", "a7024518_bus", "Asdf1234*") or die("Could not connect");
mysql_select_db("a7024518_bus") or die("Could not select database");
 
$sql = "SELECT b.`number` as bus,b.`id_route` as ruta, d.name as nombre,d.family_name as apellido, p.latitude as latitud, p.longitude as longitud, p.date as fecha, p.hour as hora FROM `bus` b INNER JOIN `bus_driver` bd ON b.id = bd.id_bus INNER JOIN `driver` d ON d.id = bd.id_driver INNER JOIN `position` p ON p.id_bus = b.id";

 
$resulset = mysql_query($sql);
 
$response = array();

// Dependiendo del método de la petición ejecutaremos la acción correspondiente.
switch ($method) {
	case 'GET':
		while ($obj = mysql_fetch_object($resulset)) {

			$response[] = array('bus' => $obj->bus,
			'ruta' => $obj->ruta,
				'nombre' => $obj->nombre,
				'apellido' => $obj->apellido,
				'latitud' => $obj->latitud,
				'longitud' => $obj->longitud,
				'fecha' => $obj->fecha,
				'hora' => $obj->hora
				);
		}
		break;
}

echo json_encode($response); // $response será un array con los datos de nuestra respuesta.
mysql_close($link);
?>
