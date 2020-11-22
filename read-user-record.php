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
    
   $userId = ""; 
   $userName = "";
   $userTime= "";

   $serverName = "localhost"; 
   $userName = "root"; 
   $password = ""; 
   $databaseName = "final_project";

try{
    $conn = new PDO("mysql:host=$serverName;dbname=$databaseName", $userName, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //update one records
    if(isset($_POST["updateRecord"])){
        $userName = htmlspecialchars($_POST["username"]);
        $userTime = htmlspecialchars($_POST["user_created_time"]);

        $updateQueryString = "UPDATE users SET username = ?, user_created_time = ?";
        $updateQueryString.= " WHERE user_id = ?";
        $updateQuery = $conn->prepare($updateQueryString);
        $updateQuery->bindParam(1, $userId);
        $updateQuery->bindParam(2, $userTime);
        $updateQuery->execute();

    }     
    else{
        $userId = htmlspecialchars($_GET['id']);
    }// end isset updateRecord
    
    //delete one records
    if(isset($_POST["deleteRecord"])){
        $userId = htmlspecialchars($_POST["user_id"]);
         
        $deleteQueryString = "DELETE FROM users WHERE";
        $deleteQueryString.= " user_id= ?";
        $deleteQuery = $conn->prepare($deleteQueryString);
        $deleteQuery->bindParam(1, $userId);
        $deleteQuery->execute();
    } 
    else{
        $customerId = htmlspecialchars($_GET['id']);
    }// end isset deleteRecord

    if(isset($_GET["id"])){
      
      $userId = htmlspecialchars($_GET["id"]);
      $selectQuery = "SELECT * FROM users WHERE user_id = " .$userId;
      echo $selectQuery;
  
      $query = $conn->prepare($selectQuery);
      $query->execute();
    
      $result = $query->setFetchMode(PDO::FETCH_ASSOC);
      $users = $query->fetch();

      if(!empty($users)){
        $userName = $users["username"];
        $userTime = $users["user_created_time"];
      }
    else{
        echo "<br />user record not found!";
      } 
    }

    $userName = $users["username"];
    $userTime = $users["user_created_time"];

 ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
    <table>
      <tr>
<div class="form-group 8">
    <input type="hidden" class="form-control" name="customer_id" value="<?php echo htmlspecialchars($userId); ?>" />
    <td>
    <label for="customer__name">Username:</label>
  </td>
  <td>
    <input type="text" id="username" class="form-control" name="username" value="<?php echo $userName ?>" />
  </td>
  </tr>
  <tr>
</div>
  <div class="form-group">
  <td>  
  <label for="customer__address">User Creation Time:</label>
  </td>
  <td>
    <input type="text" id="user_created_time" class="form-control" name="user_created_time" value="<?php echo $userTime ?>" />
  </td>
    </div>
  </tr>
            <tr>
              <td>
    <input type="submit" class="btn btn-primary" name="updateRecord" value="Update Record">
            </td>
    <br />
    <td>
    <input type="submit" class="btn btn-danger" name="deleteRecord" value="Delete Record">
            </td>
    <br />
            </tr>
            </table>
    </form>
    
    <a href="user-records.php">Back to records</a>

    <?php


    }
    catch(PDOException $e){
      echo "<br />Could not establish database connection.";
    }

  ?>

</body>
</html>