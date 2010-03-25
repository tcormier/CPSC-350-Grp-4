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
	$bandName = $_POST['band_name']; 
	$query = "DELETE FROM band WHERE band_name = '$bandName' AND band_id= '$id';";
	$result = mysqli_query($db, $query)
	or die("Error Querying Database");
	
	echo "</br><h2>$bandName has been successfully removed!</h2>
	<p><a href=\"mainPage.php\">Click Here to Access the Main Page</a>";
			
	
	
	
	
	echo "<h2>The result is...<h2>";
	
	
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
  ?> 
  </body>
  