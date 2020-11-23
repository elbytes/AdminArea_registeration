<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="styles.css">


  <title>One Customer Record</title>
  <meta charset="utf-8">

</head>

<body>
<?php require("navbar.html"); ?>
  <h2>Read one record / Edit / Delete</h2>

  <?php
   session_start();
   $customerId = ""; 
   $customerName = "";
   $customerAddress= "";
   $customerCity = "";
   $customerStatus = "";

   $statusArray = array("0", "1");  

   $serverName = "localhost"; 
   $userName = "root"; 
   $password = ""; 
   $databaseName = "final_project";

try{
    $conn = new PDO("mysql:host=$serverName;dbname=$databaseName", $userName, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if($_SESSION["authenticated"] === true){
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
        $customerName = htmlspecialchars($_POST["customer_name"]);
        $customerAddress = htmlspecialchars($_POST["customer_address"]);
        $customerCity =htmlspecialchars($_POST["customer_city"]);
        $customerStatus = htmlspecialchars($_POST["customer_status"]);
        $customerId = htmlspecialchars($_POST["customer_id"]);

        $updateQueryString = "UPDATE customers SET customer_name = ?, customer_address = ?, customer_city= ?, customer_status=?";
        $updateQueryString.= " WHERE customer_id = ?";
        $updateQuery = $conn->prepare($updateQueryString);
        $updateQuery->bindParam(1, $customerName);
        $updateQuery->bindParam(2, $customerAddress);
        $updateQuery->bindParam(3, $customerCity);
        $updateQuery->bindParam(4, $customerStatus);
        $updateQuery->bindParam(5,$customerId);
        $updateQuery->execute();
    }     
    else{
        $customerId = htmlspecialchars($_GET['id']);
    }// end isset updateRecord
    
    //delete one records
    if(isset($_POST["deleteRecord"])){
        $customerId = htmlspecialchars($_POST["customer_id"]);
         
        $deleteQueryString = "DELETE FROM customers WHERE";
        $deleteQueryString.= " customer_id= ?";
        $deleteQuery = $conn->prepare($deleteQueryString);
        $deleteQuery->bindParam(1, $customerId);
        $deleteQuery->execute();
    } 
    else{
        $customerId = htmlspecialchars($_GET['id']);
    }// end isset deleteRecord

    if(isset($_GET["id"])){
      
      $customerId = htmlspecialchars($_GET["id"]);
      $selectQueryString = "SELECT * FROM customers WHERE customer_id = ?";
      $selectQuery = $conn->prepare($selectQueryString);
      $selectQuery->bindParam(1, $customerId);
      $selectQuery->execute();

      $result = $selectQuery->setFetchMode(PDO::FETCH_ASSOC);
      $customers = $selectQuery->fetch();
      if(!empty($customers)){
        $customerName = $customers["customer_name"];
        $customerAddress = $customers["customer_address"];
        $customerCity = $customers["customer_city"];
        $customerStatus = $customers["customer_status"];
      }
    else{
        echo "<br />customer record not found!";
      } 
    }

    $customerName = $customers["customer_name"];
    $customerAddress = $customers["customer_address"];
    $customerCity = $customers["customer_city"];
    $customerStatus = $customers["customer_status"];

    require("customer-form.php");
 ?>
   
  
  <a href="customers-records.php" type="button" class="btn btn-primary" style="float: right;">Back To Records</a>


    <?php

    }
    else{
      echo "<br />Please login first!<br />";
      echo '<br /><a href="user-login.php" type="button" class="btn btn-primary" >Login</a>';
    }
    }
    catch(PDOException $e){
      echo "<br />Could not establish database connection.";
    }

  ?>

</body>
</html>