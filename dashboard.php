<?php
$db_host = 'localhost'; // $db_host = '127.0.0.1'; // pro TCP/IP spojení
$db_user = 'root';
$db_password = '';
$db_db = 'weba_db';
//$db_port = 8889; // pro TCP/IP spojení

$mysqli = new mysqli(
  $db_host,
  $db_user,
  $db_password,
  $db_db,
  //$db_port // pro TCP/IP spojení
);

if ($mysqli->connect_error) {
  echo 'Error: '.$mysqli->connect_error;
  exit();
}
        
$query_result = $mysqli->query("SELECT * FROM users ORDER BY last_login LIMIT 10;"); //Must be in db last 10 people
echo "<h2 class='move_me'>Dashboard - 10 last users logged</h2>
  <table>  
  <thead>
  <tr>						
      <th scope='col'>First</th>
      <th scope='col'>Last</th>									
      <th scope='col'>Email</th>
      <th scope='col'>Phone</th>
      <th scope='col'>Workplace</th>
      <th scope='col'>Admin</th>									
      <th scope='col'>Last login</th>			
  </tr>
  </thead>
  <tbody>";

  $i = 0;  

while ($row = $query_result->fetch_assoc()) { //nebudu to třídit protože se mi nechce a není to jako požadavek
  $name = $row['name'];
  $last = $row['last'];
  $email = $row['email'];
  $phone = $row['phone'];
  $workplace = $row['workplace'];
  $is_admin = $row['admin'];
  $login_time = $row['last_login'];

  echo "<tr>								
      <td>$name</td>							
      <td>$last</td>	
      <td>$email</td>	
      <td>$phone</td>	
      <td>$workplace</td>	
      <td>$is_admin</td>	
      <td>$login_time</td>
    </tr>";
  
}
      
    

    
  
  echo "</tbody></table>";
?>


    