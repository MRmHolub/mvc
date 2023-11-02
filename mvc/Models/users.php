<?php

function update_user($name, $last, $email, $workplace, $phone, $is_admin, $password, $email_of_user){
    $mysqli = $this->db->open();
    $mysqli = $mysqli->prepare("UPDATE users SET name=?, last=?, email=?, workplace=?, phone=?, admin=?, password=? WHERE email=?;");
    $mysqli->bind_param("ssssssss",$name, $last, $email, $workplace, $phone, $is_admin, $password, $email_of_user);
    $mysqli->execute();
    $mysqli->close();
}


function load_user_data($clicked){
    $mysqli = $this->db->open();	        
    $mysqli = $mysqli->prepare("SELECT * FROM users WHERE email=?;");
    $mysqli->bind_param("s",$clicked);
    $mysqli->execute();
    $row = $mysqli->get_result()->fetch_assoc();      
    $mysqli->close();	
    return $row;
}

function load_users(){
    $mysqli = $this->db->open();
    $users = $mysqli->query("SELECT * FROM users ORDER BY last_login;"); 
    $mysqli->close();
    return $users;
}

function delete_user($id){
    $mysqli = $this->db->open();	
    $mysqli = $mysqli->prepare("DELETE FROM users WHERE id=?;");
    $mysqli->bind_param("s",$id);
    $mysqli->execute();	
    $mysqli->close();
}

?>