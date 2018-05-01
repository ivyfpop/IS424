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
        </select>
        <button class='form-control btn btn-success' type='submit' name='eventSearch'>Search Events</button>
    </form>
</div>

<?php
  // Start the session and get ready for database interactions.
  session_start();
  include 'helper/connect.php';



  include 'helper/footer.php'
?>
</html>
