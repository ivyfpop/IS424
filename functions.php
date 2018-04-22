<?php
  include 'helper/header.php';
  include 'helper/connect.php';


  //Query for all functions

  while ($row = $result->fetch_row()) {

    if ($row['status'] == "pending") {
      // pending events
      echo"
      <!-- Start Container -->
      <div class='container bg-faded p-4 my-4'>

      <!-- Create the transactions header -->
      <hr>
      <h2 class='text-center'><strong>Pending Transactions</strong></h2>
      <hr>
      </div>";

      echo "<div class='card'><div class='card-body'>";
      //echo result data we want dispalyed
      echo "</div></div>";
    } else if ($row['status'] == "approved") {
      // past event
    } else {
      // those they can sign up for
    }
  }









?>
