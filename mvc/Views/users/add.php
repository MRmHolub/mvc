<?php
if ($added){
  echo "    
    <div class='move_me alert alert-success notification' role='alert'>
      The user:  $email was successfully added!
    </div>";
} else {
  echo "    
  <div class='move_me alert alert-danger notification' role='alert'>
    The user:  $email was not added, this email is already registered!
  </div>";
}

echo "
    <script>
    
    const notifications = document.querySelectorAll('.notification');
    var opacity = 1;
    var fadeOutInterval = setInterval(() => {
    opacity = opacity - 0.01;
    notifications.forEach(n => {
        n.style.opacity = opacity;
        if (opacity <= 0) {
        n.style.display = 'none';
        clearInterval(fadeOutInterval);	
        }
    })}, 30);
    
    </script>
    ";


    include "Views/users/users.php";


?>
