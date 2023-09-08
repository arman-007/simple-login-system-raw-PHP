<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
  header("location: login.php");
  exit;
}


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome - <?= $_SESSION['username']  ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
    <?php require 'partials/_nav.php' ?>

    
    <div class="container mt-4">
      <div class="alert alert-success" role="alert">
        <h1>Welcom, <?= $_SESSION['username'] ?>!</h1>
        <!-- <h4 class="alert-heading">Well done!</h4> -->
        <p>Hey! How are you doing? Welcome to iSecure. You're logged in as <?= $_SESSION['username'] ?>.</p>
        <hr>
        <p class="mb-0">Whenever you need to, be sure to logout using this <a href="logout.php"> link</a>.</p>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>