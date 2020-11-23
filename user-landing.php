<!DOCTYPE html>
<html>
<head>
  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">

  <title>User Landings</title>
  <meta charset="utf-8">

</head>
<body>
<?php require("navbar.html"); ?>
  <h3>User Landing Page</h3>

  
<?php
session_start();
  $serverName = "localhost";  
  $userName = "root";  
  $password = "";  
  $databaseName = "final_project";
  $fieldSize = 30;


  try {
    $conn = new PDO("mysql:host=$serverName;dbname=$databaseName", $userName, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] === true){
      echo '<div class="container-fluid">';
      echo '<div class="row">';
      echo '<div class="col-sm-8"><h4>Hello, '.$_SESSION["username"] .'</h4>';
      echo '</div>';
      echo '<div class="col-sm-4"><a href="user-logout.php" type="button" class="btn btn-info" style="float: right;">Logout</a>';
      echo '</div>';
      echo '<br /><p>Now you can access these pages:</p>';
      echo '</div></div>';
      ?>
<br>
<div class="container">
  <div class="card-deck">
    <div class="card bg-light text-dark">
    <img class="card-img-top" src="customers.png" alt="Card image">
      <div class="card-body text-center">
      <h4 class="card-title">Customers</h4>
        <p class="card-text">This section includes a list of all customers</p>
        <p class="card-text">You will also have the chance to edit or delete customer records</p>
        <p class="card-text">You can add a new record too</p>
        <a href="customers-records.php" class="btn btn-info">See Customers</a>
      </div>
    </div>
    <div class="card bg-light text-dark">
    <img class="card-img-top" src="users.png" alt="Card image">
      <div class="card-body text-center">
      <h4 class="card-title">Users</h4>
        <p class="card-text">This section includes a list of all users</p>
        <p class="card-text">You will also have the chance to delete user records, edit has issues</p>
        <p class="card-text">You can add a new record too</p>
        <a href="user-records.php" class="btn btn-info">See Users</a>
      </div>
    </div>    <div class="card bg-light text-dark">
    <img class="card-img-top" src="orders.png" alt="Card image">
      <div class="card-body text-center">
      <h4 class="card-title">Orders</h4>
        <p class="card-text">This section includes a list of all orders</p>
        <p class="card-text">This list is generated using an inner-join between orders and customers tables.</p>
        <p class="card-text">You can only view records here</p>
        <a href="customer-orders.php" class="btn btn-info">See Orders</a>
      </div>
    </div>
  </div>
</div>
      <?php
    } else{
      echo "You need to login first";
      echo '<br/>';
      echo '<a href="user-login.php" type="button" class="btn btn-primary ">Login</a>';
    }
  }  // end try
  catch (PDOException $e) {
    echo '<br />  $e (toString()): '.$e;
    echo '<br />  $e->getMessage(): '.$e->getMessage();
    echo '<br />$e->getCode(): '.$e->getCode();
  } // end catch

?>



</body>
</html>
