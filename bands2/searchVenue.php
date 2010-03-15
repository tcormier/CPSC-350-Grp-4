<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Venue Information</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<div id="wrap">
	<?php
	if(session_is_registered("username")){
	echo"<ul id=\"nav\">
		<li><a href=\"mainPage.php\">home</a></li>
		<li><a href=\"addBand.php\">add band</a></li>
		<li><a href=\"addVenue.php\">add venue</a></li>
		<li><a href=\"logout.php\">logout</a></li>
	</ul>";}
	?>
	
	<h1><a href="mainPage.php"><img src="images/logo.gif" width="118" height="25" alt="Rock Band" /></a></h1>
	
		
		
				<div id="sidebar">
					<div class="content">
						<h2>Seaches</h2>
						<p><b>Search For Artists</b></p>
						<form method="post" action="searchName.php">
						<input type="text" id="searchbox" name="searchbox" />
						<input type="submit" value="go" name="submit" />
						</form>
	
						<p><b>Search For Venue</b></p>
						<form method="post" action="searchVenue.php">
						<input type="text" id="searchbox" name="searchbox" />
						<input type="submit" value="go" name="submit" />
						</form>
					</div>
					</div>
	<div id="main">
<?php
	include "db_connect.php";
	$search = $_POST['searchbox'];
	$find = "LIKE '%$search%'";
	if($search=="")
	{
	$query = "SELECT * FROM venue";
	}
	else
	{
	$query = "SELECT * FROM venue WHERE venue $find OR description $find OR location $find;";
	}
	$result = mysqli_query($db, $query)
	or die("Error Querying Database");
	echo "<h1><a href='http://localhost/cpsc-350-grp-4/bands2/'><img src='images/logo.gif' width='118' height='25' alt='Rock Band' /></a></h1>";
	echo "<table ALIGN='center' id=\"hor-minimalist-b\">\n<tr><th>Venue Name</th><th>Location</th><th>Description</th></tr>\n\n";
  
   while($row = mysqli_fetch_array($result)) {
  	
  	$name = $row['venue'];  	
  	$location= $row['location'];
	$description = $row['description'];
  	echo "<tr><td  >$name</td><td>$location</td><td>$description</td></tr>\n";
  }
 echo "</table>\n"; 
	
	mysqli_close($db);
?>
	</div>
	