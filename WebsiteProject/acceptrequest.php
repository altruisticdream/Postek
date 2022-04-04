<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
	header("location: login.php");
	exit;
}

include "config.php";
$username=$_SESSION['username'];


$username2 = $_GET['username2'];


// $id = $_GET['id'];
// $user_one=$_SESSION['username'];
// $user_two=$_SESSION['user_two'];
// echo $user_one;
// echo $user_two;

// $sql1 = "SELECT * FROM `users` WHERE id='$id';";
// $result1=mysqli_query($conn,$sql1);
// $rows=mysqli_fetch_assoc($result1);
// $user_two=$rows['username'];

// $sql="INSERT INTO `friends` (`user_one`, `user_two`, `isfriends`) VALUES ('$user_one', '$user_two', '0');";
// $result=mysqli_query($conn,$sql);
// $id = $_GET['id'];
// $sql1 = "SELECT * FROM `users` WHERE id='$id';";
// $result1=mysqli_query($conn,$sql1);
// $rows=mysqli_fetch_assoc($result1);

// $user_twoo=$rows['username'];


$sql="UPDATE `friends` SET `isfriends` = '1' WHERE `friends`.`user_one` = '$username2' AND `friends`.`user_two`='$username';";
$result=mysqli_query($conn,$sql);

$sql2="INSERT INTO `friends`(`user_one`,`user_two`,`isfriends`) VALUES ('$username','$username2','1');";
$result2=mysqli_query($conn,$sql2);

header("location: friends.php");



?>
