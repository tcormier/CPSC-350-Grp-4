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

<form method="post" action="editBand.php">

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
<h1>Band Information
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
	// $genre1 = $row['genre1'];
	// $genre2 = $row['genre2'];
	// $genre3 = $row['genre3'];
	// $album1 = $row['album1'];
	// $album2 = $row['album2'];
	// $album3 = $row['album3'];
	// $album4 = $row['album4'];
	// $album5 = $row['album5'];
	
 }
 
 //<img src="$picture">
 echo "<form method=\"post\" action=\"editBand.php\">
	
	<br/>
	<br/>
	<h3>	
	Edit the following to change information about the band.
	</h3>
	<br/>
	<table>
	<tr>
	<td><b>Band Name:</b></td><td><input text=\"\" name=\"band_name\" size=\"15\" value=\"$bandName\"/></td>
	</tr>
	</table>
	<table>
	<tr>
	<td><h2>Hometown City and State: <h2></br></td>              
	</tr>
	<table>
	<tr>
	<td><b>City:</b></td>  <td><input text=\"\" name=\"city\" size=\"50\"  value=\"$city\" /></td></tr>
	
	<td><b>State(abbreviation):<b></td><td>  <input text=\"\" name=\"state\" size=\"2\" value=\"$state\" /></td>
	</tr>
	</table>
	<table>
	<tr>
	<td><b>Genre:<b></tr>
	
				<tr>
				
				<select name=\"genre1\">";
				
			
				include "db_connect.php";
				$query = "SELECT DISTINCT genre_name, genre_id FROM genre;";
				$result = mysqli_query($db, $query);
				
				while($row = mysqli_fetch_array($result))	
				{
					$genre1 = $row['genre_name'];
					$value1 = $row['genre_id'];
					echo "<option value= \"$value1\" >$genre1</option>\n";
				}
				
				echo "
				</select>
						
				</tr>
				<tr>
				
				<select name=\"genre2\">";
				
				include "db_connect.php";
				$query = "SELECT DISTINCT genre_name, genre_id FROM genre;";
				$result = mysqli_query($db, $query);
				
				while($row = mysqli_fetch_array($result))	
				{
					$genre2 = $row['genre_name'];
					$value2 = $row['genre_id'];
					echo "<option value = \"$value2\" >$genre2</option>\n";
				}
				
				echo "
				</select>
						
				</tr>
				<tr>
				
				<select name=\"genre3\">";
			
				include "db_connect.php";
				$query = "SELECT DISTINCT genre_name, genre_id FROM genre;";
				$result = mysqli_query($db, $query);
				
				while($row = mysqli_fetch_array($result))	
				{
					$genre3 = $row['genre_name'];
					$value3 = $row['genre_id'];
					echo "<option value=\"$value3\">$genre3</option>\n";
				}
				
				echo "
				</select>
						
				</tr></td>
	<tr></tr>
	<tr></tr>
	<tr></tr>
	<tr><td>Description:</td></tr>
	<tr><td><TEXTAREA NAME=\"description\" COLS=40 ROWS=6 value=\"$description\">$description</TEXTAREA></td>
	</tr>
	<tr>
	<td>Albums:</td></tr>";
	
	$array[] = array(0=>$album1, 1=>$album2, 2=>$album3, 3=>$album4, 4=>$album5);
		
			
	$query = "SELECT ba.album_name FROM band_albums ba NATURAL JOIN band b WHERE b.band_name = '$bandName';";
	
	$result = mysqli_query($db, $query)
	or die("Error Querying Database");
	$i = 0;
	while($row = mysqli_fetch_array($result))
	{
	  
	  $array[$i] = $row['album_name'];
	  echo "<tr><td>$album</td></tr>";
	  $i = $i + 1;
	}	
	
	echo "
	<tr><td><input text=\"\" name=\"album1\" size=\"20\" value=\"$array[0]\"/></td></tr>
	<tr><td><input text=\"\" name=\"album2\" size=\"20\" value=\"$array[1]\"/></td></tr>
	<tr><td><input text=\"\" name=\"album3\" size=\"20\" value=\"$array[2]\"/></td></tr>
	<tr><td><input text=\"\" name=\"album4\" size=\"20\" value=\"$array[3]\"/></td></tr>
	<tr><td><input text=\"\" name=\"album5\" size=\"20\" value=\"$array[4]\"/></td></tr>
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
	<form method=\"POST\" action=\"deleteBand.php\">
	<input type=\"hidden\" name= \"id\" value=\"$id\" />
	<input type=\"hidden\" name= \"band_name\" value=\"$bandName\" />
	<input type=\"submit\" name\"submit\" value=\"Delete\"/>
	</form>
	";
 ?>
 
 </body>
 </html>