<?php 

class Database_connection {

    private $db_host = 'localhost'; // $db_host = '127.0.0.1'; // pro TCP/IP spojení
    private $db_user = 'root';
    private $db_password = '';
    private $db_db = 'weba_db';

    public $mysqli;


    public function open() {               
        $this->mysqli = new mysqli(
          $this->db_host,
          $this->db_user,
          $this->db_password,
          $this->db_db,
          //$db_port // pro TCP/IP spojení
        );
      
        if ($this->mysqli->connect_error) {
          echo 'Error: '.$this->mysqli->connect_error;
          exit();
        } 
        return $this->mysqli;
    }

    function die(){
        $this->mysqli->close();
    }

    function update_user($name, $last, $email, $workplace, $phone, $is_admin, $password, $email_of_user){
        $mysqli = $this->open();
        $mysqli = $mysqli->prepare("UPDATE users SET name=?, last=?, email=?, workplace=?, phone=?, admin=?, password=? WHERE email=?;");
        $mysqli->bind_param("ssssssss",$name, $last, $email, $workplace, $phone, $is_admin, $password, $email_of_user);
        $mysqli->execute();
        $mysqli->close();
    }
    
    
    function load_user_data($clicked){
        $mysqli = $this->open();	        
        $mysqli = $mysqli->prepare("SELECT * FROM users WHERE email=?;");
        $mysqli->bind_param("s",$clicked);
        $mysqli->execute();
        $row = $mysqli->get_result()->fetch_assoc();      
        $mysqli->close();	
        return $row;
    }

    function load_user_data_id($id){
        $mysqli = $this->open();	        
        $mysqli = $mysqli->prepare("SELECT * FROM users WHERE id=?;");
        $mysqli->bind_param("s",$id);
        $mysqli->execute();
        $row = $mysqli->get_result()->fetch_assoc();      
        $mysqli->close();	
        return $row;
    }
    
    function load_users(){
        $mysqli = $this->open();
        $users = $mysqli->query("SELECT * FROM users ORDER BY last_login;"); 
        $mysqli->close();
        return $users;
    }
    
    function delete_user($id){
        $mysqli = $this->open();	
        $mysqli = $mysqli->prepare("DELETE FROM users WHERE id=?;");
        $mysqli->bind_param("s",$id);
        $mysqli->execute();	
        $mysqli->close();
    }

    function get_user_password($logged_email){
        $mysqli = $this->open();		
        $mysqli = $mysqli->prepare("SELECT password FROM users WHERE email = ?;");
        $mysqli->bind_param("s", $logged_email);
        $mysqli->execute();
        
        $query_result = $mysqli->get_result();  
        return $query_result->fetch_assoc()['password'];				            						
    
        $mysqli->close();
    }
    
    function get_user_admin($logged_email){
        $mysqli = $this->open();	             
        $mysqli = $mysqli->prepare("SELECT admin FROM users WHERE email=?;");
        
        $mysqli->bind_param("s", $logged_email);
        $mysqli->execute();
        $result = $mysqli->get_result();    
        return $result->fetch_assoc()['admin'];
    }

}


?>