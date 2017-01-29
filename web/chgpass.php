<?php
	session_start();

	if(!isset($_SESSION["login"]) || $_SESSION["login"] != "yes"){
		$msg = "Cannot Access Change Password. Try logging-in first.";
		header("Location: index.php?msg=$msg");
	}
?>

<html>
<head>
	<title>Change Password</title>
	<link rel="stylesheet" href="index_css.css" />
</head>

<body>

	<p><a href="login.php">Back to Login</a></p>
</body>
</html
