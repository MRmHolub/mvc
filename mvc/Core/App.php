<?php

require "Core/Router.php";
require "Core/Database_connection.php";

class App {

    public $autorized;
    public $admin;
    public $domena = "http://localhost/mvc";
    public $router;
    public $db;

    function __construct(){

      session_start();

      $this->autorized = $_SESSION['email'] ?? null;    
      $this->admin = $_SESSION['admin'] ?? null;      
      $this->db = new Database_connection();      

      //this is where the controller, views code is then inserted
  }

    public function call_controller(){

      $controller = $this->router->controller;
      
      if ($controller) {      
          if (file_exists("Controllers/$controller.php")){
            include "Views/nav.php";
            include "Controllers/$controller.php";  
          } else { 
            header("Location: $this->domena");
          }
        } else {
          include "Views/nav.php";
          include "Controllers/dashboard.php";          
        }
    }

    public function process_request(){
      if ($this->autorized) {            
          $this->router = new Router($_GET['url']);
        } else {
          $this->router = new Router("login");
        }
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
