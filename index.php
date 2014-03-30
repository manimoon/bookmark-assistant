<?php 
include_once "auth/user.php";
error_log("test");
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
		<nav class="navbar navbar-default" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header>
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainmenu">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" hred="#">Social Bookmarking</a>
				</div>
				<div class="collapse navbar-collapse" id="mainmenu">
					<ul class="nav navbar-nav">
						<li><a href="#">Action</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#">Logout</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</body>
</html>
