<!DOCTYPE html>
<html lang="en">

    <?php
        include 'helper/header.php';
        include 'helper/connect.php';

        // Non-Admin got to this page.
        if(!$_SESSION[adminStatus]){
            header("Location: http://track.finkmp.com");
        }
    ?>

    <div class='navbar navbar-dark bg-primary d-flex justify-content-center'>

        <form class='form-inline' action='accountManagement.php' name='memberSearch' method='post'>
            <input class='form-control mr-3' type='text' placeholder='Search Value' name='memberSearchValue' required>
            <select type="text" class="form-control mr-3" name='memberSearchType' id='memberSearchType'>
                <option selected value="1">Last Name</option>
                <option value="2">First Name</option>
                <option value="3">Member ID</option>
            </select>

            <button class='form-control btn btn-success' type='submit' name='memberSearch'>Search Members!</button>
        </form>

    </div>

    <?php
      // Default Query if a post was not entered.
      $memberQuery = "SELECT * FROM Member ORDER BY memberID ASC LIMIT 25";

      // If a search was submitted, determine the correct query
      if (isset($_POST['memberSearch'])){
          // Member Last Name Query
          if ($_POST['memberSearchType'] == 1){
              $memberQuery = "SELECT * FROM Member WHERE lastName = '$_POST[memberSearchValue]' ORDER BY memberID ASC";
          }
          // Member First Name Query
          if ($_POST['memberSearchType'] == 2){
              $memberQuery = "SELECT * FROM Member WHERE firstName = '$_POST[memberSearchValue]' ORDER BY memberID ASC";
          }
          // Member ID Query
          else if ($_POST['memberSearchType'] == 3){
              $memberQuery = "SELECT * FROM Member WHERE memberID = '$_POST[memberSearchValue]'";
          }
      }

      // Connect to the database, run query, and close connection.
      $members = $db->query($memberQuery);
      mysqli_close($db);

      // If there is only one transaction returned, go right to the modify transaction page.
      if($members && $members->num_rows == 1 && isset($_POST['memberSearch'])){
          $oneRow = mysqli_fetch_array($members, MYSQLI_BOTH);
          header("Location: http://track.finkmp.com/myAccount.php?memberID=$oneRow[memberID]");
      }
      // More than one member, loop through and print them all out.
      else if($members && $members->num_rows){
          // Open the container
          echo"<div class='container bg-faded p-4 my-4'>";
          // Loop through all of their transactions
          while ($row = mysqli_fetch_array($members, MYSQLI_BOTH)){

            echo"<div class='card mb-3 border-danger'>
                    <div class='card-header bg-danger'>
                            <button class='btn btn-link text-white float-left' type='button''>
                                <h3>#$row[memberID] - $row[firstName] $row[lastName]</h3>
                            </button>

                            <a href='myAccount.php?memberID=$row[memberID]' class='btn btn-info float-right'><h3>Update</h3></a>
                    </div>
                </div>";

          }
          // Close the container.
          echo"</div>";
      }
      // Let the user know that their query returned no results.
      else if($memberQuery){
          echo"<div class='alert alert-warning text-center mx-auto text-center w-50' role='alert'><strong>Your search returned no results, please try again!</strong></div>";
      }
      include 'helper/footer.php'
  ?>
  </html>
