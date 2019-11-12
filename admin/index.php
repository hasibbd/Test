<?php
session_start ();
if (!isset($_SESSION['user_login'])){
    header("location:login.php");
}
require_once('dbcon.php');
$u = $_SESSION['user_login'];
$query = "SELECT * FROM `users` WHERE `username`='$u'";
$result = mysqli_query($link, $query);
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="../img/icon.png">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../css/navbar-fixed.css">
    <link href="../css/style.css" rel="stylesheet"/>
    <title>SMS-Student Managment System</title>
</head>
<body>
<!--Navigation Section-->
<nav class="navbar bg-light navbar-light navbar-expand-md fixed-top">
    <a class="navbar-brand" href="index.php">SMS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>
<!--Nav Menu Section-->
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <p class="nav-link" href="#"><img style="width: 20px;" src="../img/<?php echo $row['photo'];?>"> Welcome <?php echo  $u; ?></php> </p>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=user-add"><i class="fa fa-user-plus"></i> Add User</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=profile"><i class="fa fa-user"></i> Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php"><i class="fa fa-power-off"></i> Logout</a>
            </li>
        </ul>
    </div>
</nav>
<!--Main Body Section-->
<section class="py-5 mt-4">
    <div class="">
        <div class="row">
<!--Sidebar Section-->
            <div class="px-5 col-lg-3">
                <ul class="list-group">
                    <a class="list-group-item active" href="index.php?page=dashboard"><i class="fa fa-dashboard"> Dashboard</i></a>
                    <a class="list-group-item" href="index.php?page=add-student"><i class="fa fa-user-plus"> Add Student</i></a>
                    <a class="list-group-item" href="index.php?page=all-student"><i class="fa fa-group"> All Student</i></a>
                    <a class="list-group-item" href="index.php?page=user"><i class="fa fa-user"> All Users</i></a>
                    <a></a>
                </ul>
            </div>
<!--Section Section-->
  <?php

        if (isset($_GET['page'])){
            $page= $_GET['page'].'.php';

           require_once("$page");

        }
        else{
            require_once("dashboard.php");
        }
  ?>
        </div>
    </div>
</section>
<!--Footer Section-->
<footer class="bg-primary text-light py-3">
    <p class="Lead text-center">Designed By: Hasibul Hasan</p>
</footer>

<script src="../js/jquery.min.js"></script>
<script src="../js/popper.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery.dataTables.min.js"></script>
<script src="../js/dataTables.bootstrap4.min.js"></script>
<script src="../js/datatables.script.js"></script>
<script src="../js/navbar-fixed.js"></script>
</body>
</html>
