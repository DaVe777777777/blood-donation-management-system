<!DOCTYPE html>
<html lang="en">
<head>
  <title>REGISTRATION</title>
  <meta charset="UTF-8">
  <!-- <link rel="stylesheet" href="donator.css"> -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  
    
   
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
        integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;700&display=swap" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <a href="index.php"><img src="trial.png" /></a>
        
            <div class="nav-links" id="navLinks">
                <i class="bi bi-x-lg" onclick="hideMenu()"></i>
                    <ul>
                        <li><a href="index.php">HOME</a></li>
                        <li><a href="requirements.php">REQUIREMENTS</a></li>
                        <li><a href="donator.php">REGISTRATION</a></li>
                        <li><a href="view_donator.php">DONATORS</a></li>
                        <li ><a href="logout.php" class="logout-button">LOGOUT</a></li>
                    </ul>
            </div>
                <i class="bi bi-list" onclick="showMenu()"></i>
        </nav>
</section> 

<br><br>
<div class="container">
<!-- d-flex justify-content-between -->
  <div class=" text-center">
  <hr color="red">
  <hr color="red">
  <h2 >ADD NEW BLOOD DONATOR</h2>
  <hr color="red">
  <hr color="red">
  <!-- <a href="logout.php" class="btn btn-danger p-3">Logout</a> -->
  </div>
  <form action="" method="post">
  <div class="form-group">
      <label>Name:</label>
      <input type="text" class="form-control"  placeholder="Name" name="name" required>
    </div><div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control"  placeholder="Enter Email" name="email" required>
    </div>
    <div class="form-group">
      <label for="address">Address:</label>
      <input type="address" class="form-control"  placeholder="Enter Address" name="address" required>
    </div>
    <div class="form-group">
      <label for="dropdown">Blood Type:</label>
      <select id="dropdown"  class="form-control"  placeholder="Blood Type" name="blood_type" required>
        <option>--SELECT--</option>
        <option>A</option>
        <option>B</option>
        <option>AB</option>
        <option>O</option>
        <option>A+</option>
        <option>B+</option>
        <option>AB+</option>
        <option>O+</option>
        <option>A-</option>
        <option>B-</option>
        <option>AB-</option>
        <option>O-</option>
      </select>
    
    </div>
    <div class="form-group">
      <label>Age:</label>
      <input type="number" class="form-control"  placeholder="Age" name="age"  required>
    </div>

    <div class="form-group">
      <label>Weight In Pounds:</label>
      <input type="number" class="form-control"  placeholder="weight" name="weight"  required>
    </div>
    
    <input type="submit" name="insert-btn" class="btn btn-primary mt-3"/>
    <a href="view_donator.php" class="btn btn-danger mt-3">Cancel<a>
  </form>
</div>
<?php



$conn = mysqli_connect('localhost','root','','bdm_system');

if(isset($_POST['insert-btn']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $blood_type = $_POST['blood_type'];
    $age = $_POST['age'];
    $weight = $_POST['weight'];

    if ($age < 17) {
        echo '<script>
                Swal.fire({
                  icon: "warning",
                  title: "Oops...",
                  text: "You are not eligible to donate blood. Read requirements.",
                  confirmButtonColor: "#dc3545",
                }).then((result) => {
                  if (result.isConfirmed) {
                    window.location.href="requirements.php";
                  }
                });
              </script>';
    } elseif ($weight < 109) {
        echo '<script>
                Swal.fire({
                  icon: "warning",
                  title: "Oops...",
                  text: "You are not eligible to donate blood. Read requirements.",
                  confirmButtonColor: "#dc3545",
                }).then((result) => {
                  if (result.isConfirmed) {
                    window.location.href="requirements.php";
                  }
                });
              </script>';
    } else {
        $insert = "INSERT INTO donator(name,email,address,blood_type,age,weight) VALUES('$name','$email','$address','$blood_type','$age','$weight')";

        $run_insert = mysqli_query($conn, $insert);

        if ($run_insert === true) {
            echo '<script>
                    Swal.fire({
                      icon: "success",
                      title: "Success!",
                      text: "Data has been inserted.",
                      confirmButtonColor: "#28a745",
                    });
                  </script>';
        } else {
            echo '<script>
                    Swal.fire({
                      icon: "error",
                      title: "Oops...",
                      text: "Failed, try again.",
                      confirmButtonColor: "#dc3545",
                    });
                  </script>';
        }
    }
}

?>

<style>
* {
    margin: 0;
    padding: 0;
    font-family: "Roboto", sans-serif;
}





.header {
    
    width: 100%;
    background-color: red ;
    background-position: center;
    background-size: cover ;
    position: relative;
    min-height: 10vh;
}
nav {
    display: flex;
    padding: 2% 6%;
    justify-content: space-between;
    align-items: left;
    padding-bottom:21px;
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
    padding: 30px 12px;
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
