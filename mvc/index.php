<?php
  require "Core/App.php";

  
try {
  $app = new App();

  $autorized = $app->get_autorized();

  $app->process_request();
  $app->call_controller();



} catch (Exception $e){
  echo 'Caught exception: ',  $e->getMessage(), "\n";
}
?>