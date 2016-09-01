<?php
    require 'database.php';
    $id = null;
    if ( !empty($_GET['Movie_ID'])) {
        $id = $_REQUEST['Movie_ID'];
    }
     
    if ( null==$id ) {
        header("Location: index.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM movies where movie_ID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title> View Movie </title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<link rel="stylesheet" type="text/css" href="css/styles.css">


</head>
 
<body>
    <div class="container-fluid">
   
                  <?php echo '<img id="viewimage" src="'.$data['Movie_URL'].'" alt="">';?>
                   <div class="row" id="movcontent">
                      
                      <h2> Movie Details </h2>    
                      <div class="">
                        <label class="">Movie Title:</label>
                                <?php echo $data['Movie_Name'];?>
                      </div>

                      <div class="">
                        <label class="">Movie Studios:</label>
                                <?php echo $data['Movie_Studio'];?>
                      </div>

                      <div class="">
                        <label class="">Movie Release Date:</label>
                                <?php echo $data['Movie_Year'];?>
                      </div>

                      <div class="">
                        <label class=""> Movie Revenue:</label>
                                <?php echo '$'.$data['Movie_Revenue'].' Million';?>
                      </div>

                        <div class="form-actions">
                          <a class="btn btn-primary" href="index.php">Back</a>
                       </div>
                     
                    </div>
                 
    </div> <!-- /container -->
  </body>
</html>
