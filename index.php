<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HOME PAGE</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
        integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous" /> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script> -->
<!-- 
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin /> -->

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BDMS WEBSITE</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
        integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;700&display=swap" rel="stylesheet" />
</head>
<body>
<?php
session_start();
if(empty($_SESSION['username']))
{
    header('location:login.php');
}
if(!empty($_SESSION['username']))
{
$username = $_SESSION['username'];
}
?>

<section class="header">
        <nav>
            <a href="index.html"><img src="trial.png" /></a>
            <div class="nav-links" id="navLinks">
                <i class="bi bi-x-lg" onclick="hideMenu()"></i>
            <ul>
            <li><a href="index.php">HOME</a></li>
                <li><a href="requirements.php">REQUIREMENTS</a></li>
                <li><a href="donator.php">DONATE</a></li>
                <li><a href="view_donator.php">REQUEST</a></li>
                <li><a href="certificate.php">CERTIFICATE</a></li>

                <li ><a href="logout.php" class="logout-button">LOGOUT</a></li>
            </ul>
            </div>
            <i class="bi bi-list" onclick="showMenu()"></i>
        </nav>
        <div class="text-box">
            <h2>WELCOME TO</h2>
            <h1>BLOOD DONATION SYSTEM MANAGEMENT!</h1>
            <p>DONATE BLOOD, SAVE LIFE.</p>
            <br />
            <a href="donator.php" class="hero-btn">DONATE NOW!</a>
        </div>

    
<style>
  
* {
    margin: 0;
    padding: 0;
    font-family: "Roboto", sans-serif;
}

.header {
    min-height: 100vh;
    width: cover;
    background-image: linear-gradient(rgba(4, 9, 30, 0.7), rgba(4, 9, 30, 0.7)),
        url(med.png);
    background-position: center;
    background-size: cover;
    position: relative;
}

nav {
    display: flex;
    padding: 2% 6%;
    justify-content: space-between;
    align-items: center;
}
nav img {
    width: 150px;
}
.nav-links {
    flex: 1;
    text-align: right;
}
.nav-links ul li {
    list-style: none;
    display: inline-block;
    padding: 20px 12px;
    position: relative;
}
.nav-links ul li a {
    color: #fff;
    text-decoration: none;
    font-size: 14px;
}

.nav-links ul li a::after {
    content: "";
    width: 0%;
    height: 2px;
    background: yellow;
    display: block;
    margin: auto;
    transition: 0.5s;
}
.nav-links ul li a:hover::after {
    width: 100%;
}

.text-box {
    width: 90%;
    color: #fff;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
}
.hero-btn {
    display: inline-block;
    text-decoration: none;
    color: #fff;
    border: 1px solid #fff;
    padding: 12px 34px;
    font-size: 13px;
    background: transparent;
    position: relative;
    cursor: pointer;
}

.hero-btn:hover {
    border: 1px solid #fff;
    background: yellow;
    transition: 1s;
}
nav .bi {
    display: none;
}


    @media (max-width: 768px) {
    .text-box h1 {
        font-size: 20px;
    }
    .nav-links ul li {
        display: block;
    }
    .nav-links {
        position: absolute;
        background: red;
        height: 100vh;
        width: 200px;
        top: 0;
        right: -200px;
        text-align: left;
        z-index: 2;
        transition: 1s;
    }

    nav .bi {
        display: block;
        color: #fff;
        margin: 10px;
        font-size: 22px;
        cursor: pointer;
    }
    .nav-links ul {
        padding: 30px;
    }
}
.logout-button {
  display: inline-block;
  padding: 8px 16px;
  font-size: 16px;
  font-weight: bold;
  text-align: center;
  text-decoration: none;
  color: #fff;
  background-color: #c0392b;
  border: none;
  border-radius: 5px;
  box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.2);
  transition: background-color 0.2s ease-in-out;
}

.logout-button:hover {
  background-color: #e74c3c;
}
</style>

</section>

<section class="info">

<div class="row" id="">
    <div class="info-col">
        <hr color="red">
        <hr color="red">
        <h1>ABOUT US</h1>
        <hr color="red">
        <hr color="red">
        <p>Our blood donation system management team is committed to making a difference in the world by helping save lives through blood donation. Our goal is to connect donors with patients in need, making it as easy as possible to donate blood and provide support to those who require it. We believe that donating blood is a simple act of kindness that can have a major impact on the health and well-being of those in need. With our dedicated team of professionals, we strive to ensure that every donor has a positive and meaningful experience when contributing to our cause. Thank you for being a part of our mission to save lives through blood donation.</p>
          

    </div>
    <div class="info-col">
        <img src="poor.jpg">
        
    </div>


    <style>
    .row {
    margin-top: 5%;
    display: flex;
    justify-content: space-between;
}

@media (max-width: 700px) {
    .row {
        flex-direction: column;
    }
}

.info{
    width: 80%;
    margin: auto;
    padding-top: 0;
    padding-bottom: 0;
    
}

.info-col{
    flex-basis: 48%;
    padding: 30px 2px;
}

.info-col img{
    width: 100%;
    height: 100%;
}

.info-col h1{
    text-align: left;
}
.info-col h1{
    text-align: left;
}
.info-col p{
    margin: 0px;
    font-size: 20px;
    font-style: italic;
    padding: 15px 0 25px;
} 




</style>
</div>




</section>

<!-- FOOTER -->

<section class="footer">
        <p>Thank You for visiting our website! <br>(made by: Javie Tibayan De Leon & John Dave Fame De Leon) with partnership by: Mary Mediatrix Medical Center</p>


<style>
    /* FOOTER */

.footer{
    width: 100%;
    text-align: center;
    padding: 30px 0;
}

.footer {
    min-height: 5vh;
    width: 100%;
    background-color: red;
    background-position: center;
    background-size: cover;
    position: relative;
}
.footer p{
    color: #fff;
}
</style>
</section>

<script>
        var navLinks = document.getElementById("navLinks");

        function showMenu() {
            navLinks.style.right = "0";
        }
        function hideMenu() {
            navLinks.style.right = "-200px";
        }
</script>

</body>
</html>
