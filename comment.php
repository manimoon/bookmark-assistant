<?php
session_start();
include_once "db.php";

$link_id = $_POST['link_id'];
$comment_text = $_POST['comment_text'];
error_log(json_encode($_SESSION));
$userid = $_SESSION['auth_user_id'];
$query = "insert into comments(link_id,user_id,comment_text,time) values($link_id,$userid,'$comment_text',sysdate())";
error_log($query);
global $con;
$con->query($query);
?>