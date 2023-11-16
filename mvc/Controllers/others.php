<?php 

$api_id = $_SESSION['query'] ?? '';

echo "<h1 class='move_me'>Others podstránka</h1>

<p class='move_me half'>Your last query: </p>
<div id='api_get_container' data-action='$api_id'>
<table id='api_data_table'>
    <thead>
      <tr>
        <th>Email</th>
        <th>Last</th>
        <th>Name</th>
        <th>Phone</th>
      </tr>
    </thead>
    <tbody>
      <!-- Table rows will be dynamically added here -->
    </tbody>
  </table>
</div>";


?>