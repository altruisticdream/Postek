<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "config.php";
    $username = $_POST['username'];
    $password = $_POST['password'];

    $hash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "SELECT * FROM users WHERE username='$username';";

    $result = mysqli_query($conn, $sql);

    $num = mysqli_num_rows($result);
    if ($num == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password'])) {
                $login = true;
                session_start();

                $query = "SELECT * FROM `users` WHERE `username`= '$username'";
                $result1 = mysqli_query($conn, $query);
                $row1 = mysqli_fetch_assoc($result1);
                $fullname = $row1['fullname'];
                $imagename = $row1['image'];

                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['fullname'] = $fullname;
                $_SESSION['image'] = $imagename;



                header("location: index.php");
            } else {
                echo '<script>alert("Error! Please enter a valid username or password")</script>';
            }
        }
    } 
    // else {
        echo '<script><alert("Error! Please Enter a valid username or password")</script>';
    // }
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
        <form action="login.php" method="POST">
            <div class="Login">
                <h3>LOGIN</h3><br>
                <label for="username">UserName</label><br>
                <input class="input1" type="text" name="username" id="username" placeholder="username"><br><br>
                <label for="password">Password</label><br>
                <input class="input1" type="password" name="password" id="password" placeholder="Password"><br><br>
                <button class="text-light" type="submit">Login</button><br><br><br>
                <h5>Create an account?<a href="register.php">Signup</a></h5>
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