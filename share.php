<?php
session_start();
include_once "auth/user.php";

$linkid=$_REQUEST['id'];
$userid = $_SESSION['auth_user_id'];
$tousername=$_REQUEST['to'];
$touserid=get_userid($tousername);

$query = "insert into share(`link_id`,`from`,`to`) values($linkid,$userid,$touserid)";
global $con;
if($con->query($query)) {
	echo "link shared with $tousername";
} else {
	echo "Failed to share the link";
	error_log($query);
}
?>
