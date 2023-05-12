<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
    crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <div class="container my-5 text-center">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Register</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="mobile">Mobile Number:</label>
                                <input type="text" class="form-control" id="moblie" name="mobile" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </form>
                    </div>
                    <div class="card-footer">
                        <p class="text-center">Already have an account?</p>
                        <p class="text-center"> <a href="login.php">Login here.</a><p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
session_start();

$conn = mysqli_connect('localhost','root','','bdm_system');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $mobile = $_POST["mobile"];
    $encpass = md5($password);
    

    // check if user already exists in the table
    $check_query = "SELECT * FROM users WHERE username='$username'";
    $check_result = $conn->query($check_query);
    if ($check_result->num_rows > 0) {
        echo '<script>Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Username already exists. Please choose a different username.",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "OK"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href="register.php";
                }
            });
        </script>';
        exit;
    }

    // insert new user into table
    $insert_query = "INSERT INTO users (username, email, password, mobile) VALUES ('$username','$email', '$encpass','$mobile')";
    if ($conn->query($insert_query) === TRUE) {
        // set session variable to indicate user is logged in
        $_SESSION["loggedin"] = true;

        // redirect to donation.php
        echo '<script>Swal.fire({
            icon: "success",
            title: "Registered successfully!",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "OK"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href="login.php";
                }
            });
        </script>';
        exit;
    } else {
        echo '<script>Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Error registering user. Please try again.",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "OK"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href="register.php";
                }
            });
        </script>';
        exit;
    }
}

$conn->close();
?>

<style>
*{
    margin: 0;
    padding: 0;
    box-sizing:border-box;
}
.container{
    background-image:url(bg.png);
    background-size: cover ;
    height:100vh;
    width:100%;
    background-position:center;
    background-repeat: no-repeat;
    padding-top: 4%;
}

</style>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
    integrity="sha384-q8i/X+965DzO0"
    crossorigin="anonymous"></script>

</body>
</html>


