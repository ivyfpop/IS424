<?php include 'helper/header.php' ?>

    <?php
        // If a new account has been made, congratulate them.
        if(isset($_GET[new_account])){
            echo"
                <div class='container text-center'>
                    <div class='alert alert-success' role='alert'>
                        <strong>Welcome to the track club! </strong>
                    </div>
                </div>";
        }
    ?>
    
	<br>
	
	<div class='container bg-faded'>
		<h1 class='index-header'>
			Test Page! Test 2
		</h1>
	</div>
	
<?php include 'helper/footer.php'?>