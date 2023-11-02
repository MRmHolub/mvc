<?php
	session_start();
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    	
    	$name = $_SESSION['name'];
		if(is_null($name)){
			include "reg.php";		  
		} else {
			$s = $_GET["pozadavek"];
			$a = explode('/', $s);

			if ($a[0] == 'logout'){
				unset($_SESSION['name']);
				include "reg.php";
			} else {
				include "nav.php";	
				
				if ($a[0] == 'dashboard' || $a[0] == '') include "dashboard.php";	
				else if ($a[0] == 'users'){
					echo "<h1>";
					echo "USERS PODSTRÁNKA, Uživatel: ";
					echo $name;
					echo "</h1>";
				}		
				else if ($a[0] == 'others'){
					echo "<h1>";
					echo "OTHERS PODSTRÁNKA";
					echo "</h1>";
				}	
				else if ($a[0] == 'items'){
					echo "<h1>";
					echo "ITEMS PODSTRÁNKA";
				  	echo "</h1>";
				}
				else {
					echo "<h1>";
					echo "Neexistující PODSTRÁNKA";
				  	echo "</h1>";	
				}
			}  	
		}
	
	} 
	else if ($_SERVER['REQUEST_METHOD'] == 'POST') {	
		
		  $_SESSION["name"] = $_POST["name"];
		  include "nav.php";

		  include "dashboard.php";

	}
	
?>