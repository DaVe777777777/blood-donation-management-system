<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the values from the POST request
    $id = $_POST['id'];
    $status = $_POST['status'];

    // Update the status in the "donator" table
    $sql = "UPDATE donator SET status = $status WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Status updated successfully";
    } else {
        echo "Error updating status: " . $conn->error;
    }

    $conn->close();
}
?>
