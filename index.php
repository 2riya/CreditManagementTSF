<?php
    $con = mysqli_connect("sql102.epizy.com","epiz_26467073","Shr9zmqlnyEq", "epiz_26467073_creditmanagementdb") or die(mysqli_error($con));
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        
        <title>HOME | CreditManagement</title>
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Monoton&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Lemonada&display=swap" rel="stylesheet">
        
        <style>
            #user_list{
                    display: none;
                }
            body{
                background-color: black;
                font-family: 'Lemonada', cursive;                
            }
        </style>
        <script>
            function dispUserList() {
            document.getElementById("user_list").style.display = "block";
            }
        </script>
        
        
    </head>
    <body>
        <div class="container">
            <center>
                <h1 style="font-family: 'Permanent Marker', cursive; color: white;">Credit Management</h1>
                <h3 style="font-family: 'Permanent Marker', cursive; color: white; margin-top: -10px;">(The Sparks Foundation)</h3>
                
                <h1 style="font-family: 'Monoton', cursive; padding-top: 10px; color: #FFDAB9;">HOME</h1>
                <br>
                
                <div style="padding-top: 2%; padding-right: 8%; padding-left: 8%; ">
                <details>
                    <summary style="padding: 0.75%; background-color: #9400D3; color: white;"> <h3>View Users</h3> </summary>
                    <table class="table table-striped" style="background-color: #D8BFD8;" >
                        <?php 
                            $users_query = "SELECT * FROM users";
                            $users_query_result = mysqli_query($con, $users_query) or die(mysqli_error($con));
                            
                        if ( mysqli_num_rows($users_query_result) == 0){
                            echo 'No users found!';
                        }
                        else{
                        ?>
                        <thead>
                        <tr>
                          <th>ID</th>
                          <th>Name</th>
                        </tr>
                        </thead>
                        <tbody>
                          <?php
                          while( $row = mysqli_fetch_array($users_query_result) ){
                          echo "<tr> <td>".
                            $row['id'].
                            "</td> <td>".
                            "<button type='button' class='btn btn btn-link' data-toggle='modal' data-target='#".
                                  $row['name'].
                                  "'>".
                                  $row['name'].
                            "</button>".
                        "</td> <td> </tr>"; ?>
                            
                          <div class="modal" id="<?php echo $row['name'];?>" >
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h2 class="modal-title"><?php echo $row['name'];?>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </h2>
                                        
                                      </div>

                                      <div class="modal-body">
                                          <h4>E-mail ID: <?php echo $row['email'];?></h4>
                                          <h4>Current Credit: <?php echo $row['curr_cred'];?></h4>
                                          <br>
                                      </div>

                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" onclick="location.href='transfer.php'">Transfer Credit</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                      </div>

                                      </div>
                                    </div>
                                  </div>
                        
                        <?php }} ?>
                        </tbody>   
                    </table>
                    
                </details>
                
                <br><br>
                
                <details>
                    <summary style="padding: 0.75%; background-color: #00CED1; color: white;"> <h3>Transaction History</h3> </summary>
                    <table class="table table-striped" style="background-color: #E0FFFF;" >
                        <?php 
                            $trans_query = "SELECT * from transfer ORDER BY transac_id DESC";
                            $trans_query_result = mysqli_query($con, $trans_query) or die(mysqli_error($con));
                            
                        if ( mysqli_num_rows($trans_query_result) == 0){
                            echo '<h6 style="color:white;">No transactions done yet!</h6>';
                        }
                        else{
                        ?>
                        <thead>
                        <tr>
                          <th>ID</th>
                          <th>From</th>
                          <th>To</th>
                          <th>Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                          <?php
                          while( $row = mysqli_fetch_array($trans_query_result) ){
                          echo "<tr> <td>".
                            $row['transac_id'].
                            "</td> <td>".
                            $row['from_name'].
                           "</td> <td>".
                            $row['to_name'].
                           "</td> <td>".
                            $row['amt'].     
                        "</td> <td> </tr>"; ?>
                           <?php }} ?>
                        </tbody>   
                    </table>
                    
                </details>
                </div>
            </center>
  
        </div>
        
    </body>

</html>