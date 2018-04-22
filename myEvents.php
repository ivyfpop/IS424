<?php
  include 'helper/header.php';
  include 'helper/connect.php';


  //Query for all events member has not signed up for
  //assuming query result var is notSignedUp

  while ($row =  $notSignedUp->fetch_row()) {
    echo "<div class='card'><div class='card-body'>";
    echo $row['function_Description']. " " . $row['function_Location'] . " " . $row['function_Date'];
    echo "</div></div>";
  }

  //Query for all past events

  while ($row = $pastEvents->fetch_row()) {
    echo "<div class='card'><div class='card-body'>";
    echo $row['function_Description']. " " . $row['function_Location'] . " " . $row['function_Date'];
    echo "</div></div>";
  }






?>
