<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
	header("location: login.php");
	exit;
}

include "config.php";

$user_one=$_SESSION['username'];
$user_two = $_GET['usernameopp'];

// echo $user_two;

// echo $user_one;
// echo $user_two;
// $user_two=$_SESSION['user_two'];
// echo $user_one;
// echo $user_two;

// $sql1 = "SELECT * FROM `users` WHERE id='$id';";
// $result1=mysqli_query($conn,$sql1);
// $rows=mysqli_fetch_assoc($result1);
// $user_two=$_GET['user_two'];

$sql="INSERT INTO `friends` (`user_one`, `user_two`, `isfriends`) VALUES ('$user_one', '$user_two', '0');";
$result=mysqli_query($conn,$sql);

$sql1="INSERT INTO `friends` (`user_one`, `user_two`, `isfriends`) VALUES ('$user_one', '$user_two', '0');";
$result1=mysqli_query($conn,$sql1);
header("location: friends.php");

?>
