<?php 			
	$email = $_SESSION["email"];
	
	
	$db->update_last_login($email);	
	
	unset($_SESSION['email']);
	unset($_SESSION["admin"]);

	header("Location: $domena/");
?>