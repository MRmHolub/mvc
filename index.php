<?php
	session_start();

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {    	
    	
		$email = $_SESSION['email'];
		
		if(is_null($email)){ //if user not logged in
			include "reg.php";			
		} else {
			$s = $_GET["pozadavek"];
			$a = explode('/', $s);

			if ($a[0] == 'logout'){
				include "logout.php";
				include "reg.php";
			} else {
				include "nav.php";									

				//I am logged in
				if ($a[0] == 'dashboard' || $a[0] == '') include "dashboard.php";	
				else if ($a[0] == 'users'){
					echo "<h1>Přihlášený uživatel: $email </h1>";										
					include 'users.php';																															
				}		
				else if ($a[0] == 'others'){
					echo "<h1>OTHERS PODSTRÁNKA</h1>";
				}	
				else if ($a[0] == 'items'){
					echo "<h1>ITEMS PODSTRÁNKA</h1>";									  	
				}
				else if ($a[0] == 'change_user'){
					include 'change_user.php';								
				}
				else {
					echo "<h1>Neexistující PODSTRÁNKA</h1>";					
				}
			}  	
		}
	}
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {									
		$mysqli = connect_db();	
		$logged_email = $mysqli->real_escape_string($_POST['email']) ?? null;		
		$inserted_password = $mysqli->real_escape_string($_POST['password']) ?? null;
		
		if ($logged_email && $inserted_password){						
			$query_result = $mysqli->query("SELECT password FROM users WHERE email='$logged_email';"); 
			while ($row = $query_result->fetch_assoc()) {
				$user_password = $row['password'];				
			}						
			
			if ($user_password == $inserted_password){
				$_SESSION["email"] = $_POST["email"];		
				$result = $mysqli->query("SELECT admin FROM users WHERE email='$logged_email' AND password = '$user_password';"); 
				while ($row = $result->fetch_assoc()) {
					$_SESSION["admin"] = $row["admin"];
				}				
			}
		}
		$mysqli->close();
		header('Location: http://localhost/ukol3/');									
	}
			

	function connect_db() {
		$db_host = 'localhost'; // $db_host = '127.0.0.1'; // pro TCP/IP spojení
		$db_user = 'root';
		$db_password = '';
		$db_db = 'weba_db';
		//$db_port = 8889; // pro TCP/IP spojení
	  
		$mysqli = new mysqli(
		  $db_host,
		  $db_user,
		  $db_password,
		  $db_db,
		  //$db_port // pro TCP/IP spojení
		);

		if ($mysqli->connect_error) {
			echo 'Error: '.$mysqli->connect_error;
			exit();
		} else {
			echo "PŘIPOJENÍ SE ZDAŘILO";
		}

		return $mysqli;
	  }
?>