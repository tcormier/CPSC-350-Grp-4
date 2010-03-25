<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Delete Band</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<h1><a href="index.php"><img src="images/logo.gif" width="118" height="25" alt="Rock Band" /></a></h1>
<body>

<?php
	
	include "db_connect.php";
	$id = $_POST['id'];
	$venueName = $_POST['venue']; 
	$query = "DELETE FROM venue WHERE venue = '$venueName' AND venue_id= '$id';";
	echo $query;
	$result = mysqli_query($db, $query)
	or die("Error Querying Database");
	
	echo "</br><h2>$venueName has been successfully removed!</h2>
	<p><a href=\"mainPage.php\">Click Here to Access the Main Page</a>";
			
	
	
	
	
	echo "<h2>The result is...<h2>";
	
	
	$query = "SELECT * FROM venue ORDER BY venue_id";
  
  $result = mysqli_query($db, $query)
   or die("Error Querying Database");
  
  echo "<table ALIGN='center' id=\"hor-minimalist-b\">\n<tr><th>Venue Name</th><th>Location</th><tr>\n\n";
  
  while($row = mysqli_fetch_array($result)) {
  	
  	$name = $row['venue'];  	
  	$location = $row['location'];  	
  	echo "<tr><td  >$name</td><td>$location</td></tr>\n";
  }
 echo "</table>\n";
	
	mysqli_close($db);
  ?> 
  </body>
  