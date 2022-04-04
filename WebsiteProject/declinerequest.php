<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
	header("location: login.php");
	exit;
}

include "config.php";
$username=$_SESSION['username'];

$username2 = $_GET['usernameopp'];


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






$sql = "DELETE FROM `friends` WHERE `friends`.`user_one`= '$username' AND `friends`.`user_two` = '$username2';";
$sql1 = "DELETE FROM `friends` WHERE `friends`.`user_one`= '$username2' AND `friends`.`user_two` = '$username';";

$result = mysqli_query($conn, $sql);
$result1 = mysqli_query($conn, $sql1);


header("location: friends.php");



?>
