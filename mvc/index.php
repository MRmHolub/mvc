<?php

$domena = "http://localhost:8888/mvc";

// zavedeme jednotnou strukturu URL
// http://domena/kontroler
// http://domena/kontroler/metoda
// http://domena/kontroler/metoda/parametr1
// http://domena/kontroler/metoda/parametr1/parametr2
// ...

// například: http://domena/users/edit/42


session_start();

login();

$autorized = $_SESSION['email'] ?? null;
$admin = $_SESSION['admin'] ?? null;

// pokud je uživatel přihlášen, zpracujeme URL, jinak zobrazit login 
if ($autorized) {  
  include "Views/nav.php";
  $router = process_URL();  
} else {
  $router = ['controller' => 'login', 'method' => null, 'params' => null];
}


// TODO: pokud soubor neexistuje, pak 404
if ($router['controller']) {
  include "Controllers/$router[controller].php";
} else {
  include "Controllers/does_not_exist.php";
}

// zpracovani URL – router
function process_URL() 
{
  // parsování URL
  $URL = explode('/', $_GET['url'] ?? '');

  $controller = $URL[0] ?? null;
  $method = $URL[1] ?? null;
  $num_of_params = count($URL);

  $params = [];
  for ($i = 2; $i < $num_of_params; $i++) {
    $params[] = $URL[$i] ?? null;
  }
  
  return ['controller' => $controller, 'method' => $method, 'params' => $params];
}


// pouze pro demonstraci, přihlásí uživatele
function login() {
  $autorized = $_SESSION['email'] ?? null;
  $admin = $_SESSION['admin'] ?? null;
}



login(); // přihlášení uživatele


?>