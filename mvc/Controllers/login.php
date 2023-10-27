<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $mysqli = $this->db->open();	

        $logged_email = $_POST['email'] ?? null;		
        $inserted_password = $_POST['password'] ?? null;
        
        if ($logged_email && $inserted_password){	
            $mysqli = $mysqli->prepare("SELECT password FROM users WHERE email = ?;");
            $mysqli->bind_param("s", $logged_email);
            $mysqli->execute();
            $query_result = $mysqli->get_result();
            $mysqli->close();
            
            $user_password = $query_result->fetch_assoc()['password'];				            						
            
            if ($user_password == $inserted_password){   
                $mysqli = $this->db->open();	             
                $mysqli = $mysqli->prepare("SELECT admin FROM users WHERE email=? AND password = ?;");
                
                
                $mysqli->bind_param("ss", $logged_email, $user_password);
                $mysqli->execute();
                $result = $mysqli->get_result();     
                
                $_SESSION['email'] = $_POST["email"] ?? null;
                $_SESSION['admin'] = $result->fetch_assoc()['admin'];   
                $this->refresh_app();
                
            }
        }
        $mysqli->close();
        header("Location: $this->domena/");
    } else {
        include "Views/login.php";
    }

?>