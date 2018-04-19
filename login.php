
<html lang="en">
  <head>
  
    <!-- Check current session state -->
    <?php
      // Start the session
      session_start();

      // If the user is already logged in, redirect them to the index
  		if (isset($_SESSION['admin_Status'])){
        echo("<meta http-equiv='refresh' content='0;url=index.php'>");
  			exit;
  		}
    ?>		
    <!-- End Session State Check -->


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>WTC Login</title>

    <!-- Bootstrap core CSS -->
    <link href="helper/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="helper/signin.css" rel="stylesheet">
  </head>

  <body>

    <!-- Login Form -->
    <form class="form-signin" action='helper/loginHelper.php' name='login' method='post'>
    
      <div class="text-center mb-4">
        <img class="mb-4" src="helper/images/website/WTC-Logo-Updated-2015-white-cow.png">
      </div>

      <!-- Login Error Notification -->
      <?php
        // If the login attempt triggered an error, inform the user.
        if(isset($_GET['login_error'])){
          echo"
            <div class='form-lablel-group text-center alert alert-danger'>
              <strong>Incorrect Login Credentials</strong>
            </div>";
        }
      ?>
      <!-- END Login Error Notification -->

      <div class="form-label-group">
        <input type="email" id="inputEmail" class="form-control" name='email' placeholder="Email Address" required autofocus>
        <label for="inputEmail">Email Address</label>
      </div>

      <div class="form-label-group">
        <input type="password" id="inputPassword" class="form-control" name='password' placeholder="Password" required>
        <label for="inputPassword">Password</label>
      </div>
     

      <!--
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      -->



      <button class="btn btn-lg btn-success btn-block" type="submit" name='login' value='login'>Login</button>
      <a class="btn btn-lg btn-warning btn-block" href="signup.php" role="button">Sign Up!</a>

    </form>
    <!-- END Login Form -->

  </body>
</html>