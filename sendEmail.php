<?php
	$mydb = mysql_connect("sql.mit.edu", "alanma", "daBrav3s") or die(mysql_error());
	mysql_select_db("alanma+movies") or die(mysql_error());
	$from = $_GET['user'];
	$email = $_GET['email'];
	$movieID = $_GET['movieID'];
	$un = $_GET['un'];
	$saved = $_GET['saved'];
	
	if($un){
		$query = "SELECT * FROM Users WHERE Username='".$un."'";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		#if the movie was saved we are going to update, otherwise we'll insert.
		if ($saved=='true'){
			$query="UPDATE Loans SET Status='Requested' WHERE MovieID='"
								.$movieID."' AND UserID='".$row['ID']."' AND Status='Saved'";
		} else {
			$query = "INSERT INTO Loans (UserID, MovieID, Status) VALUES ('".$row['ID']."', '"
								.$movieID."', 'Requested')";
		}
		$result = mysql_query($query) or die(mysql_error());
		
		$from = $row['First'];
		$email = $row['Email'];
	}
	$query = "SELECT * FROM Movies WHERE ID='".$movieID."'";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$to = "alanmanderson@gmail.com";
	$subject = "MOVIE REQUEST";
	$body = $from .", ".$email.", wants to borrow ".$row['Title'].". Goto http://alanmanderson.com/movies/admin.php to process the request. From IP Address $_SERVER[REMOTE_ADDR]";
	if (mail($to, $subject, $body)) {
		echo("<p>Message successfully sent!</p>");
  } else {
		echo("<p>Message delivery failed... Try again</p>");
  }
	
	#echo "<script language=JavaScript>window.close();</script>";
?>

