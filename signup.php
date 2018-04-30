<html lang="en">
    <!-- Dependencies -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="helper/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="helper/css/login.css" rel="stylesheet">
    <!-- END Dependencies -->

    <title>Signup</title>

    <?php
        // Verify the user is NOT logged in.
        session_start();
        if (isset($_SESSION['memberID'])){
            header('Location: http://track.finkmp.com');
        }
	?>
    
	<body>
        <form class="form-signin" action='helper/accountHelper.php' name='signup' method='post'>

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
                <input type="text" id="inputFirstName" class="form-control" name='firstName' placeholder="First Name" required autofocus>
                <label for="inputFirstName">First Name</label>
            </div>

            <div class="form-label-group">
                <input type="text" id="inputLastName" class="form-control" name='lastName' placeholder="Last Name" required autofocus>
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
            <a class="btn btn-lg btn-warning btn-block" href="login.php" role="button">Back to Login</a>
        </form>
    <body>
        
    <?php include 'helper/footer.php' ?>    
</html>