<?php
require_once('admin/dbcon.php');
if (isset($_POST['submit'])){
    $roll = $_POST['roll'];
    $query = "SELECT * FROM student_info WHERE `roll`='$roll'";
    $result = mysqli_query($link, $query);
    $che = mysqli_num_rows($result);
    if (strlen ($roll) == 4 && $che==1){
        $row = mysqli_fetch_assoc ($result);
        $found ="";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" type="image/x-icon" href="img/icon.png">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="/css/navbar-fixed.css">
  <link href="/css/style.css" rel="stylesheet" />
  <title>SMS-Student Managment System</title>
</head>
<body>
<nav>
    <div>
        <ul class="nav-item">
            <li class="nav-link">
                <a class="btn btn-primary" href="admin/">Admin Login</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container">
    <h3 class="display-4 py-5 text-center">Student Management System <small>v1.0.0</small></h3>
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <form class="form-group" action="" method="POST">
                <div class="form-group">
          <span>Roll
        <input class="form-control" type="text" name="roll">
          </span>
                </div>
                <div class="form-group">
                    <input class="form-control btn btn-primary" type="submit" name="submit" value="Get Details">
                </div>
            </form>
        </div>
    </div>

    <?php
    if (isset($_POST['roll'])){
        if (isset($found)){
            require_once("getdetails.php");
        }
        else{
           echo "<img class='rounded mx-auto d-block' style='width:25%;' src='img/not.jpg' alt=''>";
        }

    }
   ?>
    </div>

  <script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/navbar-fixed.js"></script>
</body>
</html>