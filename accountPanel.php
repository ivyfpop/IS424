<!DOCTYPE html>
<html lang="en">
	
    <?php include 'helper/header.php' ?> 
        
	<body>
        <form class="form-signin" action='helper/accountHelper.php' name='update' method='post'>
            <div class="form-label-group">
                <input type="text" id="inputFirstName" class="form-control" name='first_Name' placeholder="First Name" required autofocus>
                <label for="inputFirstName">First Name</label>
            </div>

            <div class="form-label-group">
                <input type="text" id="inputLastName" class="form-control" name='last_Name' placeholder="Last Name" required autofocus>
                <label for="inputLastName">Last Name</label>
            </div>
            
            <div class="form-label-group">
                <input type="email" id="inputEmail" class="form-control" name='email' placeholder="Email Address" required autofocus>
                <label for="inputEmail">Email Address</label>
            </div>
            
            <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control" name='password' placeholder="Password" required>
                <label for="inputPassword">Password</label>
            </div>
            
            <div class='form-label-group form-check form-check-inline'>
                <input class='form-check-input' type='checkbox' id='isSprinter' value='isSprinter'>
                <label class='form-check-label' for='isSprinter'>Sprinter</label>
                
                <input class='form-check-input' type='checkbox' id='isDistance' value='isDistance'>
                <label class='form-check-label' for='isDistance'>Distance</label>
                
                <input class='form-check-input' type='checkbox' id='isThrower' value='isThrower'>
                <label class='form-check-label' for='isThrower'>Thrower</label>
                
                <input class='form-check-input' type='checkbox' id='isJumper' value='isJumper'>
                <label class='form-check-label' for='isJumper'>Jumper</label>
            </div>
            
            <button class="btn btn-lg btn-success btn-block" type="submit" name='update' value='update'>Update Account</button>
        </form>
    </body>
</html>