<?php
    

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){        

        $logged_email = $_POST['email'] ?? null;		
        $inserted_password = $_POST['password'] ?? null;
        
        if ($logged_email && $inserted_password){
            
            $user_password = $db->get_user_password($logged_email);
            
            if ($user_password == $inserted_password){                                   
                
                $_SESSION['email'] = $logged_email;
                $_SESSION['admin'] = $db->get_user_admin($logged_email);
                
                $app->refresh_app();                
            }
        }        
        header("Location: $domena/");
    } else {
        include "Views/login.php";
    }

?>