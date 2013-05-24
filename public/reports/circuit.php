<?php
$method = $_SERVER['REQUEST_METHOD'];


$link = mysql_connect("sitpe-db.my.phpcloud.com", "sitpe", "castrolle") or die("Could not connect");
mysql_select_db("sitpe") or die("Could not select database");
 
$sql = "SELECT * FROM `view_circuit`";

 
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
