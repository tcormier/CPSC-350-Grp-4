<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<title>Bands and Venue Search</title>
	<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
	
	if(!isset($_SESSION['user_name'])){
			echo "<h1>The username or password is incorrect. <a href=\"index.php\">Please try again.</a></h1>";
			}else{
	?>
<div id="wrapper">
	<ul id="nav">
		<li><a href="mainPage.php">home</a></li>
		<li><a href="addBand.php">add band</a></li>
		<li><a href="addVenue.php">add venue</a></li>
		<li><a href="addEvent.php">add event</a></li>
		<li><a href="index.php">logout</a></li>
	</ul>
	<h1><a href="mainPage.php"><img src="images/logo.gif" width="118" height="25" alt="Rock Band" /></a></h1>
	<div id="body">
		<div id="bodyi">
			<div id="bodyj">
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
						<p><b>Edit/Delete Band</b></p>
						<form method="post" action="bandPage.php">
						<select name="editBand" width="2"><?php
							include "db_connect.php";
							$query = "SELECT DISTINCT band_name FROM band;";
							$result = mysqli_query($db, $query);
							$band=NULL;
							while($row = mysqli_fetch_array($result))	
							{
							$band = $row['band_name'];
							echo "<option>$band</option>\n";
							}
							?>
					</select> 
					<input type="submit" value="Go" name="submit2" />
					<br />
					</form>
					<p><b>Edit/Delete Venue</b></p>
						<form method="post" action="venuePage.php">
						<select name="editVenue" width="2"><?php
							include "db_connect.php";
							$query = "SELECT DISTINCT venue FROM venue;";
							$result = mysqli_query($db, $query);
							$venue=NULL;
							while($row = mysqli_fetch_array($result))	
							{
							$venue = $row['venue'];
							echo "<option>$venue</option>\n";
							}
							?>
						</select> 
						<input type="submit" value="Go" name="submit3" />
					<br />
					</form>
					</div>
					<div class="divider"></div>
					<div class="content">
						<h2>Featured Artist &amp; Updates</h2>
						<h3><?php 
						$date= date('Y-m-d H:i:s');
						echo $date; ?></h3>
						<p><?php include "featured.php"?>
						<img src="images/pic_3.jpg" width="65" height="43" alt="pic 3" />
						</p>
					</div>
				</div>
				<div id="content">
					<img src="images/dmb.jpg" width="346" height="234" alt="dmb" />
					<div class="content">
						<h2>Upcoming Events</h2>
						
						<?php
						include "db_connect.php";
						$query = "SELECT b.band_name, v.venue, e.time, e.date
FROM band b
INNER JOIN upcoming_shows e
INNER JOIN venue v ON b.band_id = e.band_id
AND v.venue_id = e.venue_id
GROUP BY e.event_id";
						echo "<table ALIGN='center' id=\"hor-minimalist-b\">\n<tr><th>Band Name</th><th>Venue Name </th><th>Time</th><th>Date</th></tr>\n\n";
						$result = mysqli_query($db, $query)
						 or die("Error Querying Database");
						 while($row = mysqli_fetch_array($result)){
								
						$bandName = $row['band_name'];
						$venue = $row['venue'];
						$time = $row['time'];
						$date = $row['date'];
						
	
						
						echo "<tr><td  >$bandName</td><td>$venue</td><td>$time</td><td>$date</td></tr>\n";}
						echo "</table>";?>
						<div class="divider"></div>
						<h2>Featured Venue</h2>
						<?php
						include "db_connect.php";
						$query = "SELECT description, location, venue FROM venue ORDER BY RAND() LIMIT 1;";
						$result = mysqli_query($db, $query)
						or die("Error Querying Database");
						while($row = mysqli_fetch_array($result)) {
	
						$description = $row['description'];
						$location = $row['location'];
						//$picture = $row['picture_file'];
	
						$name = $row['venue'];
																	}?>
						<table summary="Venue" border="0" cellspacing="0">
						<tr>
							<th width="55%">Venue</th>
							<?php echo "<td> $name </td>";?>
							<th>Place</th>
						</tr>
						<tr>
							<td><img src="images/pic_5.jpg" width="94" height="90" alt="Venue" class="left" /></td>
							<?php echo "<td> $location</td>";?>
						</tr>
						<th>Description</th>
						<?php echo "<td> $description </td>";?>
						</table>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<p id="power">Powered by Artist and Venue Search</p>
	<?php } 
	?>
</div>
</body>
</html>