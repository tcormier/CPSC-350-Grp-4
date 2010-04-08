<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Add a Comment</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<h1><a href="mainPage.php"><img src="images/logo.gif" width="118" height="25" alt="Rock Band" /></a><br/>
Thanks for submitting your post!</h1>
<body>

<?php
	include "db_connect.php";
	
	$comments = $_POST['comments'];
	$bandName = $_POST['band_name'];
	$id = $_POST['id'];
	
	$validinput = true;
	$target ="images/$filename";
	move_uploaded_file($_FILES['picture']['tmp_name'], $target);
	
	if (is_null($_POST['$comment_name']) or $_POST['comment_name'] == "")
	{
		$validinput = false;
		$statestatus = "* Invalid Entry";
	}
	$query2 = "INSERT INTO comments (band_id, comment_name) values ('$id', '$comments');";
		$result2 = mysqli_query($db, $query2)
		or die("Error Querying Database");
		
	if(!$validinput){
		echo "<form method=\"post\" action=\"postComment.php\">";
		
		echo "<p>Thanks for submitting the form</p>";
	
		echo "<h2>Recent Comments:</h2>";
		
		$query2 = "SELECT c.comment_name FROM comments c NATURAL JOIN band b WHERE b.band_id = '$id' GROUP BY c.id;";
		$result2 = mysqli_query($db, $query2)
		or die("Error Querying Database");
	
		while($row=mysqli_fetch_array($result2)) {
			$comments = $row['comment_name'];
			echo "<tr><td><ul><li>$comments</li></ul></td></tr>";
		}
		mysqli_close($db);
	}
	?>