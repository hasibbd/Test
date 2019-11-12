
<?php
require_once('dbcon.php');
session_start();
if (isset($_SESSION['user_login'])){
    header("location:index.php");
}
if (isset($_POST['Login'])) {
    $user = $_POST['user'];
    $pass = $_POST['password'];
    $query ="SELECT * FROM `users` WHERE `username`='$user' && `password`='$pass'";
    $result=mysqli_query($link,$query);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count>0) {
        $login_suc = "Successfull Login";
        $_SESSION['user_login'] = $user;
        header("location: index.php");
    }else {
        $login_error = "Username or Password Wrong";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="../img/m.png">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/navbar-fixed.css">
    <link href="../css/style.css" rel="stylesheet" />
    <title>Student Management System</title>
</head>
<body>
<div class="container py-5 text-center">
    <h3 class="display-4">Student Management System</h3>
    <div class="row justify-content-md-center py-5">
        <div class="col-lg-4 ">
      <span class="" for=""><?php if (isset($login_error)) {
              echo $login_error;
          } ?></span>
            <span class="" for=""><?php if (isset($login_suc)) {
                    echo $login_suc;
                } ?></span>
            <form class="" action="" method="post">

                <div class="">
                    <input class="form-control" type="text" name="user" value="" placeholder="Username" id="user">
                </div>
                <br>
                <div class="">
                    <input class="form-control" type="password" name="password" value="" placeholder="Password" id="password">
                </div>
                <br>
                <div class="">
                    <input class="btn btn-primary" type="submit" name="Login" value="Login">
                    <a class="btn btn-primary" href="add-user.php">Registratiion</a>
                </div>
            </form>

        </div>
    </div>
</div>

<script src="../js/jquery.min.js"></script>
<script src="../js/popper.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/navbar-fixed.js"></script>
</body>
</html>
