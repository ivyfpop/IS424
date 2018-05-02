<!DOCTYPE html>
<html lang="en">

    <?php
        include 'helper/header.php';
        include 'helper/connect.php';

        // An admin is updating another account
        if(isset($_GET[memberID])){
          // Don't allow Non-Admins to access other member info by URL
          if(!$_SESSION[adminStatus]){
              header("Location: http://track.finkmp.com/myAccount.php");
          }
          $memberResult = $db->query("SELECT * FROM Member WHERE memberID = '$_GET[memberID]'");
        }
        // A member is updating their own account
        else
          $memberResult = $db->query("SELECT * FROM Member WHERE memberID = '$_SESSION[memberID]'");
        
        mysqli_close($db);
        $row = mysqli_fetch_array($memberResult, MYSQLI_BOTH);
    ?>

    <body>
        <div class="container bg-faded p-4 my-4">
            <form class="form-signin" action='helper/accountHelper.php' name='update' method='post'>
                <center><h1> User Account Panel </h1></center>

                <input type='hidden' name='memberID' value=<?php echo "'$row[memberID]'";?>>

                <div class="form-label-group">
                    <input type="text" id="inputFirstName" class="form-control" name='firstName' value=<?php echo "'$row[firstName]'";?> required>
                    <label for="inputFirstName">First Name</label>
                </div>

                <div class="form-label-group">
                    <input type="text" id="inputLastName" class="form-control" name="lastName" value=<?php echo "'$row[lastName]'";?> required>
                    <label for="inputLastName">Last Name</label>
                </div>

                <div class="form-label-group">
                    <input type="email" id="inputEmail" class="form-control" name="email" value=<?php echo "'$row[email]'";?> required>
                    <label for="inputEmail">Email Address</label>
                </div>

                <div class="form-label-group">
                    <input type="password" id="inputPassword" class="form-control" name="password"  value=<?php echo "'$row[password]'";?> required>
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

                <button class="btn btn-lg btn-success btn-block mt-2" type="submit" name='update'>Update Account</button>
            </form>
        </div>
    </body>
    <?php include 'helper/footer.php' ?>
</html>
