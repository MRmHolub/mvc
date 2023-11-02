<?php
if ($added){
  echo "    
    <div class='move_me alert alert-success notification' role='alert'>
      The user:  $email was successfully added!
    </div>";
} else {
  echo "    
  <div class='move_me alert alert-danger notification' role='alert'>
    The user:  $email was not added, this email already registerd!
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
    
    
    var elements = document.querySelectorAll('.form-control');

    elements.forEach(elem => elem.addEventListener('input', e => {
      if (elem.validity.typeMismatch) { //the type of the value is correct
        elem.setCustomValidity('This is invalid input!');
        elem.reportValidity();          
    });


    const form = document.getElementsByName('new_user')[0].value
    
    form.addEventListener('submit', e => {      
      const email = document.getElementbyId('email');
      const name = document.getElementById('name');
      const last = document.getElementById('last');
      if (!email.value || !name.value || !last.value) {
        showError(email);
        event.preventDefault(); // zabránění odeslání formuláře
      }
    });
    </script>
    ";


    include "Views/users/users.php";


?>