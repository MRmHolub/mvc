<?php 	

session_start();

$mail = $_SESSION["email"];
if ($mail){	
	include "nav.php";

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {	
		$_SESSION['clicked_user'] = $_GET['clicked_user'];
		$mysqli = connect_db();	
		$query_result = $mysqli->query("SELECT * FROM users WHERE email='$_GET[clicked_user]';");
		$row = $query_result->fetch_assoc();  //nebudu to třídit protože se mi nechce a není to jako požadavek	
		$mysqli->close();	
		$name = $row['name'];
		$last = $row['last'];
		$email = $row['email'];
		$phone = $row['phone'];
		$password = $row['password'];
		$workplace = $row['workplace'];
		$is_admin = $row['admin'];
		
			  
		echo "
		<h2 class='move_me'>Change user information</h2>
		<form name='new_user' class='move_me' method='POST' action='change_user.php'>						
		<label for='name'>name:</label>
		<input type='text' id='name' name='name' placeholder='Enter your name' value='$name' required>
		<br>
		<label for='last'>last:</label>
		<input type='text' id='last' name='last' placeholder='Enter your last name' value='$last' required>
		<br>
		<label for='email'>email:</label>
		<input type='text' id='email' name='email' placeholder='Enter your email' value='$email'required>
		<br>
		<label for='phone'>phone:</label>
		<input type='text' id='phone' name='phone' placeholder='Enter your phone' value='$phone' required>
		<br>
		<label for='password'>Password:</label>
		<input type='password' id='password' name='password' placeholder='Enter your password' value='$password'required>
		<br>
		<label for='workplace'>workplace:</label>
		<input type='text' id='workplace' name='workplace' placeholder='Enter your workplace' value='$workplace'required>
		<br>
		<span>Is admin:</span>
		";
		if ($is_admin == "true"){	
			echo 
			"<input type='radio' id='admin' name='admin' value='true'>
			<label for='admin'>No</label>
			<input type='radio' id='not_admin' name='admin' value='false' checked>
			<label for='not_admin'>Yes</label>
			<br>
			<button type='submit' class='btn btn-warning'>Save</button>			
			</form>";		
		} else {
			echo 
			"<input type='radio' id='admin' name='admin' value='true' checked>
			<label for='admin'>No</label>
			<input type='radio' id='not_admin' name='admin' value='false'>
			<label for='not_admin'>Yes</label>
			<br>
			<button type='submit' class='btn btn-warning'>Save</button>			
			</form>";		
		}
		
	} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {		
		$mysqli = connect_db();	
        $name = $mysqli->real_escape_string($_POST['name']) ?? null;		
		$password = $mysqli->real_escape_string($_POST['password']) ?? null;
        $last = $mysqli->real_escape_string($_POST['last']) ?? null;
		$email = $mysqli->real_escape_string($_POST['email']) ?? null;
        $workplace = $mysqli->real_escape_string($_POST['workplace']) ?? null;
        $phone = $mysqli->real_escape_string($_POST['phone']) ?? null;
        $is_admin = $mysqli->real_escape_string($_POST['admin']) ?? null;                
		$mysqli->query("UPDATE users SET name='$name', last='$last', email='$email', workplace='$workplace', phone='$phone', admin='$is_admin', password='$password' WHERE email='$_SESSION[clicked_user]';");
		$mysqli->close();
		unset($_SESSION["clicked_user"]);
		header('Location: http://localhost/ukol3/users');				
	}
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
}
return $mysqli;
}
	
?>

