<?php
  include 'helper/header.php';
  include 'helper/connect.php';


  //Query for all functions

  while ($row = $result->fetch_row()) {

    if ($row['status'] == "pending") {
      echo "<div class='card'><div class='card-body'>";
      //echo result data we want dispalyed
      echo "</div></div>";
    } else if ($row['status'] == "approved") {

    } // else if past event
  }









?>
