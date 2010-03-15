<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Add a Band</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<h1><a href="mainPage.php"><img src="images/logo.gif" width="118" height="25" alt="Rock Band" /></a></h1>
<body>

<?php
	include "db_connect.php";
	
	
	$name = $_POST['band_name'];
	$hometown = $_POST['city'].", ".$_POST['state'];
	$city=$_POST['city'];
	$state=$_POST['state'];
	$genre = $_POST['genre1'] .", ". $_POST['genre2'] . ", ".$_POST['genre3'];
	$genre1 = $_POST['genre1'];
	$genre2 = $_POST['genre2'];
	$genre3 = $_POST['genre3'];
	$description = $_POST['description'];
	$filename = $_FILES['picture']['picture'];
	$albums = $_POST['albums1'].", ". $_POST['albums2'].", ".$_POST['albums3'].", ".$_POST['albums4'].", ".$_POST['albums5'];
	$albums1 = $_POST['albums1'];
	$albums2 = $_POST['albums2'];
	$albums3 = $_POST['albums3'];
	$albums4 = $_POST['albums4'];
	$albums5 = $_POST['albums5'];
	
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
	
	if (is_null($_POST['albums1']) or $_POST['albums1'] == "")
	{
		$validinput = false;
		$albumstatus = "* Please enter at lease one album";
	}
	
	
	
	if(!$validinput){
		echo "<form method=\"post\" action=\"postBand.php\">

	<br/>
	<br/>
	<h1>
	
	Enter the following information to add a new Band
	</h1>
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
				<tr><td><input text=\"\" name=\"genre1\" size=\"20\" value=\"$genre1\"/>$genrestatus</td></tr>
				<tr><td><input text=\"\" name=\"genre2\" size=\"20\" value=\"$genre2\"/></td></tr>
				<tr><td><input text=\"\" name=\"genre3\" size=\"20\" value=\"$genre3\"/></tr></td>
				</tr>
	<tr></tr>
	<tr></tr>
	<tr></tr>
	<tr><td>Description:</td></tr>
	<tr><td><TEXTAREA NAME=\"description\" COLS=40 ROWS=6 value=\"$description\"></TEXTAREA>$descriptionstatus</td>
	</tr>
	<tr>
	<td>Albums:</td></tr>
	<tr><td><input text=\"\" name=\"albums1\" size=\"20\" value=\"$albums1\"/>$albumstatus</td></tr>
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
	}else{
	
	$query = "INSERT INTO band (band_name, hometown, genre, description, picture_file, albums)
		VALUES ('$name','$hometown','$genre','$description','$target','$albums');";
		
	$result = mysqli_query($db, $query)
	
	
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