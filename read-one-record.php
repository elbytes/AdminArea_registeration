<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <style type="text/css">
    ol {
      margin:1em;
      width:70%;
    }
    pre {
      border: 1px solid black;
      margin: 1em 0;
    }
    body {
      padding: 1em;
      background-color: #282828 ;
      color: #eff7fe;
    }
 
    .form-control{
        margin: 1em;
    }
  </style>

  <title>PHP</title>
  <meta charset="utf-8">

</head>

<body>

  <h2>Read one record / Edit / Delete</h2>

  <?php

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

    }     // end isset updateRecord
    else{
        $customerId = htmlspecialchars($_GET['id']);
    }
    
    //delete one records
    if(isset($_POST["deleteRecord"])){

    } // end isset deleteRecord



    $selectQuery = "SELECT * FROM customers WHERE customer_id = " .$customerId;
    echo $selectQuery;

    $query = $conn->prepare($selectQuery);
    $query->execute();
  
    $result = $query->setFetchMode(PDO::FETCH_ASSOC);


    $customers = $query->fetch();

    if(!empty($customers)){
        $customerName = $customers["customer_name"];
        $customerAddress = $customers["customer_address"];
        $customerCity = $customers["customer_city"];
        $customerStatus = $customers["customer_status"];
    }
    else{
        echo "<br />customer record not found!";
    }


    $customerName = $customers["customer_name"];
    $customerAddress = $customers["customer_address"];
    $customerCity = $customers["customer_city"];
    $customerStatus = $customers["customer_status"];
 ?>
    <form class="form-inline" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
<div class="form-group">
    
    <input type="hidden" class="form-control" name="customer_id" value="<?php echo htmlspecialchars($customerId); ?>" />

    <label for="customer__name">Customer Name:</label>
    <input type="text" id="customer__name" class="form-control" name="customer_name" value="<?php echo $customerName ?>" />
</div>
  <div class="form-group">
    <label for="customer__address">Customer Address:</label>
    <input type="text" id="customer__address" class="form-control" name="customer_address" value="<?php echo $customerAddress ?>" />
    </div>
  <div class="form-group">
    <label for="customer__city">Customer City:</label>
    <input type="text" id="customer__city" class="form-control" name="customer_city" value="<?php echo $customerCity ?>" />
    </div>
  <div class="form-group">
    <label for="customer__status">Customer Status:</label>
    <select class="form-control form-control-sm" name="customer_status" id="customer_status">
    <?php
              foreach($statusArray as $value){
                echo '<option value="'.$value.'">'.$value.'</option>';
              }           
            ?>
    </div>
    <input type="submit" class="btn btn-primary" name="updateRecord" value="Update Record">
    <br />
    <input type="submit" class="btn btn-danger" name="deleteRecord" value="Delete Record">
    <br />
    </form>
    
    <a href="customers-records.php">Back to records</a>

    <?php

    
    }
    catch(PDOException $e){
      echo "<br />Could not establish database connection.";
    }

  ?>


  

</body>
</html>