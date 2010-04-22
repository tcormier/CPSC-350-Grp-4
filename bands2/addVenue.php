<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Add a Venue</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<form method="post" action="postVenue.php">

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
<b>Enter the following information to add a new Venue
</b>
<br/>
<table>
<tr>
<td><b>Venue Name:</b></td><td><input text="" name="venue_name" size="15"/></td>
</tr>
</table>
<table>
<tr>
<td><h2>Address: <h2></br></td>              
</tr>
<table>
<tr>
<td><b>City:</b></td>  <td><input text="" name="city" size="50" /> </td></tr>
	
<tr><td><b>State(abbreviation):<b></td><td>  <input text="" name="state" size="2" /></td>
</tr>
<tr><td><b>Zip Code:</b><input text="" name="zip" size="10" /></td></tr>

</table>
<table>

<tr><td>Description:</td></tr>
<tr><td><TEXTAREA NAME="description" COLS=40 ROWS=6></TEXTAREA></td>
</tr>
<tr><td>Picture File:</td><td><input type="file" id="picture" name="picture"  /></td>
</tr>
<tr>
<td>
<input type="submit" name="submit" value="Submit"/>
<input type="reset" name="reset" value="Clear Form"/>
</td>
</tr>
</table>
</form>
</body>
</html>