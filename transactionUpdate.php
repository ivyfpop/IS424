<!DOCTYPE html>
<html lang="en">
    <?php 
        include 'helper/header.php'; 

        // Non-Admin
        if(!isset($_SESSION[adminStatus])){
            header("Location: http://track.finkmp.com");
        }
        // Member doesn't exist error.
        else if(isset($_GET[no_user])){
            echo"<div class='alert alert-danger text-center mx-auto text-center w-50' role='alert'>
                    <strong>That member does not exist.</strong>
                 </div>";
        }
        // Event doesn't exist error
        else if(isset($_GET[no_event])){
            echo"<div class='alert alert-danger text-center mx-auto text-center w-50' role='alert'>
                    <strong>That event does not exist.</strong>
                 </div>";
        }

        echo"<body>
                <div class='container bg-faded p-4 my-4'>";
        // Transaction Update
        if(isset($_GET[transactionID])){

            // Run a query to gather all the transaction data.
            include 'helper/connect.php';
            $transactionResult = $db->query("SELECT * FROM Transaction WHERE transactionID = '$_GET[transactionID]'");
            mysqli_close($db);
            $row = mysqli_fetch_array($transactionResult, MYSQLI_BOTH);

            $transactionPaymentDate = NULL;
            $transactionApprovalDate = NULL;
            if($row[transactionPaymentDatetransactionPaymentDate]){
                $transactionPaymentDate = $row[transactionPaymentDate];
            }
            if($row[transactionApprovalDate]){
                $transactionApprovalDate = $row[transactionApprovalDate];
            }
            echo"<form class='form-signin' action='helper/transactionHelper.php' name='updateTransaction' method='post'>
                    <center><h1> Transaction #$row[transactionID]</h1></center>

                    <input type='hidden' name='transactionID' value='$_GET[transactionID]' hidden>

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

                    <div class='form-label-group'>
                        <input type='date' id='inputPaymentDate' class='form-control' name='transactionPaymentDate' value='$transactionPaymentDate' >
                        <label for='inputPaymentDate'>Payment Date</label>
                    </div>

                    <div class='form-label-group'>
                        <input type='date' id='inputApprovalDate' class='form-control' name='transactionApprovalDate' value='$transactionApprovalDate'>
                        <label for='inputApprovalDate'>Approval Date:</label>
                    </div>
                     
                    <div class='form-label-group'>
                        <input type='number' id='inputApprovalMemberID' class='form-control' name='transactionApprovalMemberID' value='$row[transactionApprovalMemberID]'>
                        <label for='inputApprovalMemberID'>Approval Member ID</label>
                    </div>

                    <div class='form-label-group'>
                        <input type='text' id='inputTransactionDescription' class='form-control' name='transactionDescription' value='$row[transactionDescription]' required>
                        <label for='inputTransactionDescription'>Description</label>
                    </div>

                    <button class='btn btn-lg btn-success btn-block mt-2' type='submit' name='updateTransaction'>Update Transaction</button>
                </form>";
         }
         // New transaction Form
         else{
            echo"<form class='form-signin' action='helper/transactionHelper.php' name='newTransaction' method='post'>
                    <center><h1>New Transaction</h1></center>

                    <div class='form-label-group'>
                        <input type='number' id='inputMemberID' class='form-control' name='memberID'required>
                        <label for='inputMemberID'>Associated Member ID</label>
                    </div>

                    <div class='form-label-group'>
                        <input type='number' id='inputEventID' class='form-control' name='eventID' value='NULL'>
                        <label for='inputEventID'>Associated Event ID</label>
                    </div>

                    <div class='form-label-group'>
                        <input type='number' id='inputQuantity' class='form-control' name='transactionQuantity' required>
                        <label for='inputQuantity'>Quantity</label>
                    </div>

                    <div class='form-label-group'>
                        <input type='date' id='inputPaymentDate' class='form-control' name='transactionPaymentDate' value='NULL'>
                        <label for='inputPaymentDate'>Payment Date</label>
                    </div>

                    <div class='form-label-group'>
                        <input type='date' id='inputApprovalDate' class='form-control' name='transactionApprovalDate' value='NULL'>
                        <label for='inputApprovalDate'>Approval Date:</label>
                    </div>
                     
                    <div class='form-label-group'>
                        <input type='number' id='inputApprovalMemberID' class='form-control' name='transactionApprovalMemberID' value='NULL'>
                        <label for='inputApprovalMemberID'>Approval Member ID</label>
                    </div>

                    <div class='form-label-group'>
                        <input type='text' id='inputTransactionDescription' class='form-control' name='transactionDescription' required>
                        <label for='inputTransactionDescription'>Description</label>
                    </div>                        

                    <button class='btn btn-lg btn-success btn-block mt-2' type='submit' name='newTransaction'>Create Transaction</button>
                </form>";
         }

        echo"   </div>
            </body>";

        include 'helper/footer.php';
    ?>
</html>
