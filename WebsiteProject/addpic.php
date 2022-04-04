<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
	header("location: login.php");
	exit;
}

include "config.php";
$username4=$_SESSION['username'];
// $g = $_POST['postname'];





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
            // echo $dest;
            $_SESSION['image']=$imagename;
            echo $_SESSION['image'];

            $sql="UPDATE `users` SET `image` = '$imagename' WHERE `users`.`username` = '$username4';";
            $result = mysqli_query($conn, $sql);
            header("location: index.php");
        }
        header("location: index.php");
    }
    header("location: index.php");
}

?>