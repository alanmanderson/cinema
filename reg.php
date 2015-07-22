<?php
	$un = $_GET['un'];
	$first = $_GET['first'];
	$last = $_GET['last'];
	$email = $_GET['email'];
	
	$mydb = mysql_connect("sql.mit.edu", "alanma", "daBrav3s") or die(mysql_error());
	mysql_select_db("alanma+movies") or die(mysql_error());
	
	$query="INSERT INTO Users (Username, First, Last, Email) VALUES ('"
														.$un."', '".$first."', '".$last."', '".$email."')";
	$result = mysql_query($query);
	if ($result){
		header("Location: movies.php?loggedIn=".$un);
	} elseif (substr(mysql_error(),0,15)=="Duplicate entry") {
		header("Location: register.php?first=".$first."&last=".$last."&email="
						.$email."&error=Username+in+use");
	} else {
		header("Location: register.php?first=".$first."&last=".$last."&email="
						.$email."&error=".mysql_error());
	}
?>