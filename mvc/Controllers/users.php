<?php

//if (!$autorized) die(); // ošetření spuštení mimo kontext

// TODO: připojení k databázi

// implementace metod

// SHOW
if ($router['method'] == 'show') {
  
  $users = ['Jack', 'Samantha', 'Daniel', 'Teal\'c'];
  
  // zobrazení příslušené šablony (View)
  include "Views/$router[controller]/$router[method].php"; 
}

// ADD
elseif ($router['method']== 'add') {
  print_r($_POST);

  // přesměrování na URL
  header("Location: $GLOBALS[domena]/users/");
  exit();
}

// EDIT
elseif ($router['method'] == 'edit') {
  print_r($router['params']);
}

else {
  echo "neplatná akce";
}

?>