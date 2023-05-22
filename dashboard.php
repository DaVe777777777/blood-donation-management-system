<?php
session_start();
if(empty($_SESSION['username']))
{
    header('location:admin_login.php');
}
if(!empty($_SESSION['username']))
{
$username = $_SESSION['username'];
}


include 'connection.php';

// Fetch the username from the database
$sql = "SELECT username FROM admin WHERE username = '$username'";
$result = $conn->query($sql);
if ($row = mysqli_fetch_assoc($result)) {
    $name = $row['username'];
   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

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


<section class="header">
        <nav>
            <a href="index.html"><img src="trial.png" /></a>
            <div class="nav-links" id="navLinks">
                <i class="bi bi-x-lg" onclick="hideMenu()"></i>
            <ul>
                <li><a href="dashboard.php">DASHBOARD</a></li>
                <li><a href="donor.php">DONOR</a></li>
                <li><a href="admin_requirements.php">REQUIREMENTS</a></li>
                <li><a href="request.php">REQUEST</a></li>
                <li ><a href="admin_logout.php" class="logout-button">LOGOUT</a></li>
            </ul>
            </div>
            <i class="bi bi-list" onclick="showMenu()"></i>
        </nav>
        <div class="text-box">
            <h2>WELCOME ADMIN  </h2>
            <h2>"<?php echo  $name;?>"</h2>
            <h2>TO</h2>
            <h1>BLOOD DONATION SYSTEM MANAGEMENT!</h1>
            <p>DONATE BLOOD, SAVE LIFE.</p>
            <br />
            <a href="request.php" class="hero-btn">SEE UPDATES</a>
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
        padding: 20px 12px;
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
