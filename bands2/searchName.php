<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Band Information</title>
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
		<li><a href=\"addEvent.php\">add event</a></li>
		<li><a href=\"logout.php\">logout</a></li>
	</ul>
	";}
	else{
	echo "
	<h1><a href=\"index.php\"><img src=\"images/logo.gif\" width=\"118\" height=\"25\" alt=\"Rock Band\" /></a></h1>";
	}
	?>
	
				<div id="sidebar">
				<?php
					include "db_connect.php";
					$search = $_POST['searchbox'];
					$find = "LIKE '%$search%'";
					if($search == "")
					{
					$query = "SELECT * FROM band";		
					}
					else
					{	
					$query = "SELECT * FROM band WHERE band_name $find OR hometown $find OR description $find 
					OR genre1 $find OR genre2 $find OR genre3 $find OR album1 $find OR album2 $find OR album3 $find
					OR album4 $find OR album5 $find;";
					}
					?>				
					<div class="content">
						<h2>Searches</h2>
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
						
						<form method="post" action="viewBandPage.php">
						<select name="editBand" width="2">";
							<?php
							include "db_connect.php";
							$result = mysqli_query($db, $query);
							while($row = mysqli_fetch_array($result))	
							{
							$name = $row['band_name'];
							echo "<option>$name</option>\n";
							}
							
							echo"
							</select> 
							<input type=\"submit\" value=\"Go\" name=\"submit2\" />
							<br />
							</form>";?>
					</div>
				</div>	
	<div id="main">
<?php
	$result = mysqli_query($db, $query)
	or die("Error Querying Database");
	
	
	echo "<table ALIGN='center' id=\"hor-minimalist-b\">\n<tr><th>Band Name</th><th>Hometown</th><th>Description</th></tr>\n\n";
  
   while($row = mysqli_fetch_array($result)) {
  	
  	$name = $row['band_name'];  	
  	$hometown = $row['hometown'];
	$description = $row['description'];
  	echo "<tr><td  >$name</td><td>$hometown</td><td>$description</td></tr>\n";
	}
 echo "</table>\n"; 

 
	mysqli_close($db);
?>
			</div>
		
</div>
			
	