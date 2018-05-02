<!DOCTYPE html>
<html lang="en">
    <?php include 'helper/header.php';
    /*
      This page handles gathering neccessary data from user that pertains to the event the
      user selects to sign up for. The database is updated in myEvents.php, this page
      sends a post to that page with all of the relevant information needed.
      LeaveBy: the time the user can leave by for the events. String in 24-hour format
      numberOfSeatsAvailable: only asked of the user when thier associated member has a value
                              in the driverAuthorizationDate attribute of the Member table.
                              The number of spots they have in their car

    TODO: only let member sign up if registeredSeason matches eventSeason
    */
    ?>
    <div class="container bg-faded p-4 my-4 h3">
        <h1 class="text-center">Event Details:</h1>
    <?php
        session_start();
        include 'helper/connect.php';

        if (isset($_POST['eventManagementDetails'])) {

            //Count of drivers



            //List of drivers



            //List of all members signed up for event
            $eventID = $_POST['eventID'];
            $eventMemberResult = mysqli_query($db, "SELECT Member.memberID, Member.firstName, Member.lastName FROM Registered_Member_Event JOIN Registered_Member ON Registered_Member_Event.registeredID=Registered_Member.registeredID JOIN Member ON Registered_Member.memberID=Member.memberID WHERE Registered_Member_Event.eventID=$eventID ORDER BY Member.firstName ASC");
            echo"
            <table class='table'>
                <thead>
                    <tr>
                        <th>Member ID</th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>";
            while($innerRow = mysqli_fetch_array($eventMemberResult, MYSQLI_BOTH)) {
                //Populating rows of table
                echo"
                    <tr>
                        <td>$innerRow[memberID]</td>
                        <td>$innerRow[firstName] $innerRow[lastName]</td>
                    </tr>";
            }
            echo"</tbody></table>"; //closing table body and table
        }



        echo"</div>"; //closing bg-faded
        include 'helper/footer.php';
    ?>
