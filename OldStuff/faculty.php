<?php include 'helper/header.php'?>

			<!-- Start the script to populate the faculty list. -->
			<?php
			
			$facultyQueryResult = '';
			
			if(isset($_POST['search_faculty'])){
				echo"<div class = 'container text-center'>";
					//Store the first and last names, removing leading and trailing whitespace
					$first_name = trim($_POST['first_name']);
					$last_name = trim($_POST['last_name']);

					//First and Last Name Search
					if(strlen($first_name) > 0 && strlen($last_name) > 0){
						include 'helper/connect.php';
						$facultyQueryResult = mysqli_query($db, "SELECT first_name, last_name, user_id, position FROM user WHERE first_name = '$first_name' AND last_name = '$last_name' AND position != 'admin' AND position != 'student'");
						mysqli_close($db);
						echo"
						<div class='alert alert-success' role='alert'>
						   You searched for <q><strong><i>$first_name $last_name</i></strong></q>. To see all faculty please press <a href='faculty.php'>here</a>.
							<br><i>*Search is still in Beta, so an exact full name, or a single first or last name are required*</i>
						</div>";
					}
					
					//First Name Search
					elseif(strlen($first_name) > 0){
						include 'helper/connect.php';
						$facultyQueryResult = mysqli_query($db, "SELECT first_name, last_name, user_id, position FROM user WHERE first_name = '$first_name' AND position != 'admin' AND position != 'student'");
						mysqli_close($db);
						echo"
						<div class='alert alert-success' role='alert'>
						   You searched for <q><strong><i>$first_name</i></strong></q>. To see all faculty please press <a href='faculty.php'>here</a>.
							<br><i>*Search is still in Beta, so an exact full name, or a single first or last name are required*</i>
						</div>";
					}
					
					//Last Name Search
					elseif( strlen($last_name) > 0){
						include 'helper/connect.php';
						$facultyQueryResult = mysqli_query($db, "SELECT first_name, last_name, user_id, position FROM user WHERE last_name = '$last_name' AND position != 'admin' AND position != 'student'");
						mysqli_close($db);
						echo"
						<div class='alert alert-success' role='alert'>
						  You searched for <q><strong><i>$last_name</i></strong></q>. To see all faculty please press <a href='faculty.php'>here</a>.
							<br><i>*Search is still in Beta, so an exact full name, or a single first or last name are required*</i>
						</div>";					
					}
				
					//No Search
					else{
						include 'helper/connect.php';
						$facultyQueryResult = mysqli_query($db, "SELECT first_name, last_name, user_id, position FROM user WHERE position != 'admin' AND position != 'student' ORDER BY last_name ASC");
						mysqli_close($db);
						echo"
						<div class='alert alert-warning' role='alert'>
						  <strong>You failed to enter a first or last name</strong> We have displayed all faculty members for you. 
						</div>";
					}
				echo"</div>";	
			}
			
			//Return all faculty members.
			else{
				include 'helper/connect.php';
				$facultyQueryResult = mysqli_query($db, "SELECT first_name, last_name, user_id, position FROM user WHERE position != 'admin' AND position != 'student' ORDER BY last_name ASC");
				mysqli_close($db);
			}
			
			//Display the results
			echo"
			<!-- Start Container -->
			<div class='container bg-faded p-4 my-4'>
	  
			<!-- Create the faculty header -->
			<hr>
			<h1 class='text-center'> Our <strong>Faculty</strong></h1>
			<hr>
				<div class='row'>";		
			
			while($row = mysqli_fetch_array($facultyQueryResult, MYSQLI_BOTH)){
				
				echo"<div class='col-md-3'>
						<div class='card text-center'>
							
							<!-- Linked Name -->
							<div class='card-header'>
								<a href='moreinfo.php?faculty_id=$row[user_id]' class='card-link'><h3><strong> $row[first_name] $row[last_name] </strong></h3></a>
							</div>
							<!-- END Linked Name -->
						
							<!-- Image -->
							<img class='card-img-top' src='helper\images\\faculty\\$row[user_id].jpg'>

							
							<div class='card-block mt-1 mb-0'>
								<h3 class='card-title'><strong>$row[position]</strong></h3>
							</div>";
						
						if(isset($_SESSION['position']) && $_SESSION['position'] == 'student'){
							echo"<div class='card-footer'>
									<a href='update.php' class='btn btn-primary'>Make an Appointment!</a>
								</div>";
						}
						echo"</div>
					</div>";
						
			}
			?>
			
				</div>
				<!-- End the row -->
		
			</div>
			<!-- End Container -->

<?php include 'helper/footer.php'?>