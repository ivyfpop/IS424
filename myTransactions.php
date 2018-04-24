<!DOCTYPE html>
<html lang="en">
<?php include 'helper/header.php'?>
  
    <div class='container bg-faded p-4 my-4'>
    <h1 class='text-center'><strong>My Transactions</strong></h1>

<?php 
        include 'helper/connect.php';
        session_start();

        // Verify there are open transactions for this member, ADD ORDER BY requesting date to keep them in order.
        if($openTransactions = $db->query("SELECT * FROM Transaction WHERE transactionPaymentDate IS NULL AND memberID = '$_SESSION[memberID]'")){

            // Open Transactions Header
            echo"<h2 class='text-center'><strong>Open Transactions</strong></h2>";

            // Print out each of the Open transactions
            while ($row = mysqli_fetch_array($openTransactions, MYSQLI_BOTH)){

                $transactionInitDate = date("m/d/y g:i A", strtotime($row[transactionInitDate]));
                
                echo"
                <div class='card text-white bg-warning mb-3'>
                    <div class='card-header'>
                            <button class='btn btn-link float-left' type='button' data-toggle='collapse' data-target='#$row[transactionID]'>
                                <h3>PAYMENT DUE - $$row[transactionQuantity]</h3>
                            </button>
                            <form action='venmo.php' name='transaction' method='post'>
                                <button class='btn btn-success float-right' type='submit' name='transaction' value='$row[transactionID]'>
                                    <h3>Pay Now!</h3>
                                </button>
                            </form>
                    </div>
                    
                    <div id='$row[transactionID]' class='collapse'>
                      <div class='card-body'>
                        <strong>Transaction ID:</strong> $row[transactionID]
                        </br>
                        <strong>Request Date:</strong> $transactionInitDate
                        </br>";
                        
                        // If there is an Event associated with the transaction
                        if ($row[eventID]){
                            //Determine the name of the event
                            $eventResult = $db->query("SELECT eventName FROM Event WHERE eventID = $row[eventID]");
                            $eventRow = mysqli_fetch_array($eventResult, MYSQLI_BOTH);
                            echo"<strong>Event Name:</strong> $eventRow[eventName]
                                 </br>";
                        }
                        // Otherwise print out the category for the event
                        else{
                            echo"<strong>Category:</strong> $row[transactionCategory]
                                 </br>";
                        }
                        
                       echo"<strong>Amount:</strong> $$row[transactionQuantity]
                            </br>                                            
                            <strong>Description:</strong> $row[transactionDescription]
                        </div>
                    </div>
                </div>";             
          }
      }

        // Verify there are Past transactions for this member ADD ORDER BY payment date to keep them in order.
        if($pastTransactions = $db->query("SELECT * FROM Transaction WHERE transactionPaymentDate IS NOT NULL AND memberID = '$_SESSION[memberID]'")){

            // Open Transactions Header
            echo"<h2 class='text-center'><strong>Past Transactions</strong></h2>";

            // Print out each of the past transactions
            while ($row = mysqli_fetch_array($pastTransactions, MYSQLI_BOTH)){

                $transactionInitDate = date("m/d/y g:i A", strtotime($row[transactionInitDate]));
                $transactionPaymentDate = date("m/d/y g:i A", strtotime($row[transactionPaymentDate]));
                
                echo"
                <div class='card text-white bg-success mb-3'>
                    <div class='card-header'>
                            <button class='btn btn-link float-left' type='button' data-toggle='collapse' data-target='#$row[transactionID]'>
                                <h3>$transactionPaymentDate - $$row[transactionQuantity]</h3>
                            </button>
                    </div>
                    
                    <div id='$row[transactionID]' class='collapse'>
                      <div class='card-body'>
                        <strong>Transaction ID:</strong> $row[transactionID]
                        </br>
                        <strong>Request Date:</strong> $transactionInitDate
                        </br>
                         <strong>Payment Date:</strong> $transactionPaymentDate
                        </br>";
                        // If there is an Event associated with the transaction
                        if ($row[eventID]){
                            //Determine the name of the event
                            $eventResult = $db->query("SELECT eventName FROM Event WHERE eventID = $row[eventID]");
                            $eventRow = mysqli_fetch_array($eventResult, MYSQLI_BOTH);
                            echo"<strong>Event Name:</strong> $eventRow[eventName]
                                 </br>";
                        }
                        // Otherwise print out the category for the event
                        else{
                            echo"<strong>Category:</strong> $row[transactionCategory]
                                 </br>";
                        }
                        
                       echo"<strong>Amount:</strong> $$row[transactionQuantity]
                            </br>                                            
                            <strong>Description:</strong> $row[transactionDescription]
                        </div>
                    </div>
                </div>";             
          }
      }

      
?>
    </div>

    <!-- JS Used -->
    <script src="helper/vendor/jquery/jquery.min.js"></script>
    <script src="helper/vendor/bootstrap/js/bootstrap.min.js"></script>
</html>