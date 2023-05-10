<?php
include 'connection.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>REGISTRATION</title>
  <meta charset="UTF-8">
  <!-- <link rel="stylesheet" href="donator.css"> -->
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
<div class="mycontainer my-5">
    

    <form method="post" class="mx-auto col-md-6">
    <div class="form-group text-center">
      <input class="form-control" type="text" placeholder="Search Donator" name="search">
    </div>
    <div class="btn-group d-flex justify-content-center">
      <button class="btn btn-primary rounded-pill mr-2" name="submit">Search</button>
      <a href="view_donator.php" class="btn btn-danger rounded-pill">Cancel</a>
    </div>
        <!-- <button class="btn btn-primary " name="submit">SEARCH</button>
        <a href="view_donator.php" class="btn btn-outline-danger ">Cancel<a> -->
        <!-- <input class="search-text" type="text" placeholder="Search Donator" name="search"> -->
    </form>
    
    <div class="container my-5 ">
        <table class="table">
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
  

if(isset($_POST['submit'])){
    $search=$_POST['search'];

    $sql="SELECT * from donator where id like'%$search%' or name like '%$search%' or address like '%$search%' or blood_type like '%$search%' ";
    $result=mysqli_query($conn,$sql);
    if($result){
    if(mysqli_num_rows($result)>0){
        echo '<thead>
        <tr>
        <th>I.D</th>
        <th>Name</th>
        <th>Email</th>
        <th>Address</th>
        <th>Blood Type</th>
        <th>Age</th>
        <th>Weight</th>
        </tr>
        </thead>
        ';
        while($row=mysqli_fetch_assoc($result)){
        echo '<tbody>
        <tr>
        
        <td>'.$row['id'].'</td>
        <td>'.$row['name'].'</td>
        <td>'.$row['email'].'</td>
        <td>'.$row['address'].'</td>
        <td>'.$row['blood_type'].'</td>
        <td>'.$row['age'].'</td>
        <td>'.$row['weight'].'</td>;
        
        </tr>
        </tbody>';
        }

    }else{
        echo'<h2 class=text-danger>Data not found</h2>';
    }
    }


}         


?>


        </table>
    </div>

</div>


<style>
.search-text{
    height:50px;
    width:300px;
    margin-left: 10px;
    border-radius:20px;

}


</style>
</body>
</html>