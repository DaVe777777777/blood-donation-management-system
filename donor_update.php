<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <title>Update Donator Information</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    <h2>Update Donator Information</h2>
    <?php
   
    // session_start();
    // if(empty($_SESSION['username']))
    // {
    //     header('location:login.php');
    // }
    // if(!empty($_SESSION['username']))
    // {
    // $username = $_SESSION['username'];
    // }
    
        include 'connection.php';

        // check if the form has been submitted
        if(isset($_POST['submit'])) {
            // retrieve the form data
            $id = $_POST['id'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $mobile = $_POST['mobile'];
            

            // construct the update query
            $sql = "UPDATE users SET username='$username', email='$email', mobile='$mobile' WHERE id=$id";
            $requestUpdateSql = "UPDATE donator SET username='$username' WHERE username=$username";
            $conn->query($requestUpdateSql);

            // execute the query
            // if ($conn->query($sql) === TRUE) {
            //     header('location: view_donator.php');
            // } else {
            //     echo "Error updating record: " . $conn->error;
            // }

            if ($conn->query($sql) === TRUE) {
                ?>
                <script>
                    swal({
                        title: "Success!",
                        text: "Record has been updated.",
                        icon: "success",
                    }).then(function() {
                        window.location = "donor.php";
                    });
                </script>
                <?php
            } else {
                echo "Error updating record: " . $conn->error;
            }

            // close the database connection
            $conn->close();
        } else {
            // retrieve the id from the URL
            $id = $_GET['id'];

            // construct the select query
            $sql = "SELECT * FROM users WHERE id=$id";

            // execute the query
            $result = $conn->query($sql);

            // retrieve the data from the query result
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $username = $row['username'];
                $email = $row['email'];
                $mobile = $row['mobile'];
                
            } else {
                echo "No record found";
            }

            // output the HTML form with the data pre-filled
            ?>

<form method="post">
  <input type="hidden" name="id" value="<?php echo $id; ?>">
  <div class="form-group">
    <label for="username">Name:</label>
    <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>">
  </div>
  <div class="form-group">
    <label for="email">Email:</label>
    <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
  </div>
  <div class="form-group">
    <label for="address">Mobile:</label>
    <input type="int" class="form-control" id="mobile" name="mobile" value="<?php echo $mobile; ?>">
  </div>
  <button type="submit" class="btn btn-primary" name="submit">Update</button>
  <a href="donor.php" class="btn btn-danger">Cancel</a>
</form>



            <?php

            // close the database connection
            $conn->close();
        }
    ?>
</body>
</html>
