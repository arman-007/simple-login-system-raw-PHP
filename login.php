<?php

$login = false;
$showError = false;

if($_SERVER['REQUEST_METHOD'] == "POST"){

    include_once 'partials/_dbconnect.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    // $sql = "SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password'";
    $sql = "SELECT * FROM `users` WHERE `username` = '$username'";

    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if($num == 1){
        while($row=mysqli_fetch_assoc($result)){
            if(password_verify($password, $row['password'])){
                $login = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                header("location: welcome.php");
            }
            else{
                $showError = "Invalid password";
            }
        }
    }
    else{
        $showError = "Invalid username";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <?php 
        require 'partials/_nav.php';

        if($login){
         echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> You logged in successfully using your username & password.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        if($showError){
         echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Unsuccessful!</strong> '.$showError.'.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }

    ?>

    <div class="container col-md-6">
        <h1 class="text-center mt-4">Login to our website</h1>
        <form action="/login_system/login.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">User Name</label>
                <input type="text" maxlength="11" class="form-control" id="username" name="username">
                
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" maxlength="23" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>