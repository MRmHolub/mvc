<?php

if (!$this->get_autorized()) die();


if ($this->router->method == '') {
  $mysqli = $this->db->open();	
  $i = 0;
  $query_result = $mysqli->query("SELECT * FROM users ORDER BY last_login;"); 
  $mysqli->close();
  include "Views/users/users.php";

} else if ($this->router->method == 'update') {
  
  $mysqli = $this->db->open();	
  $name = $mysqli->real_escape_string($_POST['name']) ?? null;		
  $password = $mysqli->real_escape_string($_POST['password']) ?? null;
  $last = $mysqli->real_escape_string($_POST['last']) ?? null;
  $email = $mysqli->real_escape_string($_POST['email']) ?? null;
  $workplace = $mysqli->real_escape_string($_POST['workplace']) ?? null;
  $phone = $mysqli->real_escape_string($_POST['phone']) ?? null;
  $is_admin = $mysqli->real_escape_string($_POST['admin']) ?? null;   
  $arr = [$name, $last, $email, $workplace, $phone, $is_admin, $password];         
  $this->db->secure_query("UPDATE users SET name='?', last='?', email='?', workplace='?', phone='?', admin='?', password='?' WHERE email='$_SESSION[clicked_user]';", $arr);
  $mysqli->close();
  
  unset($_SESSION['clicked_user']);

  header("Location: $domena/users");

} else if ($this->router->method == 'edit') {    
  $mysqli = $this->db->open();	
  $clicked_email = $mysqli->real_escape_string($_POST['clicked_user']) ?? null;
  $_SESSION['clicked_user'] = $clicked_email;
  $query_result = $this->db->secure_query("SELECT * FROM users WHERE email='?';", [$clicked_email]);
  $row = $query_result->fetch_assoc();  
  $mysqli->close();	

  $name = $row['name'];
  $last = $row['last'];
  $email = $row['email'];
  $phone = $row['phone'];
  $password = $row['password'];
  $workplace = $row['workplace'];
  $is_admin = $row['admin']; 
  
  include "Views/users/edit.php";

} else if ($this->router->method == 'delete') {				

    $mysqli = $this->db->open();	
    $delete_email = $mysqli->real_escape_string($_POST['email']) ?? null;		
    if ($delete_email) $this->db->secure_query("DELETE FROM users WHERE email='?';", [$logged_email]);
    $mysqli->close();
    header("Location: $domena/users");

} else if ($this->router->method == 'add'){
    $mysqli = $this->db->open();	
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
    header("Location: $domena/users");
} else {
  include "Views/does_not_exist.php";
}


?>