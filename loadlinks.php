<?php
session_start();
include_once "db.php";
global $con;
$user_id = $_SESSION["auth_user_id"];

$query = "select * from links where user_id=$user_id";
$res = $con->query($query);
$obj = Array();

while($row = $res->fetch_assoc()) {
	if(!isset($obj[$row['category']])) {
		$obj[$row['category']] = Array();
	}
	
	$obj[$row['category']][$row['link_id']] = [
						'url'=>$row['url'],
						'title'=>$row['title']
					];
}
echo json_encode($obj);
?>
