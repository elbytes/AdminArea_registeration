<!DOCTYPE html>
<html>
<head>
  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">

  <title>Create New User</title>
  <meta charset="utf-8">

</head>

<body>
<?php require("navbar.html"); ?>
  <h3>Creating a new user</h3>

  
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

    if(isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] === true){      echo '<div class="container-fluid">';
      echo '<div class="row">';
      echo '<div class="col-sm-8"><h4>Hello, '.$_SESSION["username"] .'</h4>';
      echo '</div>';
      echo '<div class="col-sm-4"><a href="user-logout.php" type="button" class="btn btn-info" style="float: right;">Logout</a>';
      echo '</div>';
      echo '<br /><p>You can create a new user here</p>';
      echo '</div></div>';
      require("user-form.php");
    if(isset($_POST["create_new_user"])) {
      $tableUsername = $_POST["table_username"];  
      $password = $_POST["password"];
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      $confirmedPassword = $_POST["confirmed_password"];

      //password match
      if($confirmedPassword === $password){
        echo "<br />passwords match!";
    
      $insertQueryString = "INSERT INTO users (username, password) VALUES(?, ?)";
      $insertQuery = $conn->prepare($insertQueryString);
      $insertQuery->bindParam(1,$tableUsername);
      $insertQuery->bindParam(2, $hashedPassword);
      $insertQuery->execute();
      echo "<br /><h4>User was created</h4>";
      }
      else{
        echo "passwords do not match!";
      }
      ?>

<?php 

    } 
   } // end isset Create New User
   else{
    echo "<br />Please login first!<br />";
    echo '<br /><a href="user-login.php" type="button" class="btn btn-primary" >Login</a>';
  }
  

  }  // end try
  catch (PDOException $e) {
    echo '<br />  $e (toString()): '.$e;
    echo '<br />  $e->getMessage(): '.$e->getMessage();
    echo '<br />$e->getCode(): '.$e->getCode();

  } // end catch

?>
  <a href="user-landing.php" type="button" class="btn btn-primary" style="float: right;">Back</a>

</body>
</html>
