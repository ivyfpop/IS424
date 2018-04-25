<!DOCTYPE html>
<html lang="en">
<?php
include 'helper/header.php';
include 'helper/connect.php';

//Querying for registeredID from Registered_Member with memberID
$regMemQuery = "SELECT registeredID FROM Registered_Member WHERE memberID = '$SESSION[memberID]' ORDER BY registeredSeason DESC";
echo "TESTING: regMemQuery: " . $regMemQuery;
$registeredIDResult = mysqli_query($db, $regMemQuery);
$registeredID = null;
echo "TESTING: registeredID num rows: '$registeredIDResult->num_rows'";
if ($registeredIDResult->num_rows != 0) {
  $registeredIDRow = mysqli_fetch_array($registeredIDResult);
  $registeredID = $registeredIDRow[0];
  echo "TESTING: registered ID: '$registeredID'";
}
// // If registeredID doesn't exist need to decide which info to display
// //      for sure can't show signed up for - could show events to sign up for
// if ($registeredID !== null) {
//   /*
//     Signed up for events
//       - Events in Registered_Member_Event that have isComplete = no
//       - $signedUpArr = all eventIDs from query
//
//    */
//
//    $signedUpResults = mysqli_query($db, "SELECT * FROM Registered_Member_Event WHERE registeredID = '$registeredID'");
//    // add eventIDs to $signedUpArr
//
//   /* query all events, add those that are in signedUpArr to signedUpEvents area, those that aren't in signedUpArr
//    and are in the current season can be added to sign up for events and then decide which events need to be shown
//     for the past events */
//
//
//
//    if ($signedUpResults != 'FALSE') {
//      echo"<hr><h2 class='text-center'><strong>Events Signed Up For</strong></h2><hr>";
//      //Query results and display info for each event that is signed up for and add eventID to $signedUpArr
//
//
//
//
//    }
//
//    /*
//     Events to Sign up for
//       - check to make sure eventID isn't in $signedUpArr before displaying
//
//    */
//
//    /*
//     Past Events
//       - All events that fall outside of current season
//
//    */
//
// } else {
//   // Display some error.
//   echo"TESTING: Unable to find registeredID";
// }
mysqli_close($db);





?>
</html>
