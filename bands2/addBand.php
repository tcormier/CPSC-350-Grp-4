<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Add a Band</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<h1><a href="http://localhost/bands2/"><img src="images/logo.gif" width="118" height="25" alt="Rock Band" /></a></h1>
<body>
<h1><a href="http://localhost/bands2/"><img src="images/logo.gif" width="118" height="25" alt="Rock Band" /></a></h1>
<?php
	include "db_connect.php";
	$name = $_POST['band_name'];
	$hometown = $_POST['city'].", ".$_POST['state'];	
	$genre = $_POST['genre1'] .", ". $_POST['genre2'] . ", ".$_POST['genre3'];
	$description = $_POST['description'];
	$filename = $_FILES['picture']['picture'];
	$albums = $_POST['albums1'].", ". $_POST['albums2'].", ".$_POST['albums3'].", ".$_POST['albums4'].", ".$_POST['albums5'];
	
	$target ="images/$filename";
	move_uploaded_file($_FILES['picture']['tmp_name'], $target);
	
	
	$query = "INSERT INTO band (band_name, hometown, genre, description, picture_file, albums)
		VALUES ('$name','$hometown','$genre','$description','$target','$albums');";
		
	$result = mysqli_query($db, $query);
	
	echo "<p>Thanks for submitting the form</p>";
	
	echo "<h2>Recent Bands</h2>";
	
	$query = "SELECT * FROM band ORDER BY band_id";
  
  $result = mysqli_query($db, $query)
   or die("Error Querying Database");
  
  echo "<table ALIGN='center' id=\"hor-minimalist-b\">\n<tr><th>Band Name</th><th>Hometown</th><tr>\n\n";
  
  while($row = mysqli_fetch_array($result)) {
  	
  	$name = $row['band_name'];  	
  	$hometown = $row['hometown'];  	
  	echo "<tr><td  >$name</td><td>$hometown</td></tr>\n";
  }
 echo "</table>\n";
 
  
  mysqli_close($db);