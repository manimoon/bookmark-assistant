<?php
session_start();
include_once "db.php";

function authenticate($username, $password) {
	global $con;
	$query = "select * from user where username='$username' and password='$password'";
	$result = $con->query($query);
	if($result->num_rows==1) {
		return TRUE;
	} else {
		return FALSE;
	}
}

function is_authenticated() {
	if(isset($_SESSION["auth_user_id"])) {
		return TRUE;
	} else {
		return FALSE;
	}
}

function login($user_id) {
	global $con;
	$query = "select * from user where user_id=$user_id";
	$result = $con->query($query);
	if($result->num_rows==1) {
		$record = $result->fetch_assoc();
		foreach($record as $k => $v) {
			$_SESSION["login_".$k]=$v;
		}
	} else {
		error_log($query);
		error_log("Failed to login the speciefied user.");
		return FALSE;
	}
}

function logout() {
	foreach($_SESSION as $k => $v) {
		if(strpos($k,"login_")===0) {
			unset($_SESSION[$k]);
		}
	}
}
?>
