<?php

$showSuccessAlert = false;
$showError = false;

if($_SERVER['REQUEST_METHOD'] == "POST"){

    include_once 'partials/_dbconnect.php';

    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    //check whether a username exists or not
    
    $existsSql = "SELECT * From `users` WHERE `username` = '$username'";
    $result = mysqli_query($conn, $existsSql);
    $numExistingRow = mysqli_num_rows($result);
    if($numExistingRow > 0){
        // $exists = true;
        $showError = "username already exists";
    }
    else{
        // $exists = false;
        if ($password == $cpassword){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`username`, `password`, `dt`) VALUES ('$username', '$hash', current_timestamp())";

            $result = mysqli_query($conn, $sql);

                if($result){
                    $showSuccessAlert = true;
                }
        }
        else{
            $showError = "Password do not match";
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SignUp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <?php 
        require 'partials/_nav.php';

        if($showSuccessAlert){
         echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> You can now log in using your username & password.
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
        <h1 class="text-center mt-4">SignUp to our website</h1>
        <form action="/login_system/signup.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">User Name</label>
                <input type="text" maxlength="11" class="form-control" id="username" name="username">
                
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" maxlength="23" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" maxlength="23" class="form-control" id="cpassword" name="cpassword">
                <div id="emailHelp" class="form-text">Make sure to type the same password.</div>
            </div>
            <button type="submit" class="btn btn-primary">SignUp</button>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>