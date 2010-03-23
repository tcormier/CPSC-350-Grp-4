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

<form method="post" action="postBand.php">

<br/>
<br/>
<h1>
<a href="http://localhost/bands2/"><img src="images/logo.gif" width="118" height="25" alt="Rock Band" /></a><br/>

<b></b>
<?php
 include "db_connect.php";
 $bandName = $_POST['editBand']; 
 $query = "SELECT * FROM band WHERE band_name = '$bandName';";
 $result = mysqli_query($db, $query)
 or die("Error Querying Database");

 while($row = mysqli_fetch_array($result)) {
	
	$description = $row['description'];
	$hometown = explode(", ",$row['hometown']);
	$city = $hometown[0];
	$state = $hometown[1];
	//$picture = $row['picture_file'];
	$genre1 = $row['genre1'];
	$genre2 = $row['genre2'];
	$genre3 = $row['genre3'];
	$bandName = $row['band_name'];
	$albums1 = $row['album1'];
	$albums2 = $row['album2'];
	$albums3 = $row['album3'];
	$albums4 = $row['album4'];
	$albums5 = $row['album5'];
	
 }
 
 //<img src="$picture">
 echo "<form method=\"post\" action=\"postBand.php\">

	<br/>
	<br/>
	<h1>
	
	Enter the following information to add a new Band
	</h1>
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
				
				<select name=\"genre1\">
				<?php
				include \"db_connect.php\";
				$query = \"SELECT DISTINCT genre_name FROM genre;\";
				$result = mysqli_query($db, $query);
				
				while($row = mysqli_fetch_array($result))	
				{
					$genre1 = $row['genre_name'];
					echo \"<option>$genre</option>\n\";
				}
				?>
				</select>
						
				</tr>
				<tr>
				
				<select name=\"genre2\">
				<?php
				include \"db_connect.php\";
				$query = \"SELECT DISTINCT genre_name FROM genre;\";
				$result = mysqli_query($db, $query);
				
				while($row = mysqli_fetch_array($result))	
				{
					$genre2 = $row['genre_name'];
					echo \"<option>$genre</option>\n\";
				}
				?>
				</select>
						
				</tr>
				<tr>
				
				<select name=\"genre3\">
				<?php
				include \"db_connect.php\";
				$query = \"SELECT DISTINCT genre_name FROM genre;\";
				$result = mysqli_query($db, $query);
				
				while($row = mysqli_fetch_array($result))	
				{
					$genre3 = $row['genre_name'];
					echo \"<option>$genre</option>\n\";
				}
				?>
				</select>
						
				</tr></td>
	<tr></tr>
	<tr></tr>
	<tr></tr>
	<tr><td>Description:</td></tr>
	<tr><td><TEXTAREA NAME=\"description\" COLS=40 ROWS=6 value=\"$description\"></TEXTAREA></td>
	</tr>
	<tr>
	<td>Albums:</td></tr>
	<tr><td><input text=\"\" name=\"albums1\" size=\"20\" value=\"$albums1\"/></td></tr>
	<tr><td><input text=\"\" name=\"albums2\" size=\"20\" value=\"$albums2\"/></td></tr>
	<tr><td><input text=\"\" name=\"albums3\" size=\"20\" value=\"$albums3\"/></td></tr>
	<tr><td><input text=\"\" name=\"albums4\" size=\"20\" value=\"$albums4\"/></td></tr>
	<tr><td><input text=\"\" name=\"albums5\" size=\"20\" value=\"$albums5\"/></td></tr>
	<tr>
	<td>Picture File:</td><td><input type=\"file\" id=\"picture\" name=\"picture\"  /></td>
	</tr>
	<tr>
	<td>
	<input type=\"submit\" name=\"submit\" value=\"Submit\"/>
	<input type=\"reset\" name=\"reset\" value=\"Clear Form\"/>
	</td>
	</tr>	
	</table>
	";
 ?>