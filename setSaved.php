<?php
	header("Content-type: text/html; charset=ISO-8859-1");
	$mydb = mysql_connect("sql.mit.edu", "alanma", "daBrav3s") or die(mysql_error());
	mysql_select_db("alanma+movies") or die(mysql_error());
	$movieID = $_GET['movieID'];
	$un = $_GET['un'];
	
	echo($un." ".$movieID);
	
	$query = "SELECT * FROM Users WHERE Username='".$un."'";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	
	$query = "INSERT INTO Loans (UserID, MovieID, Status) VALUES ('".$row['ID']."', '"
								.$movieID."', 'Saved')";
	
	$result = mysql_query($query) or die(mysql_error());
	
	header("Location: movies.php?loggedIn=".$un);

?>