<?php
session_start();
include_once "db.php";
global $con;
if(isset($_GET['id'])) {
	$link_id=$_GET['id'];
} else {
	echo "{}";
	exit(1);
}
//$query = "select * from comments where link_id=$link_id";
$query = "select user.username,comments.comment_text,comments.time from user,comments where user.user_id=comments.user_id and comments.link_id=$link_id";
error_log($query);
$res = $con->query($query);

$obj = Array();

while($row = $res->fetch_assoc()) {
	//$obj[$row["comment_id"]]=$row["comment_text"];
	$obj[]=$row;
}

echo json_encode($obj);
?>
