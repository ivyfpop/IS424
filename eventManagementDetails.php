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

            //Counts the number of drivers (attribute numberOfSeatsAvailable != 0), and sums numberOfSeatsAvailable
            $CountOfDriversResult = mysqli_query($db, "SELECT COUNT(carCapacity), SUM(carCapacity) FROM Registered_Member_Event WHERE NOT carCapacity=0");
            $countOfDriversRow = mysqli_fetch_array($countOfMembersResult, MYSQLI_BOTH);
            echo $db->error;
            print_r($countOfDriversRow);
            echo"Sum of seats available: " . $countOfDriversRow[1] . "</br>";
            echo"Number of members attending: " . $_POST['sumMembers'] . "</br>";
            echo"Number of Drivers: " . $countOfDriversRow[0] . "</br>";



            //List of drivers



            //List of all members signed up for event
            $eventID = $_POST['eventID'];
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
            echo"</tbody></table>"; //closing table body and table
        }



        echo"</div>"; //closing bg-faded
        include 'helper/footer.php';
    ?>
