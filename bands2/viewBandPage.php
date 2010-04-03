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
<h1>
<a href="index.php"><img src="images/logo.gif" width="118" height="25" alt="Rock Band" /></a><br/>
Band Information
</h1>


<b></b>

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
	//$picture = $row['picture_file'];
	
	//$album1 = $row['album1'];
	//$album2 = $row['album2'];
	//$album3 = $row['album3'];
	//$album4 = $row['album4'];
	//$album5 = $row['album5'];
	
	}
	

				// $query = "SELECT genre_name FROM genre WHERE genre_id = $genres_as_array[0];";
				// $result = mysqli_query($db, $query);				
				// $genre1 = mysqli_fetch_array($result);
				// $genre1 = $genre1['genre_name'];
				
				// $query = "SELECT genre_name FROM genre WHERE genre_id = $genres_as_array[1];";
				// $result = mysqli_query($db, $query);
				// $genre2 = mysqli_fetch_array($result);
				// $genre2 = $genre2['genre_name'];
				
				// $query = "SELECT genre_name FROM genre WHERE genre_id = $genres_as_array[2];";
				// $result = mysqli_query($db, $query);
				// $genre3 = mysqli_fetch_array($result);
				// $genre3 = $genre3['genre_name'];
 
 
 //<img src="$picture">
 echo "
	<!-- display band picture here -->
	<br/>
	<br/>
	
	<br/>
	<table>	
	<th><font size=\"2\" face=\"Verdana\"> $bandName</th>	
	<tr>
	<td><font size=\"2\" face=\"Verdana\">$city</td></tr>
	<tr><td><font size=\"2\" face=\"Verdana\">$state </td>
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
	
	<tr><td><font size=\"2\" face=\"Verdana\">$description</td>
	</tr>
	<tr>
	<td><font size=\"2\" face=\"Verdana\"><b>Albums:</b></td></font></tr>";
	
	$query = "SELECT ba.album_name FROM band_albums ba NATURAL JOIN band b WHERE b.band_name = '$bandName';";
	
	$result = mysqli_query($db, $query)
	or die("Error Querying Database");
	
	 while($row = mysqli_fetch_array($result)) {
	  
	  $album = $row['album_name'];
	  echo "<tr><td>$album</td></tr>";
	  }
	 echo"
	<!-- display band picture here -->
	</tr>
	<tr>
	<td>
	</table>
	";
 ?>
 
 </body>
 </html>