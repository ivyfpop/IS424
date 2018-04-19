
<html lang="en">
  <head>
  
    <!-- Check current session state -->
    <?php
        // If the user is already logged in, redirect them to the index
		if (isset($_SESSION['admin_Status'])){
            echo("<meta http-equiv='refresh' content='0;url=login.php'>");
			exit;
		}
        // Determine if the user entered the information correctly 
		else if(isset($_GET['login_error'])){
			echo"<div class='container text-center alert alert-danger'>
					<strong>You have entered your username or password incorrectly.</strong>
				</div>";
		}
        // Log the user in
        else{
            
        }
    ?>		
    <!-- End Session State Check -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>UW Track Club Management System</title>

    <!-- Bootstrap core CSS -->
    <link href="helper/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="helper/signin.css" rel="stylesheet">
  </head>

  <body>
    <form class="form-signin" action='helper/loginHelper.php' name='login' method='post'>
    
      <div class="text-center mb-4">
        <img class="mb-4" src="helper/images/website/WTC-Logo-Updated-2015-white-cow.png">
      </div>

      <div class="form-label-group">
        <input type="email" id="inputEmail" class="form-control" name='email' required autofocus>
        <label for="inputEmail">Email Address</label>
      </div>

      <div class="form-label-group">
        <input type="password" id="inputPassword" class="form-control" name='password'  required>
        <label for="inputPassword">Password</label>
      </div>
     <!--
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      -->
      </div>
      <button class="btn btn-lg btn-success btn-block" type="submit" name='login' value='login'>Login</button>
    </form>
  </body>
</html>