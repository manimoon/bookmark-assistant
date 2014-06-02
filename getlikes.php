<?php
include_once "db.php";
global $con;

$linkid = $_GET['id'];	
$query = "select count(*) from likes_dislikes where link_id=$linkid";

if($result = $con->query($query)) {
	if($row = $result->fetch_array())
	echo $row[0];
	else
	echo '0';
}else {
	echo '0';
	exit(1);
}
