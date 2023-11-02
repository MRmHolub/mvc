<?php

function get_user_password($logged_email){
    $mysqli = $this->db->open();		
    $mysqli = $mysqli->prepare("SELECT password FROM users WHERE email = ?;");
    $mysqli->bind_param("s", $logged_email);
    $mysqli->execute();
    
    $query_result = $mysqli->get_result();  
    return $query_result->fetch_assoc()['password'];				            						

    $mysqli->close();
}

function get_user_admin($logged_email){
    $mysqli = $this->db->open();	             
    $mysqli = $mysqli->prepare("SELECT admin FROM users WHERE email=?;");
    
    $mysqli->bind_param("ss", $logged_email);
    $mysqli->execute();
    $result = $mysqli->get_result();    
    return $result->fetch_assoc()['admin'];
}


?>