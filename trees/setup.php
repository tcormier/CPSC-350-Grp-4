<html>
<?php
 $conn = new Mongo();
 $db = $conn->trees;
 $collection = $db->blogs;
 $cursor = $collection->find();
 
 echo "<h1><table border='1' width='600'>";
 foreach($cursor as $doc) {
    echo "<p><tr><td>" . $doc['text'] . "</td></tr>";
	$collection->remove($doc);
    }
	echo "</table></h1>";
    $conn->close();

 $collection->insert(array("text"=>"I love trees!", "author"=>"treehugger", "id"=>"0"));
 $collection->insert(array("text"=>"Trees are five kinds of awesome.", "author"=>"Michael Jordan", "id"=>"1"));
 $collection->insert(array("text"=>"I wish I were a tree. Because they're so awesome.", "author"=>"hippie123", "id"=>"2"));
 $collection->insert(array("text"=>"Seriously.", "author"=>"frogger24", "id"=>"3"));
 
 ?>
 </html>