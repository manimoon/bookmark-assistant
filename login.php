<?php
include_once "auth/user.php";
$error_message="";
	logout();
	if(isset($_POST['loginform']) && 
		isset($_POST['username']) && 
		isset($_POST['password']))
	{
		if(authenticate($_POST['username'],$_POST['password']))
		{
			login($_POST['username']);
			if(isset($_GET['redirect_to'])) {
				header('Location: '.$_GET['redirect_to']);
			} else {
				header('Location: ./index.php');
			}
		} else {
			$error_message="Login failed";
		}
	} else {
		$error_message = "Login failed";
		error_log(json_encode($_POST));
	}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<style>
		#loginpanel {
			margin:100px auto;
			width:400px;
			
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">Social Bookmarking</a>
			</div>
		</div>
	</nav>
	<div class="panel panel-default" id="loginpanel">
		<div class="panel-heading">Login</div>
		<div class="panel-body">
			<form method='POST' role="form">
				<input type="hidden" name="loginform" value="loginform" />
				<div class="error_message">
					<?php echo $error_message; ?>
				</div>
				<div class="form-group">
					<label>Username</label>
					<input type="text" name="username" class="form-control">
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="password" class="form-control">
				</div>
				<div class="form-group">
					<a href="register.php" class="btn btn-link">Don't have an account? Register!</a>
					<input type="submit" value="Login" class="btn btn-default pull-right">
				</div>
			</form>
		</div>
	</div>
</body>
</html>
