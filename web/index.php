<html>
<head>
	<title>Welcome to the Velagala website</title>
	<link rel="stylesheet" type="text/css" href="index_css.css" />
</head>

<body>

	<h1>Welcome to the website</h1>
	<p>Enter your log-in details in the form below: <p>

	<div id="formbox">
	<form method="POST" action="login.php">
	<h3>Enter Credentials</h3>
	<p>Username: <input type="text" name="username" placeholder="Eg. user123" /></p>
	<p>Password: <input type="password" name="password" placeholder="Eg. pass345" /></p>
	<p><input type="submit" name="submit" value="Log me in" />
	   <a href="newuser.php"><input type="button" name="btn" value="Register" href="newuser.php" /></a></p>	
	</form>
	</div>
	
	<br />
	<br />
	<div id="messagebox">
	<?php
		if(isset($_GET["msg"])){
			echo "<p>Message: ".$_GET["msg"].".";
		}
	?>
	</div>
	
<body>
<html>