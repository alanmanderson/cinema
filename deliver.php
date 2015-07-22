<?php
	$mydb = mysql_connect("sql.mit.edu", "alanma", "daBrav3s") or die(mysql_error());
	mysql_select_db("alanma+movies") or die(mysql_error());
	$cmd = $_GET['cmd'];
	$ids = $_GET['id'];
	if($cmd=='deliver'){
		foreach($ids as $id){
			$query="UPDATE Loans SET Status='Delivered' WHERE ID='$id'";
			$result = mysql_query($query) or die(mysql_error());
			$query="SELECT First FROM Loans JOIN Users ON Loans.UserID=Users.ID WHERE Loans.ID='$id'";
			$result = mysql_query($query) or die(mysql_error());
			$row = mysql_fetch_array($result);
			$userFirst = $row['First'];
			$query="SELECT MovieID FROM Loans WHERE ID='$id'";
			$result = mysql_query($query) or die(mysql_error());
			$row = mysql_fetch_array($result);
			$movieID = $row['MovieID'];
			$query="UPDATE Movies SET Location='$userFirst' WHERE ID='$movieID'";
			$result = mysql_query($query) or die(mysql_error());
		}
	} elseif($cmd=='return'){
		foreach($ids as $id){
			$query="UPDATE Loans SET Status='Returned' WHERE ID='".$id."'";
			mysql_query($query) or die(mysql_error());
			$query="SELECT MovieID FROM Loans WHERE ID='$id'";
			$result = mysql_query($query) or die(mysql_error());
			$row = mysql_fetch_array($result);
			$movieID = $row['MovieID'];
			$query="UPDATE Movies SET Location='Home' WHERE ID='$movieID'";
			mysql_query($query) or die(mysql_error());
		}
	}
	
	header("Location: admin.php");
?>