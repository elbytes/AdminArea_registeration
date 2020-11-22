<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">

  <title>Create New Customer</title>
  <meta charset="utf-8">

</head>

<body>
<?php require("navbar.html"); ?>

<?php

  try {

    $servername = "localhost";  
    $username = "root";
    $password = "";
    $dbname = "final_project";
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      

      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Connected successfully";


      // Debug
      define('DEBUG_FIELD_SIZE', 100);
      define('PRODUCTION_FIELD_SIZE', 30);

      
      // set this with one of the above values:
     $fieldSize = DEBUG_FIELD_SIZE;

      $customerId = ""; 
      $customerName = "";
      $customerAddress= "";
      $customerCity = "";
      $customerStatus = ""; 

      $statusArray = array("0", "1");  

      if(isset($_POST['insert_record'])) {
        $customerName = htmlspecialchars($_POST['customer_name']);
        $customerAddress = htmlspecialchars($_POST['customer_address']);
        $customerCity = htmlspecialchars($_POST['customer_city']);
        $customerStatus = htmlspecialchars($_POST['customer_status']);

        $insertQueryString = "INSERT INTO customers";
        $insertQueryString.= " (customer_name, customer_address, customer_city, customer_status)";
        $insertQueryString.= " VALUES(?,?,?,?)";

        $insertQuery = $conn->prepare($insertQueryString);

        $bindParamCounter =1;

        $insertQuery->bindParam($bindParamCounter++, $customerName);
        $insertQuery->bindParam($bindParamCounter++, $customerAddress);
        $insertQuery->bindParam($bindParamCounter++, $customerCity);
        $insertQuery->bindParam($bindParamCounter++, $customerStatus);

        $insertQuery->execute();
      }//end isset insert

  require("customer-form.php");
  ?>

  

<a href="customers-records.php">Back to records</a>

  <?php
      }
  catch(PDOException $e)
      {
      echo "Connection failed: " . $e->getMessage();
      }
 ?>

</body>
</html>
