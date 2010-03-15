<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Add a Venue</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<h2><a href="mainPage.php"><img src="images/logo.gif" width="118" height="25" alt="Rock Band" /></a></h2>
<?php
	include "db_connect.php";
	$name = $_POST['venue_name'];
	$address=$_POST['city'] . ", ". $_POST['state'] . ", " . $_POST['zip'];		
	$description = $_POST['description'];
	$filename = $_FILES['picture']['name'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$zip = $_POST['zip'];
	$target ="images/$filename";
	$validinput=true;
	move_uploaded_file($_FILES['picture']['tmp_name'], $target);
	
	if(is_null($name) or $name=="")
	{
		$validinput = false;
		$namestatus = "* Invalid Entry";
	}
	
	if(is_null($_POST['city']) or $_POST['city']=="")
	{
		$validinput = false;
		$citystatus = "* Invalid Entry";
	}
	
	if(is_null($_POST['state']) or $_POST['state']=="")
	{
		$validinput = false;
		$statestatus = "* Invalid Entry";
	}
	
	if(is_null($_POST['zip']) or $_POST['zip']=="")
	{
		$validinput = false;
		$zipstatus = "* Invalid Entry";
	}

	
	if(is_null($description) or $description == "")
	{
		$validinput = false;
		$descriptionstatus = "* Invalid Entry";
	}
	if(!$validinput){
	echo "<form method=\"post\" action=\"postVenue.php\">

<br/>
<br/>
<h1>
Enter the following information to add a new Venue
</h1>
<br/>
<table>
<tr>
<td><b>Venue Name:</b></td><td><input text=\"\" name=\"venue_name\" size=\"15\" value=\"$name\"/>$namestatus</td>
</tr>
</table>
<table>
<tr>
<td><h2>Address: <h2></br></td>              
</tr>
<table>
<tr>
<td><b>City:</b></td>  <td><input text=\"\" name=\"city\" size=\"50\" value=\"$city\" $citystatus</td></tr>
	
<tr><td><b>State(abbreviation):<b></td><td>  <input text=\"\" name=\"state\" size=\"2\" value=\"$state\"/>$statestatus</td>
</tr>
<tr><td><b>Zip Code:</b><input text=\"\" name=\"zip\" size=\"10\" value=\"$zip\"/>$zipstatus</td></tr>

</table>
<table>

<tr><td>Description:</td></tr>
<tr><td><TEXTAREA NAME=\"description\" COLS=40 ROWS=6 value=\"$description\"></TEXTAREA>$descriptionstatus</td>
</tr>
<tr><td>Picture File:</td><td><input type=\"file\" id=\"picture\" name=\"picture\"  /></td>
</tr>
<tr>
<td>
<input type=\"submit\" name=\"submit\" value=\"Submit\"/>
<input type=\"reset\" name=\"reset\" value=\"Clear Form\"/>
</td>
</tr>
</table>
</form>
</body>";
}else{
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
  	
  	echo "<tr><td  >$name</td><td>$location</td></tr>\n";
  }
 echo "</table>\n";   
  mysqli_close($db);
  }
  ?>