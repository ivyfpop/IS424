<!DOCTYPE html>
<html lang="en">

    <?php include 'helper/header.php'; 
            // Non-Admin got to this page.
            if(!$_SESSION[adminStatus]){
                header("Location: http://track.finkmp.com");
            }

            // Check for new transaction
            if(isset($_POST[newTransaction])){
                // Verify that the member exists
                include 'helper/connect.php';
                $memberResult = $db->query("SELECT * FROM Member WHERE memberID = '$_POST[memberID]'");
                mysqli_close();
                
                // The member doesn't exist.
                if($memberResult->num_rows != 1){
                    echo"<div class='alert alert-danger text-center mx-auto text-center w-50' role='alert'>
                            <strong>That member does not exist</strong>
                         </div>";
                }
                // Valid member, create the transaction.
                else{

                    // Connect and create the transaction record.
                    include 'helper/connect.php';
                    $db->query("INSERT  INTO Transaction (memberID, transactionQuantity, transactionDescription)
                                        VALUES ('$_POST[memberID]','$_POST[transactionQuantity]','$_POST[transactionDescription]')");

                    // Get the transaction ID that was created.
                    $transactionResult = $db->query("SELECT transactionID FROM Transaction WHERE memberID = '$_POST[memberID]' ORDER BY transactionID DESC LIMIT 1");
                    $row = mysqli_fetch_array($transactionResult, MYSQLI_BOTH);

                    // Redirect back to the edit page for the new transaction.
                    header("Location: http://track.finkmp.com/transactionManagementUpdate.php?transactionID=$row[transactionID]");                
                }    
            }





    ?>
    <body>
        <div class='container bg-faded p-4 my-4'>
        
        <?php
            
            
            
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
                            <input type='number' id='inputQuantity' class='form-control' name='transactionQuantity' required>
                            <label for='inputQuantity'>Quantity</label>
                        </div>
                        
                        <div class='form-label-group'>
                            <input type='text' id='inputDescription' class='form-control' name='transactionDescription' required>
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
