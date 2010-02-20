<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Add a Band</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>

<?php
	include "db_connect.php";
	$name = $_POST['venue_name'];
	$address=$_POST['city'] . ", ". $_POST['state'] . ", " . $_POST['zip'];		
	$description = $_POST['description'];
	$filename = $_FILES['picture']['name'];
	
	$target ="images/$filename";
	move_uploaded_file($_FILES['picture']['tmp_name'], $target);
	
	
	$query = "INSERT INTO venue (venue, location, description, picture_file)
		VALUES ('$name','$address','$description','$target')";
		
	$result = mysqli_query($db, $query);
	
	echo "<p>Thanks for submitting the form</p>";
	
	echo "<h1>Recent Venues</h1>";
	
	$query = "SELECT * FROM venue ORDER BY venue_id";
  
  $result = mysqli_query($db, $query)
   or die("Error Querying Database");
  
  echo "<table id=\"hor-minimalist-b\">\n<tr><th>Venue Name</th><th></th><th>Location</th><tr>\n\n";
  
  while($row = mysqli_fetch_array($result)) {
  	
  	$name = $row['venue'];
  	
  	$location = $row['location'];
  	
  	echo "<tr><td  >$name</td><td >$city</td><td>$location</td></tr>\n";
  }
 echo "</table>\n"; 
  
  mysqli_close($db);