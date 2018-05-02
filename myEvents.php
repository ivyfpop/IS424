<!DOCTYPE html>
<html lang="en">
  <?php
  /*
    This file is responsible for displaying events to the user. There are three views for
    registered members:
      1) Sign Up for Events
        -Events that don't appear in the Registered_Member_Event with the members associated
         registeredID. These are events the user can sign up for.
      2) Events Signed Up For
        -Events the user has signed up for but have not taken place yet (isComplete = 0)
      3) Past Events
        -Events the user has signed up for that have taken place (isComplete = 1)
    If a member is not registered they see all events they could sign up for but do not have
    the option to sign up for them.
    This file also updates the database with the information gained from eventSignUp.php, which
    which gives us our signing up ability.

    //TODO: show events with no sign up button
    //TODO: fix all elses -> e.g. when a user hasn't signed up for an event need to display
            "You have not signed up for any events"

  */
  include 'helper/header.php';
  session_start();
  include 'helper/connect.php';
  //Updating the database with info attained from eventSignUp.php
  if(isset($_POST['submitSignUp'])) {
    //numberOfSeatsAvailable will only be set if the user is an eligible driver
    if (isset($_POST['numberOfSeatsAvailable'])) {
      $eventSignUpQuery = "INSERT INTO Registered_Member_Event (registeredID, eventID, transactionID, isComplete, carCapacity, leaveBy) VALUES ($_POST[registeredID], $_POST[eventID], NULL, 0, $_POST[numberOfSeatsAvailable], '$_POST[leaveBy]')";
    } else {
      $eventSignUpQuery = "INSERT INTO Registered_Member_Event (registeredID, eventID, transactionID, isComplete, carCapacity, leaveBy) VALUES ($_POST[registeredID], $_POST[eventID], NULL, 0, 0, '$_POST[leaveBy]')";
    }
    mysqli_query($db, $eventSignUpQuery);
  }
  ?>

  <div class='container bg-faded p-4 my-4'>
    <h1 class='text-center'><strong>My Events</strong></h1>

<?php

  //Querying for registeredID with memberID
  $regMemQuery = "SELECT registeredID FROM Registered_Member WHERE memberID = '$_SESSION[memberID]' ORDER BY registeredSeason DESC";
  $registeredIDResult = mysqli_query($db, $regMemQuery);
  $registeredID = null;
  if ($registeredIDResult->num_rows != 0) {
    $registeredIDRow = mysqli_fetch_array($registeredIDResult);
    $registeredID = $registeredIDRow[0];
  }

   // TODO: If registeredID doesn't exist need to decide which info to display
   // for sure can't show signed up for - could show events to sign up for

   //Only show these 3 views if member is registered
  if ($registeredID !== null) {
    //All events that don't have an association with the member's registeredID in Registered_Member_Event
    $signUpForResults = mysqli_query($db, "SELECT * FROM Event WHERE eventID NOT IN (
    SELECT eventID from Registered_Member_Event WHERE registeredID = '$registeredID' AND isComplete = 0)");
    //Events to Sign up For
    if ($signUpForResults->num_rows != 0) {
      echo"<hr><h2 class='text-center'><strong>Sign Up For Events</strong></h2><hr>";
      //Looping through result to show all events
      while($row = mysqli_fetch_array($signUpForResults, MYSQLI_BOTH)) {
        echo"
        <div class='card mb-3 border-success'>
          <div class='card-header bg-success'>
            <button class='btn btn-link text-white float-left' type='button' data-toggle='collapse' data-target='#$row[eventID]'>
                <h3>$row[eventName]</h3>
            </button>
          </div>
          <div id='$row[eventID]' class='collapse'>
            <div class='card-body border-success'>
              <strong>Event ID:</strong> $row[eventID]
              </br>
              <strong>Event Category:</strong> $row[eventCategory]
              </br>
              <strong>Date:</strong> $row[eventDate]
              </br>
              <strong>Location:</strong> $row[eventAddress], $row[eventCity], $row[eventState], $row[eventZip]
              </br>
              <strong>Description:</strong> $row[eventBio]
              </br>
              <form action='eventSignUp.php' name='eventSignUp' method='post'>
                <input type='hidden' name='registeredID' id='registeredID' value=$registeredID>
                <input type='hidden' name='eventID' value=$row[eventID]>
                <button type='submit' class='btn btn-danger'>Sign Up</button>
              </form>
              </br>
              </div>
            </div>
          </div>";
      }
      mysqli_free_result($signUpForResults);
    } else { //There are no events the user isn't signed up for
      echo"<div class='container'>There are no events for you to sign up for at this time. Please check back soon!</div>";
    }

    //All events that the user is signed up for but have NOT taken place yet
    $signedUpResults = mysqli_query($db, "SELECT * FROM Registered_Member_Event
      INNER JOIN Event ON Registered_Member_Event.eventID=Event.eventID WHERE registeredID =
      '$registeredID' AND isComplete = 0");
    echo"<hr><h2 class='text-center'><strong>Events Signed Up For</strong></h2><hr>";
    //current events display
    if ($signedUpResults->num_rows != 0) { //Making sure that query returns data
      //Looping through result to show all events
      while($row = mysqli_fetch_array($signedUpResults, MYSQLI_BOTH)){
          //Displaying info in toggable accordian
          //TODO: show transaction ID
          echo"
          <div class='card mb-3 border-success'>
            <div class='card-header bg-success'>
              <button class='btn btn-link text-white float-left' type='button' data-toggle='collapse' data-target='#$row[eventID]'>
                  <h3>$row[eventName]</h3>
              </button>
              </div>
              <div id='$row[eventID]' class='collapse'>
                <div class='card-body border-success'>
                  <strong>Event Category:</strong> $row[eventCategory]
                  </br>
                  <strong>Date:</strong> $row[eventDate]
                  </br>
                  <strong>Location:</strong> $row[eventAddress], $row[eventCity], $row[eventState], $row[eventZip]
                  </br>
                  <strong>Leave By:</strong> $row[leaveBy]
                  </br>
                  <strong>Description:</strong> $row[eventBio]
                  </br>
                </div>
              </div>
            </div>";
          }
          mysqli_free_result($signedUpResults);
        } else { //User is not signed up for any events, meaning the query result has no rows.
          echo"<div class='container' style='text-align:center;'>You are not signed up for any events</div>";
        }
        //All events that the user is signed up for that have taken place
        $pastEvents = mysqli_query($db, "SELECT * FROM Registered_Member_Event
          INNER JOIN Event ON Registered_Member_Event.eventID=Event.eventID WHERE registeredID =
          '$registeredID' AND isComplete = 1");

          //Past events view
          echo"<hr><h2 class='text-center'><strong>Past Events</strong></h2><hr>";
          if ($pastEvents->num_rows != 0) {
            while($row = mysqli_fetch_array($pastEvents, MYSQLI_BOTH)){
                //TODO: consider adding transaction ID
              echo"
              <div class='card mb-3 border-success'>
                <div class='card-header bg-success'>
                  <button class='btn btn-link text-white float-left' type='button' data-toggle='collapse' data-target='#$row[eventID]'>
                      <h3>$row[eventName]</h3>
                  </button>
                  </div>
                  <div id='$row[eventID]' class='collapse'>
                    <div class='card-body border-success'>
                      <strong>Event Category:</strong> $row[eventCategory]
                      </br>
                      <strong>Date:</strong> $row[eventDate]
                      </br>
                      <strong>Location:</strong> $row[eventAddress], $row[eventCity], $row[eventState], $row[eventZip]
                      </br>
                      <strong>Leave By:</strong> $row[leaveBy]
                      </br>
                      <strong>Description:</strong> $row[eventBio]
                      </br>
                    </div>
                  </div>
                </div>";
            }
            mysqli_free_result($pastEvents);
          } else { //User has not completed any events.
            echo"<div class='container' style='text-align:center;'>There are no past events to display for this account. </div>";
          }
  } else {
      // Not Registered Header
      echo"<h4 class='text-center'><strong>You are not registered! Here are some events you are missing out on!</strong></h4>";

      $notRegisteredResult = mysqli_query($db, "SELECT * FROM Event ORDER BY eventSeason DESC LIMIT 25");

      while ($notRegisteredRow = mysqli_fetch_array($notRegisteredResult, MYSQLI_BOTH)) {
          echo"
          <div class='card mb-3 border-warning'>
            <div class='card-header bg-warning'>
              <button class='btn btn-link text-white float-left' type='button' data-toggle='collapse' data-target='#$notRegisteredRow[eventID]'>
                  <h3>$notRegisteredRow[eventName]</h3>
              </button>
              </div>
              <div id='$notRegisteredRow[eventID]' class='collapse'>
                <div class='card-body border-success'>
                  <strong>Event Category:</strong> $notRegisteredRow[eventCategory]
                  </br>
                  <strong>Date:</strong> $notRegisteredRow[eventDate]
                  </br>
                  <strong>Location:</strong> $notRegisteredRow[eventAddress], $notRegisteredRow[eventCity], $notRegisteredRow[eventState], $notRegisteredRow[eventZip]
                  </br>
                  <strong>Description:</strong> $notRegisteredRow[eventBio]
                  </br>
                </div>
              </div>
            </div>";
      }
      mysqli_free_result($notRegisteredResult);
  }
  mysqli_close($db);


  ?>
  </div>
  <?php include 'helper/footer.php' ?>
</html>
