<!-- Used to connect to the MySQL Databse -->
<?php
	$db = new mysqli( "localhost", "u619266525_admin", "Password1", "u619266525_track");
	if($db->connect_errno > 0){
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
?>