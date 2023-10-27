<?php 	
	$mysqli = $this->db->open();
	$time = date("y-m-d h:i:s");	
	$email = $this->get_autorized();	
	$mysqli->query("UPDATE users SET last_login='$time' WHERE email='$email';");
	$mysqli->close();
	
	unset($_SESSION['email']);
	unset($_SESSION["admin"]);

	header("Location: $this->domena/");
?>