<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){					
        $mysqli = connect_db();	
        $logged_email = $mysqli->real_escape_string($_POST['email']) ?? null;		
        if ($logged_email) $mysqli->query("DELETE FROM users WHERE email='$logged_email';");
        $mysqli->close();
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