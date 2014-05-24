<?php
session_start();
include_once "db.php";
global $con;

$query="select * from user";
$res = $con->query($query);
$response = array("user"=>array());

while($row = $res->fetch_assoc()) {
	error_log(json_encode($row));
    $response["user"][]=$row;
}


echo json_encode($response);
?>
