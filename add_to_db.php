<?php
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
        exit();}

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $mysqli->real_escape_string($_POST['name']) ?? null;		
		$password = $mysqli->real_escape_string($_POST['password']) ?? null;
        $last = $mysqli->real_escape_string($_POST['last']) ?? null;
		$email = $mysqli->real_escape_string($_POST['email']) ?? null;
        $workplace = $mysqli->real_escape_string($_POST['workplace']) ?? null;
        $phone = $mysqli->real_escape_string($_POST['phone']) ?? null;
        $is_admin = $mysqli->real_escape_string($_POST['admin']) ?? null;
        

        $query = $mysqli->query("SELECT * from users WHERE email = '$email';");
		if (mysqli_num_rows($query) == 0){
            $query_result = $mysqli->query("INSERT INTO users (name, last, password, email, phone, workplace, admin) VALUES ('$name', '$last', '$password', '$email', '$phone', '$workplace', '$is_admin');"); 
        }
		
    }

    $mysqli->close();	
    header('Location: http://localhost/ukol3/users');
    exit;
    
?>