<!DOCTYPE html>
<html lang="en">
    <?php include 'helper/header.php';
    /*

    */
    ?>
    <div class="container bg-faded p-4 my-4 h3">
        <h1 class="text-center">Event Details:</h1>
    <?php
        session_start();
        include 'helper/connect.php';

        if (isset($_POST['eventManagementDetails'])) {

            //Counts the number of drivers (attribute numberOfSeatsAvailable != 0)
            //and sums the number of seats
            $combined = mysqli_query($db, "SELECT COUNT(carCapacity), SUM(carCapacity) FROM Registered_Member_Event WHERE NOT carCapacity = 0");
            $combinedRow = mysqli_fetch_array($combined, MYSQLI_BOTH);

            echo "Number of seats available: " . $combinedRow[1] . "</br>";
            echo "Number of members attending: " . $_POST['sumMembers'] . "</br>";
            echo "Number of Drivers: " . $combinedRow[0] . "</br>";

            mysqli_free_result($combinedRow);

            //List of drivers
            $eventID = $_POST['eventID'];

            $driverListResult = mysqli_query($db, "SELECT Member.memberID, Member.firstName, Member.lastName, Member.email, Member.driverAuthorizationDate FROM Registered_Member_Event JOIN Registered_Member ON Registered_Member_Event.registeredID = Registered_Member.registeredID JOIN Member ON Registered_Member.memberID = Member.memberID WHERE Registered_Member_Event.eventID = $eventID AND NOT Registered_Member_Event.carCapacity = 0");

            //Opening table
            echo"
            <h3 class='text-center'>All Drivers Signed Up for Event:</h3>
            <table class='table'>
                <thead>
                    <tr>
                        <th>Member ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Driver Auth Submission</th>
                    </tr>
                </thead>
                <tbody>";

            while($driverRow = mysqli_fetch_array($driverListResult, MYSQLI_BOTH)) {
                //Populating rows of table
                echo"
                    <tr>
                        <td>$driverRow[memberID]</td>
                        <td>$driverRow[firstName] $driverRow[lastName]</td>
                        <td>$driverRow[email]</td>
                        <td>$driverRow[driverAuthorizationDate]</td>
                    </tr>";
            }
            echo"</tbody></table>"; //closing table body and table

            mysqli_free_result($driverListResult);

            //List of all members signed up for event & member details
            $eventMemberResult = mysqli_query($db, "SELECT Member.memberID, Member.firstName, Member.lastName FROM Registered_Member_Event JOIN Registered_Member ON Registered_Member_Event.registeredID=Registered_Member.registeredID JOIN Member ON Registered_Member.memberID=Member.memberID WHERE Registered_Member_Event.eventID=$eventID ORDER BY Member.firstName ASC");
            echo"
            <h3 class='text-center'>All Members Signed Up for Event:</h3>
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
            mysqli_free_result($eventMemberResult);
            mysqli_close($db);
            echo"</tbody></table>"; //closing table body and table
        }



        echo"</div>"; //closing bg-faded
        include 'helper/footer.php';
    ?>
