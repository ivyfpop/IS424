<html lang="en">
    <!-- Check current session state -->
    <?php     
        // If they are logging in
        if(isset($_POST['login'])){
            // Connect to the database, run query, close connection
            include 'connect.php';
            $result = mysqli_query($db,"SELECT memberID,adminStatus,firstName,lastName,email,driverAuthorizationDate FROM Member WHERE email = '$_POST[email]' AND password = '$_POST[password]'");
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
                $_SESSION['email'] = $row['email'];
                $_SESSION['driverAuthorizationDate'] = $row['driverAuthorizationDate'];
                // Determine the member is registered for the current season
                include 'connect.php';
                $registeredResult = mysqli_query($db,"SELECT * FROM Registered_Member WHERE memberID = '$row[memberID]' ORDER BY registeredSeason DESC LIMIT 1");
                mysqli_close($db);
                // Current season is hard coded right now. Will need to create season table in the database.
                if($registeredResult->num_rows == 1 && !strcmp($row['registeredSeason'],"2017-2018")){
                    $_SESSION['registeredSeason'] = $row['registeredSeason'];
                    $_SESSION['fallDuesDate'] = $row['registeredSeason'];
                    $_SESSION['springDuesDate'] = $row['springDuesDate'];
                    $_SESSION['liabilityFormDate'] = $row['liabilityFormDate'];
                    $_SESSION['healthFormDate'] = $row['healthFormDate'];
                }
                
                header('Location: http://track.finkmp.com');
            }
            // Login credentials were wrong; inform the user.
            else{
                header('Location: http://track.finkmp.com/login.php?login_error=1');
            }
        }
        // Check if they are trying to log out
        else if(isset($_POST['logout'])){
                session_start();
            	session_destroy();
                header('Location: http://track.finkmp.com/login.php?logout=1');
        }
        // Check if they are trying to sign up
        else if(isset($_POST['signup'])){
             // Verify that the email isn't taken already
            include 'connect.php';
            $result = mysqli_query($db,"SELECT * FROM Member WHERE email = '$_POST[email]'");
            if(!$row = mysqli_fetch_array($result, MYSQLI_BOTH)){
                // Query used to create the account
                $db->query("INSERT INTO Member (firstName, lastName, email, password) VALUES ('$_POST[firstName]','$_POST[lastName]','$_POST[email]','$_POST[password]')");
                mysqli_close($db);
                header('Location: http://track.finkmp.com/login.php?new_account=1');
            }
            // If the email is already taken inform the user.
            else{
                header('Location: http://track.finkmp.com/signup.php?account_error=1');
            }
        }
        // Check if they are trying to update their account.
        else if(isset($_POST['self-update']) || isset($_POST['admin-update'])){

            include 'connect.php';
            session_start();
            
            $isSprinter = $isThrower = $isDistance = $isJumper = 0;

            if (isset($_POST['isSprinter'])) $isSprinter = 1;
            if (isset($_POST['isThrower'])) $isThrower = 1;
            if (isset($_POST['isDistance'])) $isDistance = 1;
            if (isset($_POST['isJumper'])) $isJumper = 1;

            // Query used to update the account
            // update doesn't support SET () VALUES ()
            $updateQuery = "UPDATE Member SET firstName = '$_POST[firstName]', lastName = '$_POST[lastName]', email = '$_POST[email]', password = '$_POST[password]', isSprinter = $isSprinter, isDistance = $isDistance, isThrower = $isThrower, isJumper = $isJumper WHERE memberID = $_SESSION[memberID]";

            // Update account and send them to the homepage
            if (mysqli_query($db, $updateQuery)) {
                //Stuff
            }

            if (isset($_POST['self-update'])) {
                $_SESSION['firstName'] = $_POST['firstName'];
                $_SESSION['lastName'] = $_POST['lastName'];
                $_SESSION['email'] = $_POST['email'];
                header('Location: http://track.finkmp.com/myAccount.php');
            } else if (isset($_POST['admin-update'])){
              header('Location: http://track.finkmp.com/accountManagement.php');
            }

        }
        // Otherwise just redirect them to the index page.
        else{
            header('Location: http://track.finkmp.com');
        }
    ?>
<html>
