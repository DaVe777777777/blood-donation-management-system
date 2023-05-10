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
   
    session_start();
    if(empty($_SESSION['username']))
    {
        header('location:login.php');
    }
    if(!empty($_SESSION['username']))
    {
    $username = $_SESSION['username'];
    }
    
        include 'connection.php';

        // check if the form has been submitted
        if(isset($_POST['submit'])) {
            // retrieve the form data
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $blood_type = $_POST['blood_type'];
            $age = $_POST['age'];
            $weight = $_POST['weight'];

            // construct the update query
            $sql = "UPDATE donator SET name='$name', email='$email', address='$address', blood_type='$blood_type', age='$age', weight='$weight' WHERE id=$id";

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
                        window.location = "view_donator.php";
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
            $sql = "SELECT * FROM donator WHERE id=$id";

            // execute the query
            $result = $conn->query($sql);

            // retrieve the data from the query result
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $name = $row['name'];
                $email = $row['email'];
                $address = $row['address'];
                $blood_type = $row['blood_type'];
                $age = $row['age'];
                $weight = $row['weight'];
            } else {
                echo "No record found";
            }

            // output the HTML form with the data pre-filled
            ?>

<form method="post">
  <input type="hidden" name="id" value="<?php echo $id; ?>">
  <div class="form-group">
    <label for="name">Name:</label>
    <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
  </div>
  <div class="form-group">
    <label for="email">Email:</label>
    <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
  </div>
  <div class="form-group">
    <label for="address">Address:</label>
    <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>">
  </div>
  <div class="form-group">
    <label for="blood_type">Blood Type:</label>
    <input type="text" class="form-control" id="blood_type" name="blood_type" value="<?php echo $blood_type; ?>">
  </div>
  <div class="form-group">
    <label for="age">Age:</label>
    <input type="number" class="form-control" id="age" name="age" value="<?php echo $age; ?>">
  </div>
  <div class="form-group">
    <label for="weight">Weight:</label>
    <input type="number" class="form-control" id="weight" name="weight" value="<?php echo $weight; ?>">
  </div>
  <button type="submit" class="btn btn-primary" name="submit">Update</button>
  <a href="view_donator.php" class="btn btn-danger">Cancel</a>
</form>



            <?php

            // close the database connection
            $conn->close();
        }
    ?>
</body>
</html>
