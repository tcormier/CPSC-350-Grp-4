<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Band Page</title>
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
 $bandName = $_POST['editBand']; 
 $query = "SELECT * FROM band WHERE band_name = '$bandName';";
 $result = mysqli_query($db, $query)
 or die("Error Querying Database");

 while($row = mysqli_fetch_array($result)) {
 
	$bandName = $row['band_name'];
	$id = $row['band_id'];
	$description = $row['description'];
	$hometown = explode(", ",$row['hometown']);
	$city = $hometown[0];
	$state = $hometown[1];
	$comments = $row['comment_name'];
	}
 echo "

	<br/>
	<br/>
	
	<br/>
	<table>	
	<th><font size=\"2\" face=\"Verdana\"><b>Band Name:</b></th>
	<tr>
	<td><font size=\"1\" face=\"Verdana\"> $bandName</td>
	</tr>
	<tr>
	<td><font size=\"2\" face=\"Verdana\"><b>Location:</b></td>
	<tr>
	<td><face=\"Verdana\">$city, $state</td>
	</tr>
	</table>
	<table>
	<th><font size=\"2\" face=\"Verdana\"><b>Genre:</b></font></th>";

	$query = "SELECT g.genre_name FROM genre g NATURAL JOIN band_genres bg NATURAL JOIN band WHERE band_name = '$bandName' GROUP BY g.genre_name;";
	
	$result = mysqli_query($db, $query)
	or die("Error Querying Database");
	
	 while($row = mysqli_fetch_array($result)) {
	  
	  $genre = $row['genre_name'];
	  echo "<tr><td>$genre</td></tr>";
	  }


	echo "</tr>
	<tr></tr>
	<tr></tr>
	
	<tr>
	<td><font size=\"2\" face=\"Verdana\"><b>Description:</b></td>
	<tr>
	<tr><td><face=\"Verdana\">$description</td>
	</tr>
	<tr>
	<td><font size=\"2\" face=\"Verdana\"><b>Popular Albums:</b></td></font></tr>";
	
	$query = "SELECT ba.album_name FROM band_albums ba NATURAL JOIN band b WHERE b.band_name = '$bandName';";
	
	$result = mysqli_query($db, $query)
	or die("Error Querying Database");
	
	 while($row = mysqli_fetch_array($result)) {
	  
	  $album = $row['album_name'];
	  echo "<tr><td>$album</td></tr>";
	  }
	  
	  echo"<p><b>Similar Music</b></p>
			<form method = \"POST\" action=\"viewBandPage.php\">
			<select name=\"editBand\" width=\"2\">";
			include "db_connect.php";
			$query = "SELECT b.band_name
						FROM band b
						INNER JOIN genre g						
						WHERE b.band_id = g.genre_id
						GROUP BY b.band_name";
			$result = mysqli_query($db, $query)
			or die("Error Querying Database");
			$venue = NULL;
			while($row = mysqli_fetch_array($result))
			{
				$band_name = $row['band_name'];
				echo "<option>$band_name</option>\n";
			}
			echo "</select>
				<input type = \"submit\" value=\"Go\" name=\"submit3\" />
				<br \>
				</form>";  
	  
	 echo"
	<td><font size=\"2\" face=\"Verdana\"><b>Add Comments:</b></td>
	</tr>
	<form method=\"POST\" action=\"postComment.php\">
	<tr>
	<td><TEXTAREA NAME=\"comments\" COLS=40 ROWS=6 value=\"$comments\">$comments</TEXTAREA></td>
	</tr>
	<tr>
	<td>
	<form method=\"POST\" action=\"postComment.php\">
	<input type=\"hidden\" name= \"id\" value=\"$id\" />
	<input type=\"hidden\" name= \"comment_name\" value=\"$comments\" />
	<input type=\"submit\" name=\"submit\" value=\"Submit\"/></td>
	</tr>
	<tr>
	<td><font size=\"2\" face=\"Verdana\"><b>Comments:</b></td>
	</tr>";
	$query2 = "SELECT c.comment_name FROM comments c NATURAL JOIN band b WHERE b.band_name = '$bandName' GROUP BY c.id;";
	$result2 = mysqli_query($db, $query2)
	or die("Error Querying Database");
	
	while($row=mysqli_fetch_array($result2)) {
		$comments = $row['comment_name'];
		echo "<tr><td><ul><li>$comments</li></ul></td></tr>";
	}
	echo"
	
	<!-- display band picture here -->
	</tr>
	<tr>
	<td>
	</table>
	";
	
	echo "<h2>Upcoming Shows</h2>";
	include "db_connect.php";
						$query = "SELECT e.event_name, b.band_name, v.venue, e.time, e.date
						FROM band b
						INNER JOIN upcoming_shows e
						INNER JOIN venue v ON b.band_id = e.band_id
						AND v.venue_id = e.venue_id AND b.band_name = '$bandName'
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
					echo "</table>";?>
 
 
 </body>
 </html>