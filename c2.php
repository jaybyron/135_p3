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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>




</head>

<body>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Insert A Movie!</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="create.php" method="post">
					  <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
					    <label class="control-label">Name</label>
					    <div class="controls">
					      	<input name="name" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
					      	<?php if (!empty($nameError)): ?>
					      		<span class="help-inline"><?php echo $nameError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
					    <label class="control-label">Email Address</label>
					    <div class="controls">
					      	<input name="email" type="text" placeholder="Email Address" value="<?php echo !empty($email)?$email:'';?>">
					      	<?php if (!empty($emailError)): ?>
					      		<span class="help-inline"><?php echo $emailError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($mobileError)?'error':'';?>">
					    <label class="control-label">Mobile Number</label>
					    <div class="controls">
					      	<input name="mobile" type="text"  placeholder="Mobile Number" value="<?php echo !empty($mobile)?$mobile:'';?>">
					      	<?php if (!empty($mobileError)): ?>
					      		<span class="help-inline"><?php echo $mobileError;?></span>
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
