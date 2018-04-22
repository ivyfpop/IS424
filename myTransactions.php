<?php
  include 'helper/header.php';
  include 'helper/connect.php';

  // $pending_result
  // $due_result
  // $past_result

  //if ($pending_result != NULL){
  // Pending transactions
  echo"
  <!-- Start Container -->
  <div class='container bg-faded p-4 my-4'>

  <!-- Create the transactions header -->
  <hr>
  <h1 class='text-center'><strong>Pending Transactions</strong></h1>
  <hr>
  </div>";
  //}

  // if ($due_result != NULL)
  // Due transactions
  echo"
  <!-- Start Container -->
  <div class='container bg-faded p-4 my-4'>

  <!-- Create the transactions header -->
  <hr>
  <h2 class='text-center'><strong> Transactions</strong></h2>
  <hr>
  </div>";
  //}

  // Past transactions
  echo"
  <!-- Start Container -->
  <div class='container bg-faded p-4 my-4'>

  <!-- Create the transactions header -->
  <hr>
  <h3 class='text-center'><strong>Pending Transactions</strong></h3>
  <hr>
  </div>";

  include 'helper/footer.php';
?>
