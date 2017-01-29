<html>
<head>
	<title>New User Form</title>
	<link rel="stylesheet" type="text/css" href="index_css.css" />
</title>
<body>
	<h1>Fill in the form below to create a New User</h1>
	
	<div id="newuserform">
	<fieldset>
	<legend>New user: </legend>
	<form method="post" action="newuser.php">
	<p>Name: <input type="text" id="name" name="username" placeholder="Eg. priyanka" />	Note: Do not include any special characters</p>
	<p>Password: <input type="text" id="jpass1"name="password" placeholder="Eg. secretpassword" /></p>
	<p>Re-enter Password: <input type="text" id="jpass2" name="password2" placeholder="Eg. secretpassword" /></p>
	<input type="submit" value="Create me!" onclick="validate();" />
	</fieldset>
	</form>
	
	<?php
		
		mysql_connect("localhost", "root", "") OR die(mysql_error());
		//mysql_query("CREATE DATABASE mywebdb") OR die(mysql_error());
		mysql_select_db("mywebdb") Or die(mysql_error());
		
		if(isset($_POST["username"])){
			$username = $_POST["username"];
			$password = $_POST["password"];
			$insert = "INSERT INTO users(username,password) VALUES('$username','$password')";
			mysql_query($insert) OR die(mysql_error());
		}		
		mysql_close();
	?>
	
	<div>
		<a href="index.php"><input type="button" value="Back to Home"/><a>
	</div>
	
	

	<script type="text/javascript">
		function(){
			alert("hello!");
			var pass1 = document.getElementById("jpass1").value;
			var pass2 = document.getElementById("jpass2").value;
			var name = var pass2 = document.getElementById("name").value;
			if(pass1 == pass2){
				alert("Thank you, " + name);
			}
			else{
				alert("Sorry, your passwords don't match. Try again");
				return false;
			}
		}
	</script>

</body>
</html>