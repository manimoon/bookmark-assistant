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
	
	$obj[$row['category']][$row['link_id']] = array(
						'url'=>$row['url'],
						'title'=>$row['title']
					);
}
<<<<<<< HEAD
if(sizeof($obj)==0)
$obj['empty']='true';

=======
>>>>>>> bd0440d6272738a719ef8df018611ab7c85c6689
echo json_encode($obj);
?>
