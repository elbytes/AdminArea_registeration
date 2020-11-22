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
  session_start();
   
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
        
          $_SESSION["username"] = $tableUsername;
          $_SESSION["authenticated"] = true;

         
        }//end if password_verify
      else{
        echo "password and username do not match!";
      }
      if($_SESSION["authenticated"] === true){
        echo 'Hello, '.$_SESSION["username"];
        echo '<br />Now you can access these pages: ';
        
        echo '<br />';
       header("Location: user-landing.php"); 
      }
    }  // end if isset user login
  }  // end try
  catch (PDOException $e) {
    echo '<br />  $e (toString()): '.$e;
    echo '<br />  $e->getMessage(): '.$e->getMessage();
    echo '<br />$e->getCode(): '.$e->getCode();
  } // end catch
?>


<div class="container-fluid">
    <div class="row">
      <div class="col-sm-6" >
    </div>
    </div>
    <br>
    <div class="row">
      <div class="col-sm-4" ></div>
      <div class="col-sm-4" >
      <div class="card" style="width:400px">
  <img class="card-img-top" src="img_avatar1.png" alt="Card image" style="padding: 1em 1em;">
  <div class="card-body">
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
       
        <td colspan="4">
        <br />
          <input type="submit" class="btn btn-primary btn-lg" style="display: block;  margin-left: auto; margin-right: auto;" name="login" value="Login" />
        </td>
      </tr>
    </table>
  </form>
      </div>
      </div>
      </div>

  </div>


  

</body>
</html>
