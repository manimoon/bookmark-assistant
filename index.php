<?php 
include_once "auth/user.php";
if(!is_authenticated()) {
	header("Location: login.php");
}
?>
<!DOCTYPE html>
<!--
    To change this license header, choose License Headers in Project Properties.
    To change this template file, choose Tools | Templates
    and open the template in the editor.
-->
<html>
	<head>
		<title>Social Bookmarking Service</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/main.css">
	</head>
	<body>
		<div class="navbar navbar-default navbar-fixed-top">
			<div class="navbar-brand">
				<div class="navbar-btn" >Social Bookmarking</div>
			</div>
		</div>
	</body>
</html>
