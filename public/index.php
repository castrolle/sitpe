<?php

$method = $_SERVER['REQUEST_METHOD'];


$link = mysql_connect("127.0.0.1", "sitp", "castrolle") or die("Could not connect");
mysql_select_db("sitp") or die("Could not select database");
 
$sql = "SELECT * FROM `position` ";
 
$resulset = mysql_query($sql);
 
$response = array();

while($obj = mysql_fetch_object($resulset )) {
      $response [] = $obj;
}

// add the header line to specify that the content type is JSON
header("Content-type: application/json");

echo "{\"data\":" .json_encode($response ). "}";
mysql_close($link);

?>