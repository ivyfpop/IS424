<!DOCTYPE html>
<html lang="en">

<?php include 'helper/header.php'?>

<div class='navbar navbar-dark bg-primary d-flex justify-content-center'>
    <form action='createNewEvent.php' method='post'>
        <button type='submit' name='newEvent' class='btn btn-warning'>Create New Event</button>
    </form>
</div>

<?php
    // Start the session and get ready for database interactions.
    session_start();
    include 'helper/connect.php';

    //TODO: SEARCH POSTS WILL GO HERE
    if (isset($_POST['newEvent'])) {
        $name = $_POST['name'];
        $season = $_POST['season'];
        $category = $_POST['category'];
        $date = $_POST['date'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zip = $_POST['zip'];
        $description = $_POST['description'];
        $testQuery = "INSERT INTO Event (eventName, eventSeason, eventCategory, eventDate, eventAddress, eventCity, eventState, eventZip, eventBio) VALUES ('$name', '$season', '$category', '$date', '$address', '$city', '$state', '$zip', '$description')";
        echo"Test query: " . $testQuery;
        $createEvent = mysqli_query($db, $testQuery);
    }

    //Default view when no POSTs are submitted
    //Showing more current events first
    $defaultViewResult = mysqli_query($db, "SELECT eventID, eventName FROM Event ORDER BY eventID DESC LIMIT 25");
    //Going to be too many results eventually. Put a cap on it but then how to see extended history?

    echo"<div class='container bg-faded p-4 my-4'>";

    //Creating a card for each event
    while($row = mysqli_fetch_array($defaultViewResult, MYSQLI_BOTH)) {

        //Opening of card
        //Count of how many people are Going
        //link to more information
            //list of authorized drivers, number of seats, count of members Going
            //under that list of memebers attending
        echo"<div class='card mb-3 border-success'>
                <div class='card-header bg-success'>
                    <button class='btn btn-link text-white float-left' type='button' data-toggle='collapse' data-target='#$row[eventID]'>
                        <h3>$row[eventName]</h3>
                    </button>
                </div>
                <div id='$row[eventID]' class='collapse'>
                    <div class='card-body border-success'>
                        <strong>Number of Members Signed Up: </strong>";
        $countOfMembersResult = mysqli_query($db, "SELECT COUNT(registeredID) FROM Registered_Member_Event WHERE eventID = $row[eventID] AND NOT isComplete = 1");
        $sumRow = mysqli_fetch_array($countOfMembersResult, MYSQLI_BOTH);
        echo$sumRow[0];
        echo"
                        </br>
                        <strong>Event ID: </strong>$row[eventID]
                        <form action='eventManagementDetails.php' name='eventManagementDetails' method='post'>
                            <input type='hidden' name='sumMembers' value=$sumRow[0]>
                            <input type='hidden' name='eventID' value=$row[eventID]>
                            <button type='submit' name='eventManagementDetails' class='btn btn-danger'>More Details</button>
                        </form>
                        </br>
                    </div>
                </div>
            </div>";

        mysqli_free_result($countOfMembersResult);
    }
    mysqli_free_result($defaultViewResult);
    mysqli_close($db);
    echo"</div>"; // Closes bg-faded

    include 'helper/footer.php';
?>
</html>
