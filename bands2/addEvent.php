<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Add an Event</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<form method="post" action="postEvent.php">

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
<b>Enter the following information to add a new Event
</b>
<br/>
<table>
<tr>
<td><b>Band Name:</b></td>
<td><select name="editBand"><?php
        include "db_connect.php";
        $query = "SELECT DISTINCT band_name FROM band;";
        $result = mysqli_query($db, $query);
	  
		while($row = mysqli_fetch_array($result))	
		{
			$band = $row['band_name'];
			echo "<option>$band</option>\n";
		}
		?>
	    </select></td>
</tr>


<tr>
<td><h2>Venue: <h2></br></td> 
<td><select name="choosevenue"><?php
include "db_connect.php";
$query = "SELECT DISTINCT venue FROM venue;";
$result = mysqli_query($db, $query);

while($row = mysqli_fetch_array($result))	
		{
		$venue = $row['venue'];
		echo "<option>$venue</option>\n";
		}
		?>
</select></td>
             
</tr>
<tr><td><b>Name of Event:</b></td> <td> <input text="" name="eventName" size = "20" /> </td></tr>
<tr>
<td><b>Date of Event:</b></td>  <td><input text="" name="date" size="20" /> </td></tr>
<tr>	
<td><b>Time:<b></td><td>  <input text="" name="time" size="10" /></td>
</tr>
</table>

<tr>
<td>
<input type="submit" name="submit" value="Submit"/>
<input type="reset" name="reset" value="Clear Form"/>
</form>
</td>
</tr>
</table>
</body>
</html>