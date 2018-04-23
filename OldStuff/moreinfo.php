<?php include 'helper/header.php' ?>

	<!-- Start Container -->
	<div class='container bg-faded p-4 my-4'>
		
		<!-- Start Script -->
		<?php
		
			//No selected faculty member.
			if(!isset($_GET['faculty_id']) || $_GET['faculty_id'] == ''){
				echo"<meta http-equiv=Refresh content= 0;url=index.php>";
				exit();
			}
			
			//Run and store the query to gather the main information about the faculty member
			include 'helper/connect.php';
			$faculty_result = mysqli_query($db, "SELECT username, first_name, last_name, position, department, office, phone, description FROM user WHERE user_id = $_GET[faculty_id]");
			mysqli_close($db);
			
			//Verify that there is a faculty member.
			if($row = mysqli_fetch_array($faculty_result, MYSQLI_BOTH)){				

				echo("	
				<!-- Holds name -->
				<hr class='divider'>
					<h2 class='text-center text-lg text-uppercase my-0'><strong> $row[first_name] $row[last_name]</strong></h2>
				<hr class='divider'>
				<!-- End -->
				
				
				<!-- Holds picture -->
				<img class='mx-auto d-block text-center' src='helper\images\\faculty\\$_GET[faculty_id].jpg'>  
				<!-- End -->


				<!-- Hold basic details -->
				<h4 class='card-title m-0 text-center'>
					<br> $row[position]
					<br> $row[department]
					<br>Office: <medium class='text-muted'>$row[office]</medium>
					<br>Phone: <medium class='text-muted'>$row[phone]</medium>
					<br>Email: <medium class='text-muted'>$row[username]@wisc.edu</medium>												
				</h4>
				<!-- End -->
				
				<!-- Holds the brief description -->
				<hr class='divider'>
				<center> $row[description] </center>
				<hr class='divider'>
				<!-- End -->
				");
	
				$items = array("Education", "Publications", "Conferences", "Research", "Courses"); //Could make this dynamic like inside update.
	
				//Creates a list for each type of "item" faculty member has.
				foreach($items as $item){
					
					//Run a query to gather the info needed for this category
					include 'helper/connect.php';
					$result = mysqli_query($db, "SELECT description FROM item WHERE faculty_id = $_GET[faculty_id] AND category = '$item' AND active = 1 ORDER BY display_order ASC");
					mysqli_close($db);
					
					//Verify there are items in this row.
					if(mysqli_num_rows($result)){
						
						//Displays the info gathered in a list.
						echo("
						<h3 class='card-title'>$item</h3>
							<ul class='list-group list-group-flush'>");
								while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
									//$description = $row[description];
									echo("<li class='list-group-item'>$row[description]</li>");
								}
						echo("</ul></br>");
					}
				
				}
			}
			else{
				echo"<meta http-equiv=Refresh content= 0;url=index.php>";
				exit();
			}
		?>
		<!-- END Script -->
	</div>
	<!-- END Container -->
	
<?php include 'helper/footer.php'?>