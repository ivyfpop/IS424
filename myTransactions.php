<?php
  include 'helper/header.php';
  include 'helper/connect.php';

  $result = mysqli_query($db,"SELECT transaction_ID,member_ID,transaction_Amount,
    transaction_Description FROM TRANSACTION WHERE transaction_Payment_Date = ''");
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

  while($row = mysqli_fetch_array($facultyQueryResult, MYSQLI_BOTH))
    echo"display row";

  // if ($due_result != NULL)
  // Due transactions
  echo"
  <!-- Start Container -->
  <div class='container bg-faded p-4 my-4'>

  <!-- Create the transactions header -->
  <hr>
  <h2 class='text-center'><strong>Due Transactions</strong></h2>
  <hr>
  </div>";
  //}

  // Past transactions
  echo"
  <!-- Start Container -->
  <div class='container bg-faded p-4 my-4'>

  <!-- Create the transactions header -->
  <hr>
  <h3 class='text-center'><strong>Past Transactions</strong></h3>
  <hr>
  </div>";

  include 'helper/footer.php';
?>
