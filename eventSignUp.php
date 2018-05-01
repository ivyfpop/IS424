<?php
include 'helper/header.php';
session_start();
include 'helper/connect.php';

/*
  registeredID and eventID in $_POST.

  TODO: If member has a date in driverAuthorizationDate, ask for timeToLeaveBy
          -What to do for user that is not an eligible driver?
  TODO: comment throughout
*/
?>
<div class="container bg-faded p-4 my-4">
  <h1 class="text-center">Event Details</h1>
<?php
  $eventDetails = mysqli_query($db, "SELECT * FROM Event WHERE eventID = $_POST[eventID]");

  if ($eventDetails->num_rows == 1) {
    $row = $eventDetails->fetch_array(MYSQLI_ASSOC);
    echo"<h3><strong>Event ID:</strong> $row[eventID]";
    echo"<h3><strong>Event Name:</strong> $row[eventName]";
    echo"<h3><strong>Date of Event:</strong> $row[eventDate]";
    echo"<h3><strong>Event Location:</strong> $row[eventAddress] $row[eventCity], $row[eventState] $row[eventZip]";
    echo"<h3><strong>Description:</strong> $row[eventBio]";
  }

  mysqli_free_result($eventDetails);

  $driverStatus = mysqli_query($db, "SELECT driverAuthorizationDate FROM Member WHERE memberID = $_SESSION[memberID]");
  $driverStatusRow = $driverStatus->fetch_array(MYSQLI_ASSOC);
  echo"
  <form action='myEvents.php' method='post'>
  <div class='form-group'>
    <label for='leaveBy'><strong>Time you are able to leave by.</strong></label>
    <input type='text' name='leaveBy' id='leaveBy'>
    <small id='leaveByHelp' class='form-text text-muted'>Please enter times in CST in 24-Hour format and include seconds. Example: 2:00 PM would be entered as 14:00:00</small>
  </div>";
  if ($driverStatusRow[driverAuthorizationDate] != NULL) {
    echo"
    <div class='form-group'>
      <label for='numberOfSeatsAvailable'>Seats available in car</label>
      <select class='from-control' name='numberOfSeatsAvailable' id='numberOfSeatsAvailable'>
        <option selected disabled>Select</option>
        <option value='0'>0</option>
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

  echo"
    <input type='hidden' name='eventID' value=$_POST[eventID]>
    <input type='hidden' name='registeredID' value=$_POST[registeredID]>
    <input type='submit' class='btn btn-danger' name='submitSignUp' value='Confirm Sign Up'>
  </form>";
 ?>
</div>
