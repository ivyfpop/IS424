<!DOCTYPE html>
<html lang="en">

    <?php include 'helper/header.php'; 
        // Non-Admin
        if(!(isset($_SESSION[adminStatus])){
            header("Location: http://track.finkmp.com");
        }
        // No Transaction
        else if(!isset($_GET[transactionUpdate]) ){
            header("Location: http://track.finkmp.com");
        }

        // Run a query to gather all the transaction data.
        include 'helper/connect.php';
        $transactionResult = $db->query("SELECT * FROM Transaction, Member JOIN Member ON transactionApprovalMemberID = memberID WHERE transactionID = $_GET[transactionID]");
        mysqli_close($db);
        $row = mysqli_fetch_array($transactionResult, MYSQLI_BOTH);

        echo"<body>
                <div class='container bg-faded p-4 my-4'>

                    <form class='form-signin' action='helper/transactionHelper.php' name='transactionUpdate' method='post'>
                        <center><h1> Transaction #$row[transactionID]</h1></center>

                        <div class='form-label-group'>
                            <input type='number' id='inputMemberID' class='form-control' name='memberID' value='$row[memberID]'required>
                            <label for='inputMemberID'>Associated Member ID</label>
                        </div>

                        <div class='form-label-group'>
                            <input type='number' id='inputEventID' class='form-control' name='eventID'>
                            <label for='inputEventID'>Associated Event ID</label>
                        </div>

                        <div class='form-label-group'>
                            <input type='number' id='inputQuantity' class='form-control' name='transactionQuantity' required>
                            <label for='inputQuantity'>Quantity</label>
                        </div>

                        <div class='form-label-group'>
                            <input type='date' id='inputPaymentDate' class='form-control' name='transactionPaymentDate'>
                            <label for='inputPaymentDate'>Payment Date</label>
                        </div>

                        <div class='form-label-group'>
                            <input type='date' id='inputApprovalDate' class='form-control' name='transactionApprovalDate'>
                            <label for='inputApprovalDate'>Approval Date:</label>
                        </div>
                        
                        <div class='form-label-group'>
                            <input type='number' id='inputApprovalMemberID' class='form-control' name='transactionApprovalMemberID'>
                            <label for='inputApprovalMemberID'>Approval Member ID</label>
                        </div>

                        <div class='form-label-group'>
                            <input type='text' id='inputTransactionDescription' class='form-control' name='transactionDescription' required>
                            <label for='inputTransactionDescription'>Description</label>
                        </div>                        

                        <button class='btn btn-lg btn-success btn-block mt-2' type='submit'>Update Transaction</button>
                    </form>
                </div>
            </body>";
    
    include 'helper/footer.php' ?>
</html>
