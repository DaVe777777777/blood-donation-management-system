<?php
session_start();
if (empty($_SESSION['username'])) {
    header('location:login.php');
}
if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
}

include 'connection.php';

if (isset($_POST['submit'])) {
    $search = $_POST['search'];
    if (!empty($search)) {
        $sql = "SELECT donator.* FROM donator JOIN users ON donator.username = users.username WHERE users.username = '$username' AND (donator.id LIKE '%$search%' OR donator.blood_type LIKE '%$search%')";
    } else {
        $sql = "SELECT donator.* FROM donator JOIN users ON donator.username = users.username WHERE users.username = '$username'";
    }
} else {
    $sql = "SELECT donator.* FROM donator JOIN users ON donator.username = users.username WHERE users.username = '$username'";
}

$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>SEARCH</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container my-5">
    <form method="post" class="mx-auto col-md-6">
        <div class="form-group text-center">
            <input class="form-control" type="text" placeholder="Search Donator" name="search">
        </div>
        <div class="text-center">
            <button class="btn btn-primary rounded-pill mr-2" name="submit">Search</button>
            <a href="view_donator.php" class="btn btn-danger rounded-pill">Cancel</a>
        </div>
    </form>
    

    <div class="table-responsive mt-4">
        <table class="table table-striped table-hover table-bordered">
        <tr>
    <th>Id</th>
    <th>Blood Type</th>
    <th>Age</th>
    <th>Weight</th>
    <th>Units</th>
    <th>Actions</th>
    <th>Status</th>

    
</tr>

<?php
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['blood_type']."</td>";
            echo "<td>".$row['age']."</td>";
            echo "<td>".$row['weight']."</td>";
            echo "<td>".$row['unit']."</td>";
            echo "<td>
                    <a href='update.php?id=".$row['id']."' ' class='btn btn-sm btn-warning'>Update</a>
                    <a href='delete.php?id=".$row['id']."' onclick='return confirm(\"Are you sure?\")' class='btn btn-sm btn-danger'>Delete</a>
                </td>";
                echo "<td class='status-column'>";
                if ($row['status'] == 2) {
                    echo "<span class='accepted-status'>Accept</span>";
                } elseif ($row['status'] == 3) {
                    echo "<span class='rejected-status'>Reject</span>";
                } else {
                    echo "<span class='pending-status'>Pending</span>";
                }
                "</td>";
            "</tr>";
            
            
        }
    }elseif (isset($_POST['submit'])) { ?>
        <tr>
        <td colspan="7" class="text-center">
        No records found.
        </td>
        </tr>
        <?php } 
   



?>


        </table>
    </div>
</div>


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
</style>


</body>
</html>
