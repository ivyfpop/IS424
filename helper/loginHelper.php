<html>
	<?php

		//Check if the info was submitted
		if($_POST['login']){

			include 'connect.php';		
			$result = mysqli_query($db,"SELECT user_id,first_name, last_name, position FROM user WHERE username = '$_POST[username]' AND password = '$_POST[password]'");
			mysqli_close($db);

			//Verify that the there is a user and store the session data if so.
			if($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
				session_start();
				$_SESSION['position'] = $row['position'];
				$_SESSION['user_id'] = $row['user_id'];
				$_SESSION['first_name'] = $row['first_name'];
				$_SESSION['last_name'] = $row['last_name'];
				echo"<meta http-equiv=Refresh content= 0;url=../index.php>";
			}
			else echo"<meta http-equiv=Refresh content= 0;url=../index.php?login_error=1>";
		}
		else echo"<meta http-equiv=Refresh content=0;url=../index.php>";

	?>
</html>