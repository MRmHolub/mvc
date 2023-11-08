<?php			
echo "
    <h1 class='move_me'>Přihlášený uživatel: $_SESSION[email] </h1>
    <h2 class='move_me'>Add new user</h2>
    <form id='add_user' name='new_user' class='move_me half' method='POST' action='$domena/users/add'>						    
    
        <label for='name'>Name</label>
        <input class='form-control require' type='text' id='name' name='name' placeholder='Enter your name' required>        

        <label for='last'>Last</label>
        <input class='form-control require' type='text' id='last' name='last' placeholder='Enter your last name' required>                

        <label for='email'>Email</label>
        <input class='form-control require' type='email' id='emailos' name='email' placeholder='Enter your email' required>        

        <label for='phone'>Phone</label>
        <input class='form-control require' type='text' id='phone' name='phone' placeholder='Enter your phone' required>        

        <label for='password'>Password</label>
        <input class='form-control require' type='password' id='password' name='password' placeholder='Enter your password' required>        

        <label for='workplace'>Workplace</label>
        <input class='form-control require' type='text' id='workplace' name='workplace' placeholder='Enter your workplace' required>                
        
        <div>
            <span>Permissions</span>
            <br>
            <input type='radio' id='admin' name='admin' value='true'>
            <label for='admin'>Admin</label>
            <input type='radio' id='not_admin' name='admin' value='false'>
            <label for='not_admin'>Basic User</label>            
        </div>
        
        <button type='submit' id='add_user_btn' class='btn btn-success float-end'>Add user</button>
    </form>
    <dialog id='dialog' class='dialog'>
        <p id='dialog__text'>Do you really want to delete
        <span id='dialog__item-to-delete'>X</span>? This action cannot be undone.</p>        
        <form method='dialog'>
            <button id = 'dialog__confirm-link' onclick='ajaxDelete()' class='btn btn-success float-end'>Confirm</button>
            <button onclick='closeDeleteDialog()' class='btn btn-danger' data-bs-dismiss='modal'>Close</button>          
        </form>
    </dialog>
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

    
while ($row = $query_result->fetch_assoc()) {

    $id = $row['id'];
    $name = $row['name'];
    $last = $row['last'];
    $email = $row['email'];
    $phone = $row['phone'];
    $workplace = $row['workplace'];
    $is_admin = $row['admin'];

    echo "<tr id='row_$id'>								
            <td>$name</td>							
            <td>$last</td>	
            <td>$email</td>	
            <td>$phone</td>	
            <td>$workplace</td>	
            <td>$is_admin</td>";    

    if ($_SESSION["admin"] == "true" || $email == $_SESSION["email"]){   
        echo "<td>           
                <form method='POST' action='$domena/users/edit' style='display: inline-block;'>
                    <input type='hidden' name='clicked_user' value='$email'>
                    <button type='submit' class='btn btn-warning'>Edit</button>
                </form>                                  
                    <button class='btn btn-danger button--delete' data-action='users/delete/$id/$email'>Delete</button>                      
        </tr>";
    } else {
        echo "                                          
        </tr>";
    }
        
        
    }	

    echo "</tbody>
        </table>                   
    ";
    ?>