<?php
    $con = mysqli_connect("sql102.epizy.com","epiz_26467073","Shr9zmqlnyEq", "epiz_26467073_creditmanagementdb") or die(mysqli_error($con));
?>

<?php
    $from = $_POST['from'];
    $to = $_POST['to'];
    $amt = (int)$_POST['amt'];
    
    if(strcmp($from, $to) == 0){
        header('location: transfer.php?sameName=Sender and receiver cannot be the same!');
    }else{
        $checkBal_query = "select curr_cred from users where name='$from'";
        $checkBal_query_result = mysqli_query($con, $checkBal_query) or die(mysqli_error($con));
        if (mysqli_num_rows($checkBal_query_result) == 0){
            header('location: transfer.php?error_incurred=Some error incurred, try again later!');
        }
        else{
            $row = mysqli_fetch_array($checkBal_query_result);
            if( $amt > (int)$row['curr_cred'] ){
                header('location: transfer.php?invalidAmt=Entered amount exceeds current credit balance!');
            }else if( $amt == 0 ){
                header('location: transfer.php?invalidAmt=Amount cannot be zero!');
	    }else{
                              
                //deducting the amount from sender's current credit in users table
                $sender_query = "select * from users where name='$from'";
                $sender_query_result = mysqli_query($con, $sender_query) or die(mysqli_error($con));
                $row = mysqli_fetch_array($sender_query_result);
                
                $updated_cred = (int)$row['curr_cred'] - $amt;
                $updating_query = "update users set curr_cred='$updated_cred' where name='$from'" ;
                $updating_query_result = mysqli_query($con, $updating_query) or die(mysqli_error($con));                
                
                //adding the amount from receiver's current credit in users table
                $receiver_query = "select * from users where name='$to'";
                $receiver_query_result = mysqli_query($con, $receiver_query) or die(mysqli_error($con));
                $row = mysqli_fetch_array($receiver_query_result);
                
                $updated_cred = (int)$row['curr_cred'] + $amt;
                $updating_query = "update users set curr_cred='$updated_cred' where name='$to'" ;
                $updating_query_submit = mysqli_query($con, $updating_query) or die(mysqli_error($con));
                
                //adding the transaction into transfer table
                $addTransac_query = "INSERT INTO `transfer` (`transac_id`, `from_name`, `to_name`, `amt`) VALUES (NULL, '$from', '$to', '$amt')";
                
                $addTransac_query_submit = mysqli_query($con, $addTransac_query) or die(mysqli_error($con));
                
                //redirecting to transfer.php
                header('location:transfer.php?credUpdate=success');
            }
        }
        
    }
?>