<!DOCTYPE html>
<html lang="en">
<?php include 'helper/header.php';
    session_start();
    include 'helper/connect.php';
?>

  <div class='container bg-faded p-4 my-4'>
  <h1 class='text-center'><strong>My Events</strong></h1>

    <?php


      //Querying for registeredID from Registered_Member with memberID
      $regMemQuery = "SELECT registeredID FROM Registered_Member WHERE memberID = '$_SESSION[memberID]' ORDER BY registeredSeason DESC";
      $registeredIDResult = mysqli_query($db, $regMemQuery);
      $registeredID = null;
      if ($registeredIDResult->num_rows != 0) {
        $registeredIDRow = mysqli_fetch_array($registeredIDResult);
        $registeredID = $registeredIDRow[0];
      }

       // TODO: If registeredID doesn't exist need to decide which info to display
       // for sure can't show signed up for - could show events to sign up for
      if ($registeredID !== null) {

        /*
         Events to Sign up for
           - check to make sure eventID isn't in $signedUpArr before displaying
        */
        $signUpForResults = mysqli_query($db, "SELECT * FROM Event WHERE eventID NOT IN (
        SELECT eventID from Registered_Member_Event WHERE registeredID = '$registeredID')");

        if ($signUpForResults != 'FALSE') {
          echo"<hr><h2 class='text-center'><strong>Sign Up For Events</strong></h2><hr>";
          while($row = mysqli_fetch_array($signUpForResults, MYSQLI_BOTH)) {
//TODO add sign up button -> handle sign up :) 
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
                  </div>
                </div>
              </div>";

          }
        }



        //Querying for all events in Registered_Member_Event with user's registeredID
        $signedUpResults = mysqli_query($db, "SELECT * FROM Registered_Member_Event
          INNER JOIN Event ON Registered_Member_Event.eventID=Event.eventID WHERE registeredID =
          '$registeredID'");
          /*
            Current Events display.
            A current event is one that is in the Registered_Member_Event table and
            has isComplete set to 0. This means that the event has not happened yet.
          */
        if ($signedUpResults != 'FALSE') { //Making sure that query returns data
          while($row = mysqli_fetch_array($signedUpResults, MYSQLI_BOTH)){
            //Events that have not been paid for - red background
            if ($row[isComplete] == 0){
              //TODO need to find a better way to place the events udner teh correct header
              // -> looping through row and need to show "Events signed up for" and
              // Past Events.
              echo"<hr><h2 class='text-center'><strong>Events Signed Up For</strong></h2><hr>";
              echo"
              <div class='card mb-3 border-danger'>
                <div class='card-header bg-danger'>
                  <button class='btn btn-link text-white float-left' type='button' data-toggle='collapse' data-target='#$row[transactionID]'>
                      <h3>$row[eventName]</h3>
                  </button>
                  </div>
                  <div id='$row[transactionID]' class='collapse'>
                    <div class='card-body border-success'>
                      <strong>Transaction ID:</strong> $row[transactionID]
                      </br>
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
            } else if ($row[isComplete] == 1) { //Events that have been paid for - green background
              /*
               Past Events Display.
               A past event is one that has already happened, meaning the attribute isComplete is
               set to 1 in the database.
              */
              echo"<hr><h2 class='text-center'><strong>Past Events</strong></h2><hr>";
              echo"
              <div class='card mb-3 border-success'>
                <div class='card-header bg-success'>
                  <button class='btn btn-link text-white float-left' type='button' data-toggle='collapse' data-target='#$row[transactionID]'>
                      <h3>'$row[eventName]'</h3>
                  </button>
                  </div>
                  <div id='$row[transactionID]' class='collapse'>
                    <div class='card-body border-success'>
                      <strong>Transaction ID:</strong> $row[transactionID]
                      </br>
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
          }
        }

      } else {
          // Not Registered Header
          echo"<h2 class='text-center'><strong>You Are Not Registered!</strong></h2>";

          // ?? display all events with disabled signup buttons
      }
      mysqli_close($db);


    ?>
  </div>

  <!-- JS Used -->
  <script src="helper/vendor/jquery/jquery.min.js"></script>
  <script src="helper/vendor/bootstrap/js/bootstrap.min.js"></script>
</html>
