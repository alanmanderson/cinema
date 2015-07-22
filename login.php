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
    <title>FastQs Push Question</title>
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="jquery.label_over.js"></script>
		<script type="text/javascript">
		  $(function() {        
        $('label.targetLabel')  .labelOver('labelover'); 
      })
	  
	  $(function() {
			$("#loginButton").click(function() {
				$.ajax({
					url: 'validate.php',
					type: 'POST',
					data: {'username': document.myForm.txtUsername.value, 'password': document.myForm.txtPassword.value},
					dataType: 'text',
					timeout: 20000,
					error: function(){				      
						alert('Failed to communicate to the server. Try again!');
					},
					success: function(text){
						if (text=="OK") {
							window.location.href="movies.php";
						} else {
							alert("there");
						}
						
					}
				});
			});
	  })
		
		
		</script>

	</head>
  <body style="font-family: Arial;border: 0 none;">
		<form action="validate.php" name="myForm" method="POST">
	
			<div class="labeledfield">            
				<label class="targetLabel" for="txtUsername">Username</label>
				<input type="text" id="txtUsername" name="txtUsername" />
			</div>
			<div class="labeledfield">            
				<label class="targetLabel" for="txtPassword">Password</label>
				<input type="text" id="txtPassword" name="txtPassword" />
			</div>
			<div class="button" id="loginButton">
				Login
			</div>
		</form>
  </body>
</html>
	