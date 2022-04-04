<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
	header("location: login.php");
	exit;
}

include "config.php";

$id=$_GET['id'];
$fullname=$_SESSION['fullname'];
$image=$_SESSION['image'];
$username=$_SESSION['username'];
$description=$_POST['desc'];

$sql1="INSERT INTO `comments` (`authname`, `user_image`, `comment_desc`, `comment_categary_id`, `comment_time`) VALUES ('$fullname', '$image', '$description','$id', CURRENT_TIMESTAMP);";
$result=mysqli_query($conn,$sql1);


header("location: comments.php?id=$id;");

?>
