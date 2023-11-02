<?php

require "Core/Router.php";
require "Core/Database_connection.php";

class App {

    public $autorized;
    public $admin;    
    public $router;
    public $db;

    function __construct(){
      session_start();

      $this->autorized = $_SESSION['email'] ?? null;    
      $this->admin = $_SESSION['admin'] ?? null;                
  }
 
    public function get_autorized(){        
        return $_SESSION['email'];
    }

    public function get_permission(){
        return $_SESSION['admin'];
    }

    public function refresh_app(){
      $this->autorized = $_SESSION['email'] ?? null;    
      $this->admin = $_SESSION['admin'] ?? null;      
    }

  
}
?>
