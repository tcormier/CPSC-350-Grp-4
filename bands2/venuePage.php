<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Venue Page<title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<form method="post" action="editVenue.php">

<br/>
<br/>
<h1>
<a href="index.php"><img src="images/logo.gif" width="118" height="25" alt="Rock Band" /></a><br/>
Venue Information
</h1>

<b></b>

<?php
 include "db_connect.php";
 $venueName = $_POST['editVenue']; 
 $query = "SELECT * FROM venue WHERE venue = '$venueName';";
 $result = mysqli_query($db, $query)
 or die("Error Querying Database");

 while($row = mysqli_fetch_array($result)) {
	$venueName = $row['venue'];
	$id = $row['venue_id'];
	$description = $row['description'];
	$location = explode(", ",$row['location']);
	$city = $location[0];
	$state = $location[1];
	//$picture = $row['picture_file'];
 }
 
 //$zipQuery = "SELECT location FROM users WHERE user = '$_SESSION['user_name']';";
 $destinationQuery = "SELECT location FROM venue WHERE venue = '$venueName';";
 $result = mysqli_query($db, $query)
 or die("Error Querying Database");
 
 while($row = mysqli_fetch_array($result)) {
	$destination = $row['location'];
	}
	
 
 //<img src="$picture">
 echo "<form method=\"post\" action=\"editVenue.php\">
	
	<br/>
	<br/>
	<h3>	
	Edit the following to change information about the venue.
	</h3>
	<br/>
	<table>
	<tr>
	<td><b>Venue Name:</b></td>
	<td><input text=\"\" name=\"venue\" size=\"15\" value=\"$venueName\" /></td>
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
	</form>";
	echo "
	
	<form action=\"http://maps.google.com/maps\" method=\"get\">
	<p><label for=\"saddr\">Your ZIP code for directions</label>
	<input type=\"text\" name=\"saddr\" id=\"saddr\" value=\"\" />
	<input type=\"submit\" value=\"Go\" />
	<input type=\"hidden\" name=\"daddr\" value='$destination' />
	<input type=\"hidden\" name=\"hl\" value=\"en\" /></p>
	</form>
	";

 ?>
 </body>
 </html>