<!-- Used to connect to the MySQL Databse -->
<?php
	$db = new mysqli( "localhost", "finkm503_Admin", "Password1", "finkm503_IS422");
	if($db->connect_errno > 0){
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
?>