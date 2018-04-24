<!DOCTYPE html>
<html lang="en">
<?php
include 'helper/header.php';
include 'helper/connect.php';

//$registeredID is needed here - might need to query for
$regMemQuery = "SELECT registeredID FROM Registered_Member WHERE memberID = {$SESSION['memberID']} ORDER BY registeredSeason + 1 DESC";
echo "TESTING: regMemQuery: {$regMemQuery}";
$registeredIDResult = mysqli_query($db, $regMemQuery);
$registeredID = null;
echo "TESTING: registeredID num rows = {$registeredIDResult->num_rows}";
if ($registeredIDResult->num_rows != 0) {
  $registeredIDRow = mysqli_fetch_array($registeredIDResult);
  $registeredID = $registeredIDRow[0];
  echo "TESTING: registered ID : {$registeredID}";
}

if ($registeredID !== null) {
  /*
    Signed up for events
      - Events in Registered_Member_Event that have isComplete = no
      - $signedUpArr = all eventIDs from query

   */
   $signedUpResults = mysqli_query($db, "SELECT * FROM Registered_Member_Event WHERE registeredID = {$registeredID}");
   //Query results and display info for each event that is signed up for and add eventID to $signedUpArr



   /*
    Events to Sign up for
      - check to make sure eventID isn't in $signedUpArr before displaying

   */

   /*
    Past Events
      - All events that fall outside of current season

   */
} else {
  // Display some error.
}





?>
</html>
