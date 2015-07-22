<?php
	$mydb = mysql_connect("sql.mit.edu", "alanma", "daBrav3s") or die(mysql_error());
	mysql_select_db("alanma+movies") or die(mysql_error());
	$un = $_GET['un'];
	$query = "SELECT Username FROM Users WHERE Username='".$un."'";
	$result = mysql_query($query);
	if(mysql_num_rows($result)>0){
		header("Location: movies.php?loggedIn=".$un);
	} else {
		header("Location: register.php?un=".$un);
	}
	
?>