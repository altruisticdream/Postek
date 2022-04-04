<?php
session_start();


include "config.php";


$id = $_GET['id'];


$username1 = $_SESSION['username'];

$sql = "SELECT * FROM `users` WHERE id='$id';";
$result = mysqli_query($conn, $sql);

$rows = mysqli_fetch_assoc($result);
$fullname = $rows['fullname'];
$username = $rows['username'];
$image2 = $rows['image'];



$sql1 = "SELECT * FROM `post_100` WHERE username='$username';";
$result1 = mysqli_query($conn, $sql1);
$rows1 = mysqli_fetch_assoc($result1);




?>






<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./css/styletwo.css">
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
	<script src="https://kit.fontawesome.com/f66629755c.js" crossorigin="anonymous"></script>
	<title>Postek</title>
</head>

<body>
	<header class="header">
		<nav class="navbar bg-dark">
			<div class="container">
				<h1 class="logo heading text-light main-heading">Postek</h1>
				<ul class="nav-items">
					<li class="nav-item"><a href="index.php">Home</a></li>
					<li class="nav-item"><a href="about.php">About</a></li>
					<li class="nav-item"><a href="contact.php">Contact</a></li>
					<li class="nav-item"><a href="profile.php">Profile</a></li>
					<li class="nav-item"><a href="./logout.php">Logout</a></li>

				</ul>

			</div>

		</nav>
	</header>


	<div class="profile">
		<div class="profile1">
			<img src="img/<?php echo $image2 ?>" alt="photo">
			<div class="updatePhoto">
				<!-- <span>Update Image</span> -->
			</div>
			<div class="postform1">
				<div class="postform2" id="postform3">
					<form method="POST" action="addpic.php" enctype="multipart/form-data">
						<p>Choose image</p>
						<input type="file" name="image" required>
						<button type="submit" name="imagesubmit" value="UPLOAD">Submit</button>
					</form>
				</div>
			</div>
		</div>
		<div class="profile2">
			<p>Name : <?php echo $fullname ?></p>
			<p>Username : <?php echo $username ?></p>
			<p>Email : </p>
		</div>
	</div>

	<div class="profileforpost">

		<div class="postsection">
			<div class="postsectiointimeline">
				<p>Timeline</p>

			</div>
			<?php

			$count = mysqli_num_rows($result1);

			if ($count > 0) {
				while ($row1 = mysqli_fetch_assoc($result1)) {
					$fullname = $row1['fullname'];
					$time = $row1['time'];
					$postname = $row1['postname'];
					$desciption = $row1['description'];
					$imagename = $row1['image'];


			?>

					<div class="cards">
						<div class="author">
							<h2><?php echo $fullname ?></h2>
							<h5><?php echo $time ?></h5>
							<h3><?php echo $postname ?></h3>
						</div>
						<div class="text-contanier">
							<h3><?php echo $desciption ?></h3>
						</div>
						<div class="image-container">
							<img src="img/<?php echo $imagename ?>" alt="photo">

						</div>
					</div>


			<?php

				}
			}


			?>
		</div>

	</div>




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
<script>
	var showHide;

	function show_hide1() {
		if (showHide == 0) {
			document.getElementById("postform3").style.display = "none";
			return showHide = 1;
		} else {
			document.getElementById("postform3").style.display = "inline";
			return showHide = 0;
		}
	}
</script>