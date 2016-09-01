<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title> Movie Grid</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<link rel="stylesheet" type="text/css" href="css/styles.css">

</head>
 
<body>
    <div class="container" id="homepage">
            <div class="row" id = "topbar">
                <a href="."> <h1> MOVIE GRID </h1> </a>
                <h5>Byron Inocencio</h5>
            </div>
            <div class="row" id="description">
                <p> This is a very simple Movie Grid that follows CRUD design patterns. This application is written in PHP and connected to a MYSQL Database. This was created for CSE 135 Programming Assignment 3, Summer 2016 with Thomas Powell.
<br><br><b> Note: </b>Movie Posters have to be a real link or have to be manually inserted into our image folder on the server. Recommended: Use posters from impawards.com for simple testing with a valid image. Ideally, we would upload images within the application interface, but due to time constraint this was not implemented</p>
            </div>
            <div class="row">
               <p>
                   <a href="." class="btn btn-default">Home</a>
                   <a href="create.php" class="btn btn-success">Add Movie</a>
                   <a class = "pag btn" href="index.php?pag=all<?php if(!empty($_GET['sort']))echo '&sort='.$_GET['sort']?>">All</a>
                   <a class = "pag btn" href="index.php?pag=15<?php if(!empty($_GET['sort']))echo '&sort='.$_GET['sort']?>">15</a>
                   <a class = "pag btn" href="index.php?pag=10<?php if(!empty($_GET['sort']))echo '&sort='.$_GET['sort']?>">10</a>
                   <a class = "pag btn" href="index.php?pag=5<?php if(!empty($_GET['sort']))echo '&sort='.$_GET['sort']?>">5</a>
               </p>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th><a href="index.php?sort=name">Name</a></th>
                      <th><a href="index.php?sort=studio">Studio</a></th>
                      <th><a href="index.php?sort=year">Year</a></th>
                      <th><a href="index.php?sort=revenue">Revenue</a></th>
                      <th>Movie Poster</th>
                      <th id="actionHeader">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include 'database.php';
                   include 'paginator.php';
                   $paginator = new Paginator();
                   $pdo = Database::connect();

                   $sort = $_GET['sort'];             
                       
                   $sql = 'SELECT count(*) FROM movies ';
                   $paginator->paginate($pdo->query($sql)->fetchColumn());

                   $start = (($paginator->getCurrentPage()-1)*$paginator->itemsPerPage);
                   $length = ($paginator->itemsPerPage);
                   
                   if($sort == "name"){
                      $sql ="SELECT * FROM movies ORDER BY Movie_Name ASC limit $start, $length ";
                   }
                   elseif($sort == "studio"){
                      $sql ="SELECT * FROM movies ORDER BY Movie_Studio ASC limit $start, $length ";
                   }
                   elseif($sort == "year"){
                      $sql ="SELECT * FROM movies ORDER BY Movie_Year DESC limit $start, $length ";
                   }

                   elseif($sort == "revenue"){
                      $sql ="SELECT * FROM movies ORDER BY Movie_Revenue DESC limit $start, $length ";
                   }


                   else{
                   $sql = "SELECT * FROM movies limit $start, $length ";}
                   foreach ($pdo->query($sql) as $row) {
                            $link = $row['Movie_URL'];
                            //echo '<img src="'.$link.'" style="width:150px;height:200px;">';
                            echo '<tr>';
                            echo '<td>'. $row['Movie_Name'] . '</td>';
                            echo '<td>'. $row['Movie_Studio'] . '</td>';
                            echo '<td>'. $row['Movie_Year'] . '</td>';
                            echo '<td>'.'$'. $row["Movie_Revenue"] .' million'.'</td>';
                            echo '<td>'. '<img src="'.$link.'" style="width:150px;height:200px;" alt="">'.'</td>';
                            echo '<td>';
                            echo '<br><a class="btn btn-default" href="view.php?Movie_ID='.$row['Movie_ID'].'">View</a>';  
                            echo '<br><br>';
                            echo '<a class="btn btn-primary" href="update.php?Movie_ID='.$row['Movie_ID'].'">Update</a>';
                            echo '<br><br>';
                            echo '<a class= "btn btn-danger" href="delete.php?Movie_ID='.$row['Movie_ID'].'">Delete</a>';
                            echo '</td>';
                            echo '</tr>';
                   }
                   Database::disconnect();
                  ?>
                  </tbody>
            </table>
              <?php echo $paginator->pageNav();?>
        </div>
    </div> <!-- /container -->
  </body>
</html>
