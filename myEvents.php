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

        $signedUpResults = mysqli_query($db, "SELECT * FROM Registered_Member_Event
          INNER JOIN Event ON Registered_Member_Event.eventID=Event.eventID WHERE registeredID =
          '$registeredID'");
          echo mysqli_num_rows($signedUpResults);

        if ($signedUpResults != 'FALSE') {

          echo"<hr><h2 class='text-center'><strong>Events Signed Up For</strong></h2><hr>";
          //Query results and display info for each event that is signed up for and add eventID to $signedUpArr
          while($row = mysqli_fetch_array($signedUpResults, MYSQLI_BOTH)){
            // events signed up for
            if ($row[isComplete] == 0){
              echo"
              <div class='card mb-3 border-danger'>
                <div class='card-header bg-danger'>
                  <button class='btn btn-link text-white float-left' type='button' data-toggle='collapse' data-target='#$row[transactionID]'>
                      <h3>$transactionPaymentDate - $$row[transactionQuantity]</h3>
                  </button>
                  </div>
                  <div id='$row[transactionID]' class='collapse'>
                    <div class='card-body border-success'>
                      <strong>Transaction ID:</strong> $row[transactionID]
                      </br>
                      <strong>Request Date:</strong> $transactionInitDate
                      </br>
                      <strong>Payment Date:</strong> $transactionPaymentDate
                      </br>
                        <strong>Approval Date:</strong> $transactionApprovalDate
                      </br>
                    </div>
                  </div>
                </div>";
            } else if ($row[isComplete] == 1) {
              echo"
              <div class='card mb-3 border-success'>
                <div class='card-header bg-success'>
                  <button class='btn btn-link text-white float-left' type='button' data-toggle='collapse' data-target='#$row[transactionID]'>
                      <h3>$transactionPaymentDate - $$row[transactionQuantity]</h3>
                  </button>
                  </div>
                  <div id='$row[transactionID]' class='collapse'>
                    <div class='card-body border-success'>
                      <strong>Transaction ID:</strong> $row[transactionID]
                      </br>
                      <strong>Request Date:</strong> $transactionInitDate
                      </br>
                      <strong>Payment Date:</strong> $transactionPaymentDate
                      </br>
                        <strong>Approval Date:</strong> $transactionApprovalDate
                      </br>
                    </div>
                  </div>
                </div>";
            }
          }

        } else {
          echo "nope";
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
