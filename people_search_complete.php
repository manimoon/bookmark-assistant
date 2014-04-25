<?php
include_once "db.php";
include_once "auth/user.php";
if(!is_authenticated()) {
	header("Location: login.php");
}
global $con;

if(!isset($_GET['query'])) {
    exit(1);
}
$q = $_GET['query'];
$userid=$_SESSION['auth_user_id'];

$query="select * from user where (username like '%$q%' or first_name like '%$q%' or last_name like '%$q%') and user_id not in (select friend_id from contacts where user_id=$userid) and user_id<>$userid";

$res = $con->query($query);
$response = array(
        "user"=>array(),
        "contacts"=>array()
);

while($row = $res->fetch_assoc()) {
    $response["user"][]=$row;
}


$query = "select * from user where user_id in (select friend_id from contacts where user_id=$userid)";

$res = $con->query($query);

while($row = $res->fetch_assoc()) {
    $response["contacts"][]=$row;
}
echo json_encode($response);
?>
