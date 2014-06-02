<?php
session_start();
require_once 'db.php';
$userid = $_SESSION['auth_user_id'];
$linkid = $_REQUEST['id'];

global $con;
$x="select * from likes_dislikes where link_id=$linkid and user_id=$userid";
$result = $con->query($x);
error_log("----===---");
error_log("%%%%%%%".$x."%%%%%%%");
error_log("====".json_encode($result)."====");
error_log("----===----");
if($result->fetch_row()) {
	$query = "delete from likes_dislikes where link_id=$linkid and user_id=$userid";
	error_log($query);
	$con->query($query);	
} else {
	$query = "INSERT INTO likes_dislikes(link_id,user_id,likedislike) VALUES($linkid,$userid,'like')";
	error_log($query);
	$con->query($query);
}

?>
