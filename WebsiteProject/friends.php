<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
	header("location: login.php");
	exit;
}
include "config.php";

// $sql="SELECT fullname FROM users;";
// $result=mysqli_query($conn,$sql);
// $rows=mysqli_fetch_assoc($result);
// $fullname=$rows['fullname'];
$username1 = $_SESSION['username'];
$imagename1 = $_SESSION['image'];

$sql = "SELECT * FROM users WHERE username='$username1';";
$result = mysqli_query($conn, $sql);
$rows = mysqli_fetch_assoc($result);
$fullname = $rows['fullname'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./css/styletwo.css">

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
	<div class="friendprofile2">
		<div class="internalprofile2">
			<img src="img/<?php echo $imagename1 ?>" alt="phto">
			<div class="profile22">
				<p>Name : <?php echo $fullname ?></p>
				<p>Username : <?php echo $username1 ?></p>


			</div>
		</div>

	</div>
	<div class="tabscontent">
		<ul class="tabs">
			<li data-tab-target="#user" class="active tab">USERS</li>
			<li data-tab-target="#friends" class="tab">FRIENDS</li>
			<li data-tab-target="#requests" class="tab">REQUESTS</li>
		</ul>

		<div class="tab-content">
			<div id="user" data-tab-content class="active">
				<div class="user-cards">

					<?php
					$username = $_SESSION['username'];
					
					// echo $username;
					$sql1 = "SELECT * FROM users WHERE username!='$username;'";
					$result1 = mysqli_query($conn, $sql1);
					$rows1 = mysqli_fetch_assoc($result1);


					if ($result1 == TRUE) {
						$count = mysqli_num_rows($result1);
						if ($count > 0) {
							while ($rows1 = mysqli_fetch_assoc($result1)) {

								$fullname1 = $rows1['fullname'];
								$username2=$rows1['username'];
								// echo $username2;
								$compare = $rows1['username'];
								$imagename = $rows1['image'];
								$id = $rows1['id'];
								if ($username == $compare) {
									continue;
								}
					    ?>
								<div class="cards2">
									<div class="image-class-of-user">
										<img src="img/<?php echo $imagename ?>" alt="photo">
									</div>
									<div class="whitebutton">
										<p> <?php echo $fullname1 ?></p>
										<button class="Profilebuttonuser"><a href="user_profile.php?id=<?php echo $id; ?>">VIEW PROFILE</a></button>


										<?php
										
										$check = "SELECT * FROM `friends` WHERE `user_two` = '$username2' AND `isfriends` = '0';";
										$checkresult = mysqli_query($conn, $check);
										$countresult = mysqli_num_rows($checkresult);

										if($countresult == 0) {
											?>
											<button class="Profilebuttonuser"><a href="addfriends.php?usernameopp=<?php echo $username2; ?>">ADD USER</a></button> 
											<?php
										}


										?>



									</div>

								</div>


					    <?php

							}
						}
					}
					?>
				</div>
			</div>
			<div id="friends" data-tab-content>
			<?php
					$username = $_SESSION['username'];
					// echo $username;

					$sql1 = "SELECT * FROM `friends` WHERE user_two='$username' AND isfriends='1';";
					$result1 = mysqli_query($conn, $sql1);
					$rows1 = mysqli_fetch_assoc($result1);
					if ($result1 == TRUE) {
						$count = mysqli_num_rows($result1);
						if ($count > 0) {
							while ($rows1 = mysqli_fetch_assoc($result1)) {
								$user_onename=$rows1['user_one'];
								$sql3="SELECT * FROM `users` WHERE `username`='$user_onename';";
								$result3=mysqli_query($conn,$sql3);
								$rows3=mysqli_fetch_assoc($result3);

								// $fullname1 = $rows1['fullname'];
								// $compare = $rows1['user_one'];
								$imagename = $rows3['image'];
								// $id = $rows1['id'];
								// if ($username == $compare) {
								// 	continue;
								// }
					?>
								<div class="cards2">
									<div class="image-class-of-user">
										<img src="img/<?php echo $imagename ?>" alt="photo">
									</div>
									<div class="whitebutton">
										 <p> <?php echo $user_onename ?></p> 
										<button class="Profilebuttonuser"><a href="user_profile.php?id=<?php echo $id;?>">VIEW PROFILE</a></button> 
										<button class="Profilebuttonuser"><a href="removefriends.php?usernameopp=<?php echo $user_onename;?>">REMOVE FRIEND</a></button> 
									</div>

								</div>
					<?php
							}
						}
					}
					?>
			</div>
			<div id="requests" data-tab-content>
			<?php
					$username = $_SESSION['username'];
					// echo $username;
					
					$sql1 = "SELECT * FROM `friends` WHERE user_two='$username' AND isfriends='0';";
					$result1 = mysqli_query($conn, $sql1);
					$rows1 = mysqli_fetch_assoc($result1);
					if ($result1 == TRUE) {
						$count = mysqli_num_rows($result1);
						if ($count > 0) {
							while ($rows1 = mysqli_fetch_assoc($result1)) {
								$user_onename=$rows1['user_one'];
								
								$sql3="SELECT * FROM `users` WHERE `username`='$user_onename';";
								$result3=mysqli_query($conn,$sql3);
								$rows3=mysqli_fetch_assoc($result3);
								// $fullname1 = $rows1['fullname'];
								// $compare = $rows1['user_one'];
								$imagename = $rows3['image'];
								// $id = $rows1['id'];
								// if ($username == $compare) {
								// 	continue;
								// }
					?>
								<div class="cards2">
									<div class="image-class-of-user">
										<img src="img/<?php echo $imagename ?>" alt="photo"> 
									</div> 
									<div class="whitebutton">
										<p> <?php echo $user_onename ?></p>
										<button class="Profilebuttonuser"><a href="acceptrequest.php?username2=<?php echo $user_onename; ?>">ACCEPT</a></button>
										<button class="Profilebuttonuser"><a href="addfriends.php?id=<?php echo $id;?>">DECLINE</a></button>
									</div>

								</div>
					<?php
							}
						}
					}
					?>
			</div>
		</div>
	</div>
</body>

</html>

<script>
	const tabs = document.querySelectorAll('[data-tab-target]')
	const tabContents = document.querySelectorAll('[data-tab-content]')

	tabs.forEach(tab => {
		tab.addEventListener('click', () => {
			const target = document.querySelector(tab.dataset.tabTarget)
			tabContents.forEach(tabContent => {
				tabContent.classList.remove('active')
			})
			tabs.forEach(tab => {
				tab.classList.remove('active')
			})
			tab.classList.add('active')
			target.classList.add('active')
		})
	})
</script>
<?php
include "footer.php";
?>