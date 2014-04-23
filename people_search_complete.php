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



$query="select * from user where username like '%$q%' or first_name like '%$q%' or last_name like '%$q%'";
$res = $con->query($query);
$response = array(
        "user"=>array(),
        "contacts"=>array()
);

while($row = $res->fetch_assoc()) {
    $response["user"][]=$row;
}

$query="select * from contacts";
$res = $con->query($query);

while($row = $res->fetch_assoc()) {
    $response["contacts"][]=$row;
}
echo json_encode($response);
?>
