<!DOCTYPE html>
<html lang="en">
<?php include 'helper/header.php' ?>
  
  <div class='container bg-faded p-4 my-4'>
    <h1 class='text-center'><strong>My Transactions</strong></h1>";

    <?php 
      include 'helper/connect.php';
      session_start();

      // Verify there are open transactions for this member
      if($openTransactions = $db->query("SELECT * FROM Transaction WHERE transactionPaymentDate IS NULL AND memberID = '$_SESSION[memberID]'")){

        // Open Transactions Header
        echo"<h2 class='text-center'><strong>Open Transactions</strong></h2>";
          
        // Start the accordion
        echo"<div class='accordion' id='accordion'>";

          // Print out each of the transactions
          while ($row = mysqli_fetch_array($openTransactions, MYSQLI_BOTH)){
              
              echo"
                  <div class='card border-warning mb-3'>
                  
                    <div class='card-header' id='headingOne'>
                      <h5 class='mb-0'>
                        <button class='btn btn-link' type='button'>
                          '$row[transactionInitDate]': '$row[transactionQuantity]''
                        </button>
                      </h5>
                    </div>

                    <div id='collapseOne' class='collapse show'>
                      <div class='card-body'>
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                      </div>
                    </div>

                  </div>";
                /* OLD CARD
                <div class='card border-warning mb-3'>
                  <div class='card-header'>Transaction: '$row[transactionID]'</div>
                  <div class='card-body'>
                    <p class='card-text'>Quantity: '$row[transactionQuantity]'</p>
                    <p class='card-text'>EventID: '$row[eventID]'</p>             
                    <p class='card-text'>Category: '$row[transactionCategory]'</p>             
                    <p class='card-text'>Description: '$row[transactionDescription]'</p>             
                  </div>
                </div>";*/
          }

    echo "</div>";
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