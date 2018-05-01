<!DOCTYPE html>
<html lang="en">

    <?php   
        include 'helper/header.php';
        include 'helper/connect.php';
        session_start();
        
        // Admin is updating a transaction record.
        if(isset($_GET[transactionID]){
            
        }
        // Admin is creating a new transaction record.
        else if (isset($_GET[newTransaction]){
            
        }
        $eventResult = $db->("SELECT * FROM Transaction, Member JOIN Member ON transactionApprovalMemberID = memberID WHERE transactionID = $_GET[transactionID]");
        mysqli_close($db);
        $row = mysqli_fetch_array($eventResult, MYSQLI_BOTH);
    ?>

    <body>
        <div class="container bg-faded p-4 my-4">
            <form class="form-signin" action='transactionManagementUpdate.php' name='transactionUpdate' method='post'>
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

                <button class="btn btn-lg btn-success btn-block mt-2" type="submit" name='self-update'>Update Account</button>
            </form>
        </div>
    </body>
    <?php include 'helper/footer.php' ?>
</html>
