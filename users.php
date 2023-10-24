<?php			
echo "<h2 class='move_me'>Add new user</h2>
<form name='new_user' class='move_me' method='POST' action='add_to_db.php'>						
    <label for='name'>name:</label>
    <input type='text' id='name' name='name' placeholder='Enter your name' required>
    <br>
    <label for='last'>last:</label>
    <input type='text' id='last' name='last' placeholder='Enter your last name' required>
    <br>
    <label for='email'>email:</label>
    <input type='text' id='email' name='email' placeholder='Enter your email' required>
    <br>
    <label for='phone'>phone:</label>
    <input type='text' id='phone' name='phone' placeholder='Enter your phone' required>
    <br>
    <label for='password'>Password:</label>
    <input type='password' id='password' name='password' placeholder='Enter your password' required>
    <br>
    <label for='workplace'>workplace:</label>
    <input type='text' id='workplace' name='workplace' placeholder='Enter your workplace' required>
    <br>
    <span>Is admin:</span>
    <input type='radio' id='admin' name='admin' value='true'>
    <label for='admin'>No</label>
    <input type='radio' id='not_admin' name='admin' value='false'>
    <label for='not_admin'>Yes</label>
    <br>
    <button type='submit' class='btn btn-success'>Add user</button>
</form>

<table>
    <thead>
    <tr>						
        <th scope='col'>First</th>
        <th scope='col'>Last</th>									
        <th scope='col'>Email</th>
        <th scope='col'>Phone</th>
        <th scope='col'>Workplace</th>
        <th scope='col'>Admin</th>									
    </tr>
    </thead>
    <tbody>";

$mysqli = connect_db();	
$i = 0;
$query_result = $mysqli->query("SELECT * FROM users;"); 

while ($row = $query_result->fetch_assoc()) {
    $i = $i + 1;
    $name = $row['name'];
    $last = $row['last'];
    $email = $row['email'];
    $phone = $row['phone'];
    $workplace = $row['workplace'];
    $is_admin = $row['admin'];

    echo "<tr>								
            <td>$name</td>							
            <td>$last</td>	
            <td>$email</td>	
            <td>$phone</td>	
            <td>$workplace</td>	
            <td>$is_admin</td>";

    
    if ($_SESSION["admin"] == "true" || $email == $_SESSION["email"]){   
        echo "<td>           
                <form method='get' action='change_user.php' style='display: inline-block;'>
                    <input type='hidden' name='clicked_user' value='$email'>
                    <button type='submit' class='btn btn-warning'>Edit</button>
                </form>      
                <form method='post' action='delete_user.php' style='display: inline-block;'>
                    <input type='hidden' name='email' value='$email'>
                    <button type='submit' class='btn btn-danger'>Delete</button>
                </form>                    
        </tr>";
    } else {
        echo "                                          
        </tr>";
    }
        
        
    }	

    echo "</tbody></table>";
    $mysqli->close();
?>