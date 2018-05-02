<!DOCTYPE html>
<html lang="en">

<?php include 'helper/header.php'?>

<div class='navbar navbar-dark bg-primary d-flex justify-content-center'>
    <a href='transactionManagementUpdate.php?newTransaction=1' class='btn btn-warning mr-3'>New Event</a>
        <form class='form-inline' action='eventManagement.php' name='eventSearch' method='post'>
            <input class='form-control mr-3' type='text' placeholder='Search Value' name='eventSearchValue' required>
            <select type="text" class="form-control mr-3" name='eventSearchType' id='transactionSearchType'>
                <option value="1">Event ID</option>
                <option value="2">Member ID</option>
                <option value="3">Event Season</option>
                <option value="4">Event Name</option>
            </select>
            <button class='form-control btn btn-success' type='submit' name='eventSearch'>Search Events</button>
        </form>
</div>

<?php
    // Start the session and get ready for database interactions.
    session_start();
    include 'helper/connect.php';

    //TODO: POSTS WILL GO HERE


    //Default view when no POSTs are submitted
    //Showing more current events first
    $defaultViewResult = mysqli_query($db, "SELECT eventID, eventName FROM Event ORDER BY eventID DESC");
    //Going to be too many results eventually. Put a cap on it but then how to see extended history?

    echo"<div class='container bg-faded p-4 my-4'>";

    //Creating a card for each event
    while($row = mysqli_fetch_array($defaultViewResult, MYSQLI_BOTH)) {

        //Opening of card
        echo"<div class='card mb-3 border-success'>
                <div class='card-header bg-success'>
                    <button class='btn btn-link text-white float-left' type='button' data-toggle='collapse' data-target='#$row[eventID]'>
                        <h3>$row[eventName]</h3>
                    </button>
                </div>
                <div id='$row[eventID]' class='collapse'>
                    <div class='card-body border-success'>";

        $eventMemberResult = mysqli_query($db, "SELECT Member.memberID, Member.firstName, Member.lastName FROM Registered_Member_Event JOIN Registered_Member ON Registered_Member_Event.registeredID=Registered_Member.registeredID JOIN Member ON Registered_Member.memberID=Member.memberID WHERE eventID = $row[eventID] ORDER BY Member.firstName ASC");

        while($innerRow = mysqli_fetch_array($eventMemberResult, MYSQLI_BOTH)) {
            echo"$innerRow[firstName] $innerRow[lastName] $innerRow[memberID]";
        }
        
        echo"</div></div></div>"; // Closes card
    }

    echo"</div>"; // Closes bg-faded

    include 'helper/footer.php'
?>
</html>
