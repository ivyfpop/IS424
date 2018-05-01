<!DOCTYPE html>
<html lang="en">

    <?php   
        include 'helper/header.php';
        session_start();
        
        // Non-Admin got to this page.
        if(!$_SESSION[admin_status]){
            header("Location: http://track.finkmp.com");
        }
        

        // Admin is updating a transaction record.
        if(isset($_GET[transactionID]){
            // Run a query to gather all the transaction data
            include 'helper/connect.php';
            $transactionResult = $db->query("SELECT * FROM Transaction, Member JOIN Member ON transactionApprovalMemberID = memberID WHERE transactionID = $_GET[transactionID]");
            mysqli_close($db);
            $row = mysqli_fetch_array($eventResult, MYSQLI_BOTH);            
        }


    ?>

    <body>
        <div class="container bg-faded p-4 my-4">
            <form class="form-signin" action='transactionManagementUpdate.php' name='transactionCreation' method='post'>
                <center><h1> Transaction Creation Panel </h1></center>

                <div class="form-label-group">
                    <input type="number" id="inputMemberID" class="form-control" name='memberID' required>
                    <label for="inputMemberID">Associated Member ID</label>
                </div>
                
                <div class="form-label-group">
                    <input type="number" id="inputEventID" class="form-control" name='eventID'>
                    <label for="inputEventID">(OPTIONAL) Associated event ID</label>
                </div>

                <div class="form-label-group">
                    <input type="number" id="inputQuantity" class="form-control" name='transactionQuantity' required>
                    <label for="inputQuantity">Quantity</label>
                </div>
                
                <div class="form-label-group">
                    <input type="text" id="inputDescription" class="form-control" name='transactionDescription' required>
                    <label for="inputDescription">(OPTIONAL) Description</label>
                </div>
                
                <button class="btn btn-lg btn-success btn-block mt-2" type="submit">Create Transaction</button>
            </form>
        </div>
    </body>
    
    <?php include 'helper/footer.php' ?>
</html>
