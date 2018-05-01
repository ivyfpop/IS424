<!DOCTYPE html>
<html lang="en">

    <?php include 'helper/header.php'; ?>
    <body>
        <div class='container bg-faded p-4 my-4'>
        
        <?php
            session_start();
            
            // Non-Admin got to this page.
            if(!$_SESSION[adminStatus]){
                header("Location: http://track.finkmp.com");
            }
            
            // Check for new transaction
            if(isset($_POST[transactionCreation])){
                // Verify that the member and event exists
                include 'helper/connect.php';
                $memberResult = $db->query("SELECT * FROM Member WHERE memberID = '$_POST[memberID]'");
                $eventResult = $db->query("SELECT * FROM Member WHERE eventID = '$_POST[eventID]'");
                mysqli_close();
                
                // No event was entered or the event doesn't exist.
                if($_POST[eventID] && $eventResult->num_rows != 1){
                    echo"<div class='alert alert-danger text-center mx-auto text-center w-50' role='alert'>
                            <strong>That event does not exist</strong>
                         </div>";
                }
                // The member doesn't exist.
                else if($memberResult->num_rows != 1){
                    echo"<div class='alert alert-danger text-center mx-auto text-center w-50' role='alert'>
                            <strong>That member does not exist</strong>
                         </div>";
                 }
                // Create a transaction record with the info passed.
                else{
                    include 'helper/connect.php';
                    $db->query("INSERT INTO Transaction (memberID, lastName, email, password) VALUES ('$_POST[firstName]','$_POST[lastName]','$_POST[email]','$_POST[password]')");
                    mysqli_close();
                }    
            }
            
            // Admin is updating a transaction record.
            if(isset($_GET[transactionID]){
                // Run a query to gather all the transaction data
                include 'helper/connect.php';
                $transactionResult = $db->query("SELECT * FROM Transaction, Member JOIN Member ON transactionApprovalMemberID = memberID WHERE transactionID = $_GET[transactionID]");
                mysqli_close($db);
                $row = mysqli_fetch_array($eventResult, MYSQLI_BOTH);            
            }
            else{
               echo"<form class='form-signin' action='transactionManagementUpdate.php' name='transactionCreation' method='post'>
                        <center><h1> Transaction Creation Panel </h1></center>

                        <div class='form-label-group'>
                            <input type='number' id='inputMemberID' class='form-control' name='memberID' required>
                            <label for='inputMemberID'>Associated Member ID</label>
                        </div>
                        
                        <div class='form-label-group'>
                            <input type='number' id='inputEventID' class='form-control' name='eventID'>
                            <label for='inputEventID'>(OPTIONAL) Associated event ID</label>
                        </div>

                        <div class='form-label-group'>
                            <input type='number' id='inputQuantity' class='form-control' name='transactionQuantity' required>
                            <label for='inputQuantity'>Quantity</label>
                        </div>
                        
                        <div class='form-label-group'>
                            <input type='text' id='inputDescription' class='form-control' name='transactionDescription'>
                            <label for='inputDescription'>(OPTIONAL) Description</label>
                        </div>
                        
                        <button class='btn btn-lg btn-success btn-block mt-2' type='submit'>Create Transaction</button>";
            }
        ?>
            </form>
        </div>
    </body>

    
    <?php include 'helper/footer.php' ?>
</html>
