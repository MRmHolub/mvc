<?php 
echo "
<h2 class='move_me'>Change user information</h2>
<form name='new_user' class='move_me' method='POST' action='$domena/users/update'>						
<label for='name'>name:</label>
<input type='text' id='name' name='name' placeholder='Enter your name' value='$name' required>
<br>
<label for='last'>last:</label>
<input type='text' id='last' name='last' placeholder='Enter your last name' value='$last' required>
<br>
<label for='email'>email:</label>
<input type='text' id='email' name='email' placeholder='Enter your email' value='$email'required>
<br>
<label for='phone'>phone:</label>
<input type='text' id='phone' name='phone' placeholder='Enter your phone' value='$phone' required>
<br>
<label for='password'>Password:</label>
<input type='password' id='password' name='password' placeholder='Enter your password' value='$password'required>
<br>
<label for='workplace'>workplace:</label>
<input type='text' id='workplace' name='workplace' placeholder='Enter your workplace' value='$workplace'required>
<br>
<span>Is admin:</span>
";
if ($is_admin == "true"){	
    echo 
    "<input type='radio' id='admin' name='admin' value='true'>
    <label for='admin'>No</label>
    <input type='radio' id='not_admin' name='admin' value='false' checked>
    <label for='not_admin'>Yes</label>
    <br>
    <button type='submit' class='btn btn-warning'>Save</button>			
    </form>";		
} else {
    echo 
    "<input type='radio' id='admin' name='admin' value='true' checked>
    <label for='admin'>No</label>
    <input type='radio' id='not_admin' name='admin' value='false'>
    <label for='not_admin'>Yes</label>
    <br>
    <button type='submit' class='btn btn-warning'>Save</button>			
    </form>";		
}


?>