<?php
	$mydb = mysql_connect("sql.mit.edu", "alanma", "daBrav3s") or die(mysql_error());
	mysql_select_db("alanma+movies") or die(mysql_error());
	
	$title = $_GET['newTitle'];
	$year = $_GET['newYear'];
	$rating = $_GET['newRating'];
	$genre = $_GET['newGenre'];
	$duration = $_GET['newDuration'];
	$website = $_GET['newWebsite'];

	$sql = "INSERT INTO Movies (Title,Year,Rating,Genre,Duration,Location,Website) 
					VALUES ('$title','$year','$rating','$genre','$duration','Home','$website')";
	#echo $sql;
	mysql_query($sql) or die(mysql_error());
	header("Location: admin.php");
?>