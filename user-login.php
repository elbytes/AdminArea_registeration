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
  <h3>User Login</h3>

  
<?php
  $serverName = "localhost";  
  $userName = "root";  
  $password = "";  
  $databaseName = "final_project";

  $fieldSize = 30;


  try {
    $conn = new PDO("mysql:host=$serverName;dbname=$databaseName", $userName, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_POST["login"])) {
      $tableUsername = $_POST["table_username"];  
      $password = $_POST["password"];

      $userQueryString = "SELECT * FROM users WHERE username = ?";
      $userQuery = $conn->prepare($userQueryString);
      $userQuery->bindParam(1, $tableUsername);
      $userQuery->execute();
      $userQueryResult = $userQuery->setFetchMode(PDO::FETCH_ASSOC);
      
      $user = $userQuery->fetch();

      //verify password
      if(password_verify($password, $user["password"])){
        session_start();
        echo 'Hello, '.$_SESSION["username"];
        echo '<br />Now you can access these pages: ';
        
        echo '<br />';
        
        $_SESSION["username"] = "a";
        $_SESSION["authenticated"] = true;

        echo '<br /> <div class="row">';
        echo '<div class="col-sm-4">';
        echo '<a href="customers-records.php" type="button" class="btn btn-info ">Customers</a>';
        echo '</div>';
        echo '<div class="col-sm-4">';
        echo '<a href="user-records.php" type="button" class="btn btn-info ">Users</a>';
        echo '</div>';
        echo '<div class="col-sm-4">';
        echo '<a href="" type="button" class="btn btn-info ">Info</a>';
        echo '</div>';
        echo '</div><br />';
 
      }
      
      else{
        echo "passwords do not match!";
      }
    }  // end isset user login
   

  }  // end try
  catch (PDOException $e) {
    echo '<br />  $e (toString()): '.$e;
    echo '<br />  $e->getMessage(): '.$e->getMessage();
    echo '<br />$e->getCode(): '.$e->getCode();
  } // end catch

?>




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
        <td colspan="2">
          <input type="submit" class="btn btn-primary" name="login" value="Login" />
        </td>
      </tr>
    </table>
  </form>


</body>
</html>