<!DOCTYPE html>
<html lang="en">
<?php
  include 'helper/header.php';
  
  //  Run the queries to gather the pending and complete transactions.
  include 'helper/connect.php';
  $pendingTransactions = mysqli_query($db,"SELECT * FROM Transaction WHERE transaction_Payment_Date = ''");
  $completeTransactions = mysqli_query($db,"SELECT * FROM Transaction WHERE transaction_Payment_Date = ''");
  mysqli_close($db);

  // Page Header
  <center> <h1> My Transactions </h1> </center>
  </br>
  </br>
  
  // If there are pending transactions, print the header and print them out.
  if($row = $pendingTransactions->fetch_row()){

    // Pending Transactions Header
    
  
    while ($row = $pendingTransactions->fetch_row()){
        
    }
  }  
  
  // Print all of the pending transactions
  while ($row = $result->fetch_row()) {

    if ($row['status'] == "pending") {
      // pending transactions
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

?>
</html>