<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<link rel="stylesheet" type="text/css" href="styles.css">;

</head>
 
<body>
    <div class="container">
            <div class="row" id = "topbar">
                <h1>MOVIE GRID</h1>
                <h5>Byron Inocencio</h5>
            </div>
            <div class="row">
               <p>
                   <a href="create.php" class="btn btn-success">Create</a>
               </p>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Studio</th>
                      <th>Year</th>
                      <th>Revenue</th>
                      <th>Movie Poster</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include 'database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM movies ORDER BY Movie_name ASC;';
                   foreach ($pdo->query($sql) as $row) {
                            $link = $row['Movie_URL'];
                            //echo '<img src="'.$link.'" style="width:150px;height:200px;">';
                            echo '<tr>';
                            echo '<td>'. $row['Movie_Name'] . '</td>';
                            echo '<td>'. $row['Movie_Studio'] . '</td>';
                            echo '<td>'. $row['Movie_Year'] . '</td>';
                            echo '<td>'.'$'. $row["Movie_Revenue"] . '</td>';
                            echo '<td>'. '<img src="'.$link.'"style="width:150px;height:200px;">'.'</td>';
                            echo '<td width =250>';
                            echo '<a class="btn btn-default" href="view.php?Movie_ID='.$row['Movie_ID'].'">View</a>';  
                            echo ' ';
                            echo '<a class="btn btn-success" href="update.php?Movie_ID='.$row['Movie_ID'].'">Update</a>';
                            echo ' ';
                            echo '<a class= "btn btn-danger" href="delete.php?Movie_ID='.$row['Movie_ID'].'">Delete</a>';
                            echo '</td>';
                            echo '</tr>';
                   }
                   Database::disconnect();
                  ?>
                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->
  </body>
</html>
