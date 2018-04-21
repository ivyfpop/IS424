<html lang="en">
    <!-- Dependencies -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="helper/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="helper/css/login.css" rel="stylesheet">
    <!-- END Dependencies -->
    
    <head>
	<!-- Input Handling -->
    <?php
        // If the user is logged in, redirect them to the home page
        if (isset($_SESSION['member_ID'])){
            echo("<meta http-equiv='refresh' content='0;url=index.php'>");
        }
		//Handles basic user sign up
		else if (isset($_POST['signup'])){

            // Verify that the email isn't taken already
            include 'helper/connect.php';
            $result = mysqli_query($db,"SELECT * FROM MEMBER WHERE email = '$_POST[email]'");
            if(!$row = mysqli_fetch_array($result, MYSQLI_BOTH)){

                // Create the account
                
                /*
                // Query used to create the account
                $updateQuery = "INSERT INTO MEMBER (grade_level,first_Name,last_Name,email,password)
                                VALUES($_POST[first_name],$_POST[last_name],$_POST[email],$_POST[password])";

                // Create account and send them to the homepage
                mysqli_query($db, $updateQuery); */
                echo("<meta http-equiv='refresh' content='0;url=login.php?new_account=1'>");
                exit();
			}
            // If the email is already taken inform the user.
            else{
                echo("<meta http-equiv='refresh' content='0;url=signup.php?account_error=1'>");
                exit();
            }
		}
	?>
    </head>
    
	<body>
        <form class="form-signin" action='signup.php' name='signup' method='post'>

            <div class="text-center mb-4">
                <img class="mb-4" src="helper/images/website/WTC-Logo-Updated-2015-white-cow.png">
            </div>
            
             <?php
                // Email is already in use.
                if(isset($_GET['account_error'])){
                    echo"
                    <div class='form-lablel-group text-center alert alert-danger'>
                        <strong>That email is already in use!</strong>
                    </div>";
                }
            ?>
           

            <div class="form-label-group">
                <input type="text" id="inputFirstName" class="form-control" name='first_Name' placeholder="First Name" required autofocus>
                <label for="inputFirstName">First Name</label>
            </div>

            <div class="form-label-group">
                <input type="text" id="inputLastName" class="form-control" name='last_Name' placeholder="Last Name" required autofocus>
                <label for="inputLastName">Last Name</label>
            </div>
            
            <div class="form-label-group">
                <input type="email" id="inputEmail" class="form-control" name='email' placeholder="Email Address" required autofocus>
                <label for="inputEmail">Email Address</label>
            </div>
            
            <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control" name='password' placeholder="Password" required>
                <label for="inputPassword">Password</label>
            </div>
            
            <button class="btn btn-lg btn-success btn-block" type="submit" name='signup' value='login'>Create Account</button>
            <br>

            <a class="btn btn-lg btn-warning btn-block" href="login.php" role="button">Back to Login</a>
        </form>
    <body>
</html>