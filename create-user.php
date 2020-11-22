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
  $serverName = "localhost";  
  $userName = "root";  
  $password = "";  
  $databaseName = "final_project";

  $fieldSize = 30;


  try {
    $conn = new PDO("mysql:host=$serverName;dbname=$databaseName", $userName, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Clear post variables
    if(isset($_POST["clear_post"])) {
      $_POST = array();
    }

    if(isset($_POST["create_new_user"])) {

      echo "<br />Create button pressed";

      $tableUsername = $_POST["table_username"];  
      $password = $_POST["password"];
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      $confirmedPassword = $_POST["confirmed_password"];

      echo $hashedPassword;

      //password match
      if($confirmedPassword === $password){
        echo "passwords match!";
    
      $insertQueryString = "INSERT INTO users (username, password) VALUES(?, ?)";
      $insertQuery = $conn->prepare($insertQueryString);
      $insertQuery->bindParam(1,$tableUsername);
      $insertQuery->bindParam(2, $hashedPassword);
      $insertQuery->execute();
      }
      else{
        echo "passwords do not match!";
      }
      ?>

<?php 

    }  // end isset Create New User
    echo "<br />";

  }  // end try
  catch (PDOException $e) {
    echo '<br />  $e (toString()): '.$e;
    echo '<br />  $e->getMessage(): '.$e->getMessage();
    echo '<br />$e->getCode(): '.$e->getCode();

  } // end catch

?>



1
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
    <table>
      <tr>
        <td>
          <label for="new_username">Username:</label>
        </td>
        <td>
          <input class="form-control" type="text" name="table_username" id="table_username" size="<?php echo $fieldSize; ?>" />
        </td>
      </tr>
      <tr>
        <td>
          <label for="password">Password:</label>
        </td>
        <td>
          <input class="form-control" type="password" name="password" id="password" size="<?php echo $fieldSize; ?>" v/>
        </td>
      </tr>
      <tr>
        <td>
          <label for="confirmed_password">Confirm Password:</label>
        </td>
        <td>
          <input class="form-control" type="password" name="confirmed_password" id="confirmed_password" size="<?php echo $fieldSize; ?>" />
        </td>
      </tr>

      <tr>
        <td colspan="2">
          <input type="submit" class="btn btn-primary" name="create_new_user" value="Create New User" />
        </td>
      </tr>
    </table>
  </form>
  <a href="user-records.php">Back to records</a>

</body>
</html>
