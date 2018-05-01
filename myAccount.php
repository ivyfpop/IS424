<!DOCTYPE html>
<html lang="en">

    <?php   
        include 'helper/header.php';
        session_start();
        
        include 'helper/connect.php';
        $eventResult = $db->query("SELECT password,isSprinter,isThrower,isDistance,isJumper FROM Member WHERE memberID = '$_SESSION[memberID]'");
        mysqli_close($db);
        $row = mysqli_fetch_array($eventResult, MYSQLI_BOTH);
    ?>

    <body>
        <div class="container bg-faded  p-4 my-4">
            <form class="form-signin" action='helper/accountHelper.php' name='self-update' method='post'>
                <center><h1> User Account Panel </h1></center>

                <div class="form-label-group">
                    <input type="text" id="inputFirstName" class="form-control" name='firstName' value=<?php echo "'$_SESSION[firstName]'";?> required>
                    <label for="inputFirstName">First Name</label>
                </div>

                <div class="form-label-group">
                    <input type="text" id="inputLastName" class="form-control" name="lastName" value=<?php echo "'$_SESSION[lastName]'";?> required>
                    <label for="inputLastName">Last Name</label>
                </div>

                <div class="form-label-group">
                    <input type="email" id="inputEmail" class="form-control" name="email" value=<?php echo "'$_SESSION[email]'";?> required>
                    <label for="inputEmail">Email Address</label>
                </div>

                <div class="form-label-group">
                    <input type="password" id="inputPassword" name="password" class="form-control"  value=<?php echo "'$row[password]'";?> required>
                    <label for="inputPassword">Password</label>
                </div>

                <div class='form-check form-check-inline'>
                    <input class='form-check-input' type='checkbox' id='inputIsSprinter' name='isSprinter' <?php if ($row[isSprinter]) echo "checked";?>>
                    <label class='form-check-label' for='inputIsSprinter'>Sprinter</label>
                </div>

                <div class='form-check form-check-inline'>
                    <input class='form-check-input' type='checkbox' id='inputIsDistance' name='isDistance'<?php if ($row[isDistance]) echo "checked";?>>
                    <label class='form-check-label' for='inputIsDistance'>Distance</label>
                </div>

                <div class='form-check form-check-inline'>
                    <input class='form-check-input' type='checkbox' id='inputIsThrower' name='isThrower'<?php if ($row[isThrower]) echo "checked";?>>
                    <label class='form-check-label' for='inputIsThrower'>Thrower</label>
                </div>

                <div class='form-check form-check-inline'>
                    <input class='form-check-input' type='checkbox' id='inputIsJumper' name='isJumper'<?php if ($row[isJumper]) echo "checked";?>>
                    <label class='form-check-label' for='inputIsJumper'>Jumper</label>
                </div>

                <button class="btn btn-lg btn-success btn-block" type="submit" name='self-update'>Update Account</button>
            </form>
        </div>
    </body>
    <?php include 'helper/footer.php' ?>
</html>
