<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
	header("location: login.php");
	exit;
}


include "config.php";
$username2 = $_SESSION['username'];
$fullname2= $_SESSION['fullname'];
$g = $_POST['postname'];
$postname = strtoupper($g);
$description = $_POST['description'];




if(isset($_POST['imagesubmit'])) {

    $file = $_FILES['image'];

    $imagename = $file['name'];
    // echo $imagename;
    
    $tmplocation = $file['tmp_name'];
    $fileExt = pathinfo($imagename, PATHINFO_EXTENSION);
    // echo $fileExt;

    $imagesize = $file['size'];

    $allowedExt = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
    if(in_array($fileExt, $allowedExt))
     {
        if($imagesize < 10000000) {
            $dest = './img/'.$imagename;
            move_uploaded_file($tmplocation, $dest);
            echo $dest;
            echo '1';
            $sql="INSERT INTO `post_100` (`fullname`, `username`, `time`, `image`, `postname`, `description`) VALUES ('$fullname2', '$username2', current_timestamp(), '$imagename', '$postname', '$description');";
            $result = mysqli_query($conn, $sql);
            header("location: index.php");
        }
        header("location: index.php");
    }
    header("location: index.php");
}

?>