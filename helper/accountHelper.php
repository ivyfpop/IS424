<html lang="en">
    <!-- Check current session state -->
    <?php     
        // If they are logging in
        if(isset($_POST['login'])){
            // Connect to the database, run query, close connection
            include 'connect.php';
            $memberResult = mysqli_query($db,"SELECT memberID,adminStatus,driverAuthorizationDate FROM Member WHERE email = '$_POST[email]' AND password = '$_POST[password]'");

            //Verify that the there is a user and store the session data if so.
            if($row = mysqli_fetch_array($memberResult, MYSQLI_BOTH)){
                // Start the session, store data and go to index page
                session_start();

                // Store the memberID
                $_SESSION['memberID'] = $row['memberID'];

                // Store the adminStatus if they are an admin.
                if($row['adminStatus']){
                    $_SESSION['adminStatus'] = $row['adminStatus'];
                }

                // Store the driverAuthorizationDate if they are an authorized Driver.
                if($row['driverAuthorizationDate']){
                    $_SESSION['driverAuthorizationDate'] = $row['driverAuthorizationDate'];
                }

                // Current season is hard coded right now. Will need to create season table in the database.
                $registeredResult = mysqli_query($db,"SELECT * FROM Registered_Member WHERE memberID = '$row[memberID]' ORDER BY registeredSeason DESC LIMIT 1");
                mysqli_close($db);
                if($row = mysqli_fetch_array($registeredResult, MYSQLI_BOTH) && !strcmp($row['registeredSeason'],"2017-2018")){
                    $_SESSION['fallDuesDate'] = $row['registeredSeason'];
                    $_SESSION['springDuesDate'] = $row['springDuesDate'];
                    $_SESSION['liabilityFormDate'] = $row['liabilityFormDate'];
                    $_SESSION['healthFormDate'] = $row['healthFormDate'];
                }

                // Send them to the home page
                header('Location: http://track.finkmp.com');
            }
            // Login credentials were wrong, redirect to login.
            else{
                header('Location: http://track.finkmp.com/login.php?login_error=1');
            }
        }
        // Logging user out.
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

            session_start();
            /*
            $isSprinter = $isThrower = $isDistance = $isJumper = 0;

            if (isset($_POST['isSprinter'])) $isSprinter = 1;
            if (isset($_POST['isThrower'])) $isThrower = 1;
            if (isset($_POST['isDistance'])) $isDistance = 1;
            if (isset($_POST['isJumper'])) $isJumper = 1;*/

            // Update account and send them to the homepage
            include 'connect.php';
            $updateQuery = "UPDATE Member SET firstName = '$_POST[firstName]', lastName = '$_POST[lastName]', email = '$_POST[email]', password = '$_POST[password]', isSprinter = '$_POST[isSprinter]', isDistance = '$_POST[isDistance]', isThrower = '$_POST[isThrower]', isJumper = '$_POST[isJumper]' WHERE memberID = $_SESSION[memberID]";
            mysqli_query($db, $updateQuery)
            mysqli_close();

            // Redirect them back to their respective pages based on status.
            if (isset($_POST['self-update'])) {
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
