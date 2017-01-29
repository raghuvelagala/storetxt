<?php
	session_start();

	if($_SESSION["login"] != "yes"){
		$msg = "Sorry, you are not logged in. Access Denied";
		header("Location: index.php?msg=$msg");
	}
	else{
		if(isset($_POST["savefile"]) && $_SESSION["login"] == "yes"){
			$filename = $_SESSION["user"] . ".txt";
			$path = $_SERVER['DOCUMENT_ROOT']. "/web/userfiles/$filename";
			$fw = fopen($path, "w");
			fwrite($fw, $_POST["userdata"]);
			fclose($fw);
		}
		else if(isset($_POST["logout"]) && $_SESSION["login"] == "yes"){
			$_SESSION["user"] = "";
			$_SESSION["login"] = "no";
			session_destroy();
			$msg="LOGGED OUT SUCCESSFULLY";
			header("Location: index.php?msg=$msg");
		}
	}
?>
<html>
<head>
	<title>User's Secret Page</title>
	<link rel="stylesheet" href="index_css.css" />	
	
	
</head>

<body>
	<form method="post" action="user.php">
	<h3>Add some text to the textbox below. Remember to click save when you are done editing!</h3>
	<div id="fInfoContainer">
	<p><span class="fInfo1">Filename: </span><span class="fInfo2"><?php echo $_SESSION["user"].".txt"; ?></span></p>
	<p><span class="fInfo1">Last Edited: </span><span class="fInfo2"><?php 
			$filename = $_SESSION["user"].".txt";
			$path = $_SERVER['DOCUMENT_ROOT']. "/web/userfiles/$filename";
			echo date("r", fileatime($path)); 
	?> UTC</span></p>
	<p><span class="fInfo1">File Size: </span><span class="fInfo2"><?php 
			$filename = $_SESSION["user"].".txt";
			$path = $_SERVER['DOCUMENT_ROOT']. "/web/userfiles/$filename";
			echo filesize($path); 
	?> bytes</span></p>
	</div>
	<div id="userfile">
		<textarea name="userdata" autofocus="autofocus" cols="100" rows="30" placeholder="Enter your text..."><?php
			$filename = $_SESSION["user"].".txt";
			$path = $_SERVER['DOCUMENT_ROOT']. "/web/userfiles/$filename";
			$f = fopen($path, "a+");
			while(!feof($f)){
				echo fgets($f);
			}
			fclose($f);
		?></textarea>
	</div>
	
	<div id="btnHolders">
	<input type="submit" name="savefile" value="Save" />
	<input type="submit" name="logout" value="Logout (to Homepage)"/>
	</div>
	</form>
	<div id="useNote">
	<h5 id="userwarning">NOTE: only what you see in the textbox will be saved to "<?php echo $filename; ?>". everything else will be over-written (logout to leave the file as it is)!<h5>
	<div>
	
			
</body>
</html>