<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Add a Band</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<h1><a href="mainPage.php"><img src="images/logo.gif" width="118" height="25" alt="Rock Band" /></a><br/>
Enter the following information to add a new Band</h1>
<body>

<?php
	include "db_connect.php";
	
	
	$name = $_POST['band_name'];
	$hometown = $_POST['city'].", ".$_POST['state'];
	$city=$_POST['city'];
	$state=$_POST['state'];	
	$genre1 = $_POST['genre1'];
	$genre2 = $_POST['genre2'];
	$genre3 = $_POST['genre3'];
	$description = $_POST['description'];
	$filename = $_FILES['picture']['picture'];	
	$album1 = $_POST['album1'];
	$album2 = $_POST['album2'];
	$album3 = $_POST['album3'];
	$album4 = $_POST['album4'];
	$album5 = $_POST['album5'];
	
	$validinput = true;
	$target ="images/$filename";
	move_uploaded_file($_FILES['picture']['tmp_name'], $target);
	
	if(is_null($name) or $name=="")
	{
		$validinput = false;
		$namestatus = "* Invalid Entry";
	}
	
	if (is_null($_POST['city']) or $_POST['city'] == "")
	{
		$validinput = false;
		$citystatus = "* Invalid Entry";
	}
	
	if (is_null($_POST['state']) or $_POST['state'] == "")
	{
		$validinput = false;
		$statestatus = "* Invalid Entry";
	}
		
	if (is_null($_POST['genre1']) or $_POST['genre1'] == "")
	{
		$validinput = false;
		$genrestatus = "* Please enter at least one genre";
	}
	
	if(is_null($description) or $description == "")
	{
		$validinput = false;
		$descriptionstatus = "* Invalid Entry";
	}
	
	if (is_null($_POST['album1']) or $_POST['album1'] == "")
	{
		$validinput = false;
		$albumstatus = "* Please enter at lease one album";
	}
	
	
	
	if(!$validinput){
		echo "<form method=\"post\" action=\"postBand.php\">

	<br/>
	<br/>
	
	<br/>
	<table>
	<tr>
	<td><b>Band Name:</b></td><td><input text=\"\" name=\"band_name\" size=\"15\" value=\"$name\"/>$namestatus</td>
	</tr>
	</table>
	<table>
	<tr>
	<td><h2>Hometown City and State: <h2></br></td>              
	</tr>
	<table>
	<tr>
	<td><b>City:</b></td>  <td><input text=\"\" name=\"city\" size=\"50\"  value=\"$city\" />$citystatus</td></tr>
	
	<td><b>State(abbreviation):<b></td><td>  <input text=\"\" name=\"state\" size=\"2\" value=\"$state\" />$statestatus</td>
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
	<tr><td><TEXTAREA NAME=\"description\" COLS=40 ROWS=6 value=\"$description\">$description</TEXTAREA>$descriptionstatus</td>
	</tr>
	<tr>
	<td>Albums:</td></tr>
	<tr><td><input text=\"\" name=\"album1\" size=\"20\" value=\"$album1\"/>$albumstatus</td></tr>
	<tr><td><input text=\"\" name=\"album2\" size=\"20\" value=\"$album2\"/></td></tr>
	<tr><td><input text=\"\" name=\"album3\" size=\"20\" value=\"$album3\"/></td></tr>
	<tr><td><input text=\"\" name=\"album4\" size=\"20\" value=\"$album4\"/></td></tr>
	<tr><td><input text=\"\" name=\"album5\" size=\"20\" value=\"$album5\"/></td></tr>
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
	}else{
	
	
	$query = "UPDATE band SET band_name = '$name', hometown = '$hometown', genre1 = '$genre1', genre2 = '$genre2', genre3 = 'genre3',
			description = '$description', picture_file = '$target', album1 = '$album1',album2 = '$album2',album3 = '$album3',
			album4 = '$album4',album5 = '$album5' WHERE band_name = '$name';";
		
	$result = mysqli_query($db, $query)
	or die("error Querying Database");
	echo "\n";
	
	
	echo "<p>Thanks for submitting the form</p>";
	
	echo "<h2>Recent Bands</h2>";
	
	$query = "SELECT * FROM band ORDER BY band_id";
  
  $result = mysqli_query($db, $query)
   or die("Error Querying Database");
  
  echo "<table ALIGN='center' id=\"hor-minimalist-b\">\n<tr><th>Band Name</th><th>Hometown</th><tr>\n\n";
  
  while($row = mysqli_fetch_array($result)) {
  	
  	$name = $row['band_name'];  	
  	$hometown = $row['hometown'];  	
  	echo "<tr><td  >$name</td><td>$hometown</td></tr>\n";
  }
 echo "</table>\n";
 
  
  mysqli_close($db);
  }
  ?>


		
		
