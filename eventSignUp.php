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
include 'helper/connect.php';
?>

<div class="container bg-faded p-4 my-4">
  <h1 class="text-center">Event Details</h1>
<?php
  //Querying all details of event with the passed in eventID.
  $eventDetails = mysqli_query($db, "SELECT * FROM Event WHERE eventID = $_POST[eventID]");
  //Displaying event details.
  if ($eventDetails->num_rows == 1) {
    $row = $eventDetails->fetch_array(MYSQLI_ASSOC);
    echo"<h3><strong>Event ID:</strong> $row[eventID]";
    echo"<h3><strong>Event Name:</strong> $row[eventName]";
    echo"<h3><strong>Date of Event:</strong> $row[eventDate]";
    echo"<h3><strong>Event Location:</strong> $row[eventAddress] $row[eventCity], $row[eventState] $row[eventZip]";
    echo"<h3><strong>Description:</strong> $row[eventBio]";
  }

  mysqli_free_result($eventDetails);
  //Querying for driverAuthorizationDate from Member table
  $driverStatus = mysqli_query($db, "SELECT driverAuthorizationDate FROM Member WHERE memberID = $_SESSION[memberID]");
  $driverStatusRow = $driverStatus->fetch_array(MYSQLI_ASSOC);
  //Asking user for leaveBy time - see top for description.
  echo"
  <form action='myEvents.php' method='post'>
  <div class='form-group'>
    <label for='leaveBy'><strong>Leave By: </strong></label>
    <input type='time' name='leaveBy' id='leaveBy' required autofocus>
  </div>";
  //Asking user for numberOfSeatsAvailable - see top for description.
  if ($driverStatusRow[driverAuthorizationDate] != NULL) {
    echo"
    <div class='form-group'>
      <label for='numberOfSeatsAvailable'>Seats available in car</label>
      <select class='from-control' name='numberOfSeatsAvailable' id='numberOfSeatsAvailable'>
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

  mysqli_free_result($driverStatus);
  mysqli_close($db);
  //Including eventID and registeredID allows for easier database updating
  echo"
    <input type='hidden' name='eventID' value=$_POST[eventID]>
    <input type='hidden' name='registeredID' value=$_POST[registeredID]>
    <input type='submit' class='btn btn-danger' name='submitSignUp' value='Confirm Sign Up'>
  </form>";
 ?>
</div>
