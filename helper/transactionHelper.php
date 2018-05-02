<!DOCTYPE html>
<html lang="en">
<?php 
    // Verify that the member exists
    include 'helper/connect.php';
    $memberResult = $db->query("SELECT * FROM Member WHERE memberID = '$_POST[memberID]'");
    $eventResult = $db->query("SELECT * FROM Event WHERE eventID = '$_POST[eventID]'");
    mysqli_close($db);

    // Member does not exist.
    if($memberResult->num_rows != 1){
        header("Location: http://track.finkmp.com/transactionUpdate.php?no_user=1");
    }
    // Only event doesn't exist
    else if($_POST[eventID] && ($eventResult->num_rows != 1)){
        header("Location: http://track.finkmp.com/transactionUpdate.php?no_event=1");
    }
    // Valid data, create the transaction
    else{
        $memberID = $_POST[memberID];
        $eventID = NULL;
        $paymentDate = NULL;
        $approvalDate = NULL;
        $approvalID = NULL;
        $quantity = $_POST[transactionQuantity];
        $description = $_POST[transactionDescription];

        if($_POST[eventID]){
            $eventID = $_POST[eventID];
        }
        if($_POST[transactionPaymentDate]){
            $paymentDate = $_POST[transactionPaymentDate];
        }
        if($_POST[transactionApprovalDate]){
            $approvalDate = $_POST[transactionApprovalDate];
        }
        if($_POST[transactionApprovalMemberID]){
            $approvalID = $_POST[transactionApprovalMemberID];
        }

        // New Transaction Query
        include 'helper/connect.php';
        if(isset($_POST[newTransaction])){
            $db->query("INSERT  INTO Transaction (memberID,eventID,transactionInitDate,transactionPaymentDate,transactionApprovalDate,transactionApprovalMemberID,transactionQuantity,transactionDescription)
                        VALUES ('$memberID','$eventID', curdate(),'$paymentDate','$approvalDate','$approvalID','$quantity','$description')");
        }
        // Update Transaction Query
        else{
            $db->query("UPDATE Transaction SET memberID='$memberID',eventID='$eventID',transactionQuantity='$quantity',transactionPaymentDate='$paymentDate',transactionApprovalDate='$approvalDate',transactionApprovalMemberID='$approvalID',transactionDescription='$description' WHERE transactionID = '$_POST[transactionID]'");
        }
        
        // Get the transaction ID that was created and redirect back to that page.
        $transactionResult = $db->query("SELECT transactionID FROM Transaction WHERE memberID = '$_POST[memberID]' ORDER BY transactionID DESC LIMIT 1");
        mysqli_close($db);
        $row = mysqli_fetch_array($transactionResult, MYSQLI_BOTH);
        header("Location: http://track.finkmp.com/transactionUpdate.php?transactionID=$row[transactionID]");                
    }
?>
</html>