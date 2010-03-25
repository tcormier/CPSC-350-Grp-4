<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Add a Band</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<h1><a href="mainPage.php"><img src="images/logo.gif" width="118" height="25" alt="Rock Band" /></a><br/>
Enter the following information to edit the Venue</h1>
<body>

<?php
	include "db_connect.php";
	
	$id = $_POST['id'];
	$name = $_POST['venue'];
	$location = $_POST['city'].", ".$_POST['state'];
	$city=$_POST['city'];
	$state=$_POST['state'];	
	$description = $_POST['description'];
	$filename = $_FILES['picture']['picture'];	
	
	$validinput = true;
	$target ="images/$filename";
	move_uploaded_file($_FILES['picture']['tmp_name'], $target);
	
	if(is_null($name) or $name=="")
	{
		$validinput = false;
		$namestatus = "* Invalid Entry";
	}
	
	if (is_null($_POST['city']) or $_POST['city'] == "")
	{
		$validinput = false;
		$citystatus = "* Invalid Entry";
	}
	
	if (is_null($_POST['state']) or $_POST['state'] == "")
	{
		$validinput = false;
		$statestatus = "* Invalid Entry";
	}
	
	if(is_null($description) or $description == "")
	{
		$validinput = false;
		$descriptionstatus = "* Invalid Entry";
	}
	if(!$validinput){
		echo "<form method=\"post\" action=\"editVenue.php\">
	
	<br/>
	<br/>
	<h3>	
	Edit the following to change information about the venue.
	</h3>
	<br/>
	<table>
	<tr>
	<td><b>Venue Name:</b></td><td><input text=\"\" name=\"venue\" size=\"15\" value=\"$venueName\"/></td>
	</tr>
	</table>
	<table>
	<tr>
	<td><h2>Location City and State: <h2></br></td>              
	</tr>
	<table>
	<tr>
	<td><b>City:</b></td>  <td><input text=\"\" name=\"city\" size=\"50\"  value=\"$city\" /></td></tr>
	
	<td><b>State(abbreviation):<b></td><td>  <input text=\"\" name=\"state\" size=\"2\" value=\"$state\" /></td>
	</tr>
	</table>
	<table>
	
	
	<tr><td>Description:</td></tr>
	<tr><td><TEXTAREA NAME=\"description\" COLS=40 ROWS=6 value=\"$description\">$description</TEXTAREA></td>
	</tr>
	<tr>
	
	<td>Picture File:</td><td><input type=\"file\" id=\"picture\" name=\"picture\"  /></td>
	</tr>
	<tr>
	<td>
	<input type=\"hidden\" name= \"id\" value=\"$id\" />
	<input type=\"submit\" name=\"submit\" value=\"Submit\"/>
	<input type=\"reset\" name=\"reset\" value=\"Clear Form\"/>
	</td>
	</tr>	
	</table>
	</form>
	<form method=\"POST\" action=\"deleteVenue.php\">
	<input type=\"hidden\" name= \"id\" value=\"$id\" />
	<input type=\"hidden\" name= \"venue\" value=\"$venueName\" />
	<input type=\"submit\" name\"submit\" value=\"Delete\"/>
	</form>
	";
	}else{
	$query = "UPDATE venue SET venue = '$name', location = '$location', 
			description = '$description', picture_file = '$target'
			WHERE venue_id = '$id';";
	
	$result = mysqli_query($db, $query)
	or die("Error Querying Database");
	echo "\n";
	
	
	echo "<p>Thanks for submitting the form</p>";
	
	echo "<h2>Recent Venues</h2>";
	
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
  }
  ?>


		
		
