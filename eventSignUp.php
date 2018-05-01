<?php
/*
  This page handles gathering neccessary data from user that pertains to the event the
  user selects to sign up for. The database is updated in myEvents.php, this page
  sends a post to that page with all of the relevant information needed.
  LeaveBy: the time the user can leave by for the events. String in 24-hour format
  numberOfSeatsAvailable: only asked of the user when thier associated member has a value
                          in the driverAuthorizationDate attribute of the Member table.
                          The number of spots they have in their car
*/
include 'helper/header.php';
session_start();
?>

<div class="container bg-faded p-4 my-4">
    <h1 class="text-center">Event Registration:</h1>
        <?php
            //Querying all details of event with the passed in eventID.
            include 'helper/connect.php';
            $eventDetails = $db->query("SELECT * FROM Event WHERE eventID = $_POST[eventID]");
            mysqli_close($db);
            
            // Display the event, if there is an event
            if ($eventRow = $eventDetails->fetch_array(MYSQLI_ASSOC)) {
                // Display the details of the event they can register for:
                echo"<h3>
                        <strong>Event ID:</strong> $eventRow[eventID]
                        <strong>Event Name:</strong> $eventRow[eventName]
                        <strong>Event Date:</strong> $eventRow[eventDate]
                        <strong>Event Location:</strong> $eventRow[eventAddress] $eventRow[eventCity], $eventRow[eventState] $eventRow[eventZip]
                        <strong>Event Description:</strong> $eventRow[eventBio]
                        <form action='myEvents.php' method='post'>
                            <div class='form-group'>
                                <label for='leaveBy'><strong>Leave By: </strong></label>
                                <input type='time' name='leaveBy' id='leaveBy' required autofocus>
                            </div>";
                        
                // Only authorized drivers can be asked how many seats they have
                if ($_SESSION[driverAuthorizationDate] != NULL) {
                    echo"<div class='form-group'>
                            <label for='numberOfSeatsAvailable'>(If Driving)Extra Seats:</label>
                            <select class='form-control' name='numberOfSeatsAvailable' id='numberOfSeatsAvailable'>
                                <option value='0' selected>0</option>
                                <option value='1'>1</option>
                                <option value='2'>2</option>
                                <option value='3'>3</option>
                                <option value='4'>4</option>
                                <option value='5'>5</option>
                                <option value='6'>6</option>
                                <option value='7'>7</option>
                            </select>
                        </div>";
                }
                else{
                    echo"<strong> Become an authorized driver!</strong>";
                }

              //Including eventID and registeredID allows for easier database updating
              echo"
                <input type='hidden' name='eventID' value=$_POST[eventID]>
                <input type='hidden' name='registeredID' value=$_POST[registeredID]>
                <input type='submit' class='btn btn-danger' name='submitSignUp' value='Confirm Sign Up'>
                <button class='form-control btn btn-success' type='submit' name='transactionSearch'>Search Transactions!</button>
              </form>";
         ?>
</div>
