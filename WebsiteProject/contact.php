<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.php");
    exit;
}


include "header.php";
?>





<section class="contact-form">
    <div class="container">
        <div class="form-wrapper">
            <div>
                <!-- <div class="company">
                    <div class="address-group">
                        <i class="far fa-envelope fa-3x text-red">
                            <h2 class="text-grey md-heading">Email</h2>
                            <p class="text-grey">Lorem, ipsum dolor.</p>
                        </i>
                    </div>
                    <div class="address-group">
                        <i class="fas fa-phone-square-alt fa-3x text-red">
                            <h2 class="text-grey md-heading">Call</h2>
                            <p class="text-grey">Lorem, ipsum dolor.</p>
                        </i>
                    </div>
                    <!-- <img src="./img/company-img.jpg" alt="companyimage"> -->
                </div> 
                <form action="" class="form">
                    <h1 class="heading text-black">Contact Us</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    <div class="form-group">
                        <label for="username">UserName</label>
                        <input type="text" name="" id="username">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="" id="email">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" name="" id="phone">
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea name="" id="message" required></textarea>
                        </div>
                        <button type="submit" class="form-btn">Submit</button>
                </form>
            </div>
        </div>

    </div>

</section>
</section>
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