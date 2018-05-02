<!DOCTYPE html>
<html lang="en">
    <?php include 'helper/header.php'?>

    <div class='container bg-faded p-4 my-4'>
    <h1 class='text-center'><strong>My Transactions</strong></h1>

        <?php
            include 'helper/connect.php';

            // Verify there are open transactions for this member, ADD ORDER BY requesting date to keep them in order.
            if($openTransactions = $db->query("SELECT * FROM Transaction WHERE memberID = '$_SESSION[memberID]' ORDER BY transactionPaymentDate ASC, transactionApprovalDate ASC")){
                // Loop through all of their transactions
                while ($row = mysqli_fetch_array($openTransactions, MYSQLI_BOTH)){
                    // The transaction has not been paid yet
                    if($row[transactionPaymentDate] == null){
                        echo"
                        <div class='card mb-3 border-danger'>
                            <div class='card-header bg-danger'>
                                    <button class='btn btn-link text-white float-left' type='button' data-toggle='collapse' data-target='#$row[transactionID]'>
                                        <h3>#$row[transactionID] - PAYMENT DUE - $$row[transactionQuantity]</h3>
                                    </button>

                                    <a class='btn btn-success float-right' href='https://venmo.com/' role='button'><h3>Pay Now!</h3></a>
                            </div>
                            
                            <div id='$row[transactionID]' class='collapse'>
                              <div class='card-body border-warning'>
                                <strong>Transaction ID:</strong> $row[transactionID]
                                </br>
                                <strong>Request Date:</strong> $row[transactionInitDate]
                                </br>";

                                // If there is an Event associated with the transaction
                                if ($row[eventID]){
                                    //Determine the name of the event
                                    $eventResult = $db->query("SELECT eventName FROM Event WHERE eventID = $row[eventID]");
                                    $eventRow = mysqli_fetch_array($eventResult, MYSQLI_BOTH);
                                    echo"<strong>Event Name(If any):</strong> $eventRow[eventName]
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
                    // The transaction is pending.
                    else if($row[transactionApprovalDate] == NULL){
                        echo"<div class='card mb-3 border-warning'>
                            <div class='card-header bg-warning'>
                                    <button class='btn btn-link text-white float-left' type='button' data-toggle='collapse' data-target='#$row[transactionID]'>
                                        <h3>#$row[transactionID] - PENDING - $$row[transactionQuantity]</h3>
                                    </button>
                            </div>

                            <div id='$row[transactionID]' class='collapse'>
                              <div class='card-body border-warning'>
                                <strong>Transaction ID:</strong> $row[transactionID]
                                </br>
                                <strong>Request Date:</strong> $row[transactionInitDate]
                                </br>
                                 <strong>Payment Date:</strong> $row[transactionPaymentDate]
                                </br>";

                                // If there is an Event associated with the transaction
                                if ($row[eventID]){
                                    //Determine the name of the event
                                    $eventResult = $db->query("SELECT eventName FROM Event WHERE eventID = $row[eventID]");
                                    $eventRow = mysqli_fetch_array($eventResult, MYSQLI_BOTH);
                                    echo"<strong>Event Name(If any):</strong> $eventRow[eventName]
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
                    // The transaction has been approved.
                    else{
                        // The actual transaction html stuff
                        echo"<div class='card mb-3 border-success'>
                                <div class='card-header bg-success'>
                                        <button class='btn btn-link text-white float-left' type='button' data-toggle='collapse' data-target='#$row[transactionID]'>
                                            <h3>#$row[transactionID] - $row[transactionPaymentDate] - $$row[transactionQuantity]</h3>
                                        </button>
                                </div>

                                <div id='$row[transactionID]' class='collapse'>
                                  <div class='card-body border-success'>
                                    <strong>Transaction ID:</strong> $row[transactionID]
                                    </br>
                                    <strong>Amount:</strong> $$row[transactionQuantity]
                                    </br>
                                    <strong>Request Date:</strong> $row[transactionInitDate]
                                    </br>
                                     <strong>Payment Date:</strong> $row[transactionPaymentDate]
                                    </br>
                                     <strong>Approval Date:</strong> $row[transactionApprovalDate]
                                    </br>";

                                    //Print out the approving officer's name
                                    $approvalMemberResult = $db->query("SELECT firstName, lastName FROM Member WHERE memberID = $row[transactionApprovalMemberID]");
                                    $approvalMemberRow = mysqli_fetch_array($approvalMemberResult, MYSQLI_BOTH);
                                    echo"<strong>Approving Officer:</strong> $approvalMemberRow[firstName] $approvalMemberRow[lastName]
                                         </br>";

                                    // If there is an Event associated with the transaction
                                    if ($row[eventID]){
                                        //Determine the name of the event
                                        $eventResult = $db->query("SELECT eventName FROM Event WHERE eventID = $row[eventID]");
                                        $eventRow = mysqli_fetch_array($eventResult, MYSQLI_BOTH);
                                        echo"<strong>Event Name(If any):</strong> $eventRow[eventName]
                                             </br>";
                                    }
                                    // Otherwise print out the category for the event
                                    else{
                                        echo"<strong>Category:</strong> $row[transactionCategory]
                                             </br>";
                                    }

                                   echo"
                                        <strong>Description:</strong> $row[transactionDescription]
                                    </div>
                                </div>
                            </div>";

                    }
                }
            }
        mysqli_close($db);
        ?>
    </div>
  <?php include 'helper/footer.php' ?>
</html>
