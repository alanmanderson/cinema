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
				$("#registerBtn").click(function() {
					var un = $('#txtUsername').val();
					var first = $('#txtFirst').val();
					var last = $('#txtLast').val();
					var email = $('#txtEmail').val();
					var url = "reg.php?un=" + un + "&first=" + first + "&last=" + last + "&email=" + email;
					location.href = url;
				});
			})
			
			$(function() {
				$("#cancelBtn").click(function() {
					var url = "movies.php";
					location.href = url;
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
				<table align="center" width="730px">
					<?php
						if ($_GET['error']){
							echo("<tr class=\"error\"><td colspan=\"2\">".$_GET['error']."</td></tr>");
						}
					?>
				
					<tr><td colspan="2">
						<div class="labeledfield">
							<label class="targetLabel" for="txtUsername">Username</label>
							<?php
								echo("<input type=\"text\" id=\"txtUsername\" name=\"txtUsername\"");
								if ($_GET['un']){
									echo("value=\"".$_GET['un']."\"");
								}
								echo("/>");
							?>
						</div>
						</td>
					</tr>
					<tr><td>
						<div class="labeledfield">
							<label class="targetLabel" for="txtFirst">First name</label>
							<?php
								echo("<input type=\"text\" id=\"txtFirst\" name=\"txtFirst\"");
								if ($_GET['first']){
									echo(" value=\"".$_GET['first']."\"");
								}
								echo("/>");
							?>
						</div>
						</td><td>
						<div class="labeledfield">
							<label class="targetLabel" for="txtLast">Last name</label>
							<?php
								echo("<input type=\"text\" id=\"txtLast\" name=\"txtLast\"");
								if ($_GET['last']){
									echo("value=\"".$_GET['last']."\"");
								}
								echo("/>");
							?>
						</div>
					</td></tr>
					<tr><td colspan="2">
						<div class="labeledfield">
							<label class="targetLabel" for="txtEmail">Email</label>
							<?php
								echo("<input type=\"text\" id=\"txtEmail\" name=\"txtEmail\"");
								if ($_GET['email']){
									echo("value=\"".$_GET['email']."\"");
								}
								echo("/>");
							?>
						</div>
						</td>
					</tr>
					<tr><td>
						<div class="button" id="registerBtn">Register!</div>
						</td><td>
						<div class="button" id="cancelBtn">Cancel</div>
					</td></tr>
				</table>
			</form>
		</div>
	</body>
</html>