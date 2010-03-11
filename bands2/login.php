<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>login</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<h1><a href="index.php"><img src="images/logo.gif" width="118" height="25" alt="Rock Band" /></a></h1>
<body>

<?php
	
	include "db_connect.php";
	$username = $_POST['username'];
	$password = $_POST['password'];	
	$query = "SELECT * from users WHERE username= '$username' AND password= SHA('$password')";
	
	$result = mysqli_query($db, $query);
	$_SESSION['user_name'] = '$username';
    $_SESSION['password'] = '$password';
	if ($row = mysqli_fetch_array($result))
	{
	echo "</br><h2>You are now signed in. Thanks $username!</h2>
			<p><a href=\"mainPage.php\">Click Here to Access the Main Page</a>";
			session_register("username");
	}
	else
	{
	echo "<h2>The username or password is incorrect. <a href=\"index.php\">Click Here to try again.</a></h2>";
	}
	mysqli_close($db);
	
  ?> 
  </body>
  