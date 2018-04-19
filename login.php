
<html lang="en">
  <head>
    <?php
        // If the user is already logged in, redirect them to the index
		if(isset($_SESSION['admin_Status'])){
			echo("<meta http-equiv=Refresh content= 0;url=index.php>");
			exit;
		}
        // Determine if the user entered the information correctly
		else if(isset($_GET['login_error']) AND !isset($_SESSION['position'])){
			echo"<div class='container text-center alert alert-danger'>
					<strong>You have entered your username or password incorrectly.</strong>
				</div>";
		}
		?>		
		<!-- END login-Error -->        
    ?>
  
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
    <form class="form-signin">
      <div class="text-center mb-4">
        <img class="mb-4" src="helper/images/website/WTC-Logo-Updated-2015-white-cow.png">
      </div>

      <div class="form-label-group">
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputEmail">Email address</label>
      </div>

      <div class="form-label-group">
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <label for="inputPassword">Password</label>
      </div>

      <div class="checkbox mb-3">
      <!--
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      -->
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign In</button>
      <p class="mt-5 mb-3 text-muted text-center">IS 424 &copy; 2017-2018</p>
    </form>
  </body>
</html>