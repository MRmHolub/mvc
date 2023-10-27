<?php

// zavedeme jednotnou strukturu URL
// http://domena/kontroler
// http://domena/kontroler/metoda
// http://domena/kontroler/metoda/parametr1
// http://domena/kontroler/metoda/parametr1/parametr2
// ...

// například: http://domena/users/edit/42

class Router {

    public $controller;
    public $method;
    public $num_of_params;    
    public $params_arr;

    public function __construct($url) {        
        $this->process_URL($url);
    }

    public function process_URL($url){
        $URL_arr = explode('/', $url ?? '');

        $this->controller = $URL_arr[0] ?? null;
        $this->method = $URL__arr[1] ?? null;
        $this->num_of_params = count($URL_arr);
    
        $this->params = [];
        for ($i = 2; $i < $this->num_of_params; $i++) {
            $this->params[] = $URL_arr[$i] ?? null;
        }
        
        //return ['controller' => $controller, 'method' => $method, 'params' => $params];
    }  
}

?>