<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Add an Event</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<h1><a href="mainPage.php"><img src="images/logo.gif" width="118" height="25" alt="Rock Band" /></a><br/>
Enter the following information to add a new Event</h1>
<body>

<?php
	include "db_connect.php";
	
	$eventName = $_POST['eventName'];
	$band = $_POST['editBand'];
	$venue=$_POST['choosevenue'];
	$date=$_POST['date'];	
	$time = $_POST['time'];
	
	$validinput = true;
	$target ="images/$filename";
	move_uploaded_file($_FILES['picture']['tmp_name'], $target);
	
	if(is_null($band) or $band == "")
	{
		$validinput = false;
		$bandstatus = "* Invalid Entry";
	}
	
	if (is_null($venue) or $venue == "")
	{
		$validinput = false;
		$venuestatus = "* Invalid Entry";
	}
	
	if (is_null($date) or $date == "")
	{
		$validinput = false;
		$datestatus = "* Invalid Entry";
	}
		
	if (is_null($time) or $time == "")
	{
		$validinput = false;
		$timestatus = "* Please enter a time for the event!";
	}
	
	if(!$validinput){
		echo "<br/>
	<br/>
	<h1>
	<a href=\"http://localhost/bands2/\"><img src=\"images/logo.gif\" width=\"118\" height=\"25\" alt=\"Rock Band\" /></a><br/>
	Enter the following information to add an event for a band.
	</h1>
	<br/>
	<table>
	<tr>
	<td><b>Band Name:</b></td>
	<td><select name=\"editBand\">";
	
        include "db_connect.php";
        $query = "SELECT DISTINCT band_name FROM band;";
        $result = mysqli_query($db, $query);
	    $band=NULL;
		while($row = mysqli_fetch_array($result))	
		{
		$band = $row['band_name'];
		echo "<option>$band</option>\n";
		}
		echo "
	    </select></td>
	</tr>


	<tr>
	<td>Venue:</br></td> 
	<td><select name=\"choosevenue\">";
	
	include "db_connect.php";
	$query = "SELECT DISTINCT venue FROM venue;";
	$result = mysqli_query($db, $query);
	$venue=NULL;
	while($row = mysqli_fetch_array($result))	
		{
		$venue = $row['venue'];
		echo "<option>$venue</option>\n";
		}
	
	echo "
	</select></td>
             
	</tr>

	<tr>
	<td><b>Date of Event:</b></td>  <td><input text=\"\" name=\"date\" size=\"20\" />$datestatus </td></tr>
	
	<td><b>Time:<b></td><td>  <input text=\"\" name=\"time\" size=\"10\" />$timestatus</td>
	</tr>
	</table>

	<tr>
	<td>
	<input type=\"submit\" name=\"submit\" value=\"Submit\"/>
	<input type=\"reset\" name=\"reset\" value=\"Clear Form\"/>
	</td>
	</tr>
	</table>
	</body>";	
	}else{
	include "db_connect.php";
		$query = "SELECT DISTINCT band_id FROM band WHERE band_name = '$band';";
		$result = mysqli_query($db, $query);

		while($row = mysqli_fetch_array($result))	
		{
		$bandid = $row['band_id'];		
		}
	
		$query = "SELECT DISTINCT venue_id FROM venue where venue = '$venue';";
		$result = mysqli_query($db, $query);

		while($row = mysqli_fetch_array($result))	
		{
		$venueid = $row['venue_id'];
		
		}
	
	$query = "INSERT INTO upcoming_shows (band_id, event_name, date, time, venue_id)
		VALUES ('$bandid','$eventName','$date','$time', '$venueid');";
		
	$result = mysqli_query($db, $query)
	or die("error Querying Database");
	echo "\n";
	
	
	
  
  mysqli_close($db);
  }
  include "db_connect.php";
  $query = "SELECT b.band_name, v.venue, e.event_name, e.time, e.date
FROM band b
INNER JOIN upcoming_shows e
INNER JOIN venue v ON b.band_id = e.band_id
AND v.venue_id = e.venue_id
GROUP BY e.event_id";
  $result = mysqli_query($db, $query)
  or die("Error Querying Database");
  while($row = mysqli_fetch_array($result)){
		$eventName = $row['event_name'];
		$bandName = $row['band_name'];
		$venue = $row['venue'];
		$time = $row['time'];
		$date = $row['date'];
	}
	
	echo "<table ALIGN='center' id=\"hor-minimalist-b\">\n<tr><th>Event Name</th><th>Band Name</th><th>Venue Name </th><th>Time</th><th>Date</th></tr>\n\n";
	echo "<tr><td>$eventName</td><td >$bandName</td><td>$venue</td><td>$time</td><td>$date</td></tr>\n";
	echo "</table>";