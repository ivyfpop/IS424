<!DOCTYPE html>
<html lang="en">

<?php include 'helper/header.php'?>

<div class='navbar navbar-dark bg-primary d-flex justify-content-center'>
    <a href='transactionManagementUpdate.php?newTransaction=1' class='btn btn-warning mr-3'>New Transaction</a>
    <form class='form-inline' action='transactionManagement.php' name='transactionSearch' method='post'>
        <input class='form-control mr-3' type='text' placeholder='Search Value' name='transactionSearchValue' required>
        <select type="text" class="form-control mr-3" name='transactionSearchType' id='transactionSearchType'>
            <option selected value="1">Last Name</option>
            <option value="2">Transaction ID</option>
            <option value="3">Event ID</option>
            <option value="4">Member ID</option>
        </select>
        <button class='form-control btn btn-success' type='submit' name='transactionSearch'>Search Transactions!</button>
    </form>
</div>

<?php
  // Start the session and get ready for database interactions.
  session_start();
  include 'helper/connect.php';


  include 'helper/footer.php'
?>
</html>
