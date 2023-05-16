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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $status = $_POST['status'];

    // Update the status in the database
    $updateStatusQuery = "UPDATE donator SET status = $status WHERE id = $id";
    $conn->query($updateStatusQuery);

    // Check if the status is "Accepted" and update the stock accordingly
    if ($status == 2) {
        $getDonationQuery = "SELECT * FROM donator WHERE id = $id";
        $donationResult = $conn->query($getDonationQuery);

        if ($donationResult->num_rows > 0) {
            $donationData = $donationResult->fetch_assoc();
            $bloodType = $donationData['blood_type'];
            $units = $donationData['unit'];

            // Update the stock by adding the units of the accepted donation
            $updateStockQuery = "UPDATE stock SET units = units + $units WHERE blood_type = '$bloodType'";
            $conn->query($updateStockQuery);
        }
    }

    $conn->close();
    echo "Status updated successfully";
} else {
    echo "Invalid request";
}
?>
