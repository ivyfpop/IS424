<!DOCTYPE html>
<html lang="en">
<?php

  include 'helper/header.php';
  
  // Start the session
  session_start();

  //  Run the queries to gather the open and complete transactions.
  include 'helper/connect.php';
  //$openTransactions = mysqli_query($db,"SELECT * FROM Transaction WHERE transactionPaymentDate IS NULL AND memberID = '$_SESSION[memberID]'");
  //$pastTransactions = mysqli_query($db,"SELECT * FROM Transaction WHERE transactionPaymentDate IS NOT NULL AND '$_SESSION[memberID]' = memberID");
  
  // Page Header
  echo"
  <div class='container bg-faded p-4 my-4'>
      <hr>
      <h1 class='text-center'><strong>My Transactions</strong></h1>
      <hr>";

  // Verify there are open transactions for this member
  if($openTransactions = $db->query("SELECT * FROM Transaction WHERE transactionPaymentDate IS NULL AND memberID = '$_SESSION[memberID]'")){

    // Open Transactions Header
    echo"
    <hr>
    <h2 class='text-center'><strong>Open Transactions</strong></h2>
    <hr>";

    // Print out each of the transactions
    while ($row = mysqli_fetch_array($openTransactions, MYSQLI_BOTH)){
        echo"
          <div class='card border-warning mb-3'>
            <div class='card-header'>Transaction: '$row[transactionID]'</div>
            <div class='card-body'>
              <p class='card-text'>Quantity: '$row[transactionQuantity]'</p>
              <p class='card-text'>EventID: '$row[eventID]'</p>             
              <p class='card-text'>Category: '$row[transactionCategory]'</p>             
              <p class='card-text'>Description: '$row[transactionDescription]'</p>             
            </div>
          </div>";
    }
  }

  echo"</div>";
  
  /*

  // Print all of the pending transactions
  while ($row = $result->fetch_row()) {

    if ($row['status'] == "pending") {
      // pending transactions
      echo"
      <!-- Start Container -->

      <!-- Create the transactions header -->
      <hr>
      <h2 class='text-center'><strong>Pending Transactions</strong></h2>
      <hr>
      </div>";

      echo "<div class='card'><div class='card-body'>";
      //echo result data we want displayed
      echo "</div></div>";
    } else if ($row['status'] == "approved") {
      // approved transactions
      echo"
      <!-- Start Container -->
      <div class='container bg-faded p-4 my-4'>

      <!-- Create the transactions header -->
      <hr>
      <h2 class='text-center'><strong>Pending Transactions</strong></h2>
      <hr>
      </div>";

      echo "<div class='card'><div class='card-body'>";
      //echo result data we want displayed
      echo "</div></div>";
    } else {
      // due transactions
      echo"
      <!-- Start Container -->
      <div class='container bg-faded p-4 my-4'>

      <!-- Create the transactions header -->
      <hr>
      <h2 class='text-center'><strong>Pending Transactions</strong></h2>
      <hr>
      </div>";

      echo "<div class='card'><div class='card-body'>";
      //echo result data we want displayed
      echo "</div></div>";
    }
  }
  */
?>
</html>