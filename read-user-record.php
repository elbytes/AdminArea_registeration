<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="styles.css">


  <title>One User Record</title>
  <meta charset="utf-8">

</head>

<body>
<?php require("navbar.html"); ?>
  <h2>Read user record / Edit / Delete</h2>

  <?php
   session_start();
   $userId = ""; 
   $userNameTable = "";
   $userTime= "";

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
      echo '<br /><p>To edit a record, click on the record ID</p>';
      echo '</div></div>';

    //update one records
    if(isset($_POST["updateRecord"])){
        $userId = htmlspecialchars($_POST["user_id"]);
        $userNameTable = htmlspecialchars($_POST["username"]);
        $updateQueryString = "UPDATE users SET username = ?";
        $updateQueryString.= " WHERE user_id = ?";
        $updateQuery = $conn->prepare($updateQueryString);
        $updateQuery->bindParam(1, $userNameTable);
        $updateQuery->bindParam(2, $userId);
        $updateQuery->execute();
        echo "username updated";
    }//end update user
      //delete user
    else if(isset($_POST["deleteRecord"])){
      $userId = htmlspecialchars($_POST["user_id"]);
      $deleteQueryString = "DELETE FROM users WHERE";
      $deleteQueryString.= " user_id= ?";
      $deleteQuery = $conn->prepare($deleteQueryString);
      $deleteQuery->bindParam(1, $userId);
      $deleteQuery->execute();
  } //end delete user
    else{
      $userId = htmlspecialchars($_GET['id']);
    }
        
    //read one user
    if(isset($_GET['id'])){
      $selectQueryString = "SELECT * FROM users WHERE user_id = ?";  
      $selectQuery = $conn->prepare($selectQueryString);
      $selectQuery->bindParam(1, $userId);
      $selectQuery->execute();
    
      $result = $selectQuery->setFetchMode(PDO::FETCH_ASSOC);
      $users = $selectQuery->fetch();
      if(!empty($users)){
        $userNameTable = $users["username"];
        $userTime = $users["user_created_time"];
        ?>
 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
   <table>
      <tr>
         <div class="form-group 8">
            <input type="hidden" class="form-control" name="user_id" value="<?php echo htmlspecialchars($userId); ?>" />
            <td>
               <label for="customer__name">Username:</label>
            </td>
            <td>
               <input type="text" id="username" class="form-control" name="username" value="<?php echo $userNameTable ?>" />
            </td>
      </tr>
      </div>
      <tr>
         <td>
            <input type="submit" class="btn btn-primary" name="updateRecord" value="Update Record" style="margin: 1em;">
         </td>
         <br />
         <td>
            <input type="submit" class="btn btn-danger" name="deleteRecord" value="Delete Record" style="margin: 1em;">
         </td>
         <br />
      </tr>
   </table>
</form>
<a href="user-records.php" type="button" class="btn btn-primary" style="float: right;">Back To Records</a>
<?php
      }//end if!empty
    else{
        echo "<br />user record not found!";
      } 
    } //end isset GET['id']
 ?>
   
    <?php

  }// end isset session
  else{
    echo "<br />Please login first!<br />";
    echo '<br /><a href="user-login.php" type="button" class="btn btn-primary" >Login</a>';
  }
}//end try
catch(PDOException $e){
  echo "<br />Could not establish database connection.";
}

?>

</body>
</html>