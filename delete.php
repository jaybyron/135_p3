<?php
    require 'database.php';
    $id = 0;
     
    if ( !empty($_GET['Movie_ID'])) {
        $id = $_REQUEST['Movie_ID'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $id = $_POST['Movie_ID'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM movies  WHERE Movie_ID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        Database::disconnect();
        header("Location: index.php");
         
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title> Delete Movie </title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<link rel="stylesheet" type="text/css" href="css/styles.css">



</head>
 
<body>
    <div class="container">
     
                <div class="" id="cw">
                    <div class="row">
                        <h3>Delete a Movie</h3>
                    </div>
                     
                    <form class="form-horizontal" action="delete.php" method="post">
                      <input type="hidden" name="Movie_ID" value="<?php echo $id;?>"/>
                      <p class="alert alert-danger">Are you sure to delete?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a class="btn btn-default" href="index.php">No</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
