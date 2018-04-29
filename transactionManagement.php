<!DOCTYPE html>
<html lang="en">
<?php include 'helper/header.php'?>
    
    <div class='navbar navbar-dark bg-primary d-flex justify-content-center'>
        <form class='form-inline' action='transactionManagement.php' name='transactionSearch' method='post'>
        
            <input class='form-control mr-3' type='text' placeholder='Search Value' name='transactionSearchValue'>
            
            <select type="text" class="form-control mr-3" name='transactionSearchType' id='transactionSearchType'>
                <option selected value="1">Last Name</option>            
                <option value="2">Transaction ID</option>
                <option value="3">Event ID</option>
                <option value="4">Member ID</option>
            </select>
            
            <button class='form-control btn btn-success' type='submit' name='transactionSearch'>Search Transactions!</button>
        </form>
    </div>

        <?php
            // Start the session.
            session_start();
            
            // Default Query if a post was not entered.
            $transactionQuery = "SELECT * FROM Transaction JOIN Member ON Transaction.memberID = Member.memberID ORDER BY transactionPaymentDate ASC, transactionApprovalDate ASC LIMIT 25";

            // If a search was submitted, determine the correct query
            if(isset($_POST['transactionSearch'])){
                
                // Search field was empty
                if(!$_POST['transactionSearchValue']){
                    echo"<div class='alert alert-danger text-center' role='alert'><strong>Please enter a value into the search field!</strong></div>";
                    $transactionQuery = "";  
                }
                // Member Last Name Query
                else if($_POST['transactionSearchType'] == 1){
                    $transactionQuery = "SELECT * FROM Transaction JOIN Member on Transaction.memberID = Member.memberID WHERE lastName = '$_POST[transactionSearchValue]' ORDER BY transactionPaymentDate ASC, transactionApprovalDate ASC";                                        
                }
                // Transaction ID Query
                else if($_POST['transactionSearchType'] == 2){
                    $transactionQuery = "SELECT * FROM Transaction WHERE transactionID = '$_POST[transactionSearchValue]' ORDER BY transactionPaymentDate ASC, transactionApprovalDate ASC";
                }
                // EventID Query
                else if($_POST['transactionSearchType'] == 3){
                    $transactionQuery = "SELECT * FROM Transaction WHERE eventID = '$_POST[transactionSearchValue]' ORDER BY transactionPaymentDate ASC, transactionApprovalDate ASC";                    
                }
                // Member ID Query
                else if($_POST['transactionSearchType'] == 4){
                    $transactionQuery = "SELECT * FROM Transaction WHERE memberID = '$_POST[transactionSearchValue]' ORDER BY transactionPaymentDate ASC, transactionApprovalDate ASC";                    
                }
            }
                
                
                
            // Connect to the database, run query, and close connection.
            include 'helper/connect.php';
            $transactions = $db->query($transactionQuery);
            mysqli_close($db);
                            
            // Verify there are transactions
            if($transactions && $transactions->num_rows){
                    // Open the containte
                    echo"<div class='container bg-faded p-4 my-4'>";
                // Loop through all of their transactions
                while ($row = mysqli_fetch_array($transactions, MYSQLI_BOTH)){
                    // Date that the transaction was created.
                    $transactionInitDate = date("m/d/y g:i A", strtotime($row[transactionInitDate]));
                    
                    // The transaction has not been paid yet
                    if($row[transactionPaymentDate] == null){
                        echo"
                        <div class='card mb-3 border-danger'>
                            <div class='card-header bg-danger'>
                                    <button class='btn btn-link text-white float-left' type='button' data-toggle='collapse' data-target='#$row[transactionID]'>
                                        <h3>$row[transactionID] - PAYMENT DUE - $$row[transactionQuantity]</h3>
                                    </button>
                                    <form action='https://venmo.com/WiscoTC' name='transaction' method='post'>
                                        <button class='btn btn-success float-right' type='submit' name='transaction' value='$row[transactionID]'>
                                            <h3>Pay Now!</h3>
                                        </button>
                                    </form>
                            </div>
                            
                            <div id='$row[transactionID]' class='collapse'>
                              <div class='card-body border-warning'>
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
                    // The transaction is pending.
                    else if($row[transactionApprovalDate] == NULL){
                        
                        $transactionPaymentDate = date("m/d/y g:i A", strtotime($row[transactionPaymentDate]));
                        echo"<div class='card mb-3 border-warning'>
                            <div class='card-header bg-warning'>
                                    <button class='btn btn-link text-white float-left' type='button' data-toggle='collapse' data-target='#$row[transactionID]'>
                                        <h3>$row[transactionID] - PENDING - $$row[transactionQuantity]</h3>
                                    </button>
                            </div>
                            
                            <div id='$row[transactionID]' class='collapse'>
                              <div class='card-body border-warning'>
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
                    // The transaction has been approved.
                    else{
                        // Dates assocaited with a approved transaction
                        $transactionPaymentDate = date("m/d/y g:i A", strtotime($row[transactionPaymentDate]));
                        $transactionApprovalDate = date("m/d/y g:i A", strtotime($row[transactionApprovalDate]));
                        
                        // The actual transaction html stuff
                        echo"<div class='card mb-3 border-success'>
                                <div class='card-header bg-success'>
                                        <button class='btn btn-link text-white float-left' type='button' data-toggle='collapse' data-target='#$row[transactionID]'>
                                            <h3>$row[transactionID] - $transactionPaymentDate - $$row[transactionQuantity]</h3>
                                        </button>
                                </div>
                                
                                <div id='$row[transactionID]' class='collapse'>
                                  <div class='card-body border-success'>
                                    <strong>Transaction ID:</strong> $row[transactionID]
                                    </br>
                                    <strong>Request Date:</strong> $transactionInitDate
                                    </br>
                                     <strong>Payment Date:</strong> $transactionPaymentDate
                                    </br>
                                     <strong>Approval Date:</strong> $transactionApprovalDate
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
                // Close the container.
                echo"</div>";
            }
            // Let the user know that their query returned no results.
            else if($transactionQuery){
                echo"<div class='alert alert-warning text-center' role='alert'><strong>Your search returned no results, please try again!</strong></div>";                    
            }
        ?>
    
  <?php include 'helper/footer.php' ?>
</html>
