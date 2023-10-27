<?php

$mysqli = $this->db->open();        
$query_result = $mysqli->query("SELECT * FROM users ORDER BY last_login LIMIT 10;"); //Must be in db last 10 people
$mysqli->close();

include "Views/dashboard.php";
?>


    