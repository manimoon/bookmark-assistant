<?php 
include_once "db.php";
include_once "auth/user.php";
error_log("test");
if(!is_authenticated()) {
	header("Location: login.php");
}
global $ocn;
$user_id = $_SESSION['auth_user_id'];
if($result = $con->query("select * from user where user_id=$user_id")) {
	$user=$result->fetch_assoc();
} else {
	error_log("failed to fetch user data");
	exit(1);
}

if(isset($_POST['username']) &&
	isset($_POST['email']) &&
	isset($_POST['firstname']) &&
	isset($_POST['lastname']) &&
	isset($_POST['dob'])) {
	
	error_log(json_encode($_FILES));
	$image = $_FILES["profile-pic"]["tmp_name"];
	$imageData = base64_encode(file_get_contents($image));
	$pic = 'data: '.mime_content_type($image).';base64,'.$imageData;
	
	$result = update_user($user_id,$_POST['username'],$_POST['firstname'],$_POST['lastname'],$_POST['email'],$_POST['dob']);
	if($result) {
		header('Location: ./login.php');
	} else {
		error_log("RRR: couldn't create user".json_encode($result));
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
					<a class="navbar-brand" href=".">Social Bookmarking</a>
				</div>
				<div class="collapse navbar-collapse" id="mainmenu">
					
					<ul class="nav navbar-nav navbar-right">
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
			<div class="col-md-8 col-md-offset-3">
				<div class="panel panel-default content-panel">
					<div class="panel-heading">
						<h2>Edit Profile</h2>
					</div>
					<div class="panel-body">
						<img src="<?php echo $user['profile_pic']; ?>" id="profile-pic-image"/>
						<form role="form" class="col-md-6" method="post" action="profile.php" enctype="multipart/form-data">
							<div class="form-group">
								<label for="username">Username</label>
								<input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?php echo $user['username']; ?>">
							</div>
							<div class="form-group">
								<label for="email">Email address</label>
								<input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $user['email_id']; ?>">
							</div>
							<div class="form-group">
								<label for="firstname">First Name</label>
								<input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" value="<?php echo $user['first_name']; ?>">
							</div>
							<div class="form-group">
								<label for="lastname">Last Name</label>
								<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" value="<?php echo $user['last_name']; ?>">
							</div>
							<div class="form-group">
								<label for="dob">Date of birth</label>
								<input type="date" class="form-control" id="dob" name="dob" placeholder="Date Of Birth" value="<?php echo $user['dob']; ?>">
							</div>
							<div>
								<input type="submit" value="Update" class="btn btn-primary">
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
