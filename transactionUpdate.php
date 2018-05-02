<!DOCTYPE html>
<html lang="en">
    <?php 
        include 'helper/header.php'; 

        // Non-Admin
        if(!isset($_SESSION[adminStatus])){
            header("Location: http://track.finkmp.com");
        }
        echo"<body>
                <div class='container bg-faded p-4 my-4'>";
        // Transaction Update
        if(isset($_GET[transactionUpdate]) ||){

            // Run a query to gather all the transaction data.
            include 'helper/connect.php';
            $transactionResult = $db->query("SELECT * FROM Transaction WHERE transactionID = '$_GET[transactionID]'");
            mysqli_close($db);
            $row = mysqli_fetch_array($transactionResult, MYSQLI_BOTH);

            echo"<form class='form-signin' action='helper/transactionHelper.php' name='transactionUpdate' method='post'>
                    <center><h1> Transaction #$row[transactionID]</h1></center>
                    <div class='form-inline'>
                        <div class='form-label-group'>
                            <input type='number' id='inputMemberID' class='form-control' name='memberID' value='$row[memberID]' required>
                            <label for='inputMemberID'>Associated Member ID</label>
                        </div>

                        <div class='form-label-group'>
                            <input type='number' id='inputEventID' class='form-control' name='eventID' value='$row[eventID]'>
                            <label for='inputEventID'>Associated Event ID</label>
                        </div>

                        <div class='form-label-group'>
                            <input type='number' id='inputQuantity' class='form-control' name='transactionQuantity' value='$row[transactionQuantity]' required>
                            <label for='inputQuantity'>Quantity</label>
                        </div>
                    </div>

                    <div class='form-inline'>
                        <div class='form-label-group'>
                            <input type='date' id='inputPaymentDate' class='form-control' name='transactionPaymentDate' value='$row[transactionPaymentDate]' >
                            <label for='inputPaymentDate'>Payment Date</label>
                        </div>

                        <div class='form-label-group'>
                            <input type='date' id='inputApprovalDate' class='form-control' name='transactionApprovalDate' value='$row[transactionApprovalDate]'>
                            <label for='inputApprovalDate'>Approval Date:</label>
                        </div>
                         
                        <div class='form-label-group'>
                            <input type='number' id='inputApprovalMemberID' class='form-control' name='transactionApprovalMemberID' value='$row[transactionApprovalMemberID]'>
                            <label for='inputApprovalMemberID'>Approval Member ID</label>
                        </div>
                    </div>

                    <div class='form-label-group'>
                        <input type='text' id='inputTransactionDescription' class='form-control' name='transactionDescription' value='$row[transactionDescription]' required>
                        <label for='inputTransactionDescription'>Description</label>
                    </div>                        

                    <button class='btn btn-lg btn-success btn-block mt-2' type='submit'>Update Transaction</button>
                </form>";
         }
         // New transaction Form
         else{

            echo"<form class='form-signin' action='helper/transactionHelper.php' name='transactionUpdate' method='post'>
                    <center><h1>New Transaction</h1></center>

                    <div class='form-label-group'>
                        <input type='number' id='inputMemberID' class='form-control' name='memberID'required>
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
                </form>";

         }

        echo"   </div>
            </body>"   
        include 'helper/footer.php';
    ?>
</html>
