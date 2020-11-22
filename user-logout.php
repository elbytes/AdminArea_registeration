<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">

  <title>Log Out</title>
  <meta charset="utf-8">

</head>

<body>
<?php require("navbar.html"); ?>

  <h2>Logout</h2>

  <?php
   $serverName = "localhost"; 
   $userName = "root"; 
   $password = ""; 
   $databaseName = "final_project";


try{
    $conn = new PDO("mysql:host=$serverName;dbname=$databaseName", $userName, $password);
    echo "<br />";
    session_start();
      if(isset($_SESSION["authenticated"]) && isset($_SESSION["authenticated"]) ===true){
        session_destroy();
        $_SESSION = array();
        echo "You are now logged out.";
        echo '<br />';
        echo '<br />';
        echo '<a href="user-login.php" type="button" class="btn btn-primary" >Log back in</a>';
      }//end if
    }//end try
    catch(PDOException $e){
      echo "<br />Could not establish database connection.";
  }//end catch

  ?>


 

</body>
</html>