<?php 		
	$time = date("y-m-d h:i:s");	
	$email = $_SESSION["email"];
	
	$mysqli = $db->open();
	$mysqli->query("UPDATE users SET last_login='$time' WHERE email='$email';");
	$mysqli->close();
	
	unset($_SESSION['email']);
	unset($_SESSION["admin"]);

	header("Location: $this->domena/");
?>