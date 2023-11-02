<?php 

class Database_connection {

    private $db_host = 'localhost'; // $db_host = '127.0.0.1'; // pro TCP/IP spojení
    private $db_user = 'root';
    private $db_password = '';
    private $db_db = 'weba_db';

    public $mysqli;

    function __construct() {}

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

    //public function secure_query($str, $vars_arr){
//
    //    $this->mysqli = $this->mysqli->prepare($str);             
    //    
    //    $param_str='';
//
    //    foreach ($vars_arr as $arg){
    //        $param_str .= 's';
    //    }
    //    $mysqli = $this->mysqli->bind_param();
    //    $vars_arr = array_merge([$param_str], $vars_arr);    
    //    call_user_func($mysqli, $vars_arr);    //instead of $mysqli->bind_param($param_str, arg 1, arg 2); 
    //       
    //    $this->mysqli->execute();
    //    
    //    return $this->mysqli->get_result();
    //}
}//


?>