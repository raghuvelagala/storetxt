<?php
	session_start();
	if($_POST["username"] == ""  && $_SESSION["login"] != "yes"){	
		$msg = "Username cannot be left blank";
		header("Location: index.php?msg=$msg");
	}
?>
<html>
<head>
	<title>User Login</title>
	<link rel="stylesheet" href="index_css.css" />
	<?php
		//checking Login credentials
		
		if($_SESSION["login"] != "yes") {
			mysql_connect("localhost","root","") OR die(mysql_error());
			mysql_select_db("mywebdb") OR die(mysql_error());
		
			$usrnm = $_POST["username"];
			$pswd = $_POST["password"];
			$qrystr = "SELECT * FROM users WHERE username='$usrnm'";
		
			$userFound = "~!@NOT FOUND@!~";
			$pswdFound = "~!@NOT FOUND@!~";
			$rs = mysql_query($qrystr);
			while($row = mysql_fetch_array($rs)){
				if($row['username'] == $usrnm){
					$userFound = $row['username'];
					$pswdFound = $row['password'];
				}
			}
		}
		
		mysql_close();
	
		if(($_POST["username"] == $userFound  && $_POST["password"] == $pswdFound) ||  $_SESSION["login"] == "yes" ){
			$_SESSION["login"] = "yes";
			$_SESSION["user"] = $_POST["username"];
			echo "<p style='font-variant: small-caps;' class='usrWelcome'>Credentials verified. Welcome ".$_SESSION["user"]. "!<p>";
			echo "<p><a href='user.php'>Click here to Access your Files</a></p>";
			$adminMail = "raghu@velagala.org";
			$subject = "Message%20from%20user%20" . $_SESSION["user"];
			$body = "I%need%20help%20";
			echo "<p><a href='mailto:$adminMail?&subject=$subject&body=$body'>Send a mail to the Admin</a></p>";
			echo "<p><a href='chgpass.php?usrName=".$_POST["username"]."'>Change your password</a></p>";
			
			//Display Users for admin
			if($userFound == "admin"){
				mysql_connect("localhost", "root","") or die(mysql_error());
                mysql_select_db("mywebdb") or die (mysql_error());
                
                $query = "SELECT * FROM users";
                $result = mysql_query($query);
                $rows = mysql_num_rows($result);
                echo "<br /><br /><br /><table border='1'><tr><th>ID</th><th>Username</th></tr>";
                for($j=0; $j<$rows;++$j){
                    $row = mysql_fetch_row($result);
                    echo "<tr><td>$row[0]</td><td>".ucfirst($row[1])."</td></tr>";
                }
                echo "</table>";
                echo "<br />Total number of users: $rows";
                
			}
		}
		else{
			$_SESSION["login"] = "no";
			$_SESSION["user"] = "";
			$msg = "User Not Found. Try Again";
			echo "<p style='font-variant: small-caps;' class='userWelcome'>Credentials not found. Login Again!<p>";
			echo "<p><a href='index.php?msg=$msg'>Click here</a></p>";
		}
	?>
<body>
</body>
</html>