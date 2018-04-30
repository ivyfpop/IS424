<html lang="en">
    <!-- Check current session state -->
    <?php
        // Start the session
        session_start();

        // Otherwise, check if they are trying to log in.
        if($_POST['login']){
            // Connect to the database, run query, close connection
            include 'connect.php';
            $result = mysqli_query($db,"SELECT memberID,adminStatus,firstName,lastName,email FROM Member WHERE email = '$_POST[email]' AND password = '$_POST[password]'");
            mysqli_close($db);

            //Verify that the there is a user and store the session data if so.
            if($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
                // Start the session, store data and go to index page
                session_start();
                $_SESSION['memberID'] = $row['memberID'];
                $_SESSION['adminStatus'] = $row['adminStatus'];
                $_SESSION['firstName'] = $row['firstName'];
                $_SESSION['lastName'] = $row['lastName'];
                $_SESSION['email'] = $row['email'];
                echo"<meta http-equiv='refresh' content='0;url=../index.php'>";
            }
            // Login credentails were wrong; inform the user.
            else echo"<meta http-equiv='refresh' content='0;url=../login.php?login_error=1'>";
        }
        // Otherwise, check if they are trying to log out
        else if($_POST['logout']){
            	session_destroy();
                echo("<meta http-equiv='refresh' content='0;url=../login.php?logout=1'>");
        }
        // Otherwise, check if they are trying to signup
        else if($_POST['signup']){
             // Verify that the email isn't taken already
            include 'connect.php';
            $result = mysqli_query($db,"SELECT * FROM Member WHERE email = '$_POST[email]'");
            if(!$row = mysqli_fetch_array($result, MYSQLI_BOTH)){
                // Query used to create the account
                $updateQuery = "INSERT INTO Member (firstName, lastName, email, password) VALUES ('$_POST[firstName]','$_POST[lastName]','$_POST[email]','$_POST[password]')";

                // Create account and send them to the homepage
                mysqli_query($db, $updateQuery);
                echo("<meta http-equiv='refresh' content='0;url=../login.php?new_account=1'>");
                exit();
            }
            // If the email is already taken inform the user.
            else{
                echo("<meta http-equiv='refresh' content='0;url=../signup.php?account_error=1'>");
                exit();
            }
        }
        // Otherwise, check if they are updating their account
        else if($_POST['self-update'] || $_POST['admin-update']){

            include 'connect.php';

            $_isSprinter = $_isThrower = $_isDistance = $_isJumper = 0;

            if (isset($_POST['isSprinter']) && $_POST['isSprinter'] == 'isSprinter'){
              $_isSprinter = 1;
            }
            if (isset($_POST['isThrower']) && $_POST['isThrower'] == 'isThrower'){
              $_isThrower = 1;
            }
            if (isset($_POST['isDistance']) && $_POST['isDistance'] == 'isDistance'){
              $_isDistance = 1;
            }
            if (isset($_POST['isJumper']) && $_POST['isJumper'] == 'isJumper'){
              $_isJumper = 1;
            }

            // Query used to update the account
            // update doesn't support SET () VALUES ()
            $updateQuery = "UPDATE Member SET firstName = '$_POST[firstName]', lastName = '$_POST[lastName]', email = '$_POST[email]', password = '$_POST[password]', isSprinter = $_isSprinter, isDistance = $_isDistance, isThrower = $_isThrower, isJumper = $_isJumper WHERE memberID = $_SESSION[memberID]";

            // Update account and send them to the homepage
            if (mysqli_query($db, $updateQuery)){

              if ($_POST['self-update'])
                echo("<meta http-equiv='refresh' content='0;url=../myAccount.php'>");
              else
                echo("<meta http-equiv='refresh' content='0;url=../accountManagement.php'>");
                
            } else
              echo "<h1>Query failed!</h1>";

        }
        // Otherwise just redirect them to the index page.
        else{
            echo("<meta http-equiv='refresh' content='0;url=../index.php'>");
        }
    ?>
<html>
