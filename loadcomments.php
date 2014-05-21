<?php
session_start();
include_once "db.php";
global $con;
if(isset($_GET['id'])) {
	$comment_id=$_GET['id'];
} else {
	echo "{}";
	exit(1);
}
$query = "select * from comments where comment_id=$comment_id";
$res = $con->query($query);
$obj = Array();

while($row = $res->fetch_assoc()) {
	$obj[$row["comment_id"]]=$row["comment_text"];
}

echo json_encode($obj);
?>
