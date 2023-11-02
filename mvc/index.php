<?php
  require "Core/App.php";    

  
try {
  $domena = "http://localhost/mvc";
  $app = new App();
  $db = new Database_connection();  
  
  if ($app->autorized) {            
      $router = new Router($_GET['url']);
  } else {
      $router = new Router("login");
  }
    
  $controller = $router->controller;
    
  if ($controller) {      
      if (file_exists("Controllers/$controller.php")){    
          if ($controller != 'API' && $controller != 'api') {
            include "Views/nav.php";
          }
          include "Controllers/$controller.php";  
      } else header("Location: $domena");      
  } else {
    include "Views/nav.php";
    include "Controllers/dashboard.php";          
  }    


} catch (Exception $e){
  echo 'Caught exception: ',  $e->getMessage(), "\n";
}
?>