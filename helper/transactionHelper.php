<?php 
        // Create the session.
        session_start();

        // Shouldn't be here.
        if(!$_SESSION[adminStatus] || !isset($_POST[newTransaction]) || !isset($_POST[updateTransaction])){
            header("Location: http://track.finkmp.com");
        }
        // Check for new transaction
        else if(isset($_POST[newTransaction])){
            // Verify that the member exists
            include 'helper/connect.php';
            $memberResult = $db->query("SELECT * FROM Member WHERE memberID = '$_POST[memberID]'");
            mysqli_close();
            
            // The member doesn't exist.
            if($memberResult->num_rows != 1){
                header("Location: http://track.finkmp.com/transactionManagement.php?no_user=1");
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
                header("Location: http://track.finkmp.com/transactionUpdate.php?transactionID=$row[transactionID]");                
            }    
        }
        // Update the transaction
        else if(isset($_POST[updateTransaction])){

        }

?>