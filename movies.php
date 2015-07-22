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
    <title>Alan and Heathers Movies Database</title>
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="jquery.label_over.js"></script>
    <script type="text/javascript">
			$(function() {
        $('label.targetLabel').labelOver('labelover'); 
      })
			
			 $(function() {
				$("#searchBtn").click(function() {
					var query = $('#txtQuestion').val();
					var loggedIn = $('#loggedIn').val();
					var un = $('#txtUsername').val();
					var url = "movies.php?query=" + query + "&loggedIn=" + loggedIn;
					if (un!='Username')
						url = url + "&un=" + un;
					location.href = url;
				});
			})
			
			$(function() {
				$("#loginBtn").click(function() {
					location.href = "loginValidation.php?un=" + $('#txtUsername').val();
				});
			})
			
			function popUp(URL) {
				day = new Date();
				id = day.getTime();
				eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=250,height=150,left = 765,top = 450');");
			}
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
			
			<?php
				$mydb = mysql_connect("sql.mit.edu", "alanma", "daBrav3s") or die(mysql_error());
				mysql_select_db("alanma+movies") or die(mysql_error());
			
				if ($_GET['loggedIn']){
					include 'userInfo.php';
					echo("<table align=\"center\" width=\"1100px\">");
					echo("<tr><td width=\"360px\" valign=\"top\">");
					echo("<div class=\"section\">");
					echo("<table class=\"userInfo\">");
					echo("<tr><td>Welcome ".$_GET['loggedIn']."</td></tr>");
					
					echo("<th>Saved Movies <img src=\"bookmark.png\" alt=\"Bookmark Movie\"/></th>");
					$table = "Users JOIN Loans ON Users.ID=Loans.UserID JOIN Movies ON Loans.MovieID=Movies.ID";
					$conditions = "Users.Username='".$_GET['loggedIn']."' AND Loans.Status='Saved'";
					$query = "SELECT *, Movies.ID AS m_ID FROM ".$table." WHERE ".$conditions;
					$result = mysql_query($query);
					while($row=mysql_fetch_array($result)){
						echo("<tr><td><A class=\"requestA\" HREF=\"javascript:popUp('http://alanma.scripts.mit.edu/getName.php?movieID=".
												$row['m_ID']."&un=".$_GET['loggedIn']."&saved=true')\"><img src=\"requestIcon.png\" alt=\"Send Request\" /> </A>");
						echo($row['Title']."</td></tr>");
					}
					
					echo("<tr><td></td></tr>");
					echo("<th>Pending Requests <img src=\"requestIcon.png\" alt=\"Send Request\" /></th>");
					$conditions = "Users.Username='".$_GET['loggedIn']."' AND Loans.Status='Requested'";
					$query = "SELECT * FROM ".$table." WHERE ".$conditions;
					$result = mysql_query($query);
					while($row=mysql_fetch_array($result)){
						echo("<tr><td>".$row['Title']."</td></tr>");
					}
					echo("<tr><td></td></tr>");
					echo("<th>Movies in Your Possession</th>");
					$conditions = "Users.Username='".$_GET['loggedIn']."' AND Loans.Status='Delivered'";
					$query = "SELECT * FROM ".$table." WHERE ".$conditions;
					$result = mysql_query($query) or die(mysql_error());
					while($row=mysql_fetch_array($result)){
						echo("<tr><td>".$row['Title']."</td></tr>");
					}
					echo("<tr><td></td></tr>");
					echo("<th>Movies Recently Watched</th>");
					$conditions = "Users.Username='".$_GET['loggedIn']."' AND Loans.Status='Returned'";
					$query = "SELECT * FROM ".$table." WHERE ".$conditions;
					$result = mysql_query($query) or die(mysql_error());
					while($row=mysql_fetch_array($result)){
						echo("<tr><td>".$row['Title']."</td></tr>");
					}
					echo("</table>");
					echo("<a href=\"http://mormon.org/me/1N9R-eng/\"><img src=\"http://mormon.org/bc/assets/images/widget/profile-button/temple-i-believe-bw.jpg\" alt=\"I'm a Mormon.\"/></a>");
					echo("</div>");
					echo("</td><td valign=\"top\">");
				}
			?>
				<div class="section">
				<table align="center" width="730px">
					<?
					if (!$_GET['loggedIn']){
						echo("<tr>
							<td>
								<div class=\"labeledfield\">");
						echo("<label class=\"targetLabel\" for=\"txtUsername\">Username</label>
									<input type=\"text\" id=\"txtUsername\" name=\"textUsername\"");
						echo("</div>
							</td>
							<td>
								<div class=\"button\" id=\"loginBtn\">Login</div>
							</td>
							<td><a class=\"requestA\" href=\"register.php\">Register</a>
							</td>
						</tr>");
					}
					?>
				<tr><td>
				<div class="labeledfield">
				  <label class="targetLabel" for="txtQuestion">Search</label>           
					<?php 
						function setURL($sorted){
								$query=$_GET['query'];
								$loggedIn=$_GET['loggedIn'];
								$dir=$_GET['dir'];
								if($dir=='0' && $sorted==$_GET['sortBy']){
									$dir = 1;
								} else { $dir = 0; }
								
								$url="movies.php?sortBy=".$sorted."&dir=".$dir;
								if ($query){
									$url=$url."&query=".$query;
								}
								if ($loggedIn){
									$url=$url."&loggedIn=".$loggedIn;
								}
								echo("<a href=\"".$url."\">".$sorted);
								if ($sorted==$_GET['sortBy']){
									if ($dir==1){
										echo(" <img src=\"up.png\" alt=\"Ascending\"/>");
									} else {
										echo(" <img src=\"down.png\" alt=\"Descending\"/>");
									}
								}
								echo("</a>");
						}
						
						if ($_GET['query']){
							echo("<input type=\"text\" id=\"txtQuestion\" name=\"txtQuestion\" value=\"".$_GET['query']."\"/>");
						} else { 
							echo("<input type=\"text\" id=\"txtQuestion\" name=\"txtQuestion\" />");
						}
					?>
				</div>
				</td><td>
					<div class="button" id="searchBtn">Search</div>
				</td>
				<td><img src="requestIcon.png" alt="Send Request" /> = Send Request</td>
				</tr>
				</table>
	<?php
		$sortBy = $_GET['sortBy'];
		$search = $_GET['query'];
		$dir = (int)$_GET['dir'];
		$dirs = Array('ASC','DESC');
		if($_GET['loggedIn']){
			
			$query = "SELECT * FROM Users WHERE Username='".$_GET['loggedIn']."'";
			$result = mysql_query($query);
			$row = mysql_fetch_array($result) or die(mysql_error());
			#$query = "SELECT * FROM Movies WHERE Location='Home'";
			#$query = "SELECT *, Movies.ID AS m_id FROM Movies LEFT JOIN Loans ON Movies.ID=Loans.MovieID ".
			$query = "SELECT *, ID AS m_id FROM Movies ".
							 "WHERE ID NOT IN (SELECT MovieID FROM Loans WHERE UserId='".$row['ID']."')";
							 #"WHERE Location='Home' AND (Loans.UserID!='".$row['ID']."' OR ISNULL(Loans.UserID))";
		} else {
			$query = "SELECT *, ID AS m_id FROM Movies WHERE Location='Home'";
		}
		if ($search){
			$query=$query." AND Title LIKE '%".$search."%'";
		}
		if($sortBy){
			$query=$query." ORDER BY ".$sortBy." ".$dirs[$dir];
			if($sortBy!='Title') $query = $query.",Title";
		} else {
			$query=$query." ORDER BY Title";
		}
		$result = mysql_query($query) or die(mysql_error());
		$movieCount = mysql_num_rows($result);
	?>
				<table align="center" BORDER=0 RULES=ROWS FRAME=NONE>
						<th width="325px"><?php setURL("Title"); echo(" (".$movieCount.")");?></th>
						<th width="120px"><?php setURL("Genre")?></th>
						<th width="95px"><?php setURL("Rating")?></th>
						<th width="95px"><?php setURL("Duration")?></th>
						<th width="95px"><?php setURL("Year")?></th>
	<?php	
		$counter = 0;
		while ($row=mysql_fetch_array($result)){
			if ($counter % 2 == 0) {
				echo("<tr class=\"alt\" onmouseover=\"this.className='mousehover'\" onmouseout=\"this.className='alt'\" >");
			} else {
				echo("<tr onmouseover=\"this.className='mousehover'\" onmouseout=\"this.className=''\">");
			}
			echo("<td><A class=\"requestA\" HREF=\"javascript:popUp('http://alanmanderson.com/movies/getName.php?movieID=".
												$row['m_id']."&un=".$_GET['loggedIn']."')\">");
			echo("<img src=\"requestIcon.png\" alt=\"Send Request\" /></A>");
			
			if ($_GET['loggedIn']){
				echo(" <A class=\"requestA\" HREF=\"setSaved.php?movieID=".$row['m_id']."&un=".$_GET['loggedIn']."\">".
							"<img src=\"bookmark.png\" alt=\"Bookmark Movie\"/></A>");
			}
			if ($row['Website']!=""){
				echo("  <A class=\"requestA\" HREF=\"".$row['Website']."\" target=\"_blank\">".$row['Title']."</A></td>");
			} else {
				echo("  ".$row['Title']."</td>");
			}
			echo("<td>".$row['Genre']."</td>");
			echo("<td>".$row['Rating']."</td>");
			echo("<td>".$row['Duration']."</td>");
			echo("<td>".$row['Year']."</td>");
			echo("</tr>");
			$counter++;
		}
		$loggedIn = $_GET['loggedIn'];
		echo ("<input type=\"hidden\" id=\"loggedIn\" name=\"loggedIn\" value=\"".$loggedIn."\"/>")
	?>
				</table>
				</div>
			<?php
				if($_GET['loggedIn']){
					echo("</td></tr></table>");
				}
			?>
			</form>
		</div>
	</body>
</html>