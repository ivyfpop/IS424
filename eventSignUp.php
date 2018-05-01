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
  $eventDetails = mysqli_query($db, "SELECT * FROM Event WHERE eventID = 10");

  if ($eventDetails->num_rows == 1) {
    $row = $eventDetails->fetch_array(MYSQLI_ASSOC);
    echo"<h3>Event ID: $row[eventID]";
    echo"<h3>Event Name: $row[eventName]";
    echo"<h3>Date of Event: $row[eventDate]";
    echo"<h3>Event Location: $row[eventAddress] $row[eventCity] $row[eventState] $row[eventZip]";
    echo"<h3>Description: $row[eventBio]";
  }

  mysqli_free_reult($eventDetails);

  $driverStatus = mysqli_query($db, "SELECT driverAuthorizationDate FROM Member WHERE memberID
        = $_SESSION['memberID']");

  echo"
  <form action='myEvents.php method='post'>";
  if ($driverStatus->num_rows == 1) {
    echo"
    <div class='form-group' name='submitSignUp'>
      <label for='numberOfSeatsAvailable'>Seats available in car</label>
      <select class='from-control' id='numberOfSeatsAvailable'>
        <option selected disabled>Select</option>
        <option>0</option>
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        <option>6</option>
        <option>7</option>
      </select>
    </div>";
  }

  echo"<button type='submit' class='btn btn-danger eventSignUp'>Confirm Sign Up</button>
    </form>";

 ?>
</div>
