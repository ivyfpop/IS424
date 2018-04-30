<!DOCTYPE html>
<html lang="en">

    <?php include 'helper/header.php';
          include 'helper/connect.php';
          session_start();

          $eventQuery = "SELECT password,isSprinter,isThrower,isDistance,isJumper FROM Member WHERE memberID = '$_SESSION[memberID]'";
		      $eventResult = mysqli_query($db, $eventQuery);
          mysqli_close($db);

          $row = mysqli_fetch_array($eventResult, MYSQLI_BOTH);
    ?>

	<body>
        <form class="container bg-faded form-signin" action='helper/accountHelper.php' name='admin-update' method='post'>

            </br>
            <center><h1> User Account Panel </h1></center>

                <div class="form-label-group">
                    <input type="text" id="inputFirstName" class="form-control" name='firstName' value=<?php echo "'$_SESSION[firstName]'";?> placeholder="First Name" required autofocus>
                    <label for="inputFirstName">First Name</label>
                </div>

                <div class="form-label-group">
                    <input type="text" id="inputLastName" class="form-control" name='lastName' value=<?php echo "'$_SESSION[lastName]'";?> placeholder="Last Name" required autofocus>
                    <label for="inputLastName">Last Name</label>
                </div>

                <div class="form-label-group">
                    <input type="email" id="inputEmail" class="form-control" name='email' value=<?php echo "'$_SESSION[email]'";?> placeholder="Email Address" required autofocus>
                    <label for="inputEmail">Email Address</label>
                </div>

                <div class="form-label-group">
                    <input type="password" id="inputPassword" class="form-control" name='password' value=<?php echo "'$row[password]'";?> placeholder="Password" required>
                    <label for="inputPassword">Password</label>
                </div>

                <div class='form-check form-check-inline'>
                    <input class='form-check-input' type='checkbox' id='isSprinter' name='isSprinter' value='isSprinter' <?php if ($row[isSprinter]) echo "checked";?>>
                    <label class='form-check-label' for='isSprinter'>Sprinter</label>
                </div>

                <div class='form-check form-check-inline'>
                    <input class='form-check-input' type='checkbox' id='isDistance' name='isDistance' value='isDistance' <?php if ($row[isDistance]) echo "checked";?>>
                    <label class='form-check-label' for='isDistance'>Distance</label>
                </div>

                <div class='form-check form-check-inline'>
                    <input class='form-check-input' type='checkbox' id='isThrower' name='isThrower' value='isThrower' <?php if ($row[isThrower]) echo "checked";?>>
                    <label class='form-check-label' for='isThrower'>Thrower</label>
                </div>

                <div class='form-check form-check-inline'>
                    <input class='form-check-input' type='checkbox' id='isJumper' name='isJumper' value='isJumper' <?php if ($row[isJumper]) echo "checked";?>>
                    <label class='form-check-label' for='isJumper'>Jumper</label>
                </div>

            <br>
            <br>
            <button class="btn btn-lg btn-success btn-block" type="submit" name='admin-update' value='update'>Update Account</button>
            <br>
            <br>
        </form>
    </body>
    <?php include 'helper/footer.php' ?>
</html>
