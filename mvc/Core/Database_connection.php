<?php 

class Database_connection {

    private $db_host = 'localhost'; // $db_host = '127.0.0.1'; // pro TCP/IP spojení
    private $db_user = 'root';
    private $db_password = '';
    private $db_db = 'weba_db';

    public $mysqli;

    function __construct() {}

    public function open() {               
        $mysqli = new mysqli(
          $this->db_host,
          $this->db_user,
          $this->db_password,
          $this->db_db,
          //$db_port // pro TCP/IP spojení
        );
      
        if ($mysqli->connect_error) {
          echo 'Error: '.$mysqli->connect_error;
          exit();
        } 
        return $mysqli;
    }

    function die(){
        $mysqli->close();
    }

    public function secure_query($str, $vars_arr){
        $mysqli = $mysqli->prepare($str);             
        
        $param_str='';

        foreach ($vars_arr as $arg){
            $param_str = $param_str . 's';
        }

        $bind_param_args = array_merge([$param_str], $bind_params);
        call_user_func_array([$mysqli, 'bind_param'], $bind_param_args);    //instead of $mysqli->bind_param($param_str, arg 1, arg 2); 
           
        $mysqli->execute();
        
        return $mysqli->get_result();
    }
}


?>