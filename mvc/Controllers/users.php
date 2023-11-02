<?php
include "Models/users.php";

if ($router->method == '') {
  $mysqli = $db->open();	
  $i = 0;
  $query_result = $mysqli->query("SELECT * FROM users ORDER BY last_login;"); 
  $mysqli->close();

  include "Views/users/users.php";
  
} else if ($router->method == 'update') {
  
  try {
    $mysqli = $db->open();	
    $name = $_POST['name'];		
    $password = $_POST['password'];
    $last =$_POST['last'];
    $email = $_POST['email'];
    $workplace = $_POST['workplace'];
    $phone =$_POST['phone'];
    $is_admin = $_POST['admin'];  
    
    update_user($name, $password, $last, $email, $workplace, $phone, $is_admin, $_SESSION['clicked_user']);
   
  } catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
  }
  
  unset($_SESSION['clicked_user']);
  header("Location: $domena/users");
} 

else if ($router->method == 'edit') {    
  try {
    $clicked_email = $_POST['clicked_user'];
    
    if ($clicked_email){
      $_SESSION['clicked_user'] = $clicked_email;

      $row = load_user_data($clicked_email);

      $name = $row['name'];
      $last = $row['last'];
      $email = $row['email'];
      $phone = $row['phone'];
      $password = $row['password'];
      $workplace = $row['workplace'];
      $is_admin = $row['admin']; 
      
      include "Views/users/edit.php";
    }
  } catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
  }
} 
else if ($router->method == 'delete') {				
    $delete_id = $router->params[0];
    delete_user($delete_id);
    header("Location: $domena/users");

} else if ($router->method == 'add'){
    
    $mysqli = $db->open();	
    $name = $_POST['name'];		
    $password = $_POST['password'];
    $last = $_POST['last'];
    $email = $_POST['email'];
    $workplace = $_POST['workplace'];
    $phone = $_POST['phone'];
    $is_admin = $_POST['admin'];  
    
    $query = load_user_data($email);    
    $added = false;
    if (mysqli_num_rows($query) == 0 ){        	
        $mysqli->query("INSERT INTO users (name, last, password, email, phone, workplace, admin) VALUES ('$name', '$last', '$password', '$email', '$phone', '$workplace', '$is_admin');");         
        $added = true;        
    }
    //$query_result = load_users();
    include "Views/users/add.php";            

    //$mysqli->prepare("INSERT INTO users (name, last, password, email, phone, workplace, admin) VALUES ('?', '?', '?', '?', '?', '?', '?');"); 
} else {
  header("Location: $domena");
  include "Views/does_not_exist.php";
}


?>