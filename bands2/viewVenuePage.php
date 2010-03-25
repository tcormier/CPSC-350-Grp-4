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
 ?>
 
 </body>
 </html>