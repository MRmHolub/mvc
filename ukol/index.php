<?php
	$s = $_GET["pozadavek"];
	$a = explode('/', $s);

	include "nav.php";	
	
	if ($a[0] == 'dashboard' || $a[0] == '') include "dashboard.php";	
	else if ($a[0] == 'users'){
		echo "<h1>";
		echo "			USERS PODSTRÁNKA";
		echo "</h1>";
	}		
	else if ($a[0] == 'others'){
		echo "<h1>";
		echo "			OTHERS PODSTRÁNKA";
		echo "</h1>";
	}	
	else if ($a[0] == 'items'){
		echo "<h1>";
		echo "			ITEMS PODSTRÁNKA";
	  	echo "</h1>";		
	}else {
		echo "<h1>";
		echo "			Neexistující PODSTRÁNKA";
	  	echo "</h1>";	
	}  	
?>