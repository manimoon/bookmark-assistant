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

function login($username) {
	global $con;
	$query = "select user_id,username,first_name,last_name,email_id,dob from user where username='$username'";
	$result = $con->query($query);
	if($result->num_rows==1) {
		$record = $result->fetch_assoc();
		foreach($record as $k => $v) {
			$_SESSION["auth_".$k]=$v;
		}
	} else {
		error_log($query);
		error_log("Failed to login the speciefied user.");
		return FALSE;
	}
}

function logout() {
	foreach($_SESSION as $k => $v) {
		if(strpos($k,"auth_")===0) {
			unset($_SESSION[$k]);
		}
	}
}

function create_user($username,$fn,$ln,$pwd,$email,$pic,$dob) {
	global $con;
	$query = "INSERT INTO user(username,first_name,last_name,password,email_id,profile_pic,dob) VALUES('$username','$fn','$ln','$pwd','$email','$pic','$dob')";
	return $con->query($query);
}

function update_user($userid,$username,$fn,$ln,$email,$dob) {
	global $con;
	$query = "UPDATE user set username='$username',first_name='$fn',last_name='$ln',email_id='$email',dob='$dob' where user_id=$userid";
	error_log($query);
	return $con->query($query);
}


function get_userid($username) {
	global $con;
	$query = "select user_id from user where username='$username'";
	$result = $con->query($query);
	if(!$result) {
		error_log($query);
	}
	if($row = $result->fetch_array()) {
		return $row[0];
	}else {
		return false;
	}
}

?>
