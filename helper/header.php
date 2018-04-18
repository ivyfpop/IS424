<!DOCTYPE html>
<html lang="en">

	<head>
		<!-- Check for login. -->
		<?php session_start(); ?>

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
				<div class='navbar-nav mx-auto'>
					<form class='form-inline' action='faculty.php' name='search_faculty' method='post'>
						<input class='form-control mr-3' type='text' placeholder='First Name' name='first_name'>
						<input class='form-control mr-3' type='text' placeholder='Last Name' name='last_name'>
						<button class='form-control btn btn-outline-warning' type='submit' name='search_faculty' value='search_faculty'>Search Faculty!</button>
					</form>
				</div>
					
				<!-- Right Nav Bar -->				
				<div class='navbar-nav ml-auto'>
					<?php
					if(isset($_SESSION['position'])){
						 echo"<a class='nav-link btn btn-outline-warning mr-3' href='update.php'>Control Panel</a>
						 <a class='nav-link btn btn-outline-danger' href='helper/logout.php'>Logout</a>";
					}else{
						echo"<form class='form-inline' action='helper/login.php' name='login' method='post'>
								<input class='form-control mr-sm-1' type='username' placeholder='Username' name='username'>
								<input class='form-control mr-sm-1' type='password' placeholder='Password' name='password'>
								<button class='btn btn-outline-success' type='submit' name='login' value='login'>Login</button>
							</form>";
					}?>
				</div>
				<!-- END Right Nav Bar -->
				
			</div>
		</nav>
		<!-- END of Navigation Bar -->
		
		<!-- Login-Error -->
		<?php 
		if(isset($_GET['login_error']) AND !isset($_SESSION['position'])){
			echo"<div class='container text-center alert alert-danger'>
					<strong>You have entered your username or password incorrectly.</strong>
				</div>";
		}
		?>		
		<!-- END login-Error -->
	</head>
	<body>