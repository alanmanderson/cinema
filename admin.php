<!--
  copyright (c) 2009 google inc.

  You are free to copy and use this sample.
  License can be found here: http://code.google.com/apis/ajaxsearch/faq/#license
-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
		<link rel="stylesheet" type="text/css" href="main.css" />
    <title>Alan and Heather's Movies Database</title>
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="jquery.label_over.js"></script>
    <script type="text/javascript">
			$(function() {
        $('label.targetLabel').labelOver('labelover'); 
      })
			
			$(function() {
				$("#btnAddMovie").click(function() {
					var url = "addMovie.php?cmd=addMovie"
					url = url + "&newTitle="+document.getElementsByName("newTitle")[0].value;
					url = url + "&newYear="+document.getElementsByName("newYear")[0].value;
					url = url + "&newRating="+document.getElementsByName("newRating")[0].value;
					url = url + "&newGenre="+document.getElementsByName("newGenre")[0].value;
					url = url + "&newDuration="+document.getElementsByName("newDuration")[0].value;
					url = url + "&newWebsite="+document.getElementsByName("newWebsite")[0].value;
					//alert(url);
					location.href = url;
				});
			})
			
			 $(function() {
				$("#btnDeliver").click(function() {
					var url = "deliver.php?cmd=deliver"
					url = url+"&"
					
					var cbs = document.forms[0].elements["movieRequests"];
					if(cbs.length){
						for(var i=0; i<cbs.length; i++){
							if(cbs[i].checked){
								url=url+"&id[]="+cbs[i].value;
							}
						}
					} else{
						url=url+"&id[]="+cbs.value;
					}
					location.href = url;
				});
			})
			
			$(function() {
				$("#btnReturn").click(function() {
					var url = "deliver.php?cmd=return"
					var cbs = document.forms[0].elements["borrowedMovies"];

					for(var i=0; i<cbs.length; i++){
						if(cbs[i].checked){
							url=url+"&id[]="+cbs[i].value;
						}
					}

					location.href = url;
				});
			})
			
			$(function() {
				$("#loginBtn").click(function() {
					location.href = "loginValidation.php?un=" + $('#txtUsername').val();
				});
			})
		</script>
  </head>
  <body style="font-family: Arial;border: 0 none;">
		<div class="pageBanner">
			<table class="banner">
				<tr>
					<td>
						ANDERSON'S MOVIES
					</td>
				</tr>
			</table>
		</div>
		<div id="content">
			<form name="myForm">
				<table>
					<tr>
						<td>
							<a class="requestA" href="register.php">Add User</a>
						</td>
					</tr>
				</table>
				<table>
					<th>Add a Movie</th>
					<tr>
						<td>
							<table>
								<tr>
									<td>Title</td><td>Year</td><td>Rating</td><td>Genre</td><td>Duration</td><td>Website</td>
								</tr>
								<tr>
									<td><input type="text" name="newTitle"/></td><td><input type="text" name="newYear"></td>
									<td>
										<select name="newRating">
											<option value="G">G</option>
											<option value="PG">PG</option>
											<option value="PG-13">PG-13</option>
											<option value="R">R</option>
											<option value="Not Rated">Not Rated</option>
										</select>
									</td>
									<td>
										<select name="newGenre">
										<?php
										$mydb = mysql_connect("sql.mit.edu", "alanma", "daBrav3s") or die(mysql_error());
										mysql_select_db("alanma+movies") or die(mysql_error());
										$sql = "SELECT * FROM Genres";
										$results = mysql_query($sql) or die(mysql_error());
										while($row=mysql_fetch_array($results)){
											$genre=$row['Genre'];
											echo "<option value=\"$genre\">$genre</option>";
										}
										?>
										</select>
									</td>
									<td><input type="text" name="newDuration"/></td>
									<td><input type="text" name="newWebsite"/></td>
								</tr>
								<tr>
									<td>
										<div class="button" id="btnAddMovie">Add Movie</div>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				
				<table>
					<th> Requested Movies </th><th> Borrowed Movies </th>
					<tr>
						<td>
							<div class="section">
								<table>
									<th/><th>Movie Title</th><th>User</th>
									<?php
										function makeCheckBox($label, $id, $group){
											$chk = "<label><input type=\"checkbox\" name=\"".$group."\" class=\"radio\" value=\"".$id."\"\>".$label."</label>";
											echo $chk;
										}
										$query="SELECT *, Loans.ID AS l_id FROM Users RIGHT JOIN Loans ON Users.ID=Loans.UserID JOIN Movies ON MovieID=Movies.ID WHERE Status='Requested'";
										$requests = mysql_query($query);
										while ($row=mysql_fetch_array($requests)){
											echo("<tr><td>");
											echo(makeCheckBox("",$row['l_id'],"movieRequests"));
											echo("</td><td>");
											echo($row['Title']);
											echo("</td><td>".$row['Username']);
											echo("</td>
														</tr>");
										}
										
									?>
									<tr>
										<td colspan="3">
											<div class="button" id="btnDeliver">Deliver
											</div>
										</td>
									</tr>
								</table>
							</div>
						</td>
						<td>
							<div class="section">
								<table>
									<th/><th>Movie Title</th><th>User</th>
									<?php
										$query="SELECT *, Loans.ID AS l_id FROM Users RIGHT JOIN Loans ON Users.ID=Loans.UserID JOIN Movies ON MovieID=Movies.ID WHERE Status='Delivered'";
										$requests = mysql_query($query);
										while ($row=mysql_fetch_array($requests)){
											echo("<tr><td>");
											echo(makeCheckBox("",$row['l_id'],"borrowedMovies"));
											echo("</td><td>");
											echo($row['Title']);
											echo("</td><td>".$row['Username']);
											echo("</td>
														</tr>");
										}
										
									?>
									<tr><td/><td><div class="button" id="btnReturn">Return</div></td><td/></tr>
								</table>
							</div>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</body>
</html>