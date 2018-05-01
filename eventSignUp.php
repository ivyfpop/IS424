<!DOCTYPE html>
<html lang="en">
    <?php include 'helper/header.php';
    /*
      This page handles gathering neccessary data from user that pertains to the event the
      user selects to sign up for. The database is updated in myEvents.php, this page
      sends a post to that page with all of the relevant information needed.
      LeaveBy: the time the user can leave by for the events. String in 24-hour format
      numberOfSeatsAvailable: only asked of the user when thier associated member has a value
                              in the driverAuthorizationDate attribute of the Member table.
                              The number of spots they have in their car
    */
    ?>

    <div class="container bg-faded p-4 my-4 h3">
        <h1 class="text-center">Event Registration:</h1>
            <?php
                session_start();
                //Querying all details of event with the passed in eventID.
                include 'helper/connect.php';
                $eventDetails = $db->query("SELECT * FROM Event WHERE eventID = $_POST[eventID]");
                mysqli_close($db);
                
                // Display the event, if there is an event
                if ($eventRow = mysqli_fetch_array($eventDetails, MYSQLI_BOTH)) {
                    // Display the details of the event they can register for:
                    echo"   <strong>Event ID:</strong> $eventRow[eventID]
                            </br>
                            <strong>Event Name:</strong> $eventRow[eventName]
                            </br>
                            <strong>Event Date:</strong> $eventRow[eventDate]
                            </br>
                            <strong>Event Location:</strong> $eventRow[eventAddress] $eventRow[eventCity], $eventRow[eventState] $eventRow[eventZip]
                            </br>
                            <strong>Event Description:</strong> $eventRow[eventBio]
                            </br>
                            <form action='myEvents.php' method='post'>
                                <div class='form-group'>
                                    <label for='leaveBy'><strong>Leave By: </strong></label>
                                    <input type='time' name='leaveBy' id='leaveBy' required autofocus>
                                </div>
                                </br>";
                            
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
                            </div>
                            </br>";
                    }

                  //Including eventID and registeredID allows for easier database updating
                  echo"
                    <input type='hidden' name='eventID' value=$_POST[eventID]>
                    <input type='hidden' name='registeredID' value=$_POST[registeredID]>
                    <button class='form-control btn btn-danger' type='submit' name='submitSignUp'>Confirm Sign Up</button>
                  </form>";
                }
                // Not sure how they got to this page, redirect them back.
                else{
                    header("Location: http://track.finkmp.com/myEvents.php");
                }
             ?>
    </div>
</html>
