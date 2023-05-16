<!DOCTYPE html>
<html lang="en">
<head>
<title>REQUEST LIST</title>
<meta charset="utf-8">
<link rel="stylesheet" href="view_donator.css">
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
</head>
<body>


<section class="header">
        <nav>
            <a href="dashboard.php"><img src="trial.png" /></a>
            <div class="nav-links" id="navLinks">
                <i class="bi bi-x-lg" onclick="hideMenu()"></i>
            <ul>
                <li><a href="dashboard.php">DASHBOARD</a></li>
                <li><a href="donor.php">DONOR</a></li>
                <li><a href="admin_requirements.php">REQUIREMENTS</a></li>
                <li><a href="">REQUEST</a></li>
                <li ><a href="admin_logout.php" class="logout-button">LOGOUT</a></li>
            </ul>
            </div>
            <i class="bi bi-list" onclick="showMenu()"></i>
        </nav>
</section>


<div class="container mt-4">
<form method="post" class="mx-auto col-md-6">
        <div class="form-group text-center">
            <input class="form-control" type="text" placeholder="Search Donator" name="search">
        </div>
        <div class="text-center">
            <button class="btn btn-primary rounded-pill mr-2" name="submit">Search</button>
            <a href="request.php" class="btn btn-danger rounded-pill">Cancel</a>
        </div>
    </form>
    

    <div class="table-responsive mt-4 ">
        <table class="table table-striped table-hover table-bordered">
        <tr>
    <th >Id</th>
    <th >Name</th>
    <th >Blood Type</th>
    <th >Age</th>
    <th >Weight</th>
    <th>Units</th>
    <th >Actions</th>
    <th >Status</th>
    <th >Actions</th>


    
</tr>

<?php

session_start();
if(empty($_SESSION['username']))
{
    header('location:login.php');
    exit();
}
if(!empty($_SESSION['username']))
{
$username = $_SESSION['username'];
}


include 'connection.php';
if (isset($_POST['submit'])) {
    $search = $_POST['search'];

    $sql = "SELECT * FROM donator WHERE id LIKE '%$search%' OR username LIKE '%$search%' OR blood_type LIKE '%$search%' OR age LIKE '%$search%' OR weight LIKE '%$search%' OR unit LIKE '%$search%' OR status LIKE '%$search%'";

    $result = $conn->query($sql); // Execute the query

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['username']."</td>";
        echo "<td>".$row['blood_type']."</td>";
        echo "<td>".$row['age']."</td>";
        echo "<td>".$row['weight']."</td>";
        echo "<td>".$row['unit']."</td>";
        echo "<td>
                <a href='admin_update.php?id=".$row['id']."' class='btn btn-sm btn-warning'>Update</a>
                <a href='admin_delete.php?id=".$row['id']."' onclick='return confirm(\"Are you sure?\")' class='btn btn-sm btn-danger'>Delete</a>
            </td>";
            echo "<td class='status-column'>";
            if ($row['status'] == 2) {
                echo "<span class='accepted-status'>Accepted</span>";
            } elseif ($row['status'] == 3) {
                echo "<span class='rejected-status'>Rejected</span>";
            } else {
                echo "<span class='pending-status'>Pending</span>";
            }
            echo "</td>";
        echo "<td>
                <select onchange='updateStatus(".$row['id'].", this.value)'>
                    <option value='1' >Pending</option>
                    <option value='2' >Accepted</option>
                    <option value='3' >Rejected</option>
                </select>
            </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>No records found</td></tr>";
}
}

$conn->close();

?>


        </table>
    </div>
</div>

<script>
function updateStatus(id, status) {
    var confirmUpdate = confirm("Are you sure you want to update the status?");
    if (confirmUpdate) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "update_status.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                console.log(xhr.responseText); // Handle the response here (if needed)
                window.location.reload(); // Auto-refresh the page
            }
        };
        xhr.send("id=" + encodeURIComponent(id) + "&status=" + encodeURIComponent(status));
    }
}
</script>





<style>
.status-column span {
    display: inline-block;
    padding: 6px 12px; 
    border-radius: 4px;
    font-weight: bold;
}

.pending-status {
    background-color: orange;
    color: white;
}

.accepted-status {
    background-color: green;
    color: white;
}

.rejected-status {
    background-color: red;
    color: white;
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
