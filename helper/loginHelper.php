<html>
	<?php
		//Check if the info was submitted
		if($_POST['login']){
            // Connect to the database
			include 'connect.php';		
            
            // Run the query
			$result = mysqli_query($db,"SELECT member_ID,admin_Status,first_Name,last_Name,email FROM MEMBER WHERE email = '$_POST[email]' AND password = '$_POST[password]'");
			
            // Close the connection to database
            mysqli_close($db);

			//Verify that the there is a user and store the session data if so.
			if($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
				session_start();
				$_SESSION['member_ID'] = $row['member_ID'];
				$_SESSION['admin_Status'] = $row['admin_Status'];
				$_SESSION['first_Name'] = $row['first_Name'];
				$_SESSION['last_Name'] = $row['last_Name'];
                $_SESSION['email'] = $row['email'];
                
                // Redirect back to the index after login is successful
				echo"<meta http-equiv='refresh' content='0;url=../index.php'>";
			}
            // No user with that info, re-direct back to login page
			else echo"<meta http-equiv='refresh' content='0;url=../index.php?login_error=1'>";
        }
        // No info was submitted, must have got to page by accident
		else echo("<meta http-equiv='refresh' content='0;url=login.php'>");
	?>
</html>