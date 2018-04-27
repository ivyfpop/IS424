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
       // If registeredID doesn't exist need to decide which info to display
       //      for sure can't show signed up for - could show events to sign up for
      if ($registeredID !== null) {
         /*
           Signed up for events
             - Events in Registered_Member_Event that have isComplete = no
             - $signedUpArr = all eventIDs from query
          */

        $signedUpResults = mysqli_query($db, "SELECT * FROM Registered_Member_Event WHERE registeredID = '$registeredID'");

        if ($signedUpResults != 'FALSE') {
          // add eventIDs to $signedUpArr
          /*$signedUpArr = array();
          while($row = mysqli_fetch_array($signedUpResults, MYSQLI_BOTH)){
            array_push($signedUpArr,$row);
          }*/

         // TODO debate if this is indeed true (won't all events include events from the beginning of time?
         //      meaning we can't just assume events that aren't in the array are in the current season?)
         /* query all events, add those that are in signedUpArr to signedUpEvents area, those that aren't in signedUpArr
          and are in the current season can be added to sign up for events and then decide which events need to be shown
           for the past events */

          /*$pastEventResults = mysqli_query($db, "SELECT eventID FROM Event");*/

          // events signed up for header TODO check if any exist before printing?
          echo"<hr><h2 class='text-center'><strong>Events Signed Up For</strong></h2><hr>";
          //Query results and display info for each event that is signed up for and add eventID to $signedUpArr
          while($row = mysqli_fetch_array($signedUpResults, MYSQLI_BOTH)){

            // events signed up for
            if ($row[isComplete]){
              echo"
              <div class='card mb-3 border-warning'>
                  <div class='card-header bg-warning'>
                          <button class='btn btn-link text-white float-left' type='button' data-toggle='collapse' data-target='#$row[eventID]'>
                              <h3>PENDING - $$row[eventID]</h3>
                          </button>
                  </div>

                  <div id='$row[eventID]' class='collapse'>
                    <div class='card-body border-warning'>
                      <strong>Event ID:</strong> $row[eventID]
                      </br>
                      <strong>Transaction ID:</strong> $row[transactionID]
                      </br>
                      <strong>Car Capacity:</strong> $row[carCapacity]
                      </br>";

                      // If there is an Event associated with the transaction
                      if ($row[eventID]){
                          //Determine the name of the event
                          $eventResult = $db->query("SELECT eventName FROM Event WHERE eventID = $row[eventID]");
                          $eventRow = mysqli_fetch_array($eventResult, MYSQLI_BOTH);
                          echo"<strong>Event Name:</strong> $eventRow[eventName]
                               </br>";
                      }

                      "</div>
                  </div>
              </div>";
            }
          }

        } // end $signedUpResults !== null

          /*
           Events to Sign up for
             - check to make sure eventID isn't in $signedUpArr before displaying

          */

          /*
           Past Events
             - All events that fall outside of current season

          */

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
