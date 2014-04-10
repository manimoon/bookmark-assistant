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
		<link rel="stylesheet" type="text/css" href="css/pure-min.css">
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
						<li><a href="logout.php	">Logout</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="pure-g">
			<div class="pure-u-1-5">
				<div id="left-menu">
					<div>
						<ul class="nav nav-pills nav-stacked">
							<li><a href="#">Ass</a></li>
							<li><a href="#">Ass</a></li>
							<li><a href="#">Ass</a></li>
							<li><a href="#">Ass</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="pure-u-4-5">
				Hello World
			</div>
		</div>
	</body>
</html>
