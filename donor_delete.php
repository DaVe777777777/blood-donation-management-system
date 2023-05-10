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

    if(isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "DELETE FROM users WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Record deleted successfully!'); window.location.href = 'donor.php';</script>";

        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }

    $conn->close();
?>