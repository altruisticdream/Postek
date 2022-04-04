<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.php");
    exit;
}

include "config.php";
include "header.php";

// $sql = "SELECT * FROM post_100";
// $result = mysqli_query($conn, $sql);
// $rows = mysqli_fetch_assoc($result);
// $fullname1=$rows['username'];



$username1 = $_SESSION['username'];
$sql1 = "SELECT * FROM users WHERE username='$username1';";
$result1 = mysqli_query($conn, $sql1);
$rows1 = mysqli_fetch_assoc($result1);
$fullname = $rows1['fullname'];

// $username = $rows1['username'];
// $_SESSION['image']=$imagename;

$userimage=$_SESSION['image'];
// echo $userimage;

?>



<div class="profile4">
    <div class="profile3">
        <img src="./img/<?php echo $userimage; ?>" alt="photo">
        
    </div>
    <div class="profile2">
        <p style="font-size: 1.5rem;">FULLNAME: <?php echo $fullname ?></p>
        <p style="font-size: 1.5rem;">USERNAME: <?php echo $username1 ?></p>

    </div>
            <!-- post section  -->
    <button class="addpost" onclick="show_hide()">
        <span>Add Post</span>
    </button>
    <div class="postform1">
        <div class="postform2" id="postform3">
            <form method="POST" action="addpost.php" enctype="multipart/form-data">
                <p>Enter the name of Post</p>
                <input type="text" name="postname" placeholder="Post name" required minlength="4"><br>
                <p>Choose image (upto 5 MB)</p>
                <input type="file" name="image" required>
                <p>Post description</p>
                <textarea name="description" cols="40" rows="10" required minlength="5"></textarea><br>
                <button type="submit" name="imagesubmit" value="UPLOAD">Submit</button>
            </form>
        </div>
    </div>
</div>

<div class="float-right-most">
    <div class="app-wrap">
            <div class="headerr">
                <input type="text" autocomplete="off" class="search-box" placeholder="Search City">
            </div>
            <main>
                <section class="location">   
                    <div class="city">Lucknow,India</div>
                    <div class="date">Thursday 5 Febraury 2022</div>
                </section>
                <div class="current">
                    <div class="temp">15<span>°c</span></div>
                    <div class="weather">Sunny</div>
                    <div class="hi-low">13°c/16°c</div>
                </div>
            </main>
        </div>

</div>

<div class="float-right">

    <!-- <div class="wrapper">
        <div class="search_box">
            <div class="search_btn"><i class="fas fa-search"></i></div>
            <input type="text" class="input_search" placeholder="What are you looking for?">
        </div>
    </div> -->




    <?php

    $sql = "SELECT * FROM post_100";
    $result = mysqli_query($conn, $sql);
    $rows2=mysqli_fetch_assoc($result);
    

    if ($result == TRUE) {
        $count = mysqli_num_rows($result);
        if ($count > 0) {
            while ($rows2 = mysqli_fetch_assoc($result)) {
                $m = $rows2['postname'];
                $postname = strtoupper($m);
                $fullname1=$rows2['fullname'];
                // $id = $rows['sno'];
                $username = $rows2['username'];
                $description = $rows2['description'];
                $time = $rows2['time'];
                $image = $rows2['image'];
                $id=$rows2['id'];
    ?>

                <div class="cards">
                    <a href="comments.php?id=<?php echo $id;?>">
                        <div>

                            <div class="whitebox">
                            <div class="author">
                                <h2><?php echo $fullname1 ?></h2>
                                <h5>Posted at: <?php echo $time ?></h5>
                                <h3>Post Name: <?php echo $postname ?></h3>
                            </div>
                            <div class="text-contanier">
                                <h3>Description: <?php echo $description ?></h3>
                            </div>
                            </div>
                            
                            <div class="image-container">
                                <img src="img/<?php echo $image?>" alt="photo">
                                
                            </div>
                        </div>
                    </a>
                    
                        <!-- <button class="addcomments" onclick="show_hide3()">
                            <span>Comments</span>
                         </button>
                         <form action="" method="post">

                             <div class="comments-section" id="postform4">
                                 <input type="text" placeholder="Comments">
                             </div>

                         </form> -->
                </div>


    <?php

            }
        }
    }


    ?>
</div>

<?php
include "footer.php"
?>

<script>
    var showHide;

    function show_hide() {
        if (showHide == 0) {
            document.getElementById("postform3").style.display = "none";
            return showHide = 1;
        } else {
            document.getElementById("postform3").style.display = "inline";
            return showHide = 0;
        }
    }


    var showHide3;

    function show_hide3() {
        if (showHide3 == 0) {
            document.getElementById("postform4").style.display = "none";
            return showHide3 = 1;
        } else {
            document.getElementById("postform4").style.display = "inline";
            return showHide3 = 0;
        }
    }
    const api = {
    key: "1613b1ea1b6fa3699cf1fcdc9ee93058",
    baseurl: "https://api.openweathermap.org/data/2.5/"
  }
  
  const searchbox = document.querySelector('.search-box');
  searchbox.addEventListener('keypress', setQuery);
  
  function setQuery(evt) {
    if (evt.keyCode == 13) {
      getResults(searchbox.value);
    }
  }
  
  function getResults (query) {
    fetch(`${api.baseurl}weather?q=${query}&units=metric&APPID=${api.key}`)
      .then(weather => {
        return weather.json();
      }).then(displayResults);
  }
  

  function displayResults (weather){
      let city=document.querySelector('.location .city');
      city.innerText = `${weather.name}, ${weather.sys.country}`;

      let now=new Date();
      let date=document.querySelector('.location .date');
      date.innerText=dateBuilder(now);

      let temp=document.querySelector('.current .temp');
      temp.innerHTML=`${Math.round(weather.main.temp)}<span>°c</span>`;

      let weather_el=document.querySelector('.current .weather');
      weather_el.innerText=weather.weather[0].main;

      let hilow=document.querySelector('.hi-low')
      hilow.innerText=`${Math.round(weather.main.temp_min)}°c / ${Math.round(weather.main.temp_max)}°`
  }


  function dateBuilder (d) {
    let months = ["January", "February", "March", "Apri l", "May", "June", "July", "August", "September", "October", "November", "December"];
    let days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

    let day=days[d.getDay()];
    let date=d.getDate();
    let month=months[d.getMonth()];
    let year=d.getFullYear();

    return `${day} ${date} ${month} ${year}`; 
  }

   

</script>