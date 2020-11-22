<!DOCTYPE html>
<html>
<head>
  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">

  <title>Login</title>
  <meta charset="utf-8">

</head>
<body>
<?php require("navbar.html"); ?>
  <h3>User Landing Page</h3>

  
<?php
  $serverName = "localhost";  
  $userName = "root";  
  $password = "";  
  $databaseName = "final_project";

  $fieldSize = 30;


  try {
    $conn = new PDO("mysql:host=$serverName;dbname=$databaseName", $userName, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        session_start();
        echo 'Hello, '.$_SESSION["username"];
        echo '<br />Now you can access these pages: ';
        
        echo '<br />';
        
        //$_SESSION["username"] = $tableUsername;
        $_SESSION["authenticated"] = true;

        echo '<br /> <div class="row">';
        echo '<div class="col-sm-4">';
        echo '<a href="customers-records.php" type="button" class="btn btn-info ">Customers</a>';
        echo '</div>';
        echo '<div class="col-sm-4">';
        echo '<a href="user-records.php" type="button" class="btn btn-info ">Users</a>';
        echo '</div>';
        echo '<div class="col-sm-4">';
        echo '<a href="customer-orders.php" type="button" class="btn btn-info ">Customer Orders innerjoin</a>';
        echo '</div>';
        echo '</div><br />';
        echo '<a href="user-logout.php" type="button" class="btn btn-info ">Logout</a>';
   

  }  // end try
  catch (PDOException $e) {
    echo '<br />  $e (toString()): '.$e;
    echo '<br />  $e->getMessage(): '.$e->getMessage();
    echo '<br />$e->getCode(): '.$e->getCode();
  } // end catch

?>



</body>
</html>
