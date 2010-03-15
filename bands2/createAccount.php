<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Account Created Successfully!</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
  <h1><a href="mainPage.php"><img src="images/logo.gif" width="118" height="25" alt="Rock Band" /></a></h1>
	<body>
	<?php
		include "db_connect.php";
		$username = mysqli_real_escape_string($db, trim($_POST['username']));
		$password = mysqli_real_escape_string($db, trim($_POST['password']));
		$location = mysqli_real_escape_string($db, trim($_POST['location']));
		$validinput = true;
		
		if(is_null($username) or $username=="")
		{
		$validinput = false;
		$usernamestatus = "* Invalid Entry";
		}
		
		if(is_null($password) or $password=="")
		{
		$validinput = false;
		$passwordstatus = "* Invalid Entry";
		}
		
		if(is_null($location) or $location=="")
		{
		$validinput = false;
		$locationstatus = "* Invalid Entry";
		}
		
		if(!$validinput){
		echo "
		<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">
		<head>
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
		<title>Log In</title>
		<link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\" />
		</head>
		<script type=\"text/javascript\" src=\"calendarDateInput.js\" />

		<body>
		<div id=\"contents\">
		<h1>Create Account</h1>  
		<form method=\"post\" action=\"createAccount.php\">
			<label for=\"username\">Username:</label>
			<input type=\"text\" id=\"username\" name=\"username\" value=\"$username\"/>$usernamestatus<br />
			<label for=\"pw\">Password:</label>
			<input type=\"password\" id=\"password\" name=\"password\"/>$passwordstatus<br />
			<label for=\"zip\">Location:</label>
			<input type=\"text\" id=\"location\" name=\"location\" value=\"$location\" />$locationstatus<br />
			<input type=\"submit\" value=\"Create Account\" name=\"submit\" />
		</form>
		</div>
  
		</body>
		</html>";
		}else{
		$query = "INSERT INTO users (username, password, location)
					VALUES('$username', SHA('$password'), '$location');";
					
		
		$result = mysqli_query($db, $query)
		or die("Error Querying Database");
		
		echo "<p>Thanks for creating an Account!</p>";
		echo "<p>You are now able to access the areas of our website </br> where you can add/remove/edit band and venue entries</p>";
		echo "<a href=\"index.php\">Click here to go back and sign in.</a>";
		
		mysqli_close($db);
		}
		?>
	</body>
</html>