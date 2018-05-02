<!DOCTYPE html>
<html lang="en">

<?php
    include 'helper/header.php';

    // Start the session and get ready for database interactions.
    session_start();
    include 'helper/connect.php';

    if(isset($_POST['newEvent'])) {
        echo"
        <form action='createNewEvent.php' method='post'>
            <div class='form-group'>
                <label for='name'>Event Name:</label>
                <input type='text' class='form-control' id='name' name='name' placeholder='Event Name'>
            </div>
            <div class='form-group'>
                <label for='season'>Event Season:</label>
                <select class='form-control' id='season' name='season'>
                    <option value='2017-2018'>2017-2018</option>
                    <option value='2018-2019'>2018-2019</option>
                    <option value='2019-2020'>2019-2020</option>
                    <option value='2020-2021'>2020-2021</option>
                </select>
            </div>
            <div class='form-group'>
                <label for='category'>Event Category:</label>
                <select class='form-control' id='category' name='category'>
                    <option value='Competition'>Competition</option>
                    <option value='Meeting'>Meeting</option>
                    <option value='Volunteer'>Volunteer</option>
                </select>
            </div>
            <div class='form-group'>
                <label for='date'>Event Date:</label>
                <input type='date' id='date' name='date'>
            </div>
            <div class='form-group'>
                <label for='address'>Event Address:</label>
                <input type='text' class='form-control' id='address' name='address' placeholder='Event Address'>
            </div>
            <div class='form-group'>
                <label for='city'>Event City:</label>
                <input type='text' class='form-control' id='city' name='city' placeholder='Event City'>
            </div>
            <div class='form-group'>
                <label for='state'>Event State:</label>
                <input type='text' class='form-control' id='state' name='state' placeholder='Event State'>
            </div>
            <div class='form-group'>
                <label for='zip'>Event Zip Code:</label>
                <input type='text' class='form-control' id='zip' name='zip' placeholder='Event Zip Code'>
            </div>
            <div class='form-group'>
                <label for='description'>Event Description</label>
                <textarea class='form-control' id='description' name='description' rows='3'></textarea>
            </div>
            <button type='submit' name='newEvent' class='btn btn-danger'>Create New Event</button>
        </form>";
    }



    include 'helper/footer.php';
?>
</html>
