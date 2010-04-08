<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Venue Page</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>



<br/>
<br/>
<?php
	if(session_is_registered("username")){
	echo"<ul id=\"nav\">
		<li><a href=\"mainPage.php\">home</a></li>
		<li><a href=\"addBand.php\">add band</a></li>
		<li><a href=\"addVenue.php\">add venue</a></li>
		<li><a href=\"addEvent.php\">add event</a></li>
		<li><a href=\"logout.php\">logout</a></li>
	</ul>
	";}
	else{
	echo "
	<h1><a href=\"index.php\"><img src=\"images/logo.gif\" width=\"118\" height=\"25\" alt=\"Rock Band\" /></a></h1>";
	}
	?>
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
 echo "
	<!-- display venue picture here -->
	<br/>
	<br/>
	
	<br/>
	<table>	
	<th><font size=\"2\" face=\"Verdana\"> $venueName</th>	
	<tr>
	<td><font size=\"2\" face=\"Verdana\">$city</td></tr>
	<tr><td><font size=\"2\" face=\"Verdana\">$state </td>
	</tr>
	<tr><td><font size=\"2\" face=\"Verdana\">$description</td>
	</tr>
	<!-- display band picture here -->
	</tr>
	<tr>
	<td>
	</table>
	";
	echo "
	
	<form action=\"http://maps.google.com/maps\" method=\"get\">
	<p><label for=\"saddr\">Your ZIP code for directions</label>
	<input type=\"text\" name=\"saddr\" id=\"saddr\" value=\"\" />
	<input type=\"submit\" value=\"Go\" />
	<input type=\"hidden\" name=\"daddr\" value='$destination' />
	<input type=\"hidden\" name=\"hl\" value=\"en\" /></p>
	</form>
	";
	
	echo "<h2>Upcoming Shows</h2>";
	include "db_connect.php";
						$query = "SELECT e.event_name, b.band_name, v.venue, e.time, e.date
FROM band b
INNER JOIN upcoming_shows e
INNER JOIN venue v ON b.band_id = e.band_id
AND v.venue_id = e.venue_id AND v.venue = '$venueName'
GROUP BY e.event_id";
						$result = mysqli_query($db, $query)
						 or die("Error Querying Database");
						 echo "<table ALIGN='center' id=\"hor-minimalist-b\">\n<tr><td>Event Name</th><th>Band Name</th><th>Venue Name </th><th>Time</th><th>Date</th></tr>\n\n";
						 while($row = mysqli_fetch_array($result)){
						$eventName = $row['event_name'];		
						$bandName = $row['band_name'];
						$venue = $row['venue'];
						$time = $row['time'];
						$date = $row['date'];
	
	
					
					echo "<tr><td>$eventName</td><td  >$bandName</td><td>$venue</td><td>$time</td><td>$date</td></tr>\n";}
					echo "</table>";
 ?>
 
 </body>
 </html>