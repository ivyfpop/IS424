<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Check for login. -->
		<?php 
			// Start the session
			session_start();
            
            // Log out
            if (isset($_GET["logout"])){
            	session_destroy();
            }

            // If the user is not logged in, redirect them to the login page.
            if (!isset($_SESSION['member_ID'])){
                echo("<meta http-equiv='refresh' content='0;url=login.php'>");
            }
        ?>
        <!-- END Login Check -->

		<!-- meta values -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- END meta values-->

		<!-- Bootstrap / Core CSS -->
		<link href="helper/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">
		<link href="helper/styles.css" rel="stylesheet">
		<!-- End Bootstrap / Core CSS -->

		
		<!-- navigation bar -->
		<nav class='navbar navbar-expand navbar-dark bg-dark'>

			<!-- Menu options for devices with small screens -->
			<button class='navbar-toggler navbar-toggler-right' type='button' data-toggle='collapse' data-target='#navbarNavAltMarkup' aria-controls='navbarNavAltMarkup' aria-expanded='false' aria-label='Toggle navigation'>
				<span class='navbar-toggler-icon'></span>
			</button>
			
			<!-- Brand Logo -->
			<a class='navbar-brand' href='index.php'><img src='/helper/images/website/college_logo.png'></a>
		
			<div class='collapse navbar-collapse'>
				
				<!-- Left Nav Bar -->
				<div class='navbar-nav'>
					<a class='nav-link btn btn-outline-info' href='index.php'>Home</a>
					<a class='nav-link btn btn-outline-info ml-3 disabled' href=''>Department</a>
					<a class='nav-link btn btn-outline-info ml-3' href='faculty.php'>Faculty</a>

					</div>
				<!-- END Left Nav Bar -->
                
				<!-- Right Nav Bar -->	                
				<div class='navbar-nav mx-auto'>
					<form class='form-inline' action='faculty.php' name='search_faculty' method='post'>
						<input class='form-control mr-3' type='text' placeholder='First Name' name='first_name'>
						<input class='form-control mr-3' type='text' placeholder='Last Name' name='last_name'>
						<button class='form-control btn btn-outline-warning' type='submit' name='search_faculty' value='search_faculty'>Search Faculty!</button>
					</form>
				</div>
                			
				<div class='navbar-nav ml-auto'>
                    <a class='nav-link btn btn-outline-warning mr-3' href='update.php'>Control Panel</a>
                    <a class='nav-link btn btn-outline-danger' href='index.php?logout=1'>Logout</a>
				</div>
				<!-- END Right Nav Bar -->
									
			</div>
		</nav>
		<!-- END of Navigation Bar -->
	</head>