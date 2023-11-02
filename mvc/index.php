<?php
  require "Core/App.php";

  
try {

  $app = new App();

  $db = new Database_connection();  

  $app->process_request();
  $app->call_controller();
  

} catch (Exception $e){
  echo 'Caught exception: ',  $e->getMessage(), "\n";
}
?>