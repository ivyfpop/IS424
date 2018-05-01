<!DOCTYPE html>
<html lang="en">
<?php include 'helper/header.php'?>

    <div class='container bg-faded p-4 my-4'>
    <h1 class='text-center'><strong>My Results</strong></h1>

        <?php
            include 'helper/connect.php';
            session_start();

            // Verify there are open transactions for this member, ADD ORDER BY requesting date to keep them in order.
            if($eventResults = $db->query("SELECT * FROM Individual_Result WHERE memberID = '$_SESSION[memberID]' ORDER BY individualResultID DESC")){
                // Loop through all of their transactions
                while ($row = mysqli_fetch_array($eventResults, MYSQLI_BOTH)){

                    // The actual transaction html stuff
                    echo"<div class='card mb-3 border-success'>
                            <div class='card-header bg-success'>
                                    <button class='btn btn-link text-white float-left' type='button' data-toggle='collapse' data-target='#$row[individualResultID]'>
                                        <h3>#$row[individualResultID] - $individualEventName - $row[individualEventPlace] Place</h3>
                                    </button>
                            </div>

                            <div id='$row[individualResultID]' class='collapse'>
                              <div class='card-body border-success'>
                                <strong>Result ID:</strong> $row[individualResultID]
                                </br>
                                <strong>Event:</strong> $row[$individualEventName]
                                </br>
                                <strong>Place Taken:</strong> $individualEventPlace
                                </br>
                                 <strong>Result:</strong> $individualResult
                                </br>
                                 <strong>Comments:</strong> $individualEventComments
                                </br>";

                                // If there is an Event associated with the transaction
                                if ($row[eventID]){
                                    //Determine the name of the event
                                    $eventResult = $db->query("SELECT eventName FROM Event WHERE eventID = $row[eventID]");
                                    $eventRow = mysqli_fetch_array($eventResult, MYSQLI_BOTH);
                                    echo"<strong>Event Name(If any):</strong> $eventRow[eventName]
                                         </br>";
                                }

                               echo"
                                    <strong>Description:</strong> $row[transactionDescription]
                                </div>
                            </div>
                        </div>";
                }
            }
        ?>
    </div>
  <?php include 'helper/footer.php' ?>
</html>
