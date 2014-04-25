<?php
include_once "auth/user.php";
if(isset($_POST['username']) &&
	isset($_POST['email']) &&
	isset($_POST['firstname']) &&
	isset($_POST['lastname']) &&
	isset($_POST['dob'])) {
	
	error_log(json_encode($_FILES));
	$image = $_FILES["profile-pic"]["tmp_name"];
	$imageData = base64_encode(file_get_contents($image));
	$pic = 'data: '.mime_content_type($image).';base64,'.$imageData;
	
	
	if(create_user($_POST['username'],$_POST['firstname'],$_POST['lastname'],$_POST['email'],$pic,$_POST['dob'])) {
		header('Location: ./login.php');
	} else {
		error_log("RRR: couldn't create user");
	}
} else {
	error_log(json_encode($_POST));
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Social Bookmarking Service</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
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
					<p class="navbar-text navbar-right">Have an account? <a href="login.php" class="navbar-link">Login</a></p>
				</div>
			</div>
		</nav>
		<div class="row container page-container">
			<div class="col-md-8 col-md-offset-3">
				<div class="panel panel-default content-panel">
					<div class="panel-heading">
						<h2>Register</h2>
					</div>
					<div class="panel-body">
						<form role="form" class="col-md-6" method="post" action="register.php" enctype="multipart/form-data">
							<div class="form-group">
								<label for="username">Username</label>
								<input type="text" class="form-control" id="username" name="username" placeholder="Username">
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" class="form-control" id="password" name="password" placeholder="Password">
							</div>
							<div class="form-group">
								<label for="re-type-password">Re-type Password</label>
								<input type="password" class="form-control" id="re-type-password" name="re-type-password" placeholder="Re-Type Password">
							</div>
							<div class="form-group">
								<label for="email">Email address</label>
								<input type="email" class="form-control" id="email" name="email" placeholder="Email">
							</div>
							<div class="form-group">
								<label for="firstname">First Name</label>
								<input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name">
							</div>
							<div class="form-group">
								<label for="lastname">Last Name</label>
								<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name">
							</div>
							<div class="form-group">
								<label for="dob">Date of birth</label>
								<input type="date" class="form-control" id="dob" name="dob" placeholder="Date Of Birth">
							</div>
							
							<div class="form-group">
								<label for="profile-pic">Profile Pic</label>
								<input type="file" id="profile-pic" name="profile-pic" placeholder="Profile Pic">
							</div>
							<div>
								<input type="submit" value="Register" class="btn btn-primary">
							</div>
						</form>
					</div>
					<div class="panel-footer">
						
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
