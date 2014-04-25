<?php
include_once "db.php";
include_once "auth/user.php";
if(!is_authenticated()) {
	header("Location: login.php");
}
global $con;
if(!isset($_REQUEST['friend'])) {
    exit(1);
}

$user = $_SESSION['auth_user_id'];
$friend = $_REQUEST['friend'];

$query="INSERT INTO contacts(user_id,friend_id) VALUES($user,$friend)";
echo $query;
if($con->query($query)) {
	echo TRUE;
} else {
	echo FALSE;
}
?>
