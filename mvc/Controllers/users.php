<?php

if (!$this->get_autorized()) die();


if ($this->router->method == '') {
  $mysqli = $this->db->open();	
  $i = 0;
  $query_result = $mysqli->query("SELECT * FROM users ORDER BY last_login;"); 
  $mysqli->close();
  include "Views/users/users.php";
  
} else if ($this->router->method == 'update') {
  
  try {
    $mysqli = $this->db->open();	
    $name = $mysqli->real_escape_string($_POST['name']) ?? null;		
    $password = $mysqli->real_escape_string($_POST['password']) ?? null;
    $last = $mysqli->real_escape_string($_POST['last']) ?? null;
    $email = $mysqli->real_escape_string($_POST['email']) ?? null;
    $workplace = $mysqli->real_escape_string($_POST['workplace']) ?? null;
    $phone = $mysqli->real_escape_string($_POST['phone']) ?? null;
    $is_admin = $mysqli->real_escape_string($_POST['admin']) ?? null;   
          
    $mysqli = $this->db->open();
    $mysqli = $mysqli->prepare("UPDATE users SET name=?, last=?, email=?, workplace=?, phone=?, admin=?, password=? WHERE email=?;");
    $mysqli->bind_param("ssssssss",$name, $last, $email, $workplace, $phone, $is_admin, $password, $_SESSION['clicked_user']);
    $mysqli->execute();
    $mysqli->close();
  } catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
  }

  
  unset($_SESSION['clicked_user']);
  header("Location: $this->domena/users");

} else if ($this->router->method == 'edit') {    
  try {
    $mysqli = $this->db->open();	
    $clicked_email = $mysqli->real_escape_string($_POST['clicked_user']) ?? null;
    $_SESSION['clicked_user'] = $clicked_email;

    $mysqli = $mysqli->prepare("SELECT * FROM users WHERE email=?;");
    $mysqli->bind_param("s",$clicked_email);
    $mysqli->execute();

    $row = $mysqli->get_result()->fetch_assoc();  

    $mysqli->close();	

    $name = $row['name'];
    $last = $row['last'];
    $email = $row['email'];
    $phone = $row['phone'];
    $password = $row['password'];
    $workplace = $row['workplace'];
    $is_admin = $row['admin']; 
    
    include "Views/users/edit.php";
  } catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
  }

} else if ($this->router->method == 'delete') {				
    $delete_email = $this->router->params[0];
    $mysqli = $this->db->open();	
    $mysqli = $mysqli->prepare("DELETE FROM users WHERE email=?;");
    $mysqli->bind_param("s",$delete_email);
    $mysqli->execute();	
    $mysqli->close();
    header("Location: $this->domena/users");

} else if ($this->router->method == 'add'){
    $mysqli = $this->db->open();	
    $name = $mysqli->real_escape_string($_POST['name']) ?? null;		
    $password = $mysqli->real_escape_string($_POST['password']) ?? null;
    $last = $mysqli->real_escape_string($_POST['last']) ?? null;
    $email = $mysqli->real_escape_string($_POST['email']) ?? null;
    $workplace = $mysqli->real_escape_string($_POST['workplace']) ?? null;
    $phone = $mysqli->real_escape_string($_POST['phone']) ?? null;
    $is_admin = $mysqli->real_escape_string($_POST['admin']) ?? null;  

    $mysqli = $mysqli->prepare("SELECT password FROM users WHERE email = ?;");
    $mysqli->bind_param("s", $logged_email);
    $mysqli->execute();
    $query = $mysqli->get_result();
    $mysqli->close();
    if (mysqli_num_rows($query) == 0){
        $mysqli = $this->db->open();	
        $query_result = $mysqli->query("INSERT INTO users (name, last, password, email, phone, workplace, admin) VALUES ('$name', '$last', '$password', '$email', '$phone', '$workplace', '$is_admin');"); 
    }

    $mysqli->close();
    header("Location: $this->domena/users");

    //$mysqli->prepare("INSERT INTO users (name, last, password, email, phone, workplace, admin) VALUES ('?', '?', '?', '?', '?', '?', '?');"); 
} else {
  header("Location: $this->domena");
  include "Views/does_not_exist.php";
}


?>