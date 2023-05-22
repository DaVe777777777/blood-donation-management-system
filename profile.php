<?php
session_start();

if (empty($_SESSION['username'])) {
    header('location: admin_login.php');
    exit;
}

if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
}

include 'connection.php';

// Fetch user information from the database
$selectUserQuery = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($selectUserQuery);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
}

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update'])) {
        $newUsername = $_POST['username'];
        $email = $_POST["email"];
        $mobile = $_POST["mobile"];

        // Update username in users table
        $updateUserQuery = "UPDATE users SET username='$newUsername', email='$email', mobile='$mobile' WHERE username='$username'";
        if ($conn->query($updateUserQuery) === TRUE) {
            // Update the session with the new username
            $_SESSION['username'] = $newUsername;
            // Update the $username variable
            $username = $newUsername;

            // Fetch user information from the database with the updated username
            $selectUserQuery = "SELECT * FROM users WHERE username='$username'";
            $result = $conn->query($selectUserQuery);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            }

            $message = "Profile updated successfully.";
            echo '<script>alert("Profile updated successfully.");</script>';
        } else {
            $error = "Error updating profile: " . $conn->error;
        }

        // Update username in donator table
        $updateDonatorQuery = "UPDATE donator SET username='$newUsername' WHERE username='$username'";
        if ($conn->query($updateDonatorQuery) === TRUE) {
            $message .= " Username updated.";
        } else {
            $error .= " Error updating username: " . $conn->error;
        }
    } elseif (isset($_POST['changePassword'])) {
        $currentPassword = md5($_POST['currentPassword']);
        $newPassword = $_POST['newPassword'];

        $sql = "SELECT * FROM users WHERE username='$username' AND password='$currentPassword'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $newEncPass = md5($newPassword);
            $updatePasswordSql = "UPDATE users SET password='$newEncPass' WHERE username='$username'";
            if ($conn->query($updatePasswordSql) === TRUE) {
                $message = "Password changed successfully.";
                echo '<script>alert("Password changed successfully.");</script>';
            } else {
                $error = "Error changing password: " . $conn->error;
                
            }
        } else {
            $error = "";
            echo '<script>alert("Invalid current password.");</script>';
        }
    }

    // Redirect to reload the page
    // header('Location: ' . $_SERVER['PHP_SELF']);
    // exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>DONATORS LIST</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
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
<div class="container">
    <h2>Welcome, <?php echo $username; ?></h2>
    <?php
    if (isset($_GET['message'])) {
        echo "<div class='success'>" . $_GET['message'] . "</div>";
    }
    if (isset($error)) {
        echo "<div class='error'>" . $error . "</div>";
    }
    ?>
    <div class="row">
        <div class="col-md-6">
            <h4>Update Profile</h4>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username"
                           value="<?php echo $row['username']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email"
                           value="<?php echo $row['email']; ?>" oninput="this.value= this.value.replace(/\s/g, '')"
                           required>
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile:</label>
                    <input type="text" class="form-control" id="mobile" name="mobile"
                           value="<?php echo $row['mobile']; ?>" maxlength="11"
                           oninput="this.value=this.value.replace(/[^0-9]/g, '')" required
                           pattern="[0-9]{11}"
                           title="Mobile should have 11 numbers">
                </div>
                <button type="submit" name="update" class="btn btn-primary" onclick="return confirm('Are you sure you want to update your profile?')">Update</button>

                <button type="button" class="btn btn-danger" onclick="location.href='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>'">Cancel</button>
            </form>
        </div>
        <div class="col-md-6">
            <h4>Change Password</h4>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="currentPassword">Current Password:</label>
                    <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
                </div>
                <div class="form-group">
                    <label for="newPassword">New Password:</label>
                    <input type="password" class="form-control" id="newPassword" name="newPassword" required
                           oninput="this.value= this.value.replace(/\s/g, '')" required
                           pattern="^(?=.*[!@#$%^&*])\S{8,12}$"
                           title="Password must be 8-12 characters long and contain at least one special character (!@#$%^&*)">
                </div>
                <button type="submit" name="changePassword" class="btn btn-primary" onclick="return confirmChangePassword()">Change Password</button>
                <button type="button" class="btn btn-danger" onclick="location.href='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>'">Cancel</button>
            </form>
        </div>
    </div>
</div>

<style>
    /* .success {
        border: 2px solid green;
        padding: 10px;
        margin-bottom: 10px;
    }

    .error {
        border: 2px solid red;
        padding: 10px;
        margin-bottom: 10px;
    } */

    .header {
        width: 100%;
        background-color: red;
        background-position: center;
        background-size: cover;
        position: relative;
        height: 21vh;
    }

    nav {
        display: flex;
        padding: 2% 6%;
        justify-content: space-between;
        align-items: left;
        padding-bottom: 21px;
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
            margin-top: 10px;
            font-size: 30px;
            cursor: pointer;
        }

        nav.black .bi {
            color: #000;
        }

        #navLinks {
            position: fixed;
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
    function showMenu() {
        var navLinks = document.getElementById("navLinks");
        navLinks.style.right = "0";
    }

    function hideMenu() {
        var navLinks = document.getElementById("navLinks");
        navLinks.style.right = "-200px";
    }

    function confirmUpdate() {
        return confirm("Are you sure you want to update your profile?");
    }

    function confirmChangePassword() {
        return confirm("Are you sure you want to change your password?");
    }
</script>

</body>
</html>
