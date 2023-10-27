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