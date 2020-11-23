<!DOCTYPE html>
<html>
<head>
  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">

  <title>PHP Final Project</title>
  <meta charset="utf-8">

</head>

<body>

<?php require("navbar.html"); ?>
<div class="container-fluid">
    <div class="row">
      <div class="col-sm-6"><h1>Welcome!</h1></div>
    </div>
    </div>
  <?php  session_start();
$serverName = "localhost"; 
$userName = "root"; 
$password = ""; 
$databaseName = "final_project";

try{
 $conn = new PDO("mysql:host=$serverName;dbname=$databaseName", $userName, $password);
 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 if(isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] === true){
    echo '<div class="container-fluid">';
    echo '<div class="row">';
    echo '<div class="col-sm-8"><h4>Hello, '.$_SESSION["username"] .'</h4>';
    echo '</div>';
    echo '<div class="col-sm-4"><a href="user-logout.php" type="button" class="btn btn-info" style="float: right;">Logout</a>';
    echo '</div>';
    echo '</div></div>';
    header("Location: user-landing.php");

  }else{
    ?>
    <div class="row">
      <div class="col-sm-4" ></div>
      <div class="col-sm-4" >
      <div class="card" style="width:400px">
  <img class="card-img-top" src="img_avatar1.png" alt="Card image" style="padding: 1em 1em;">
  <div class="card-body">
    <h4 class="card-title">No Login, No Go</h4>
    <p class="card-text">Please login to access pages</p>
    <a href="user-login.php" type="button" class="btn btn-primary btn-lg" style="display: block;  margin-left: auto; margin-right: auto;">Login</a>
      </div>
      </div>
      </div>
  </div>
  <?php
  }

}
catch(PDOException $e){
  echo "<br />Could not establish database connection.";
}

  ?>
    <br>
</body>
</html>
