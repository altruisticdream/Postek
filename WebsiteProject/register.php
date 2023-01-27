<?php
session_start();
// if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
//     header("location: login.php");
//     exit;
// }
$showalert = false;
$showerror = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // echo "1";
    include "config.php";
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    $sql = "SELECT * FROM users WHERE username='$username';";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // echo "1";
        echo '<script><alert("Pls Enter the differnt user name")</script>';
    } else if ($password == $cpassword) {

        $hash = password_hash($password, PASSWORD_DEFAULT);
        // $sql1 = "INSERT INTO `users` (`fullname`, `username`, `password`, `created_at`) VALUES ('$fullname', '$username', '$hash', current_timestamp());";
        
        $sql1="INSERT INTO `users` (`username`, `fullname`, `image`, `password`, `created_at`) VALUES ('$username', '$fullname','NULL.JPG', '$hash', CURRENT_TIMESTAMP);";

        $result = mysqli_query($conn, $sql1);
        echo "1";
        if ($result) {
            $showalert = true;
        }
    } else if ($password != $cpassword) {

        $showerror = true;
    }
}
if ($showalert == true) {
    echo '<script><alert("Congratulation your account is craeted")</script>';
}
if ($showerror == true) {
    echo '<script><alert("Error! Please Enter same password")</script>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styletwo.css">
    <script src="https://kit.fontawesome.com/f66629755c.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <nav class="navbar bg-dark">
        <div class="container">
            <h1 class="logo heading text-light">Postek</h1>
            <ul class="nav-items">
                <li class="nav-item"><a href="index.php">Home</a></li>
                <li class="nav-item"><a href="about.php">About</a></li>
                <li class="nav-item"><a href="contact.php">Contact</a></li>
                <li class="nav-item"><a href="profile.php">Profile</a></li>
                <li class="nav-item"><a href="register.php">Signup</a></li>

            </ul>

        </div>

    </nav>
    <div class="bigger-section">
        <form action="" method="post">

            <div class="signup">
                <h2 class="signup-heading">SIGNUP</h2>
                <label for="username">Username</label><br>
                <input name="username" class="input1" type="text" id="email" placeholder="UserName"><br><br>
                <label for="fullname">Fullname</label><br>
                <input name="fullname" class="input1" type="text" id="fullname" placeholder="Fullname"><br><br>
                <label for="password">Password</label><br>
                <input name="password" class="input1" type="password" id="password" placeholder="Password"><br><br>
                <label for="confirmpassword">Confirm Password</label><br>
                <input name="cpassword" class="input1" type="password" id="password" placeholder=" Confirm Password"><br><br>
                <button class="text-light" type="submit">Signup</button>

                <h3>Already a user?<a href="./login.php">Login</a></h3>
            </div>

        </form>

    </div>

    <footer class="footer">
        <div class="socialmedialinks">
            <i class="fab fa-facebook fa-4x"></i>
            <i class="fab fa-twitter fa-4x"></i>
            <i class="fab fa-instagram fa-4x"></i>
        </div>
        <p>Ashutosh Gautam &copy; 2022, All Rights Reserved</p>
    </footer>



</body>

</html>