<?php
include_once "db.php";
global $con;
if(!isset($_GET['query'])) {
	exit(1);
}
if(strlen($_GET['query'])<1) {
	exit(1);
}
$q = $_GET['query'];

$query = "select * from links where title like '%$q%' or url like '%$q%' or category like '%$q%'";

$res = $con->query($query);

$obj = Array();

while($row = $res->fetch_assoc()) {
	$obj[]=$row;
}

echo json_encode($obj);
?>
