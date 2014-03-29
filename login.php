<?php
include_once "auth/user.php";
$error_message="";
	logout();
	if(isset($_POST['loginform']) || 
		isset($_POST['username']) || 
		isset($_POST['password']))
	{
		if(authenticate($_POST['username'],$_POST['password']))
		{
			login($_POST['username']);
			error_log(json_encode($_SESSION));
			if(isset($_GET['redirect_to'])) {
				header('Location: '.$_GET['redirect_to']);
			} else {
				header('Location: /index.php');
			}
		} else {
			$error_message="Login failed";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<form method='POST'>
		<div class="error_message">
			<?php echo $error_message; ?>
		</div>
		<div>
			<label>Username</label>
			<input type="text" name="username">
		</div>
		<div>
			<label>Password</label>
			<input type="password" name="password">
		</div>
		<div>
			<input type="submit">
		</div>
	</form>
</body>
</html>
