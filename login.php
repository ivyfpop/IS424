<!DOCTYPE html>
<html lang="en">

    <title>WTC Login</title>

    <!-- Check current session state -->
    <?php
        // Verify the user is NOT logged in.
        session_start();
        if (isset($_SESSION['memberID'])){
            header('Location: http://track.finkmp.com');
        }
    ?>		
    <!-- End Session State Check -->

    <!-- Dependencies -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="helper/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="helper/css/login.css" rel="stylesheet">
    <!-- END Dependencies -->

    <body>
    
        <!-- Login Form -->
        <form class="form-signin" action='helper/accountHelper.php' name='login' method='post'>

            <div class="text-center mb-4">
                <img class="mb-4" src="helper/images/website/WTC-Logo-Updated-2015-white-cow.png">
            </div>
        
            <?php
                // Login error message.
                if(isset($_GET['login_error'])){
                    echo"
                    <div class='form-label-group text-center alert alert-danger'>
                        <strong>Incorrect Login Credentials!</strong>
                    </div>";
                }
                // New Account successful creation message.
                else if(isset($_GET['new_account'])){
                     echo"
                    <div class='form-label-group text-center alert alert-success'>
                        <strong>Please log to finish account creation!</strong>
                    </div>";
                   
                }
                // Logout successful message.
                else if(isset($_GET['logout'])){
                    echo"
                    <div class='form-label-group text-center alert alert-warning'>
                        <strong>You have been successfully logged out.</strong>
                    </div>";
                } 
            ?>
            
            <div class="form-label-group">
                <input type="email" id="inputEmail" class="form-control" name='email' placeholder="Email Address" required autofocus>
                <label for="inputEmail">Email Address</label>
            </div>

            <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control" name='password' placeholder="Password" required>
                <label for="inputPassword">Password</label>
            </div>
            
            <button class="btn btn-lg btn-success btn-block" type="submit" name='login'>Login</button>

            <a class="btn btn-lg btn-warning btn-block" href="signup.php" role="button">Sign Up!</a>

        </form>
        <!-- END Login Form -->

    </body>
    <?php include 'helper/footer.php' ?>
</html>