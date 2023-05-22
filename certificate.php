<?php
session_start();
if (empty($_SESSION['username'])) {
    header('location:login.php');
}
if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
}

// Database connection
include 'connection.php';

// Fetch the username from the database
$sql = "SELECT username FROM users WHERE username = '$username'";
$result = $conn->query($sql);
if ($row = mysqli_fetch_assoc($result)) {
    $name = $row['username'];
   
}



// Date of the certificate
$currentDate = date('F d, Y');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CERTIFICATE</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
        integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<section class="header">
    <nav>
        <a href="index.php"><img src="trial.png" /></a>
        <div class="nav-links" id="navLinks">
            <i class="bi bi-x-lg" onclick="hideMenu()"></i>
            <ul>
                <li><a href="index.php">HOME</a></li>
                <li><a href="requirements.php">REQUIREMENTS</a></li>
                <li><a href="donator.php">DONATE</a></li>
                <li><a href="view_donator.php">REQUEST</a></li>
                <li><a href="certificate.php">CERTIFICATE</a></li>
                <li><a href="profile.php">PROFILE</a></li>
                <li><a href="logout.php" class="logout-button">LOGOUT</a></li>
            </ul>
        </div>
        <i class="bi bi-list" onclick="showMenu()"></i>
    </nav>
</section>

<section class="certificate">
    <div class="certificate-content">
        <h1>BLOOD DONATION CERTIFICATE</h1>
        <p>Congratulations!</p>
        <p>This certificate is given to:</p>
        <p>----------------------------------------------------------------</p>
        <h2><?php echo $name; ?></h2>
        <p>----------------------------------------------------------------</p>
        <p>to show our appreciation for donating your blood.</p>
        <p>Presented on <?php echo $currentDate; ?></p>
    </div>

    <div class="text-center">
        <button onclick="window.print()" class="btn ">Print</button>
    </div>
</section>




<style>
.btn {
    background-color: blue; 
    color: white; 
    padding: 12px 24px; 
    font-size: 16px; 
    border: none;
}

.btn:hover {
    background-color: lightblue; 
}
.text-center {
    margin-top: 20px;
}
.certificate {
    
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.certificate-content {
    text-align: center;
    border: 2px solid black;

    padding:80px;
    max-width: 400px;
    margin: 0 auto;
}

.certificate-content h1 {
    font-size: 32px;
    font-weight: bold;
    margin-bottom: 20px;
    color:red;
    font-style: italic;
}

.certificate-content h2 {
    font-size: 24px;
    font-weight: bold;
    margin: 20px 0;
    font-family: century;

}

.certificate-content p {
    font-size: 18px;
    margin-bottom: 10px;
}



* {
    margin: 0;
    padding: 0;
    font-family: "Roboto", sans-serif;
}

.header {
    
    width: 100%;
    background-color: red;
    background-position: center;
    background-size: cover ;
    position: relative;
    height: 21vh;

}
nav {
    display: flex;
    padding: 2% 6%;
    justify-content: space-between;
    align-items: left;
    
}
nav img {
    width: 100px;
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
    font-size: 13px;
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