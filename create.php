<?php require 'database.php';

	if ( !empty($_POST)) {
		// keep track validation errors
		$nameError = null;
		$studioError = null;
		$yearError = null;
		$revenueError = null;
                $URLError = null;

		// keep track post values
		$name = $_POST['name'];
		$studio = $_POST['studio'];
		$year = $_POST['year'];
                $revenue = $_POST['revenue'];
                $URL = $_POST['URL'];
		
		// validate input
		$valid = true;
		if (empty($name)) {
			$nameError = 'Please enter a Movie Title';
			$valid = false;
		}
		
		if (empty($studio)) {
			$studioError = 'Please enter a valid Studio';
			$valid = false;
		} 
			
		if (empty($year)) {
			$yearError = 'Please enter a valid year';
			$valid = false;
		}

                if (empty($revenue)){
                       $revenueError = 'please enter a valid revenue';
                       $valid = false;
                }

                if (($revenue > 100000)){
                     $revenueError= 'Too large of a number. Highest value: 100000';
                     $valid = false;
                }
                if (($year>2016)){
                    $yearError ='Please enter a valid year in the past';
                    $valid = false;
                }

                if (($revenue <0)){
                     $revenueError ='please enter a valid revenue: (NON-NEGATIVE) ';
                     $valid = false;
                }

                if (($year<0)){
                    $revenueError ='please enter a valid year: (NON-NEGATIVE) ';
                }
                if (empty($URL)){
                       $URLError = 'please enter a valid URL';
                       $valid = false;
                }
		
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO movies (Movie_Name,Movie_Studio,Movie_Year,Movie_Revenue,Movie_URL) values(?, ?, ?, ? ,?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($name,$studio,$year,$revenue,$URL));
			Database::disconnect();
			header("Location: index.php");
		}
	}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title> Create Movie </title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<link rel="stylesheet" type="text/css" href="css/styles.css">


</head>

<body>
    <div class="container">
    			<div class="span12" id ="cw">
                                         <h3>Create Movie!</h3>   		
 	    			<form class="form-horizontal" action="create.php" method="post">
                                          <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
					    <label class="control-label">Movie Title</label>
					    <div class="controls">
					      	<input name="name" type="text" placeholder="Movie Name" value="<?php echo !empty($name)?$name:'';?>">
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
					      	<input name="year" type="number"  placeholder="Released In..." value="<?php echo !empty($year)?$year:'';?>">
					      	<?php if (!empty($yearError)): ?>
					      		<span class="help-inline"><?php echo $yearError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>


					  <div class="control-group <?php echo !empty($revenueError)?'error':'';?>">
					    <label class="control-label">Gross Revenue</label>
					    <div class="controls">
					      	<input name="revenue" type="number"  placeholder="Total Revenue..." value="<?php echo !empty($revenue)?$revenue:'';?>">
					      	<?php if (!empty($revenueError)): ?>
					      		<span class="help-inline"><?php echo $revenueError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>


					  <div class="control-group <?php echo !empty($URLError)?'error':'';?>">
					    <label class="control-label">Image URL</label>
					    <div class="controls">
					      	<input name="URL" type="text"  placeholder="IMG URL" value="<?php echo !empty($URL)?$URL:'';?>">
					      	<?php if (!empty($URL)): ?>
					      		<span class="help-inline"><?php echo $URL;?></span>
					      	<?php endif;?>
					    </div>
					  </div>


					  <div class="form-actions">
                                                  <br>
						  <button type="submit" class="btn btn-success">Create</button>
						  <a class="btn btn-default" href="index.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>
