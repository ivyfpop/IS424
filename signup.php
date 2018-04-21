<html lang="en">

	<!-- Input Handling -->
    <?php
        // If the user is not logged in, redirect them to the login page.
        if (!isset($_SESSION['member_ID'])){
            echo("<meta http-equiv='refresh' content='0;url=login.php'>");
        }
		//Handles basic user sign up
		else if(isset($_POST['signup'])){

            // Verify that the email isn't taken already
            include 'helper/connect.php';
            $result = mysqli_query($db,"SELECT * FROM MEMBER WHERE email = '$_POST[email]'");
            if(!$row = mysqli_fetch_array($result, MYSQLI_BOTH)){
                // Create Session and store info
                session_start();
                $_SESSION[grade_level] = $_POST[grade_level];
                $_SESSION[first_name] = $_POST[first_name];
                $_SESSION[last_name] = $_POST[last_name];
                $_SESSION[email] = $_POST[email];
                $_SESSION[password] = $_POST[password];

                // Query used to create the account
                $updateQuery = "INSERT INTO MEMBER (grade_level,first_Name,last_Name,email,password)
                                VALUES('$_SESSION[grade_level','$_SESSION[first_name]','$_SESSION[last_name]','$_SESSION[email]','$_SESSION[password]')";

                // Create account and send them to the homepage
                mysqli_query($db, $updateQuery);
                echo("<meta http-equiv='refresh' content='0;url=index.php?new_account=1'>");
                exit();
			}
            // If the email is already taken inform the user.
            else{
                echo("<meta http-equiv='refresh' content='0;url=signup.php?account_error=1'>");
                exit();
            }
		}
        // Email already in use notification
        else if (isset($_GET[account_error])){
            echo"
            <div class='container text-center'>
                <div class='alert alert-danger' role='alert'>
                  <strong>That email is already in use! </strong>
                </div>
            </div>";
        }
	?>
	<!-- END Input Handling -->
	<body>
	<div class='container bg-faded p-4 my-4'>

		<!-- Form the gathers the user's Basic Information -->
		<center><h1>Update Basic Information</h1></center>
		<form action='update.php' class='container' name='basicUpdate' method='post'>
			<div class='row'>
				<div class='form-group mx-auto'>
					<label for='username'>Username:</label>
					<input type='text' class='form-control' value='' name='username'>
				</div>

				<div class='form-group mx-auto'>
					<label for='password'>Password:</label>
					<input type='password' class='form-control' value='' name='password'>
				</div>

				<div class='form-group mx-auto'>
					<label for='first_name'>First Name:</label>
					<input type='text' class='form-control' value='' name='first_name'>
				</div>

				<div class='form-group mx-auto'>
					<label for='last_name'>Last Name:</label>
					<input type='text' class='form-control' value='' name='last_name'>
				</div>
			</div>



                <div class ='row'>
					<div class='form-group mx-auto'>
						<label for='position'>Position:</label>
						<input type='text' class='form-control' value='' name='position'>
					</div>

					<div class='form-group mx-auto'>
						<label for='department'>Department:</label>
						<input type='text' class='form-control' value='' name='department'>
					</div>

					<div class='form-group mx-auto'>
						<label for='office'>Office:</label>
						<input type='text' class='form-control' value='' name='office'>
					</div>

					<div class='form-group mx-auto'>
						<label for='phone'>Phone:</label>
						<input type='tel' class='form-control' value='' name='phone'>
					</div>
				</div>

				<div class='col'>
					<div class ='form-group mx-auto'>
							<label for='description'>Description:</label>
							<textarea id='description' class='form-control' name='description'></textarea>
					</div>
				</div>

					<input type='hidden' value='$user[position]' name='position'>
					<input type='hidden' value='$user[department]' name='department'>
					<input type='hidden' value='$user[office]' name='office'>
					<input type='hidden' value='$user[phone]' name='phone'>
					<input type='hidden' value='$user[description]' name='description'>
					
				<div class='row'>
						<button type='submit' name='basic_update' value='basic_update' class='btn btn-primary mx-auto'>Update Basic Info!</button>
				</div>
		</form>
		<!-- END Basic Information -->";

<?php include 'helper/footer.php'?>
