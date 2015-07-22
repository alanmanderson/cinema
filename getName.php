<?php
	if ($_GET['un']){
		header("Location: sendEmail.php?movieID=".$_GET['movieID'].
						"&un=".$_GET['un']."&saved=".$_GET['saved']);
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
		<link rel="stylesheet" type="text/css" href="main.css" />
    <title>Alan and Heather's Movies Database</title>
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="jquery.label_over.js"></script>
		
	</head>
  <body style="font-family: Arial;border: 0 none;" onLoad="document.input.user.focus()">
		<form name="input" action="sendEmail.php" method="get">
		<table>
			<tr>
				<td>Name:</td><td><input type="text" name="user" /></td>
			</tr>
			<tr>
				<td>email:</td><td><input type="text" name="email" /></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<?php
						echo("<input type=\"hidden\" name=\"movieID\" value=\"".$_GET['movieID']."\" />");
					?>
					<input type="submit" value="Submit" />
				</td>
				
			</tr>
		</table>
		</form>
	</body>