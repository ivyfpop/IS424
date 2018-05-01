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
  <form action='myEvents.php' name='submitSignUp' method='post'>";
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

  echo"
    <input type='hidden' name='eventID' value=$_POST[eventID]>
    <input type='hidden' name='registeredID' value=$_POST[registeredID]>
    <button type='submit' name='submitSignUp' class='btn btn-danger'>Confirm Sign Up</button>
  </form>";
  mysqli_close($db);
 ?>
</div>
