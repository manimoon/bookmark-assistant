<?php
session_start();
include_once "db.php";
global $con;
$category = $_POST['category'];
$link = $_POST['link'];
$description = $_POST['description'];
$userid = $_SESSION["auth_user_id"];
$query = "INSERT INTO links(user_id,title,category,url) VALUES($userid,'$description','$category','$link')";
$result = $con->query($query);
print_r($result);
?>
