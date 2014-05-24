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
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/main.js"></script>
	</head>
	<body>
		<nav class="navbar navbar-fixed-top navbar-inverse" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainmenu">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Social Bookmarking</a>
				</div>
				<div class="collapse navbar-collapse" id="mainmenu">
					
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#" data-toggle="tooltip" data-placement="bottom" title="Mani Commented on your link">Notifications</a></li></li>

						<li><p class="navbar-text navbar-right">Signed in as</p></li>
						<li>
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['auth_username']; ?>
								<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li><a href="profile.php">Edit Profile</a></li>
								<li><a href="logout.php">Logout</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="row container page-container">
			<div class="col-md-3">
				<div id="left-menu">
					<div>
						<ul class="nav nav-pills nav-stacked">
							<li><a href="#AddLink">Add New Bookmark</a></li>
							<li><a href="#MyLinks">My Bookmarks</a></li>
							<li><a href="#Search">Search Bookmarks</a></li>
							<li><a href="#MyContacts">My Contacts</a></li>
							<li><a href="newaddon.xpi">Download Plugin</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<div class="panel panel-default content-panel">
				</div>
			</div>
			<div style="display:none" id="TheSpecialPageElement"></div>
		</div>
	</body>
</html>
