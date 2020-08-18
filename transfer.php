<?php
    $con = mysqli_connect("sql102.epizy.com","epiz_26467073","Shr9zmqlnyEq", "epiz_26467073_creditmanagementdb") or die(mysqli_error($con));
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Transfer | CreditManagement</title>
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link href="https://fonts.googleapis.com/css2?family=Chelsea+Market&display=swap" rel="stylesheet">
        
        <style>
            .alert {
                padding: 10px;
                background-color: #f44336;
                color: white;
              }
            .closebtn:hover {
                color: black;
              }
             body{
                background-color: #FFFACD;
                font-family: 'Chelsea Market', cursive;        
            }
        </style>
        
    </head>
    
    <body>
        
        <div class="container">
           <div class="row" style="margin-top: 75px;">
              <div class="col-sm-offset-3 col-sm-6 col-sm-offset-3 col-xs-offset-1 col-xs-10 col-xs-offset-1 column_style">
              <div class = "panel panel-primary">
              
              <div class="panel-heading">
              <h2>
                  Transfer Credit
              </h2>
              </div>
                  <div class="panel-body">
              
                  <form action="transfer_script.php" method="POST">
                  <div class="form-group">
                      <label for="from">From :</label>
                        <select class="form-control" id="from" name="from">
                          <?php
                          $users_query = "SELECT * FROM users";
                          $users_query_result = mysqli_query($con, $users_query) or die(mysqli_error($con));
                          while( $row = mysqli_fetch_array($users_query_result) ){
                          echo "<option>".$row['name']."</option>"; }
                          ?>
                        </select>
                  </div>
                      
                  <div class="form-group">
                      <label for="to">To :</label>
                        <select class="form-control" id="to" name="to">
                          <?php
                          $users_query = "SELECT * FROM users";
                          $users_query_result = mysqli_query($con, $users_query) or die(mysqli_error($con));
                          while( $row = mysqli_fetch_array($users_query_result) ){
                          echo "<option>".$row['name']."</option>"; }
                          ?>
                        </select>
                  </div>
                      
                  <?php if( isset($_GET['sameName'])) {?> 
                      <div class="alert" style="margin-top: 14px;">
                            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                            <p><?php echo $_GET['sameName']?></p>
                        </div>
                  <?php } ?>       
                  
                  <div class="form-group">
                      <label for="amt">Amount to be transferred :</label>
                      <input type="text" class="form-control" id="amt" pattern="^[0-9]*$" required="true" name="amt">
                  </div>
                  <?php if( isset($_GET['error_incurred'])) {?> 
                      <div class="alert" style="margin-top: 14px;">
                            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                            <p><?php echo $_GET['error_incurred']?></p>
                        </div>
                  <?php } ?>   
                      
                   <?php if( isset($_GET['invalidAmt'])) {?> 
                      <div class="alert" style="margin-top: 14px;">
                            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                            <p><?php echo $_GET['invalidAmt']?></p>
                        </div>
                   <?php } ?>
                      
                  <div class="form-group">
                      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                  </div>
                  
                      
                    <?php if( isset($_GET['credUpdate'])) {?>   
                      <script>
                        function myFunction() {
                            var txt;
                            if (confirm("Success!")) {
                                window.location.replace("index.php");
                            }
                        }
                        
                        myFunction();
                      </script>
                    <?php } ?>
                    
                      
                  </form>
                  </div>
                
                </div>
                </div>
            </div>
        </div>   
                   
        
    </body>
    
</html>