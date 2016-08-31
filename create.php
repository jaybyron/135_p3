<?php

    require 'database.php';

    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $studioError = null;
        $yearError = null;
        $revenueError = null;
        $URLError =null

        // keep track post values
        $name = $_POST['name'];
        $studio = $_POST['email'];
        $year = $_POST['mobile'];
        $revenue = $_POST['revenue'];
        $URL = $_POST['URL'];

        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Please enter Movie Name';
            $valid = false;
        }

        if (empty($studio)) {
            $studioError = 'Please enter Studio Name';
            $valid = false;
        }

        if (empty($year)) {
            $yearError = 'Please enter Year Value';
            $valid = false;
        }

        if (empty($revenue)){

            $revenueError = "Please enter Revenue value";
            $valid = false;
        }

       if  (empty($URL)){
           $URLError = "Please enter a valid image URL";
           $valid = false;
       }

        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO movies (Movie_Name, Movie_Studio, Movie_Year, Movie_Revenue, Movie_URL) values(?, ?, ?,?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$studio,$year,$revenue,$url));
            Database::disconnect();
            header("Location: index.php");
        }
    }
?>

<!DOCTYPE html>
<html lang = "en">
<head>
      <meta charset ="utf-8">
      
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>


<body>
    <div class="container">
     
                <div class="span9">
                    <div class="row">
                        <h3>Create a Customer</h3>
                    </div>
                      <form class="form-horizontal" action="create.php" method="post">

  
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Movie Name</label>
                        <div class="controls">
                            <input name="name" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>


                      <div class="control-group <?php echo !empty($studioError)?'error':'';?>">
                        <label class="control-label">Studio Name</label>
                        <div class="controls">
                            <input name="studio" type="text" placeholder="Studio Name" value="<?php echo !empty($studio)?$studio:'';?>">
                            <?php if (!empty($studioError)): ?>
                                <span class="help-inline"><?php echo $studioError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                    
                     <div class="control-group <?php echo !empty($yearError)?'error':'';?>">
                        <label class="control-label">Release Year</label>
                        <div class="controls">
                            <input name="year" type="text"  placeholder="Release Year" value="<?php echo !empty($year)?$year:'';?>">
                            <?php if (!empty($yearError)): ?>
                                <span class="help-inline"><?php echo $yearError;?></span>
                            <?php endif;?>
                        </div>
                      </div>


                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="index.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
        
