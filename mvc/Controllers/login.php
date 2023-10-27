<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $mysqli = $this->db->open();	

        $logged_email = $mysqli->real_escape_string($_POST['email']) ?? null;		
        $inserted_password = $mysqli->real_escape_string($_POST['password']) ?? null;
        
        if ($logged_email && $inserted_password){	
            $query_result = $db->secure_query("SELECT password FROM users WHERE email = ' ? ';", [$logged_email]);
            
            $user_password = $query_result->fetch_assoc()['password'];				            						
            
            if ($user_password == $inserted_password){                
                
                $result = $db->secure_query("SELECT admin FROM users WHERE email='?' AND password = '?';", [$logged_email, $user_password]); 
                
                set_autorization($_POST["email"]);
                set_permission($result->fetch_assoc()['admin']);                			
            }
        }
        $mysqli->close();
        header("Location: $domena/");
    } else {
        include "Views/login.php";
    }

?>