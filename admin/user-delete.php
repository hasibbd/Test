<?php
if (!isset($_SESSION['user_login'])){
    header("location:login.php");
}
require_once('dbcon.php');
$id = base64_decode($_GET['id']);
require_once('dbcon.php');
$query = "DELETE FROM `users` WHERE `id`='$id'";
$result = mysqli_query($link,$query);
header("location:index.php?page=user");
?>