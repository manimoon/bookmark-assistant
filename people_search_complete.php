<?php
include_once "db.php";
<<<<<<< HEAD
include_once "auth/user.php";
if(!is_authenticated()) {
	header("Location: login.php");
}
=======
>>>>>>> bd0440d6272738a719ef8df018611ab7c85c6689
global $con;

if(!isset($_GET['query'])) {
    exit(1);
}
<<<<<<< HEAD
$q = $_GET['query'];
$userid=$_SESSION['auth_user_id'];

$query="select * from user where (username like '%$q%' or first_name like '%$q%' or last_name like '%$q%') and user_id not in (select friend_id from contacts where user_id=$userid) and user_id<>$userid";

=======
if(strlen($_GET['query'])<1) {
    exit(1);
}
$q = $_GET['query'];



$query="select * from user where username like '%$q%' or first_name like '%$q%' or last_name like '%$q%'";
>>>>>>> bd0440d6272738a719ef8df018611ab7c85c6689
$res = $con->query($query);
$response = array(
        "user"=>array(),
        "contacts"=>array()
);

while($row = $res->fetch_assoc()) {
    $response["user"][]=$row;
}

<<<<<<< HEAD

$query = "select * from user where user_id in (select friend_id from contacts where user_id=$userid)";

=======
$query="select * from contacts";
>>>>>>> bd0440d6272738a719ef8df018611ab7c85c6689
$res = $con->query($query);

while($row = $res->fetch_assoc()) {
    $response["contacts"][]=$row;
}
echo json_encode($response);
?>
