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
    
    <div class="table-responsive my-5">
        <table class="table">
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

                $sql = "SELECT * from donator where id like '%$search%' or blood_type like '%$search%' ";
                $result = mysqli_query($conn, $sql);
                if ($result && mysqli_num_rows($result) > 0) {
                    echo '<thead>
                        <tr>
                            <th>I.D</th>
                            <th>Blood Type</th>
                            <th>Age</th>
                            <th>Weight</th>
                            <th>No of Units</th>
                            <th>Actions</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>';
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>
                                <td>'.$row['id'].'</td>
                                <td>'.$row['blood_type'].'</td>
                                <td>'.$row['age'].'</td>
                                <td>'.$row['weight'].'</td>
                                <td>'.$row['unit'].'</td>
                                
                            </tr>';
                    }
                    echo '</tbody>';
                } else {
                    echo '<tr>
                            <td colspan="4" class="data-not-found">Data not found</td>
                          </tr>';
                }
            }
            ?>
        </table>
    </div>
</div>

<style>
    .data-not-found {
      color: red;
      font-size: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 200px; 
    }
  </style>


</body>
</html>
