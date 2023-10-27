<?php
  require "Core/App.php";

  
try {

  $app = new App();

  $app->process_request();
  $app->call_controller();

  echo $app->get_autorized();




} catch (Exception $e){
  echo 'Caught exception: ',  $e->getMessage(), "\n";
}
?>