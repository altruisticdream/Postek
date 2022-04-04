<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.php");
    exit;
}
include "config.php";
include "header.php";

$id = $_GET['id'];



$sql = "SELECT * FROM `post_100` WHERE id='$id';";
$result = mysqli_query($conn, $sql);
$rows = mysqli_fetch_assoc($result);

$authname = $rows['fullname'];
$time = $rows['time'];
$image = $rows['image'];
$postname = $rows['postname'];
$desc = $rows['description'];
// echo $authname;
// echo $time;
// echo $image;
// echo $desc;

$sql1 = "SELECT * FROM `comments` WHERE comment_categary_id='$id';";
$result1 = mysqli_query($conn, $sql1);
$rows1 = mysqli_fetch_assoc($result1);



?>
<div class="cardscomments">
    <div class="whitebox">
        <div class="author">
            <h1>Author: <?php echo $authname ?></h1>
            <h4>Time: <?php echo $time ?></h4>
            <h2>Post Name: <?php echo $postname ?></h2>
        </div>
        <div class="text-contanier">
            <h4>Description: <?php echo $desc ?></h4>
        </div>
    </div>
    <div class="image-container">
        <img src="img/<?php echo $image ?>" alt="photo">

    </div>

    <div class="buttonandcomment">

        <form action="addcomment.php?id=<?php echo $id; ?>" method="POST">
            <div class="comments-section">
                <input name="desc" type="text" placeholder="Comments">
                <button>Add Comments</button>
            </div>


        </form>
    </div>

</div>
<?php

$count = mysqli_num_rows($result1);

if ($count > 0) {
    while ($rows1 = mysqli_fetch_assoc($result1)) {
        $username = $rows1['authname'];
        $imagename = $rows1['user_image'];
        $desciption = $rows1['comment_desc'];



?>

        <div class="comments-cards">

            <div class="comments-block">
                <div class="image-class-of-user">
                    <img src="img/<?php echo $imagename ?>" alt="photo">
                </div>
                <div>
                    <p><?php echo $username ?></p>
                    <p>Comments: <?php echo $desciption ?></p>

                </div>

            </div>

        </div>


<?php

    }
}


?>






<?php
include "footer.php";
?>