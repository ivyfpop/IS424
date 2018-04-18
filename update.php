<?php include 'helper/header.php' ?>
	
	<!-- Input Handling -->
	<div class='container text-center'>
	<?php
		//User must be logged in.
		if(!isset($_SESSION['position'])){
			echo("<meta http-equiv=Refresh content= 0;url=index.php>");
			exit;
		}		
		//Handles basic information update
		elseif(isset($_POST['basic_update'])){
			
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$position = $_POST['position'];
			$department = $_POST['department'];
			$office = $_POST['office'];
			$phone = $_POST['phone'];
			$description = $_POST['description'];
			$user_id = $_SESSION['user_id'];
			
			//Query used to update the main form variables.
			$updateQuery = "UPDATE  user 
							SET  	first_name = '$first_name', 
									last_name = '$last_name', 
									position = '$position',
									department = '$department',
									office = '$office',
									phone = '$phone',
									description = '$description'
									WHERE	user_id= '$user_id'";

			//Run the update query
			include 'helper/connect.php';		
			mysqli_query($db, $updateQuery);
			mysqli_close($db);
			
			//Display a successful message
			echo"
			<div class='alert alert-success' role='alert'>
			  <strong>Well done!</strong> You have successfully updated your basic information
			</div>";
		}
		//Handles item adding
		elseif(isset($_POST['addItem'])){

			//Store the variables needed
			$faculty_id = $_SESSION['user_id'];
			$category = $_POST['category'];
			$description = $_POST['description'];

			
			include 'helper/connect.php';		
			$display_order = mysqli_num_rows(mysqli_query($db, "SELECT item_id FROM item WHERE faculty_id = '$faculty_id' AND category ='$category' AND active = 1")) + 1;

			$addItemQuery = "INSERT INTO item (faculty_id, category, description, display_order) VALUES ($faculty_id,'$category', '$description', $display_order)";
			include 'helper/connect.php';		
			mysqli_query($db, $addItemQuery);
			mysqli_close($db);
			
			//Display a successful message
			echo"
			<div class='alert alert-success' role='alert'>
			  <strong>Well done!</strong> You have successfully added an item to $category.
			</div>";

		}
		//Handles item deleting
		elseif(isset($_POST['deleteItem'])){
			
			//Gather info needed about item to be deleted, then delete it.
			$deletedItem_item_id = $_POST['item_id'];
			include 'helper/connect.php';		
			$item = mysqli_fetch_array(mysqli_query($db, "SELECT category, display_order FROM item where item_id = $deletedItem_item_id"), MYSQLI_BOTH);
			mysqli_query($db, "DELETE FROM item WHERE item_id = $deletedItem_item_id");
			$category = $item['category'];
			$deletedItem_display_order = $item['display_order'];
			
			//Gather the user's id
			$faculty_id = $_SESSION['user_id'];
			
			//List of all user's items effected by delete.
			$activeItemsLeft = mysqli_query($db, "SELECT item_id, display_order FROM item WHERE faculty_id = $faculty_id AND category ='$category' AND active = 1");
			
			//Decrement the display orders of any item that was after this one.
			while($activeItem = mysqli_fetch_array($activeItemsLeft, MYSQLI_BOTH)){
				$activeItem_id = $activeItem['item_id'];
				$activeItem_display_order = $activeItem['display_order'];
				if($deletedItem_display_order < $activeItem_display_order){
						$activeItem_display_order--;
						mysqli_query($db, "UPDATE item SET display_order = $activeItem_display_order WHERE item_id = $activeItem_id");
				}
			}
			mysqli_close($db);
			
			//Display a successful message
			echo"
			<div class='alert alert-success' role='alert'>
			  <strong>Well done!</strong> You have successfully deleted an item from $category.
			</div>";
		
		}
		//Handles item activation
		elseif(isset($_POST['activateItem'])){
			
			//Gather info needed about item to be activated
			$item_id = $_POST['item_id'];
			include 'helper/connect.php';		
			$item = mysqli_fetch_array(mysqli_query($db, "SELECT category FROM item where item_id = $item_id"), MYSQLI_BOTH);
			$category = $item['category'];
			
			//Gather the user's id
			$faculty_id = $_SESSION['user_id'];

			//Current amount of active items
			$display_order = mysqli_num_rows(mysqli_query($db, "SELECT item_id FROM item WHERE faculty_id = '$faculty_id' AND category ='$category' AND active = 1")) + 1;

			
			mysqli_query($db, "UPDATE item SET active = 1, display_order =  $display_order WHERE item_id = $item_id");

			mysqli_close($db);
			
			//Display a successful message
			echo"
			<div class='alert alert-success' role='alert'>
			  <strong>Well done!</strong> You have successfully activated an item from $category.
			</div>";			
		}
		//Handles item deactivation 
		elseif(isset($_POST['deactivateItem'])){
			
			//Gather info needed about item to be deactivated
			$item_id = $_POST['item_id'];
			include 'helper/connect.php';
			$item = mysqli_fetch_array(mysqli_query($db, "SELECT category, display_order FROM item where item_id = $item_id"), MYSQLI_BOTH);
			$category = $item['category'];
			$display_order = $item['display_order'];
			mysqli_query($db, "UPDATE item SET active = 0, display_order = 0 WHERE item_id = $item_id");
			
			//Gather the user's id
			$faculty_id = $_SESSION['user_id'];
			
			//List of all currently active items
			$activeItemsLeft = mysqli_query($db, "SELECT item_id, display_order FROM item WHERE faculty_id = $faculty_id AND category ='$category' AND active = 1");
			
			//Decrement the display orders of any item that was after this one.
			while($activeItem = mysqli_fetch_array($activeItemsLeft, MYSQLI_BOTH)){
				$activeItem_id = $activeItem['item_id'];
				$activeItem_display_order = $activeItem['display_order'];
				if($display_order < $activeItem_display_order){
						$activeItem_display_order--;
						mysqli_query($db, "UPDATE item SET display_order = $activeItem_display_order WHERE item_id = $activeItem_id");
				}
			}
		}
		//Handles faculty appointment adding
		elseif(isset($_POST['addAppointment'])){
			
			//Info needed to make the appointment.
			$faculty_id = $_SESSION['user_id'];
			$start_date = $_POST['start_date'];
			$end_date = $_POST['end_date'];
			$student_id = $_POST['student_id'];
			$description = $_POST['description'];
		
			echo(" The values are $faculty_id $start_date $end_date $student_id $description");

			
			//Create the appointment
			include 'helper/connect.php';
			mysqli_query($db,"INSERT INTO appointment('faculty_id', 'student_id', 'start_date', 'end_date', 'description') VALUES ($faculty_id, $student_id, '$start_date', '$end_date', '$description')");
			mysqli_close($db);
			
			//Display a successful message
			echo"
			<div class='alert alert-success' role='alert'>
			  <strong>Well done!</strong> You have successfully created an appointment for $start_date - $end_date.
			</div>";			
		}
		//Handles faculty appointment deleting
		elseif(isset($_POST['deleteAppointment'])){
			
			$appointment_id = $_POST['appointment_id'];
		
			//Delete the appointment
			include 'helper/connect.php';
			mysqli_query($db, "DELETE FROM appointment WHERE appointment_id = $appointment_id");
			mysqli_close($db);
			
			//Display a successful message
			echo"
			<div class='alert alert-success' role='alert'>
			  <strong>Well done!</strong> You have successfully deleted an appointment.
			</div>";			
		}
		//Handles student appointment adding
		elseif(isset($_POST['joinAppointment'])){
			
			$student_id = $_SESSION['user_id'];
			$appointment_id = $_POST['appointment_id'];
		
			//Join the appointment
			include 'helper/connect.php';
			mysqli_query($db, "UPDATE appointment SET student_id = $student_id WHERE appointment_id = '$appointment_id'");
			mysqli_close($db);
			
			//Display a successful message
			echo"
			<div class='alert alert-success' role='alert'>
			  <strong>Well done!</strong> You have successfully added an appointment.
			</div>";			
		}				
		//Handles student appointment removal
		elseif(isset($_POST['leaveAppointment'])){
			
			$appointment_id = $_POST['appointment_id'];
			
			//Join the appointment
			include 'helper/connect.php';
			mysqli_query($db, "UPDATE appointment SET student_id = 0 WHERE appointment_id = '$appointment_id'");
			mysqli_close($db);
			
			//Display a successful message
			echo"
			<div class='alert alert-success' role='alert'>
			  <strong>Well done!</strong> You have successfully removed an appointment.
			</div>";			
		}
	?>
	</div>
	<!-- END Input Handling -->
		
	<!-- Forms -->
	<div class='container bg-faded p-4 my-4'>
	
	<!-- Basic Information -->
	<?php
		
		$user_id = $_SESSION['user_id'];
		
		//Run and store the query to gather the main information about the faculty member
		include 'helper/connect.php';
		$result = mysqli_query($db, "SELECT * FROM user WHERE user_id = '$user_id'");
		mysqli_close($db);
		$user = mysqli_fetch_array($result, MYSQLI_BOTH);
	
		echo"
		<!-- Form the gathers the user's Basic Information -->
		<center><h1>Update Basic Information</h1></center>	
		<form action='update.php' class='container' name='basicUpdate' method='post'>
			<div class='row'>
				<div class='form-group mx-auto'>
					<label for='username'>Username:</label>
					<input type='text' class='form-control' value='$user[username]' name='username'>
				</div>
				
				<div class='form-group mx-auto'>
					<label for='password'>Password:</label>
					<input type='password' class='form-control' value='$user[password] name='password'>
				</div>
				
				<div class='form-group mx-auto'>
					<label for='first_name'>First Name:</label>
					<input type='text' class='form-control' value='$user[first_name]' name='first_name'>
				</div>

				<div class='form-group mx-auto'>
					<label for='last_name'>Last Name:</label>
					<input type='text' class='form-control' value='$user[last_name]' name='last_name'>
				</div>
			</div>";
			
			if($user['position'] != 'student'){
				
				echo"<div class ='row'>
					<div class='form-group mx-auto'>
						<label for='position'>Position:</label>
						<input type='text' class='form-control' value='$user[position]' name='position'>
					</div>
					
					<div class='form-group mx-auto'>
						<label for='department'>Department:</label>
						<input type='text' class='form-control' value='$user[department]' name='department'>
					</div>
					
					<div class='form-group mx-auto'>
						<label for='office'>Office:</label>
						<input type='text' class='form-control' value='$user[office]' name='office'>
					</div>
					
					<div class='form-group mx-auto'>
						<label for='phone'>Phone:</label>
						<input type='tel' class='form-control' value='$user[phone]' name='phone'>
					</div>
				</div>
			
				<div class='col'>
					<div class ='form-group mx-auto'>
							<label for='description'>Description:</label>
							<textarea id='description' class='form-control' name='description'>$user[description]</textarea>
					</div>
				</div>";
			}
			else{
				echo"
					<input type='hidden' value='$user[position]' name='position'>
					<input type='hidden' value='$user[department]' name='department'>
					<input type='hidden' value='$user[office]' name='office'>
					<input type='hidden' value='$user[phone]' name='phone'>
					<input type='hidden' value='$user[description]' name='description'>
					";
			}
			echo"
				<div class='row'>
						<button type='submit' name='basic_update' value='basic_update' class='btn btn-primary mx-auto'>Update Basic Info!</button>
				</div>
		</form>
		<!-- END Basic Information -->";
		
		
		echo"<!-- Faculty Modify Page -->";
		//Faculty Only Section
		if($user['position'] != 'student'){
			echo"
				<hr>
				<center><h1>Modify Faculty Page</h1></center>
				<br> 
				<br>";
				include 'helper/connect.php';
				
				//Lists to be used for drop downs.
				$deleteItemsResult = mysqli_query($db, "SELECT item_id, category, display_order, description FROM item WHERE faculty_id = '$user_id' ORDER BY category, display_order ASC");
				$reactivateItemsResult = mysqli_query($db, "SELECT item_id, description, category FROM item WHERE faculty_id = '$user_id' AND active != 1 ORDER BY category, display_order ASC");
				$deactivateItemsResult = mysqli_query($db, "SELECT item_id, description, category FROM item WHERE faculty_id = '$user_id' AND active = 1 ORDER BY category, display_order ASC");
				$allItems = mysqlI_query($db, "SELECT item_id, description, category FROM item WHERE faculty_id = '$user_id' ORDER BY category, display_order ASC");
				$categoriesResult = mysqli_query($db, "SELECT category FROM item GROUP BY category ASC");
				$activeItemCount = 0;
				
				/* Adding an Item Form */
				echo"
				<div class = 'row'>
					<div class = 'col'>
						<h2><strong><center> Add an Item </center></strong></h2>
						<form action='update.php' name='addItem' method='post'>
							<div class='row'>
							
								<div class='form-group col'>
									<input type='text' class='form-control' placeholder='Item description' name='description'>
								</div>
								
								<div class='form-group col'>						
									<select class='select-picker form-control' name='category'>";
										while($categoryRow = mysqli_fetch_array($categoriesResult, MYSQLI_BOTH) ){
											$category = $categoryRow['category'];
											echo"<option value='$category'>$category</option>";
										}
									echo"</select>
								</div>
							
							</div>
							
							<div class='row'>						
								<div class ='form-group col'>
									<button class='form-control btn btn-success' type='submit' name='addItem'>Add Item</button>
								</div>
							</div>
							
						</form>
					</div>";
					/*END Adding an Item Form*/
					
					/* Deleting an Item Form */
					echo"

					<div class = 'col'>
						<h2><strong><center> Delete an Item </center></strong></h2>				
						<form action='update.php' name='deleteItem' method='post'>
							<div class='row'>
								
								<div class='form-group col'>						
									<select class='select-picker form-control' name='item_id'>";
										while($item = mysqli_fetch_array($deleteItemsResult, MYSQLI_BOTH) ){
											$description = $item['description'];
											$category = $item['category'];
											$item_id = $item['item_id'];
											$display_order = $item['display_order'];
											echo"<option value = $item_id>$category-$display_order: $description</option>";
										}
									echo"</select>
								</div>
							
							</div>
							
							<div class='row'>						
								<div class ='form-group col'>
									<button class='form-control btn btn-danger' type='submit' name='deleteItem'>Delete Item</button>
								</div>
							</div>
						</form>
					</div>
				</div>";		
				/*END Deleting an Item Form*/	

				echo"
					<br>";
				
				/* Activating an Item Form */
				echo"
				<div class = 'row'>
					<div class = 'col'>
					
						<h2><strong><center> Activate an Item </center></strong></h2>				
						<form action='update.php' name='activateItem' method='post'>
							<div class='row'>
								
								<div class='form-group col'>						
									<select class='select-picker form-control' name='item_id'>";
										while($item = mysqli_fetch_array($reactivateItemsResult, MYSQLI_BOTH) ){
											$description = $item['description'];
											$category = $item['category'];
											$item_id = $item['item_id'];
											echo"<option value='$item_id'>$category: $description</option>";
										}
									echo"</select>
								</div>
							
							</div>
							<div class='row'>						
								<div class ='form-group col'>
									<button class='form-control btn btn-info' type='submit' name='activateItem'>Activate Item</button>
								</div>
							</div>
						</form>
					</div>";
					/*END Activating an Item Form*/	
				
					/* Deactivating an Item Form */
					echo"
					<div class = 'col'>
						<h2><strong><center> Deactivate an Item </center></strong></h2>				
						<form action='update.php' name='deactivateItem' method='post'>
							<div class='row'>
								
								<div class='form-group col'>						
									<select class='select-picker form-control' name='item_id'>";
										while($item = mysqli_fetch_array($deactivateItemsResult, MYSQLI_BOTH) ){
											$description = $item['description'];
											$category = $item['category'];
											$item_id = $item['item_id'];
											echo"<option value='$item_id'>$category: $description</option>";
										}
									echo"</select>
								</div>
							
							</div>
							<div class='row'>						
								<div class ='form-group col'>
									<button class='form-control btn btn-warning' type='submit' name='deactivateItem'>Deactivate Item</button>
								</div>
							</div>
						</form>
					</div>
				</div>";
				/*END Deactivating an Item Form*/	
				
				
			/*Appointment modfying section*/
			
			echo"<hr>
			<center><h1>Appoint Management</h1></center>
			<br> 
			<br>";
				/* Adding an Appointment Form */
				echo"
				<div class = 'row'>
				
					<div class = 'col'>
						<h2><strong><center> Add an appointment </center></strong></h2>
						<form action='update.php' name='addAppointment' method='post'>
									<label for='start_date'>Start Date:</label>
									<input type='datetime-local' class='form-control' name='start_date'>

									<br>
									
									<label for='end_date'>End Date:</label>
									<input type='datetime-local' class='form-control' name='end_date'>	
						
									<br>

									
									<label for='student_id'>Student ID:</label>
									<input type='text' class='form-control' name='student_id' placeholder='Optional'>
								
									<br>
									<label for='description'>Appointment Description:</label>								
									<input type='text' class='form-control'name='description' placeholder='Optional'>	
									
									</br>
									
									<button class='form-control btn btn-success' type='submit' name='addAppointment'>Add Item</button>
						</form>
					</div>";
					/*END Adding an Appointment Form*/
					
					/* Deleting an Appointment Form */
					echo"

					<div class = 'col'>
						<h2><strong><center> Delete an appointment </center></strong></h2>				
						<form action='update.php' name='deleteAppointment' method='post'>
						
							<div class='row'>	
								<div class='form-group col'>						
									<select class='select-picker form-control' name='appointment_id'>";
										
										$faculty_id = $_SESSION['user_id'];
										
										$appointmentsResult = mysqli_query($db, "SELECT appointment_id, first_name, last_name, start_date, end_date FROM appointment JOIN user ON student_id = user_id WHERE faculty_id = $faculty_id ORDER BY start_date ASC");
										
										while($appointment = mysqli_fetch_array($appointmentsResult, MYSQLI_BOTH) ){
											$first_name = $appointment['first_name'];
											$last_name = $appointment['last_name'];
											$start_date = $appointment['start_date'];
											$end_date = $appointment['end_date'];
											$appointment_id = $appointment['appointment_id'];
											
											echo"<option value ='$appointment_id'>$start_date to $end_date ($last_name, $first_name)</option>";
										}
									echo"</select>
								</div>
							</div>
							
							<div class='row'>						
								<div class ='form-group col'>
									<button class='form-control btn btn-danger' type='submit' name='deleteAppointment'>Delete Appointment</button>
								</div>
							</div>
							
						</form>
					</div>
					
				</div>";		
				/*END Deleting an Appointment Form*/	
			;

		}
		//Student Only Section
		else{
			
			/*Appointment modifying section*/
			
			echo"<hr>
			<center><h1>Appoint Management</h1></center>
			<br> 
			<br>";
			
				/* Adding an Appointment Form */
				echo"
				<div class = 'row'>
						<div class = 'col'>
							<h2><strong><center> Available Appointments </center></strong></h2>							
							
							<form action='update.php' name='joinAppointment' method='post'>
							
								<div class='row'>	
									<div class='form-group col'>						
										<select class='select-picker form-control' name='appointment_id'>";
										
											$student_id = $_SESSION['user_id'];
											
											//Free advising spots
											include 'helper/connect.php';		
											$advisorsResult = mysqli_query($db, "SELECT first_name, last_name, appointment_id, start_date, end_date FROM appointment JOIN user ON faculty_id = user_id WHERE student_id = 0");
											mysqli_close($db);
									
											while($appointment = mysqli_fetch_array($advisorsResult, MYSQLI_BOTH) ){
												
												$first_name = $appointment['first_name'];
												$last_name = $appointment['last_name'];
												$start_date = $appointment['start_date'];
												$end_date = $appointment['end_date'];
												$appointment_id = $appointment['appointment_id'];
												
												echo"<option value ='$appointment_id'>($last_name, $first_name) - $start_date to $end_date</option>";
											}
										echo"</select>
									</div>
								</div>
								
								<div class='row'>						
									<div class ='form-group col'>
										<button class='form-control btn btn-success' type='submit' name='joinAppointment'>Sign up for Appointment!</button>
									</div>
								</div>
								
							</form>

					</div>";
					/*END Adding an Appointment Form*/
					
					/* Removing an Appointment Form */
					echo"

						<div class = 'col'>
							<h2><strong><center> Remove an appointment </center></strong></h2>							
							
							<form action='update.php' name='leaveAppointment' method='post'>
							
								<div class='row'>	
									<div class='form-group col'>						
										<select class='select-picker form-control' name='appointment_id'>";
												
											$student_id = $_SESSION['user_id'];
											
											//Student's advising spots										
											include 'helper/connect.php';		
											$advisorsResult = mysqli_query($db, "SELECT first_name, last_name, appointment_id, start_date, end_date FROM `appointment` JOIN user ON faculty_id = user_id WHERE student_id = '$student_id'");
											mysqli_close($db);
											
											while($appointment = mysqli_fetch_array($advisorsResult, MYSQLI_BOTH) ){
												$first_name = $appointment['first_name'];
												$last_name = $appointment['last_name'];
												$start_date = $appointment['start_date'];
												$end_date = $appointment['end_date'];
												$appointment_id = $appointment['appointment_id'];
												
												echo"<option value ='$appointment_id'>$start_date to $end_date ($last_name, $first_name)</option>";
											}
										echo"</select>
									</div>
								</div>
								
								<div class='row'>						
									<div class ='form-group col'>
										<button class='form-control btn btn-danger' type='submit' name='leaveAppointment'>Remove Appointment!</button>
									</div>
								</div>
								
							</form>
					</div>
					
				</div>";		
				/*END Deleting an Appointment Form*/				
		}
	echo"</div>";
?>	<!-- END Forms -->
<?php include 'helper/footer.php'?>