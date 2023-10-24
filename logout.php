<?php 
	$mysqli = connect_db();
	$time = date("y-m-d h:i:s");
	echo $time;
	$mysqli->query("UPDATE users SET last_login='$time' WHERE email='$_SESSION[email]';");

	$mysqli->close();
	unset($_SESSION['email']);
	unset($_SESSION["admin"]);
?>