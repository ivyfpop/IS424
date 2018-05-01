<?php
include 'helper/header.php';
session_start();
include 'helper/connect.php';
/*
  registeredID and eventID in $_POST.

  TODO: Display all information about the event the user is signing up for
  TODO: If member has a date in driverAuthorizationDate, ask for seats left in car
  TODO: Create instance in Registered_Member_Event with proper registeredID, eventID
          -Figure out how transactionID will be populated - some events don't have
           transactions
          -Should prices be set in Event table so we can tell the user how expensive
           the event is?
  TODO: Redirect to myEvents page when submitted (catch $_POST on myEvents.php page -
        this is where the update will actually happen)

*/

  echo"<h2 class='text-center'>Event Details</h2>";

  $eventDetails = mysqli_query($db, "SELECT * FROM Event WHERE eventID = 10");

  if ($eventDetails->num_rows == 1) {
    echo"worked";
  }



 ?>
