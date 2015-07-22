<?php
	$mydb = mysql_connect("localhost", "alanmand_user", "daBrav3s!") or die(mysql_error());
	mysql_select_db("alanmand_movies") or die(mysql_error());
	$username=$_POST['username'];
	$password=$_POST['password'];
	$validated=false;
	
	$query = "SELECT Username,Password FROM Users WHERE Username='".$username."'";
	$result = mysql_query($query) or die(mysql_error());
	
	if (mysql_num_rows($result)!=0){
		while($row=mysql_fetch_array($result)){
			if($row['Password']==$password){
				$validated=true;
				break;
			}
		}
	}
	
	if ($validated){
		echo("OK");
	} else {
		echo("error");
	}
?>