<html lang="en">
    <!-- Check current session state -->
    <?php
    
        // Start the session
        session_start();
        
        // Otherwise, check if they are trying to log in.
        if($_POST['login']){
            // Connect to the database, run query, close connection
            include 'connect.php';		
            $result = mysqli_query($db,"SELECT member_ID,admin_Status,first_Name,last_Name,email FROM MEMBER WHERE email = '$_POST[email]' AND password = '$_POST[password]'");
            mysqli_close($db);

            //Verify that the there is a user and store the session data if so.
            if($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
                // Start the session, store data and go to index page
                session_start();
                $_SESSION['member_ID'] = $row['member_ID'];
                $_SESSION['admin_Status'] = $row['admin_Status'];
                $_SESSION['first_Name'] = $row['first_Name'];
                $_SESSION['last_Name'] = $row['last_Name'];
                $_SESSION['email'] = $row['email'];
                echo"<meta http-equiv='refresh' content='0;url=../index.php'>";
            }
            // Login credentails were wrong; inform the user.
            else echo"<meta http-equiv='refresh' content='0;url=../login.php?login_error=1'>";
        }
        // Otherwise, check if they are trying to log out
        else if($_POST['logout']){
            	session_destroy();
                echo("<meta http-equiv='refresh' content='0;url=../login.php'>");            
        }
        // Otherwise, check if they are trying to signup
        else if($_POST['signup']){
             // Verify that the email isn't taken already
            include 'connect.php';
            $result = mysqli_query($db,"SELECT * FROM MEMBER WHERE email = '$_POST[email]'");
            if(!$row = mysqli_fetch_array($result, MYSQLI_BOTH)){                
                // Query used to create the account
                $updateQuery = "INSERT INTO MEMBER (first_Name, last_Name, email, password) VALUES ('$_POST[first_Name]','$_POST[last_Name]','$_POST[email]','$_POST[password]')";

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
        // Otherwise just redirect them to the index page.
        else{
            echo("<meta http-equiv='refresh' content='0;url=../index.php'>");            
        }
    ?>		
<html>