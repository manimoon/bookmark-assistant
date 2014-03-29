<?php
include_once "auth/user.php";
	if(isset($_POST['loginform']) || 
		isset($_POST['username']) || 
		isset($_POST['password']))
	{
		
	}
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<form>
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
